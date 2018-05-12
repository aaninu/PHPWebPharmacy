<!DOCTYPE html>
<html>
	<head>
		<title>Inregistrare | <?=s('NAME');?></title>
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
						<li class="last-child"><a href="<?=u('register/');?>">Inregistrare</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<h3>Inregistrare </h3>
				<?=($wph_msg)?"<hr><b>".$wph_msg."</b><hr><br>":"";?>
				<form action="<?=u('register/');?>" method="POST">
					<div>
						<label>Adresa de email:*</label><br>
						<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email" style="width: 250px;" required>
					</div>
					<div>
						<label>Nume:*</label><br>
						<input type="text" name="wph_nume" value="<?=$wph_nume;?>" placeholder="Nume" style="width: 250px;" required>
					</div>
					<div>
						<label>Prenume:*</label><br>
						<input type="text" name="wph_prenume" value="<?=$wph_prenume;?>" placeholder="Prenume" style="width: 250px;" required>
					</div>
					<div>
						<label>Parola:*</label><br>
						<input type="password" name="wph_password" value="<?=$wph_password;?>" placeholder="Parola" style="width: 250px;" required>
					</div>
					<div>
						<label>Telefon:*</label><br>
						<input type="text" name="wph_telefon" value="<?=$wph_telefon;?>" placeholder="Telefon" style="width: 250px;" required>
					</div>
					<div>
						<label>Adresa:*</label><br>
						<input type="text" name="wph_adresa" value="<?=$wph_adresa;?>" placeholder="Adresa" style="width: 250px;" required>
					</div>
					<div>
						<input type="submit" name="wph_register" class="button" value="Inregistrare"> | 
						<a class="button" href="<?=u('login/');?>">Conectare</a> | 
						<a class="button" href="<?=u('lost-password/');?>">Parola uitata</a>
					</div>
				</form>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
