<!DOCTYPE html>
<html>
	<head>
		<title>Modifica statusul unei comenzi | Admin | <?=s('NAME');?></title>
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
						<li><a href="<?=u('admin/invoices/');?>">Lista Comenzilor</a></li>
						<li>Modifica statusul unei comenzi</li>
						<li class="last-child"><a href="<?=u('invoice/'.p(3).'/');?>">Factura <?='#'.s('INVOICE').$invID;?></a></li>
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
							<div class="heading" style="background: #66b44d;">Admin - Modifica statusul comenzii</div>
							<div class="biodata-text-more block_display">
								<?PHP if($invSTATUS == "CANCELED"){ echo "<font color='red'><b>Aceasta comanda a fost anulata!</b></font>"; }else{ ?>
								<form action="<?=u("admin/invoice-edit/".p(3)."/");?>" method="POST" enctype="multipart/form-data">
									<table id='cart_table_admin'>
										<tr>
											<td>Status plata:</td>
											<td>
												<select name="wph_s_status" style="margin-bottom:  0px;width: 97%;">
													<option value="0">Status plata</option>
													<option value="1" <?=($invSTATUS == "PAID")?"selected":"";?>>Platita</option>
													<option value="2" <?=($invSTATUS == "UNPAID")?"selected":"";?>>In asteptarea platii</option>
													<option value="3" <?=($invSTATUS == "CANCELED")?"selected":"";?>>Anulata</option>
												</select>
											</td>
										</tr>
										<?PHP if ($invSTATUS == "PAID" and $invORDER == "OK"){}else{?>
										<tr>
											<td>Status ridicare comanda:</td>
											<td>
												<select name="wph_s_comanda" style="margin-bottom:  0px;width: 97%;">
													<option value="0"> Status ridicare comanda </option>
													<option value="1" <?=($invORDER == "OK")?"selected":"";?>>Comanda ridicata</option>
													<option value="2" <?=($invORDER == "WAIT")?"selected":"";?>>Comanda in asteptare</option>
												</select>
											</td>
										</tr>
										<?PHP } ?>
										<tr>
											<td>Informatii extra:</td>
											<td>
												<input type="text" name="wph_info" value="<?=$wph_info;?>" placeholder="Informatii extra" style="margin-bottom:  0px;width: 97%;"> 
											</td>
										</tr>
										<tr>	
											<td colspan="2">
												<center>
													<input class="button" style="background-color: #66b44d;" name="wph_editinvoice" type="submit" value="Salveaza modificarile">
												</center>
											</td>
										</tr>
									</table>
								</form>
								<?PHP } ?>
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
