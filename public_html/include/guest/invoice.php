<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>FACTURA <?=s('INVOICE').$invID;?></title>
		<link rel="stylesheet" href="<?=u("public/css/invoice.css");?>" media="all" />
	</head>
	<body>
		<header class="clearfix">
			<div id="logo">
				<img src="<?=u(s("LOGO"));?>">
			</div>
			<div id="company">
				<h2 class="name"><?=s("NAME");?></h2>
				<div><?=s("ADRESA");?></div>
				<div><?=s("PHONE");?></div>
				<div><a href="mailto:<?=s("EMAIL_PUBLIC");?>"><?=s("EMAIL_PUBLIC");?></a></div>
			</div>
		</header>
		<main>
			<div id="details" class="clearfix">
				<div id="client">
					<div class="to">Cumparator:</div>
					<h2 class="name"><?=$aUSER[0];?></h2>
					<div class="address"><?=$aUSER[1];?></div>
					<div class="email"><a href="mailto:<?=$aUSER[2];?>"><?=$aUSER[2];?></a></div>
					<div class="phone"><?=$aUSER[3];?></div>
				</div>
				<div id="invoice">
					<h1>FACTURA <?=s('INVOICE').$invID;?></h1>
					<div class="date">Data si ora emiterii: <?=date("d-m-Y (H:i)",$dCOMANDA);?></div>
					<div class="date">Data scadenta: <?=date("d-m-Y",$dCOMANDA);?></div>
				</div>
			</div>
			<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="no">#</th>
						<th class="desc">DESCRIERE</th>
						<th class="unit">PRET UNITAR</th>
						<th class="qty">CANTITATE</th>
						<th class="total">TOTAL</th>
					</tr>
				</thead>
				<tbody>
<?PHP
	$pos = 0;
	$total = 0;
	$moneda = "";
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice_items')." WHERE i_invoice = '$invID' ORDER BY id ASC;")){
		while ($info=mysqli_fetch_object($dbcon)){ 
			$pos++;
			$total += $info->s_pret*$info->i_count;
			$moneda = $info->s_moneda
?>
					<tr>
						<td class="no"><?=$pos;?></td>
						<td class="desc"><h3><?=db_gNAME_product($info->i_product);?></h3><?=db_gTIP_product($info->i_product);?></td>
						<td class="unit"><?=$info->s_pret." ".$moneda;?></td>
						<td class="qty"><?=$info->i_count;?></td>
						<td class="total"><?=$info->s_pret*$info->i_count." ".$moneda;?></td>
					</tr>
<?PHP
		}
	}
?>
				</tbody>
				<tfoot>
<?PHP if (s("TVA")){ ?>
					<tr>
						<td colspan="2"></td>
						<td colspan="2">TVA <?=s("TVA");?>%</td>
						<td><?=(($total*(s("TVA")))/100)." ".$moneda?></td>
					</tr>
<?PHP } ?>
					<tr>
						<td colspan="2"></td>
						<td colspan="2">TOTAL DE PLATA</td>
						<td><?=$total." ".$moneda;?></td>
					</tr>
				</tfoot>
			</table>
			<hr>
			<div id="notices">
				<?PHP if($sSTATUS == "UNPAID"){ ?>
					<div class="notice">Factura este in asteptarea platii.</div>
				<?PHP }elseif($sSTATUS == "PAID"){ ?>
					<div class="notice">Factura a fost platita.</div>
				<?PHP }else{ ?>
					<div class="notice"><font color="red"><b>Factura a fost anulata.</b></font></div>
				<?PHP } ?>
			</div>
			<hr>
			<table>
				<tr>
					<td style="text-align:center;padding:5px;width: 260px;">
<?PHP
	$BarCode = new Code128();
	$BarCode->setData($iINVOICE);
	$BarCode->setDimensions(250, 75);
	$BarCode->draw();
	$b64 = $BarCode->base64();
	echo "<img src='data:image/png;base64,$b64' /><br>";
?>				
					Cod factura: <b><?=$iINVOICE;?></b>
					</td>
					<td style="text-align:right;padding:5px;">
						<img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=<?=u('invoice/'.$iINVOICE.'/');?>" width="110" height="110">
					</td>
				</tr>
			</table>
			<hr>
		</main>
	</body>
</html>
