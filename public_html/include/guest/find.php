Cauta in platforma
<hr>



<form action="<?=u('find/');?>" method="POST">
  <input type="search" name="wph_search_value" value="<?=$wph_search_value;?>" placeholder="Ce doriti sa cautati?">
	<select name="wph_search_sortare" placeholder="Sortare" title="Sortare">
		<option value="0">Sortare dupa ...</option>
		<option value="DATE_ASC" <?=(p(2)=="DATE_ASC")?"selected":"";?>>Sorteaza dupa data publicarii (ascendent)</option>
		<option value="DATE_DESC" <?=(p(2)=="DATE_DESC")?"selected":"";?>>Sorteaza dupa data publicarii (descendent)</option>
		<option value="PRET_ASC" <?=(p(2)=="PRET_ASC")?"selected":"";?>>Sorteaza dupa pret (ascendent)</option>
		<option value="PRET_DESC" <?=(p(2)=="PRET_DESC")?"selected":"";?>>Sorteaza dupa pret (descendent)</option>
		<option value="VIEW_ASC" <?=(p(2)=="VIEW_ASC")?"selected":"";?>>Sorteaza dupa vizualizari (ascendent)</option>
		<option value="VIEW_DESC" <?=(p(2)=="VIEW_DESC")?"selected":"";?>>Sorteaza dupa vizualizari (descendent)</option>
	
	</select>
  <input type="submit" value="Cautare" name="wph_search"> 
</form>

<?=$wph_msg;?>
<hr>

<?PHP
	if (gSEARCH()){
		echo "Rezultatele cautarii:<br>";
?>
<table border=1>
	<tr>
		<th>#</th>
		<th>Denumire</th>
		<th>Pret</th>
		<th>Moneda</th>
		<th>Cantitate</th>
		<th>Tip medicament</th>
		<th>Imagine</th>
		<th>Vizualizari</th>
		<th>Cumpara</th>
	</tr>
	
<?PHP
	$pos = 0;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE s_nume LIKE '%".gSEARCH()."%' OR s_descriere LIKE '%".gSEARCH()."%' OR s_Tip LIKE '%".gSEARCH()."%' OR s_Mod LIKE '%".gSEARCH()."%' ".tSEARCH(p(2)).";")){
		while ($info=mysqli_fetch_object($dbcon)){ 
			$pos++;
?>
	<tr>
		<td><?=$pos;?></td>
		<td><a href="<?=u('product/'.sMyID($info->id).'/');?>"><?=$info->s_nume;?></td>
		<td><?=$info->s_pret;?></td>
		<td><?=$info->s_moneda;?></td>
		<td><?=$info->i_cantitate;?></td>
		<td><?=$info->s_Tip;?></td>
		<td><img src="<?=$info->s_imagine;?>" width="150" height="100"></td>
		<td><?=$info->i_views;?></td>
		<td><a href="<?=u('cart-add/'.sMyID($info->id).'/');?>">Cumpara</td>
	</tr>
<?PHP
		}
	}
?>
</table>
<?PHP
	}else{
		echo "Ce doriti sa cautati?";
	}
?>