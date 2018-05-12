<!DOCTYPE html>
<html>
	<head>
		<title>Medicamente | Admin | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
		<link href="<?=u('public/toast/css/jquery.toast.css');?>" rel="stylesheet">
		<script>
			var t_title = "<?=$msgTitle;?>";
			var t_text = "<?=$msgError;?>";
			var t_icon = "<?=$msgIcon;?>";
		</script>
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
						<li><a href="<?=u('admin/products/');?>">Lista cu medicamente</a></li>
						<li class="last-child"><a href="<?=u('admin/product-info/'.p(3).'/');?>"><?=$info->s_nume;?></a></li>
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
					<p><b>Descriere medicament:</b> <?=$info->s_descriere;?></p>
					<p><b>Tipul medicamentului:</b> <?=$info->s_Tip;?></p>
					<p><b>Mod de administrare:</b> <?=$info->s_Mod;?></p>
				</div>
				<div class="collright">
					<h3> Pret: <?=$info->s_pret;?> <?=$info->s_moneda;?> - <a href="<?=u('admin/products-edit/'.sMyID($info->id).'/');?>">Modifica</a> </h3>
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
		<script src="<?=u('public/toast/js/jquery.toast.js');?>"></script>
		<script src="<?=u('public/toast/js/toast.js');?>"></script>
	</body>
</html>
