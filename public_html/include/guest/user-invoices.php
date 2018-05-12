<!DOCTYPE html>
<html>
	<head>
		<title>Contul Meu | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a href="<?=u('user/');?>">Contul Meu</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<div class="sidebar">
					<div class="block">
						<h2>Optiuni</h2>
						<div class="categories">
							<ul>
								<li><a href="<?=u('user/');?>">Contul Meu</a></li>
								<li><a href="<?=u('user-password/');?>">Schimba parola</a></li>
								<li><a href="<?=u('user-invoices/');?>">Comenzile mele</a></li>
								<li><a href="<?=u('user-settings/');?>">Setarile contului</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="left_contents">
					<div class="accord">
						<div class="block">
							<div class="heading">Comenzile mele</div>
							<div class="biodata-text-more block_display">
								<table id="cart_table">
									<tr>
										<th>Factura</th>
										<th>Total de plata</th>
										<th>Data si ora comenzii</th>
										<th>Status comanda</th>
									</tr>
									
								<?PHP
									if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE i_user = '".g_uID()."' ORDER BY id DESC;")){
										while ($info=mysqli_fetch_object($dbcon)){ 
								?>
									<tr>
										<td><a href="<?=u('invoice/'.sMyID($info->id).'/');?>"><?=s('INVOICE').$info->id;?></a></td>
										<td><?=db_gTOTAL_invoice($info->id);?></td>
										<td><?=date("d-m-Y (H:i)", $info->d_comanda);?></td>
										<td>
											<?PHP if ($info->s_status == "PAID"){ if ($info->s_comanda == "OK"){ ?>
											Comanda a fost ridicata.
											<?PHP }else{ ?> 
											Comanda inca nu a fost ridicata.
											<?PHP } }elseif($info->s_status == "UNPAID"){ ?>
											Comanda este in asteptarea platii. <a href="<?=u('invoice/'.sMyID($info->id).'/');?>">Plateste.</a>
											<?PHP }else{ ?>
											Comanda a fost anulata.
											<?PHP }?>
										</td>
									</tr>
								<?PHP
										}
									}
								?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
