<!DOCTYPE html>
<html>
	<head>
		<title>Lista utilizatorilor | Admin | <?=s('NAME');?></title>
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
			<div id="page-full" class="typography_page">
				<div class="breadcrumbs">
					<ul>
						<li><a href="<?=u();?>"><img width="14" height="13" alt="" src="<?=u('public/home/');?>images/home_icon.png" /></a></li>
						<li><a href="<?=u('admin/');?>">Administrare</a></li>
						<li><a href="<?=u('admin/users/');?>">Lista utilizatorilor</a></li>
					</ul>
				</div>
			</div>
			<div class="container2">
				<div class="sidebar" style="width:  200px;">
					<div class="block">
						<h2>Optiuni</h2>
						<div class="categories">
							<?PHP include('./include/admin/dev/menu.php'); ?>
						</div>
					</div>
				</div>
				<div class="left_contents" style="width: 740px;">
					<div class="accord" style="width: 720px;">
						<div class="block" style="width: 720px;">
							<div class="heading" style="background: #66b44d;">Admin - Lista utilizatorilor</div>
							<div class="biodata-text-more block_display">
								<table id='cart_table_admin'>
									<tr>
										<th>#</th>
										<th>Nume si prenume</th>
										<th>Email</th>
										<th>Telefon</th>
										<th>Adresa</th>
										<th>Tip</th>
									</tr>
<?PHP
	$pos = 0;
	if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('users')." ORDER BY id DESC;")){
		while ($info=mysqli_fetch_object($dbcon)){ $pos++;
?>
									<tr>
										<td><a href="<?=u('admin/user-info/'.sMyID($info->id).'/');?>"><?=$pos;?></a></td>
										<td><?=$info->s_nume.' '.$info->s_prenume;?></td>
										<td><?=$info->s_email;?></td>
										<td><?=$info->s_telefon;?></td>
										<td><?=$info->s_addresa;?></td>
										<td><?=$info->eType;?></td>
									</tr>
<?PHP
		}
	}
?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br>
			<?PHP include('./include/guest/multiple/footer.php'); ?>
		</div>
		<script src="<?=u('public/toast/js/jquery.toast.js');?>"></script>
		<script src="<?=u('public/toast/js/toast.js');?>"></script>
	</body>
</html>
