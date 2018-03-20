Adauga medicament nou 
<hr>

<form action="<?=u("admin/products-add/");?>" method="POST" enctype="multipart/form-data">
	<input type="text" name="wph_s_nume" value="<?=$wph_s_nume;?>" placeholder="Denumire" required> <hr>
	<input type="text" name="wph_s_pret" value="<?=$wph_s_pret;?>" placeholder="Pret" required>
	<select name="wph_s_moneda" required>
		<option value="0"> Alege moneda </option>
		<option value="RON" <?=($wph_s_moneda=="RON")?"selected":""?>>RON</option>
		<option value="EURO" <?=($wph_s_moneda=="EURO")?"selected":""?>>EURO</option>
	</select>
	<hr>
	<input type="text" name="wph_i_cantitate" value="<?=$wph_i_cantitate;?>" placeholder="Cantitate" required> <hr>
	<textarea name="wph_s_descriere" placeholder="Descriere" required><?=$wph_s_descriere;?></textarea><hr>
	<input type="text" name="wph_s_Tip" value="<?=$wph_s_Tip;?>" placeholder="Tipul medicamentului" required> <hr>
	<textarea name="wph_s_Mod" placeholder="Mod de administrare" required><?=$wph_s_Mod;?></textarea><hr>
	<input type="date" name="wph_d_expirare" value="<?=$wph_d_expirare;?>" placeholder="Data expirarii" required> <hr>
    Select image to upload:
    <input type="file" name="wph_image" id="wph_image" required> <hr>
    <input type="submit" name="wph_addproduct" value="Adauga medicamentul" >
</form>