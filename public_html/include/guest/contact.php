<!DOCTYPE html>
<html>
	<head>
		<title>Contact | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a href="<?=u('contact/');?>">Contact</a></li>
					</ul>
				</div>
			</div>
			<div class="container">
				<div id="contents_area">
					<div class="contents">
						<div class="block last">
							<div class="heading">Formular de contact</div>
							<p><?=$wph_msg;?></p>
							<div class="comment_form">
								<form action="<?=u('contact/');?>" method="POST">
									<input type="text" name="wph_nume_prenume" class="text_short name" value="<?=$wph_nume_prenume;?>" placeholder="Nume si prenume" required>
									<input type="text" name="wph_email" class="text_short email" value="<?=$wph_email;?>" placeholder="Adresa de email" required>
									<label><b>Subiect:</b></label><br>
									<input type="text" name="wph_subiect" class="text subject" value="<?=$wph_subiect;?>" placeholder="Subiect" required><br>
									<label><b>Mesaj:</b></label><br>
									<textarea name="wph_message" placeholder="Mesaj" required><?=$wph_message;?></textarea><br>
									<input type="submit" name="wph_contact" value="Trimite" class="button">
									<input type="reset" class="button" value="Resetare" />
								</form>
							</div>
						</div>
					</div>
				</div>
				<div id="side_bar">
					<div class="block">
						<h2>Informatii de contact</h2>
						<div class="archive"><ul><li><a>Adresa</a></li></ul></div>
						<div class="categories"><ul><li><a><?=s('ADRESA');?></a></li></ul></div>
						<hr>
						<div class="archive"><ul><li><a>Telefon</a></li></ul></div>
						<div class="categories"><ul><li><a><?=s('PHONE');?></a></li></ul></div>
						<hr>
						<div class="archive"><ul><li><a>Email</a></li></ul></div>
						<div class="categories"><ul><li><a><?=s('EMAIL_PUBLIC');?></a></li></ul></div>
						<hr>
						<div class="archive"><ul><li><a>Website</a></li></ul></div>
						<div class="categories"><ul><li><a><?=s('URL');?></a></li></ul></div>
						<hr>
					</div>
				</div>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
