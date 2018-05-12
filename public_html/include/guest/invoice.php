<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>FACTURA <?=s('INVOICE').$invID;?></title>
		<link rel="shortcut icon" href="<?=u(s('ICON'));?>" type="image/x-icon">
		<link rel="stylesheet" href="<?=u("public/css/invoice.css");?>" media="all" />
	</head>
	<body>
		<header class="clearfix">
			<div id="logo">
				<a href="<?=u();?>"><img src="<?=u(s("LOGO"));?>"></a>
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
					<div class="date">Data scadenta: <?=date("d-m-Y",$dCOMANDA+604800);?></div>
					<?PHP if($sPAYM){ ?><div class="date">Plata/Data: <?=$sPAYM;?> / <?=date("d-m-Y (H:i)", $sPAYD);?></div><?PHP } ?>
					<?PHP if($sPAYT){ ?><div class="date">Tranzactie: <?=$sPAYT;?></div><?PHP } ?>
					<?PHP if($sORDER and $sPHARM){ ?><div class="date">Ridicare: Farm. <?=$sPHARM;?> / <?=date("d-m-Y (H:i)", $sORDER);?></div><?PHP } ?>
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
			$moneda = $info->s_moneda;
?>
					<tr>
						<td class="no" <?PHP if ($info->s_pret != $info->s_pret_old){ ?>rowspan="2"<?PHP } ?>><?=$pos;?></td>
						<td class="desc"><h3><?=db_gNAME_product($info->i_product);?></h3><?=db_gTIP_product($info->i_product);?></td>
						<td class="unit"><?=$info->s_pret_old." ".$moneda;?></td>
						<td class="qty"><?=$info->i_count;?></td>
						<td class="total"><?=$info->s_pret_old*$info->i_count." ".$moneda;?></td>
					</tr>
<?PHP if ($info->s_pret != $info->s_pret_old){ ?>	
					<tr>
						<td colspan="3"><h3>Reducere medicament</h3></td>
						<td class="total" style="background: #de6565;">-<?=$info->s_pret_old*$info->i_count-$info->s_pret*$info->i_count." ".$moneda;?></td>
					</tr>
<?PHP }?>		
		
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
						<td colspan="2" rowspan="2"></td>
						<td colspan="2" rowspan="2">TOTAL DE PLATA</td>
						<td><?=$total." ".$moneda;?></td>
					</tr>
					<tr>
						<td><?=$total_euro = convertCurrency($total, "RON", "EUR");?> EURO</td>
					</tr>
				</tfoot>
			</table>
			<?PHP if(p(3) == "pay-cancel"){ ?> <div class="genericError"><strong>PayPal</strong><br /> Plata a fost anulata. </div> <?PHP } ?>
			<hr>
			<div id="notices">
				<?PHP if(p(3) == "pay-success" and $sSTATUS != "PAID"){ ?>
					<font color="<?=$types;?>"><b><?=$message_1;?></b><?=$message_2;?></font>
				<?PHP }elseif($sSTATUS == "UNPAID"){ $_SESSION["wph_invoice_euro"] = $total_euro; ?>
					<div class="notice">Factura este in asteptarea platii.</div>
					<?PHP if(p(3) == ""){ ?>
					<div class="hidden-print" id="noPDF">
						<hr>
						<form action='https://www.paypal.com/cgi-bin/webscr' method='post'>
							<input type='hidden' name='business' value='<?=s('PAYPAL_EMAIL');?>'>
							<input type='hidden' name='cmd' value='_xclick'>
							<input type="hidden" name="item_number" value="<?=$invID;?>"/> 
							<input type='hidden' name='item_name' value='FACTURA <?=s('INVOICE').$invID;?>'>
							<input type='hidden' name='amount' value='<?=$total_euro;?>'>
							<input type='hidden' name='rm' value='2'>
							<input type='hidden' name='no_shipping' value='1'>
							<input type='hidden' name='currency_code' value='EUR'>
							<input type="hidden" name="tax" value="0.00" />   
							<input type='hidden' name='handling' value=''>
							<input type='hidden' name='cancel_return' value='<?=u('invoice/'.p(2).'/pay-cancel/');?>'>
							<input type='hidden' name='return' value='<?=u('invoice/'.p(2).'/pay-success/');?>'>
							<input type="image" name="submit" src="<?=u('public/images/PayPal_PayNow.png');?>" alt="Plateste folosind PayPal" style="width:  150px;"> 
						</form>
						<hr>
					</div>
					<?PHP } ?>
					<font color="green">Factura poate fi platita online folosind PayPal sau in magazinul nostru in maxim 7 zile de la data emitere.</font>
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
			<div class="hidden-print" id="noPDF2" >
				<hr>
				<?PHP if (g_uType() == "ADMIN" or g_uType() == "PHARMACY"){ ?>
					<a href="<?=u('admin/invoices/');?>">Zona Administrare</a>
					<?PHP if($sSTATUS != "CANCELED"){ ?> | <a href="<?=u('admin/invoice-edit/'.p(2).'/');?>">Modifica factura</a> <?PHP } ?>
				<?PHP }else{ ?>
					<a href="<?=u('user-invoices/');?>">Inapoi in contul de client</a>
				<?PHP } ?>
				<hr>
				<script src="https://cdn.convertapi.com/button.js" data-secret="<?=s('PDF_KEY');?>" ></script>
				<link rel="stylesheet" type="text/css" href="https://cdn.convertapi.com/button.css">
				<button  onclick="hideButton()">Salveaza in format PDF</button>
				<button class="convertapi-btn" style="display:none;" data-filename="Factura_<?=s('INVOICE').$invID;?>">Salveaza in format PDF</button>
				<hr>
			</div>
		</main>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
		<script>
			function hideButton(){
				try { document.getElementById("noPDF").style.display = "none"; } catch(err) { }
				try { document.getElementById("noPDF2").style.display = "none"; } catch(err) { }
				try { $('.convertapi-btn').click(); } catch(err) { }
				try { document.getElementById("noPDF").style.display = "block"; } catch(err) { }
				try { document.getElementById("noPDF2").style.display = "block"; } catch(err) { }
			}
		</script>
	</body>
</html>
