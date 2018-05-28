<!DOCTYPE html>
<html>
	<head>
		<title>Medicamente | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
<?PHP
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$productID' LIMIT 1;")){
		while ($info=mysqli_fetch_object($dbcon)){ 
?>			
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li><a href="<?=u('products/');?>">Lista cu medicamente</a></li>
						<li class="last-child"><a href="<?=u('product/'.p(2).'/');?>"><?=$info->s_nume;?></a></li>
					</ul>
				</div>
			</div>			
			<div class="container2">
<?PHP if ($info->i_cantitate <= 0){ ?>
				<div class="block1"> <font color='red'>Acest medicament nu se afla in stoc in acest moment. Pentru mai multe detalii va rugam sa ne contactati folosind formularul de <a href='<?=u('contact/');?>'>contact</a> sau folosind una din metodele disponibile. Multumim pentru intelegere. </font> </div>
<?PHP } ?>
			</div>

			
			<div class=" container2">
				<div class="collleft">
					<div class="image"> <img src="<?=$info->s_imagine;?>" alt="" class="left" width="250" height="250" /> </div>
					<h3><?=$info->s_nume;?></h3>
					<p><b>Descriere medicament:</b> <?=nl2br($info->s_descriere);?></p>
					<p><b>Tipul medicamentului:</b> <?=nl2br($info->s_Tip);?></p>
					<p><b>Mod de administrare:</b> <?=nl2br($info->s_Mod);?></p>
				</div>
				<div class="collright">
					<?PHP $newPRET = finalPRICE($info->s_pret, $info->s_reducere); $pret = round($info->s_pret,2); if ($newPRET != $pret){ ?>
					<h3> Pret: <del style="color: red;"><?=$pret;?> <?=$info->s_moneda;?></del> <b><?=$newPRET;?> <?=$info->s_moneda;?><b> - <a href="<?=u('cart-add/'.sMyID($info->id).'/');?>">Cumpara</a> </h3>
					<?PHP }else{ ?>
					<h3> Pret: <?=$info->s_pret;?> <?=$info->s_moneda;?> - <a href="<?=u('cart-add/'.sMyID($info->id).'/');?>">Cumpara</a> </h3>
					<?PHP } ?>
					<p> 
						<b>Disponibil in stoc:</b> <?=$info->i_cantitate;?> <br>
						<b>Data publicarii:</b> <?=date("d.m.Y", $info->d_public);?> <br>
						<b>Data ultimei modificari:</b> <?=date("d.m.Y", $info->d_edit);?> <br>
						<b>Data expirarii:</b> <?=date("d.m.Y", $info->d_expirare);?> <br>
						<b>Vizualizari:</b> <?=$info->i_views;?> <br>
					</p>
				</div>
			</div>
<?PHP
		}
	}
?>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
