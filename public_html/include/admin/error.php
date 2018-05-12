<!DOCTYPE html>
<html>
	<head>
		<title>Pagina nu exista | Admin | <?=s('NAME');?></title>
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
						<li class="last-child"><a>Pagina nu exista</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<div class="sidebar">
					<div class="block">
						<h2>Optiuni</h2>
						<div class="categories">
							<ul>
								<li><a href="<?=u('admin/');?>">Administrare</a></li>
								<li><a href="<?=u('admin/products/');?>">Lista cu medicamente</a></li>
								<li><a href="<?=u('admin/products-add/');?>">Adauga un medicament</a></li>
								<li><a href="<?=u('admin/invoices/');?>">Lista comenzilor</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="left_contents">
					<div class="accord">
						<div class="block">
							<div class="heading" style="background: #66b44d;">Admin - Pagina selectata nu exista</div>
							<div class="biodata-text-more block_display">
								<h1 style="font-size: 100px;"><?=substr(p(2), 0, 10);?></h1>
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
