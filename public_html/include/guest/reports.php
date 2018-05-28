<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Raport de vanzari [<?=date("d-m-Y", $limit_start);?>:<?=date("d-m-Y", $limit_stop);?>]</title>
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
				<div id="invoice">
					<h1>Raport de vanzari </h1>
					<div class="date"><?=date("d-m-Y", $limit_start);?>:<?=date("d-m-Y", $limit_stop);?></div>
				</div>
			</div>
<?PHP $invProd = 0; while($limit_start < $limit_stop){ if(db_total_invoices_date($limit_start, $limit_start+$limit_day)){ ?>
			<h2>Facturi din data: <?=date("d-m-Y", $limit_start);?></h2>
			<table id="t01">
				<tr>
					<th colspan='2'>Factura</th>
					<th>Cumparator</th> 
					<th>Data si ora</th> 
					<th>Status</th>
					<th>Total</th>
				</tr>
<?PHP
	$l_stopp = $limit_start+$limit_day;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE d_comanda >= '$limit_start' AND d_comanda < '$l_stopp';")){
		while ($info=mysqli_fetch_object($dbcon)){ $invProd++;
		?>
					<tr>
						<td><a href="<?=u('invoice/'.sMyID($info->id).'/');?>" target="_invoice">FACTURA <?=s('INVOICE').$info->id.' ('.sMyID($info->id).')';?></a></td>
						<td>
						<?PHP
							$BarCode = new Code128();
							$BarCode->setData(sMyID($info->id));
							$BarCode->setDimensions(400, 80);
							$BarCode->draw();
							$b64 = $BarCode->base64();
							echo "<img class='bar_code' src='data:image/png;base64,$b64' width='200' height='40'  /><br>";
						?>
						</td>
						<td><?=db_gNAME_account_id($info->i_user);?></td>
						<td><?=date("d-m-Y (H:i)", $info->d_comanda);?></td>
						<td>
			<?PHP if ($info->s_status == "PAID"){ if ($info->s_comanda == "OK"){ ?>
			Comanda a fost ridicata.
			<?PHP }else{ ?> 
			Comanda inca nu a fost ridicata.
			<?PHP } }elseif($info->s_status == "UNPAID"){ ?>
			Comanda este in asteptarea platii. 
			<?PHP }else{ ?>
			Comanda a fost anulata.
			<?PHP }?>
						</td>
						<td><?=db_gTOTAL_invoice($info->id);?></td>
					</tr>
		<?PHP
		}
	}
?>
			</table>
<?PHP } $limit_start += $limit_day; } ?>

			<?PHP if ($invProd == 0){?>
			<div id="notices">
				<div class="notice"><font color="red">Nu exista facturi emise in aceasta perioada.</font></div>
			</div>
			<?PHP } ?>
			<div class="hidden-print" id="noPDF2" >
				<hr>
				<script src="https://cdn.convertapi.com/button.js" data-secret="<?=s('PDF_KEY');?>" ></script>
				<link rel="stylesheet" type="text/css" href="https://cdn.convertapi.com/button.css">
				<button  onclick="hideButton()">Salveaza in format PDF</button>
				<button class="convertapi-btn" style="display:none;" data-filename="Raport_<?=$limit_start.'_'.$limit_stop;?>">Salveaza in format PDF</button>
				<a href="<?=u('admin/reports/');?>">Genereaza un raport nou</a>
				<hr>
			</div>
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
		</main>
	</body>
</html>