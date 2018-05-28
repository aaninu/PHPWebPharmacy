<!DOCTYPE html>
<html>
	<head>
		<title>Rapoarte de vanzari | Admin | <?=s('NAME');?></title>
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
						<li class="last-child"><a href="<?=u('admin/reports/');?>">Rapoarte de vanzari</a></li>
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
							<div class="heading" style="background: #66b44d;">Rapoarte de vanzari</div>
							<div class="biodata-text-more block_display">
								<form action="<?=u("admin/reports/");?>" method="POST">
									<table id='cart_table_admin'>
										<tr>
											<td>Data de inceput:</td>
											<td>
												<input type="date" name="wph_d_start" value="<?=$wph_d_start;?>" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>								
										<tr>
											<td>Data de sfarsit:</td>
											<td>
												<input type="date" name="wph_d_stop" value="<?=$wph_d_stop;?>" style="margin-bottom:  0px;width: 97%;" required> 
											</td>
										</tr>								
										
										<tr>	
											<td colspan="2">
												<center>
													<input class="button" style="background-color: #66b44d;" name="wph_get" type="submit" value="Genereaza raport">
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
