<!DOCTYPE html>
<html>
	<head>
		<title>Setari generale | Admin | <?=s('NAME');?></title>
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
						<li><a href="<?=u('admin/settings/');?>">Administrare</a></li>
						<li class="last-child"><a href="<?=u('admin/');?>">Setari generale</a></li>
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
							<div class="heading" style="background: #66b44d;">Setari generale</div>
							<div class="biodata-text-more block_display">
								<form action="<?=u("admin/settings/");?>" method="POST">
									<table id='cart_table_admin'>
										<tr>
											<td>Reducere generala:</td>
											<td>
												<input type="text" name="wph_discount" value="<?=$wph_discount;?>" placeholder="Reducere generala" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>								
										<tr>
											<td>Despre noi:</td>
											<td>
												<textarea rows="5" name="wph_about" style="margin-bottom:  0px;width: 97%;" placeholder="Despre noi" required><?=$wph_about;?></textarea>
											</td>
										</tr>								
										<tr>
											<td>Cariere:</td>
											<td>
												<textarea rows="5" name="wph_carrers" style="margin-bottom:  0px;width: 97%;" placeholder="Cariere" required><?=$wph_carrers;?></textarea>
											</td>
										</tr>								
										<tr>
											<td>Rezervari & Plati:</td>
											<td>
												<textarea rows="5" name="wph_replati" style="margin-bottom:  0px;width: 97%;" placeholder="Rezervari & Plati" required><?=$wph_replati;?></textarea>
											</td>
										</tr>
										<tr>	
											<td colspan="2">
												<center>
													<input class="button" style="background-color: #66b44d;" name="wph_change" type="submit" value="Salveaza modificarile">
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
