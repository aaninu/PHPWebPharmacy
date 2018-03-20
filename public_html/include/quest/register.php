Register Page
<a href="<?=u('login/')?>"> Conectare </a>
<a href="<?=u('register/')?>"> Inregistrare </a>
<a href="<?=u('user/')?>"> Zona utilizator </a>
<a href="<?=u('logout/')?>"> Deconectare </a>

<hr>

<?=$wph_msg;?>
<form action="<?=u('register/');?>" method="POST">
	<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email">
	<input type="text" name="wph_nume" value="<?=$wph_nume;?>" placeholder="Nume">
	<input type="text" name="wph_prenume" value="<?=$wph_prenume;?>" placeholder="Prenume">
	<input type="password" name="wph_password" value="<?=$wph_password;?>" placeholder="Parola">
	<input type="text" name="wph_telefon" value="<?=$wph_telefon;?>" placeholder="Telefon">
	<input type="text" name="wph_adresa" value="<?=$wph_adresa;?>" placeholder="Adresa">
	
	<input type="submit" name="wph_register" value="Inregistrare">
</form>