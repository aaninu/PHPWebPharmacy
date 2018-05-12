<div class="container">
	<div id="copyrightarea" <?PHP if(p(1) == "admin"){?> style="background: #66b44d;border-color: #66b44d;"<?PHP } ?>>
		<div id="copyrighttext"> &copy; <?=s('COPPY');?> <?=s('NAME');?>. Toate drepturile rezervate. </div>
<?PHP if(p(1) != "admin"){?>	
		<div id="socialicons">
			<ul class="social-icon">
				<li><a href="javascript:void(0);" class="facebook_link" ></a></li>
				<li><a href="javascript:void(0);" class="linkedin_link"></a></li>
			</ul>
		</div>
<?PHP } ?>
	</div>
	<a href="#" class="pageup"><img src="<?=u('public/home/');?>images/ico-pup.png" alt="" /></a> 
</div>
<div class="overlay"></div>
