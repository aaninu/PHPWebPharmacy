Index Page
<a href="<?=u('cart/')?>"> Cos de cumparaturi </a> - 
<a href="<?=u('about/')?>"> About </a> - 
<a href="<?=u('contact/')?>"> Contact </a> - 
<a href="<?=u('find/')?>"> Cautare </a> - 
<a href="<?=u('products/')?>"> Lista cu produse </a>
<br>
<a href="<?=u('login/')?>"> Conectare </a> - 
<a href="<?=u('register/')?>"> Inregistrare </a> - 
<a href="<?=u('lost-password/')?>"> Ai uitat parola? </a>

<br>
<a href="<?=u('user/')?>"> Zona utilizator </a> - 
<a href="<?=u('logout/')?>"> Deconectare </a>
<hr>
<?PHP if (g_uType() == "ADMIN" or g_uType() == "PHARMACY"){ ?>
<a href="<?=u('admin/')?>"> Zona Admin </a>
<?PHP } ?>


