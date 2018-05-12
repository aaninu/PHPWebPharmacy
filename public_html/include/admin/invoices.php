<!DOCTYPE html>
<html>
	<head>
		<title>Lista comenzilor | Admin | <?=s('NAME');?></title>
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
						<li><a href="<?=u('admin/');?>">Administrare</a></li>
						<li><a href="<?=u('admin/products/');?>">Lista cu medicamente</a></li>
						<li class="last-child">Lista comenzilor</li>
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
							<div class="heading" style="background: #66b44d;">Admin - Lista comenzilor</div>
							<div class="biodata-text-more block_display">
							
<table id='cart_table_admin'>
	<tr>
		<th>Factura</th>
		<th>Cumparator</th>
		<th>Total de plata</th>
		<th>Data si ora comenzii</th>
		<th>Status comanda</th>
		<th>Modifica</th>
	</tr>
	
<?PHP
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." ORDER BY id DESC LIMIT $startWith,$itemPage;")){
		while ($info=mysqli_fetch_object($dbcon)){ 
?>
	<tr>
		<td><a href="<?=u('invoice/'.sMyID($info->id).'/');?>">#<?=s('INVOICE').$info->id;?></a></td>
		<td><?=db_gINFO_user($info->i_user)[0];?></td>
		<td><?=db_gTOTAL_invoice($info->id);?></td>
		<td><?=date("d-m-Y (H:i)", $info->d_comanda);?></td>
		<td <?PHP if($info->s_status == "CANCELED"){ echo 'colspan="2"'; } ?>>
			<?PHP if ($info->s_status == "PAID"){ if ($info->s_comanda == "OK"){ ?>
			Comanda a fost ridicata.
			<?PHP }else{ ?> 
			Comanda inca nu a fost ridicata.
			<?PHP } }elseif($info->s_status == "UNPAID"){ ?>
			Comanda este in asteptarea platii. 
			<?PHP }else{ ?>
			Comanda a fost anulata.
			<?PHP }?>
		</td>
		<?PHP if($info->s_status != "CANCELED"){ ?><td><a href="<?=u('admin/invoice-edit/'.sMyID($info->id).'/');?>">Modifica</a></td><?PHP } ?>
	</tr>
<?PHP
		}
	}
?>
</table>
				<div class="pagination no_margin_bottom">
					<a href="<?=u('admin/invoices/');?>" class="">Prima</a>
<?PHP $page = 1; $pageI = 0; while($pageI < $totalProd){ ?>
					<a href="<?=u('admin/invoices/'.sMyID($page).'/');?>" class="<?=($pageNum==$page)?"current":"";?>"><?=$page;?></a>
<?PHP $pageI += $itemPage; $page++; } ?>
					<a href="<?=u('admin/invoices/'.sMyID($lastPage).'/');?>" class="">Ultima</a>
				</div>

							</div>
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
