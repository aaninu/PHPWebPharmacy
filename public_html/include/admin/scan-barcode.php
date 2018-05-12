<!DOCTYPE html>
<html>
	<head>
		<title>Scanare facturi | Admin | <?=s('NAME');?></title>
		<?PHP include('./include/guest/multiple/head.php'); ?>
		<link href="<?=u('public/toast/css/jquery.toast.css');?>" rel="stylesheet">
		<script>
			var t_title = "<?=$msgTitle;?>";
			var t_text = "<?=$msgError;?>";
			var t_icon = "<?=$msgIcon;?>";
			var u_platform = "<?=u();?>";
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
						<li><a href="<?=u('admin/scan-barcode/');?>">Scanare facturi</a></li>
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
				<link rel="stylesheet" type="text/css" href="<?=u('public/scan/styles.css');?>" />
 				<div class="left_contents" style="width: 740px;">
					<div class="accord" style="width: 720px;">
						<div class="block" style="width: 720px;">
							<div class="heading" style="background: #66b44d;">
								Admin - Scanare facturi
							</div>
							<div class="biodata-text-more block_display">
								<div id="result_strip">
									<ul class="thumbnails"></ul>
									<ul class="collector"></ul>
								</div>
								<div id="interactive" class="viewport"></div>
							</div>
							<div class="heading" style="background: #66b44d;">
								Setari camera
							</div>
							<div class="biodata-text-more block_display">
								<div class="controls">
									<fieldset class="input-group">
										<button class="stop">Opreste Camera</button>
									</fieldset>
									<fieldset class="reader-config-group">
										<label>
											<span>Barcode-Type</span>
											<select name="decoder_readers">
												<option value="code_128" selected="selected">Code 128</option>
												<option value="code_39">Code 39</option>
												<option value="code_39_vin">Code 39 VIN</option>
												<option value="ean">EAN</option>
												<option value="ean_extended">EAN-extended</option>
												<option value="ean_8">EAN-8</option>
												<option value="upc">UPC</option>
												<option value="upc_e">UPC-E</option>
												<option value="codabar">Codabar</option>
												<option value="i2of5">Interleaved 2 of 5</option>
												<option value="2of5">Standard 2 of 5</option>
												<option value="code_93">Code 93</option>
											</select>
										</label>
										<label>
											<span>Resolution (width)</span>
											<select name="input-stream_constraints">
												<option value="320x240">320px</option>
												<option selected="selected" value="640x480">640px</option>
												<option value="800x600">800px</option>
												<option value="1280x720">1280px</option>
												<option value="1600x960">1600px</option>
												<option value="1920x1080">1920px</option>
											</select>
										</label>
										<label>
											<span>Patch-Size</span>
											<select name="locator_patch-size">
												<option value="x-small">x-small</option>
												<option value="small">small</option>
												<option selected="selected" value="medium">medium</option>
												<option value="large">large</option>
												<option value="x-large">x-large</option>
											</select>
										</label>
										<label>
											<span>Half-Sample</span>
											<input type="checkbox" checked="checked" name="locator_half-sample" />
										</label>
										<label>
											<span>Workers</span>
											<select name="numOfWorkers">
												<option value="0">0</option>
												<option value="1">1</option>
												<option value="2">2</option>
												<option selected="selected" value="4">4</option>
												<option value="8">8</option>
											</select>
										</label>
										<label>
											<span>Camera</span>
											<select name="input-stream_constraints" id="deviceSelection">
											</select>
										</label>
									</fieldset>
								</div>
								<script src="<?=u('public/scan/jquery-1.9.0.min.js');?>" type="text/javascript"></script>
								<script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>
								<script src="<?=u('public/scan/quagga.js');?>" type="text/javascript"></script>
								<script src="<?=u('public/scan/live_w_locator.js');?>" type="text/javascript"></script>
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
