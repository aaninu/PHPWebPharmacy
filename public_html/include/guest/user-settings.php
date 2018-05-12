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
						<li class="last-child"><a href="<?=u('user-settings/');?>">Setarile contului</a></li>
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
							<div class="heading">Setarile contului</div>
							<div class="biodata-text-more block_display">
								<?=($wph_msg)?"<hr><b>".$wph_msg."</b><hr><br>":"";?>
								<form action="<?=u('user-settings/');?>" method="POST">
									<table id='cart_table'>
										<tr>
											<td>Adresa de email:*</td>
											<td>
												<input type="email" value="<?=g_uEMAIL();?>" style="margin-bottom:  0px;width: 97%;" readonly>
											</td>
										</tr>
										<tr>
											<td>Nume:*</td>
											<td>
												<input type="text" name="wph_nume" value="<?=$wph_nume;?>" placeholder="Nume" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>
											<td>Prenume:*</td>
											<td>
												<input type="text" name="wph_prenume" value="<?=$wph_prenume;?>" placeholder="Prenume" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>
											<td>Adresa:*</td>
											<td>
												<input type="text" name="wph_addr" value="<?=$wph_addr;?>" placeholder="Adresa" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>
											<td>Numar de telefon:*</td>
											<td>
												<input type="text" name="wph_phone" value="<?=$wph_phone;?>" placeholder="Numar de telefon" style="margin-bottom:  0px;width: 97%;" required>
											</td>
										</tr>
										<tr>	
											<td colspan="2">
												<center>
													<input type="submit" name="wph_change" class="button" value="Schimba informatiile">
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
