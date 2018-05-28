<!DOCTYPE html>
<html>
	<head>
		<title>Importa medicamente | Admin | <?=s('NAME');?></title>
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
						<li class="last-child"><a href="<?=u('admin/imports/');?>">Importa medicamente</a></li>
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
							<div class="heading" style="background: #66b44d;">Importa medicamente</div>
							<div class="biodata-text-more block_display">
								<?=$msg_info;?>
								<form action="<?=u("admin/imports/");?>" method="POST" enctype="multipart/form-data">
									<table id='cart_table_admin'>
										<tr>
											<td>Important:</td>
											<td>
												<font color="red">
													*Dimensiunea maxima pentru imagini este de: <?=s('FILE_SIZE');?>MB;<br>
													*Extensiile acceptate pentru imagini sunt: "png", "jpg", "jpeg", "gif";<br>
													*Fisierul care contine informatiile trebuie sa fie in formatul XML;<br>
													*Se poate incarca un sigur fisier XML pe formular;<br>
													*Cand se doreste incarcarea in platforma, trebuie selectate toate fisierele (1 fisier XML si imaginile corespunzatoare);<br>
													*In cazul in care una dintre imagini nu a fost selectata, incarcarea va fi anulata;<br>
                                                    *Daca selectati imagini in plus, acestea vor fi ignorate.
												</font>
											</td>
										</tr>
										<tr>
											<td>Template:</td>
											<td>
												Fisierul in format XML: <a href="<?=u('public/template/Template.xml');?>" target="_xml">Tempate.xml</a> <br>
												Fisierul in format XLSX (Microsoft Excel): <a href="<?=u('public/template/Template.xlsx');?>" target="_xlsx">Tempate.xlsx</a>
											</td>
										</tr>
										<tr>
											<td>Incarca fisierele:</td>
											<td>
												<input name="upload[]" type="file" multiple="multiple" required />
											</td>
										</tr>								
										
										<tr>	
											<td colspan="2">
												<center>
													<input class="button" style="background-color: #66b44d;" name="wph_get" type="submit" value="Incarca medicamentele">
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
