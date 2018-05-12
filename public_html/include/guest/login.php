<!DOCTYPE html>
<html>
	<head>
		<title>Conectare | <?=s('NAME');?></title>
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
						<li class="last-child"><a href="<?=u('login/');?>">Conectare</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<h3>Conectare </h3>
				<?=($wph_msg)?"<hr><b>".$wph_msg."</b><hr><br>":"";?>
				<form action="<?=u('login/');?>" method="POST">
					<div>
						<label>Adresa de email:*</label><br>
						<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email" style="width: 250px;" required>
					</div>
					<div>
						<label>Parola:*</label><br>
						<input type="password" name="wph_password" value="<?=$wph_password;?>" placeholder="Parola" style="width: 250px;" required>
					</div>
					<div>
						<input type="submit" name="wph_login" class="button" value="Conectare"> | 
						<a class="button" href="<?=u('register/');?>">Inregistrare</a> | 
						<a class="button" href="<?=u('lost-password/');?>">Parola uitata</a>
					</div>
				</form>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
