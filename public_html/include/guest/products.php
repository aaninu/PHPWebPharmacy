Lista produselor cu paginare
<hr>

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
	</tr>
	
<?PHP
	$pos = 0;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." ORDER BY id ASC;")){
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
		<td><?=$info->s_imagine;?></td>
		<td><?=$info->i_views;?></td>
	</tr>
<?PHP
		}
	}
?>
</table>