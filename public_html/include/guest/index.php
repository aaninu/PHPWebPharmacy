Index Page
<a href="<?=u('products/')?>"> Lista cu produse </a>
<a href="<?=u('login/')?>"> Conectare </a>
<a href="<?=u('register/')?>"> Inregistrare </a>
<a href="<?=u('user/')?>"> Zona utilizator </a>
<a href="<?=u('logout/')?>"> Deconectare </a>
<hr>
<?PHP if (g_uType() == "ADMIN" or g_uType() == "PHARMACY"){ ?>
<a href="<?=u('admin/')?>"> Zona Admin </a>
<?PHP } ?>