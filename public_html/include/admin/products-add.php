<!DOCTYPE html>
<html>
	<head>
		<title>Adauga un medicament | Admin | <?=s('NAME');?></title>
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
						<li class="last-child"><a href="<?=u('admin/products-add/');?>">Adauga un medicament</a></li>
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
							<div class="heading" style="background: #66b44d;">Admin - Adauga un medicament</div>
							<div class="biodata-text-more block_display">
								<form action="<?=u("admin/products-add/");?>" method="POST" enctype="multipart/form-data">
									<table id='cart_table_admin'>
										<tr>
											<td>Denumire:</td>
											<td>
												<input type="text" name="wph_s_nume" value="<?=$wph_s_nume;?>" placeholder="Denumire" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>
										<tr>
											<td>Pret:</td>
											<td>
												<input type="text" name="wph_s_pret" value="<?=$wph_s_pret;?>" placeholder="Pret" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>
										<tr>
											<td>Alege moneda:</td>
											<td>
												<select name="wph_s_moneda" style="margin-bottom:  0px;width: 97%;" required>
													<option value="0"> Alege moneda </option>
													<option value="RON" <?=($wph_s_moneda=="RON")?"selected":""?>>RON</option>
													<option value="EURO" <?=($wph_s_moneda=="EURO")?"selected":""?>>EURO</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>Cantitate:</td>
											<td>
												<input type="text" name="wph_i_cantitate" value="<?=$wph_i_cantitate;?>" placeholder="Cantitate" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>
										<tr>
											<td>Redurece (%):</td>
											<td>
												<input type="text" name="wph_i_reducere" value="<?=$wph_i_reducere;?>" placeholder="Redurece (%)" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>
										<tr>
											<td>Descriere:</td>
											<td>
												<textarea rows="5" name="wph_s_descriere" style="margin-bottom:  0px;width: 97%;" placeholder="Descriere" required><?=$wph_s_descriere;?></textarea>
											</td>
										</tr>
										<tr>
											<td>Tipul medicamentului:</td>
											<td>
												<input type="text" name="wph_s_Tip" value="<?=$wph_s_Tip;?>" placeholder="Tipul medicamentului" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>
										<tr>
											<td>Mod de administrare:</td>
											<td>
												<textarea rows="5" name="wph_s_Mod" style="margin-bottom:  0px;width: 97%;" placeholder="Mod de administrare" required><?=$wph_s_Mod;?></textarea>
											</td>
										</tr>
										<tr>
											<td>Data expirarii:</td>
											<td>
												<input type="date" name="wph_d_expirare" value="<?=$wph_d_expirare;?>" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>
										<tr>
											<td>Imagine specifica:</td>
											<td>
												<input type="file" name="wph_image" id="wph_image" required>
											</td>
										</tr>
										<tr>	
											<td colspan="2">
												<center>
													<input class="button" style="background-color: #66b44d;" name="wph_addproduct" type="submit" value="Adauga produsul">
												</center>
											</td>
										</tr>
									</table>
								</form>
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
