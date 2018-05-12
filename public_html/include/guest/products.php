<!DOCTYPE html>
<html>
	<head>
		<title>Lista cu medicamente | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li class="last-child"><a href="<?=u('products/');?>">Lista cu medicamente</a></li>
					</ul>
				</div>
			</div>
			<div id="page-full">
				<div class="quick_links_div">
					<div class="whide_btn_div">	
						<span><a href="<?=u('products/');?>">Lista cu medicamente</a></span>
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
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." ORDER BY id ASC LIMIT $startWith,$itemPage;")){
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
				<div class="pagination no_margin_bottom">
					<a href="<?=u('products/');?>" class="">Prima</a>
<?PHP $page = 1; $pageI = 0; while($pageI < $totalProd){ ?>
					<a href="<?=u('products/'.sMyID($page).'/');?>" class="<?=($pageNum==$page)?"current":"";?>"><?=$page;?></a>
<?PHP $pageI += $itemPage; $page++; } ?>
					<a href="<?=u('products/'.sMyID($lastPage).'/');?>" class="">Ultima</a>
				</div>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
