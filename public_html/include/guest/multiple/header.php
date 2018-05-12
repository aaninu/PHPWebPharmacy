<div class="header">
	<div class="logo"><a href="<?=u();?>"><img src="<?=u(s('LOGO'));?>" alt="<?=s('NAME');?>" height="65" /></a></div>
	<div class="righthead">
		<div class="top-menu inline">
			<ul>
<?PHP if(g_uID()){ if (g_uType() == "ADMIN" or g_uType() == "PHARMACY"){ ?>
				<li class="uadmin"><a href="<?=u('admin/')?>">Administrare</a></li>
<?PHP } ?>
				<li class="uuser"><a href="<?=u('user/')?>">Contul Meu</a></li>
				<li class="ulogout"><a href="<?=u('logout/')?>">Deconectare</a></li>
<?PHP }else{ ?>
				<li class="register"><a href="<?=u('register/');?>">Inregistrare</a></li>
				<li class="signin"> <a href="<?=u('login/');?>">Conectare</a></li>
				<li class="contact"> <a href="<?=u('contact/');?>">Contact</a></li>
<?PHP } ?>
			</ul>
		</div>
		<div class="contactinfo"> 
			<span class="black_text">
				<a href="<?=u('cart/');?>">Cos de cumparaturi (<?=cart_information();?>)</a>
			</span>
		</div>
		<div class="livechat"><span><a href="<?=u('contact/');?>"><?=s('PHONE');?></a></span></div>
	</div>
</div>
<?PHP if(p(1) == "admin"){ ?>
<div class="menu container" style="background: #66b44d;">
<?PHP }else{ ?>
<div class="menu container">
<?PHP } ?>
	<ul id="menu">
		<li><a href="<?=u('');?>">Acasa</a></li>
		<li><a href="<?=u('products/');?>">Lista cu medicamente</a></li>
		<li><a href="<?=u('discounts/');?>">Reduceri</a></li>
		<li><a href="<?=u('find/');?>">Cautare</a></li>
		<li><a href="<?=u('reservations-payments/');?>">Rezervari & Plati</a></li>
		<li><a href="<?=u('about/');?>">Despre Noi</a></li>
		<li><a href="<?=u('careers/');?>">Cariere</a></li>
		<li><a href="<?=u('contact/');?>">Contact</a></li>
	</ul>
	<div id="searchico"> <a href="#"><img src="<?=u('public/home/');?>images/ico-search.png" alt="" /></a>
		<div id="quicksearchbox" class="gray_gradient"> <img src="<?=u('public/home/');?>images/sign_in_arrow.png" alt="" class="boxArrow" />
			<fieldset id="signin_menu2">
				<form action="<?=u('find/');?>" method="POST" id="find_products">
					<label>Cautare</label>
					<div class="quickSearchField">
						<input type="text" name="wph_search_value" value="<?=$wph_search_value;?>" placeholder="Ce doriti sa cautati?">
						<input type="hidden" name="wph_search" value="Cautare">
						<input type="submit" value="Cautare" id="signin_submit2" >
					</div>
				</form>
			</fieldset>
		</div>
	</div>
</div>
