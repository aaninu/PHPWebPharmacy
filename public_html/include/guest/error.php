<!DOCTYPE html>
<html>
	<head>
		<title>Pagina nu exista | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a>Pagina nu exista</a></li>
					</ul>
				</div>
			</div>
			<br><br>
			<center>
				<h1>Pagina nu exista!</h1>
				<h1 style="font-size: 100px;"><?=substr(p(1), 0, 10);?></h1>
				<h1>Pagina nu exista!</h1>
			</center>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
