<!DOCTYPE html>
<html>
	<head>
		<title>Despre Noi | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a href="<?=u('about/');?>">Despre Noi</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<h3> Despre Noi</h3>
				<p> <?=nl2br(db_gINFO_tag('about'));?> </p>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
