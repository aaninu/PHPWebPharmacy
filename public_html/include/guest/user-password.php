<!DOCTYPE html>
<html>
	<head>
		<title>Schimba parola | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
	</head>
	<body>
		<div id="main-container"> 
			<?PHP include('./include/guest/multiple/header.php'); ?>
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li><a href="<?=u('user/');?>">Contul Meu</a></li>
						<li class="last-child"><a href="<?=u('user-password/');?>">Schimba parola</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<div class="sidebar">
					<div class="block">
						<h2>Optiuni</h2>
						<div class="categories">
							<ul>
								<li><a href="<?=u('user/');?>">Contul Meu</a></li>
								<li><a href="<?=u('user-password/');?>">Schimba parola</a></li>
								<li><a href="<?=u('user-invoices/');?>">Comenzile mele</a></li>
								<li><a href="<?=u('user-settings/');?>">Setarile contului</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="left_contents">
					<div class="accord">
						<div class="block">
							<div class="heading">Schimba parola</div>
							<div class="biodata-text-more block_display">
								<?=($wph_msg)?"<hr><b>".$wph_msg."</b><hr><br>":"";?>
								<form action="<?=u('user-password/');?>" method="POST">
									<table id='cart_table'>
										<tr>
											<td>Parola curenta:*</td>
											<td>
												<input type="password" name="wph_password" value="<?=$wph_password;?>" placeholder="Parola curenta" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>
											<td>Parola noua:*</td>
											<td>
												<input type="password" name="wph_password_new" value="<?=$wph_password_new;?>" placeholder="Parola noua" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>
											<td>Repeta parola noua:*</td>
											<td>
												<input type="password" name="wph_password_repeat" value="<?=$wph_password_repeat;?>" placeholder="Repeta parola noua" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>	
											<td colspan="2">
												<center>
													<input type="submit" name="wph_change" class="button" value="Schimba parola">
												</center>
											</td>
										</tr>
									</table>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
	</body>
</html>
