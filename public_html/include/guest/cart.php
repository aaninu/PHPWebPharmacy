Cos de cumparaturi
<hr>
	<a href="<?=u('cart-clear/');?>">Golest cosul de cumparaturi</a>
	<a href="<?=u('products/');?>">Continua cumparaturile</a>
<hr>
<?PHP 
	$aCART = gSESSION("wph_cart");
	if (count($aCART) and $aCART != ""){
		echo "<table border=1>";
		echo "<tr><th>#</th><th>Imagine</th><th>Denumire</th><th width='125'>Pret unitar</th><th>Cantitate</th><th>#</th><th width='125'>Total</th></tr>";
		$pos = 0;
		$total = 0;
		foreach($aCART as $id => $info){ 
			$pos++;
			$pret = db_gPRET_product($info[0]);
			$moneda = db_gMONEDA_product($info[0]);
			$to_pay = $pret*$info[1];
			$total += $to_pay;
?>
			<tr>
				<td><?=$pos;?></td>
				<td><img src="<?=db_gIMAGE_product($info[0]);?>" width="50" height="50"></td>
				<td><?=db_gNAME_product($info[0]);?></td>
				<td style="text-align: center;"><?=$pret." ".$moneda;?></td>
				<td>
					<input type='text' value='<?=$info[1];?>' style="width: 35px;text-align: center;" readonly>
					<a href="<?=u('cart-add/'.sMyID($info[0]).'/1/D/');?>"><button>-</button></a>
					<a href="<?=u('cart-add/'.sMyID($info[0]).'/1/');?>"><button>+</button></a>
				</td>
				<td><a href='<?=u('cart-remove/'.sMyID($info[0]).'/');?>'>Sterge</a></td>
				<td style="text-align: center;"><?=$to_pay." ".$moneda;?></td>
			</tr>
<?PHP			
		}
		echo "<tr><td colspan='7'>Total de plata: ".$total." ".$moneda."</td></tr>";
		echo "</table>";
		
		if (g_uID()){
			echo "<a href='".u('cart-finish/')."'> Finalizeaza cumparaturile </a>";
		}else{
			echo "Trebuie sa fii conectat pentru a putea cumpara. <br>";
			echo '<a href="'.u('login/').'"> Conectare </a> <a href="'.u('register/').'"> Inregistrare </a>';
		}
		
	}else{
		echo "Cosul de cumparaturi este gol.";
	}
	


?>