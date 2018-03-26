Contact 
<hr>

<?=$wph_msg;?>
<form action="<?=u('contact/');?>" method="POST">
	<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email" required><br>
	<input type="text" name="wph_nume_prenume" value="<?=$wph_nume_prenume;?>" placeholder="Nume si prenume" required><br>
	<input type="text" name="wph_subiect" value="<?=$wph_subiect;?>" placeholder="Subiect" required><br>
	<textarea name="wph_message" placeholder="Mesaj" required><?=$wph_message;?></textarea><br>
	<input type="submit" name="wph_contact" value="Trimite">
</form>