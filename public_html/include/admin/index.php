<!DOCTYPE html>
<html>
	<head>
		<title>Admin | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
		<link href="<?=u('public/toast/css/jquery.toast.css');?>" rel="stylesheet">
		<script>
			var t_title = "<?=$msgTitle;?>";
			var t_text = "<?=$msgError;?>";
			var t_icon = "<?=$msgIcon;?>";
		</script>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a href="<?=u('admin/');?>">Administrare</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<div class="sidebar">
					<div class="block">
						<h2>Optiuni</h2>
						<div class="categories">
							<?PHP include('./include/admin/dev/menu.php'); ?>
						</div>
					</div>
				</div>
				<div class="left_contents">
					<div class="accord">
						<div class="block">
							<div class="heading" style="background: #66b44d;">Administrare</div>
							<div class="biodata-text-more block_display">
								In progress
							</div>
<?PHP if($readError){ ?>
							<div class="heading" style="background: #ee948a;">Produse in cantitate sub limita impusa</div>
							<div class="biodata-text-more block_display">
								<table id="cart_table_admin">
									<thead>
										<tr>
											<th>#</th>
											<th>DENUMIRE</th>
											<th>BUC.</th>
											<th style="width: 100px;">PRET</th>
											<th>DATA EXPIRARII</th>
											<th>Modifica</th>
										</tr>
									</thead>
									<tbody>
<?PHP
	$pos = 0;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE i_cantitate <= '".s('LIM_CANT')."' ORDER BY id ASC;")){
		while ($info=mysqli_fetch_object($dbcon)){ 
			$pos++;
?>
										<tr>
											<td><?=$pos;?></td>
											<td class="txt-oflo"><a href="<?=u('admin/products-info/'.sMyID($info->id).'/');?>"><?=$info->s_nume;?></a></td>
											<td id="cce"><b><?=$info->i_cantitate;?></b></td>
											<td id="cce">
												<?PHP $newPRET = finalPRICE($info->s_pret, $info->s_reducere); $pret = round($info->s_pret,2); if ($newPRET != $pret){ echo "<del style='color:red;'>" .$pret.'</del> '.$newPRET. ' '.$info->s_moneda; }else{ echo $pret.' '.$info->s_moneda; }?>
											</td>
											<td id="cce"><?=date("d-m-Y", $info->d_expirare);?></td>
											<td><a href="<?=u('admin/products-edit/'.sMyID($info->id).'/');?>">Modifica</a></td>
										</tr>
<?PHP } } ?>
									</tbody>
								</table>
							</div>
<?PHP } ?>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
		<script src="<?=u('public/toast/js/jquery.toast.js');?>"></script>
		<script src="<?=u('public/toast/js/toast.js');?>"></script>
	</body>
</html>
