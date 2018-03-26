Ai uitat parola?
<hr>


<?=$wph_msg;?>
<form action="<?=u('lost-password/');?>" method="POST">
	<input type="email" name="wph_email" value="<?=$wph_email;?>" placeholder="Adresa de email" required>
	<input type="submit" name="wph_lost_password" value="Reseteaza parola">
</form>