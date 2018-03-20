Login Page
<a href="<?=u('login/')?>"> Conectare </a>
<a href="<?=u('register/')?>"> Inregistrare </a>
<a href="<?=u('user/')?>"> Zona utilizator </a>
<a href="<?=u('logout/')?>"> Deconectare </a>

<hr>

<?=$wph_msg;?>
<form action="<?=u('login/');?>" method="POST">
	<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email">
	<input type="password" name="wph_password" value="<?=$wph_password;?>" placeholder="Parola">
	<input type="submit" name="wph_login" value="Conectare">
</form>