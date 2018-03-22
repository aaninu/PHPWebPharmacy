Lista produselor 

<hr>

<table border=1>
	<tr>
		<th>#</th>
		<th>Autor</th>
		<th>Denumire</th>
		<th>Pret</th>
		<th>Moneda</th>
		<th>Reducere</th>
		<th>Cantitate</th>
		<th>Descriere</th>
		<th>Tip medicament</th>
		<th>Mod de administrare</th>
		<th>Imagine</th>
		<th>Data expirarii</th>
		<th>Data publicarii</th>
		<th>Data ultimei modificari</th>
		<th>Vizualizari</th>
	</tr>
	
<?PHP
	$pos = 0;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." ORDER BY id ASC;")){
		while ($info=mysqli_fetch_object($dbcon)){ 
			$pos++;
?>
	<tr>
		<td><?=$pos;?></td>
		<td><?=$info->i_user;?></td>
		<td><?=$info->s_nume;?></td>
		<td><?=$info->s_pret;?></td>
		<td><?=$info->s_moneda;?></td>
		<td><?=$info->s_reducere;?></td>
		<td><?=$info->i_cantitate;?></td>
		<td><?=$info->s_descriere;?></td>
		<td><?=$info->s_Tip;?></td>
		<td><?=$info->s_Mod;?></td>
		<td><img src="<?=$info->s_imagine;?>" width="150" height="100"></td>
		<td><?=$info->d_expirare;?></td>
		<td><?=$info->d_public;?></td>
		<td><?=$info->d_edit;?></td>
		<td><?=$info->i_views;?></td>
	</tr>
<?PHP
		}
	}
?>
</table>