<!DOCTYPE html>
<html>
	<head>
		<title>Cautare | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a href="<?=u('find/');?>">Cautare</a></li>
						<?PHP if ($wph_search_value){ ?>
						<li><a>Rezultatele cautarii pentru "<?=$wph_search_value;?>"</a></li>
						<?PHP }?>
					</ul>
				</div>
			</div>
			<div id="advsearch" class="container relative">
				<div id="letwelcareknow">Cautare avansata</div>
				<form action="<?=u('find/');?>" method="POST">
					<div id="iam">
						 <input type="search" id="find_general" name="wph_search_value" value="<?=$wph_search_value;?>" placeholder="Ce doriti sa cautati?">
					</div>
					<div id="helpme"> <span>Sotare</span>
						<select name="wph_search_sortare" placeholder="Sortare" title="Sortare" id="select-helpme">
							<option value="0">Sortare dupa ...</option>
							<option value="DATE_ASC" <?=(p(2)=="DATE_ASC")?"selected":"";?>>Sorteaza dupa data publicarii (ascendent)</option>
							<option value="DATE_DESC" <?=(p(2)=="DATE_DESC")?"selected":"";?>>Sorteaza dupa data publicarii (descendent)</option>
							<option value="PRET_ASC" <?=(p(2)=="PRET_ASC")?"selected":"";?>>Sorteaza dupa pret (ascendent)</option>
							<option value="PRET_DESC" <?=(p(2)=="PRET_DESC")?"selected":"";?>>Sorteaza dupa pret (descendent)</option>
							<option value="VIEW_ASC" <?=(p(2)=="VIEW_ASC")?"selected":"";?>>Sorteaza dupa vizualizari (ascendent)</option>
							<option value="VIEW_DESC" <?=(p(2)=="VIEW_DESC")?"selected":"";?>>Sorteaza dupa vizualizari (descendent)</option>
						</select>
					</div>
					<span class="go">
					<input class="submit" type="submit" value="Cautare" name="wph_search" />
					</span>
				</form>
				<div class="clear"></div>
			</div>
			<?=$wph_msg_find;?>

<?PHP
	$sFIND = gSEARCH();
	if ($sFIND){
		$iFIND = db_exist_product_like($sFIND);
		if (!$iFIND){ 
			echo "<center><font color='red'><b>Nu au fost gasite medicamente pentru aceasta cautare!</b></font></center>"; 
		}else{
?>
			<div id="page-full">
				<div class="quick_links_div">
					<div class="whide_btn_div">	
						<span><a>Medicamente gasite (<?=$iFIND;?>)</a></span>
					</div>
					<div class="gallery-filter-icons">
						<div class="changelayout">
							<a href="#" class="grid"><img src="<?=u('public/home/');?>images/gallery_icon2.png" alt="" /></a>
							<a href="#" class="list"><img src="<?=u('public/home/');?>images/gallery_icon1.png" alt="" /></a>
						</div>
					</div>
				</div>
				<div class="gallery_area_full">
					<ul class="gallery">
<?PHP
	$pos = 0;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE s_nume LIKE '%".$sFIND."%' OR s_descriere LIKE '%".$sFIND."%' OR s_Tip LIKE '%".$sFIND."%' OR s_Mod LIKE '%".$sFIND."%' ".tSEARCH(p(2)).";")){
		while ($info=mysqli_fetch_object($dbcon)){ 
			$pos++;
?>
						<li class="gal_li">
							<a href="<?=u('product/'.sMyID($info->id).'/');?>">
								<div class="image pic"> 
									<img src="<?=$info->s_imagine;?>" alt="" /> 
									<span class="pic_info"> 
										<span class="bar"> 
											<span class="views">Vizite: <?=$info->i_views;?></span>
											<?PHP $newPRET = finalPRICE($info->s_pret, $info->s_reducere); $pret = round($info->s_pret,2); if ($newPRET != $pret){ ?>
											<span class="duration"><del style="color: #ffc4c4;"><?=$pret;?> <?=$info->s_moneda;?></del> <b><?=$newPRET;?> <?=$info->s_moneda;?><b></span>
											<?PHP }else{ ?>
											<span class="duration"><?=$info->s_pret.' '.$info->s_moneda;?></span>
											<?PHP } ?>
										</span>
									</span> 
								</div>
								<div class="short_details">
									<h4><?=substr($info->s_nume, 0, 25).'...';?></h4>
									<span><?=$info->s_Tip;?></span> 
									<span><a href="<?=u('cart-add/'.sMyID($info->id).'/');?>">Cumpara</a></span> 
								</div>
							</a>
							<div class="pic_details">
								<p> <?=substr($info->s_descriere, 0, 250).'...';?> </p>
							</div>
						</li>
<?PHP
		} 
	}
?>
					</ul>
				</div>
			</div>
<?PHP
		}
	}else{
		echo "<br><hr><center><font color='red'>Ce medicament cautati?</font></center><hr>";
	}
?>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
