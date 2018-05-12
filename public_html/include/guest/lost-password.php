<!DOCTYPE html>
<html>
	<head>
		<title>Parola uitata | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li><a href="<?=u('user/');?>">Contul Meu</a></li>
						<li class="last-child"><a href="<?=u('lost-password/');?>">Parola uitata</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<h3>Parola uitata </h3>
				<?=($wph_msg)?"<hr><b>".$wph_msg."</b><hr><br>":"";?>
				<form action="<?=u('lost-password//');?>" method="POST">
					<div>
						<label>Adresa de email:*</label><br>
						<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email" style="width: 250px;" required>
					</div>
					<div>
						<input class="button" type="submit" name="wph_lost_password" value="Reseteaza parola"> | 
						<a class="button" href="<?=u('register/');?>">Inregistrare</a> | 
						<a class="button" href="<?=u('login/');?>">Conectare</a>
					</div>
				</form>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
