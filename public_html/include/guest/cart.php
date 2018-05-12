<!DOCTYPE html>
<html>
	<head>
		<title>Cos de cumparaturi (<?=cart_information();?>) | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child">
							<a href="<?=u('cart/');?>">Cos de cumparaturi (<?=cart_information();?>)</a>
							| ( <a href="<?=u('cart-clear/');?>">Golest cosul de cumparaturi</a> | <a href="<?=u('products/');?>">Continua cumparaturile</a> )
						</li>
					</ul>
				</div>
			</div>
<?PHP 
	$aCART = gSESSION("wph_cart");
	if (count($aCART) and $aCART != ""){
		echo "<table id='cart_table'>";
		echo "<tr><th>#</th><th>Imagine</th><th>Denumire</th><th width='125'>Pret unitar</th><th width='100'>Cantitate</th><th>Actiuni</th><th width='125'>Total</th></tr>";
		$pos = 0;
		$total = 0;
		foreach($aCART as $id => $info){ 
			$pos++;
			$pret = db_gPRET_product($info[0]);
			$pretNEW = db_gPRET_product($info[0],1);
			$moneda = db_gMONEDA_product($info[0]);
			$to_pay_old = $pret*$info[1];
			$to_pay = $pretNEW*$info[1];
			$total += $to_pay;
?>
			<tr>
				<td id="cce"><?=$pos;?></td>
				<td><img src="<?=db_gIMAGE_product($info[0]);?>" width="50" height="50"></td>
				<td>
					<a href="<?=u('product/'.sMyID($info[0]).'/');?>"><?=db_gNAME_product($info[0]);?></a>
					<?PHP 
						if($info[2] == 0)
							echo '<br><font color="red"><b>Acest medicament nu mai este disponibil in stoc.</b></font>';
						elseif($info[2] == -1)
							echo '<br><font color="red"><b>Acest medicament nu mai este disponibil in cantitatea dorita.</b></font>';
					?>
				</td>
				<td id="cce">
					<?PHP if ($pretNEW != $pret){ echo "<del style='color:red;'>".$pret." ".$moneda."</del><br>".$pretNEW." ".$moneda;; }else{ echo $pret." ".$moneda; } ?>
				</td>
				<td id="cce">
					<input type='text' value='<?=$info[1];?>' style="width: 35px;text-align: center; margin-bottom: 0px;" readonly>
					<a href="<?=u('cart-add/'.sMyID($info[0]).'/1/D/');?>"><button style="padding: 5px;">-</button></a>
					<a href="<?=u('cart-add/'.sMyID($info[0]).'/1/');?>"><button style="padding: 5px;">+</button></a>
				</td>
				<td id="cce"><a href='<?=u('cart-remove/'.sMyID($info[0]).'/');?>'>Sterge</a></td>
				<td style="text-align: center;">
					<?PHP if ($pretNEW != $pret){ echo "<del style='color:red;'>".$to_pay_old." ".$moneda."</del><br>".$to_pay." ".$moneda;; }else{ echo $to_pay." ".$moneda; } ?>
				</td>
			</tr>
<?PHP			
		}
		echo "<tr><td colspan='7'>Total de plata: <b>".$total." ".$moneda."</b> / <b>".convertCurrency($total, "RON", "EUR")." EURO</b></td></tr>";
		echo "</table>";
		
		if (g_uID()){
			echo "<div class='pagination'><a href='".u('cart-finish/')."' style='width:  125px !important;'> Finalizeaza cumparaturile </a></div>";
		}else{
			echo "<br><hr><center><font color='red'>Ai nevoie de un cont pentru a putea face o comanda.</font>";
			echo '<a href="'.u('login/').'"> Conectare </a> | <a href="'.u('register/').'"> Inregistrare </a> </center>';
		}
	}else{
		echo "Cosul de cumparaturi este gol.";
	}
?>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
