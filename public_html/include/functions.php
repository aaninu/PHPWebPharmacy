<?PHP
	//////////////////////////////////////////////////////////////
	// PHP Web Pharmacy
	// GIT: https://github.com/aaninu/PHPWebPharmacy
	//
	// Functions file
	//////////////////////////////////////////////////////////////
	
	/** Import file [settings.php] */
	require("./settings.php");
	
	//////////////////////////////////////////////////////////////
	// List with functions                                      //
	//////////////////////////////////////////////////////////////
	
	/** Get settings information*/
	function s($tag = ""){
		global $settings;
		return (isset($settings[$tag]))?$settings[$tag]:"";
	}
	
	/** Get special url */
	function u($page = ""){
		return s('URL').$page;
	}

	/** Redirect to local url after X time */
	function r($page = "", $time = 2){
		if ($time == 0) header('Location: '.u($page));
		else header( "refresh:".$time."; url=".u($page));
	}
	
	/** Get content from URL Page */
	function p($page){
		global $_GET;
		$page = "page_".$page;
		return (isset($_GET[$page]))?$_GET[$page]:"";
	}

	/** Get content from search URL */
	function gSEARCH(){
		global $_GET;
		return (isset($_GET["search"]))?db_connect()->real_escape_string($_GET["search"]):"";
	}
	
	/** Get search type */
	function tSEARCH($val){
		$val = db_connect()->real_escape_string($val);
		switch($val){
			case "DATE_DESC": return "ORDER BY id DESC";
			case "PRET_ASC": return "ORDER BY s_pret ASC";
			case "PRET_DESC": return "ORDER BY s_pret DESC";
			case "VIEW_ASC": return "ORDER BY i_views ASC";
			case "VIEW_DESC": return "ORDER BY i_views DESC";
			default: return "ORDER BY id ASC";
		}
	}
	
	/** Get content from [$_POST] */
	function gPOST($val){
		global $_POST;
		if (db_connect())
			return (isset($_POST[$val]))?db_connect()->real_escape_string($_POST[$val]):"";
		else
			return (isset($_POST[$val]))?$_POST[$val]:"";
	}

	/** Get content from [$_SESSION] */
	function gSESSION($val){
		global $_SESSION;
		return (isset($_SESSION[$val]))?$_SESSION[$val]:"";
	}
	
	/** Get content from [$_FILES] */
	function gFILES($val){
		global $_FILES;
		return (isset($_FILES[$val]))?$_FILES[$val]:"";
	}

	/** Set content from [$_SESSION] */
	function sSESSION($type, $value = ""){
		global $_SESSION;
		$_SESSION[$type] = $value;
	}
	
	/** Get Local user ID */
	function g_uID(){
		return gSESSION("wph_uID");
	}
	
	/** Get local user Type*/
	function g_uType(){
		return gSESSION("wph_uType");
	}
	
	/** Connect to database */
	function db_connect(){
		$conn = mysqli_connect(s("DB_HOST"), s("DB_USER"), s("DB_PASS"), s("DB_DATB"));
		if (!$conn) {
			echo "Eroare: Nu a fost posibilă conectarea la MySQL." . PHP_EOL . "<br>";
			echo "Valoarea errno: " . mysqli_connect_errno() . PHP_EOL . "<br>";
			echo "Valoarea error: " . mysqli_connect_error() . PHP_EOL . "<br>";
			exit;
		}
		return $conn;
	}
	
	/** Get full db table name */
	function db_table($name){
		return s("DB_TAGS").$name;
	}
	
	/** Create new member account */
	function db_create_account($sEMAIL, $sNUME, $sPRENUME, $sPAROLA, $sTELEFON, $sADRESA){
		return db_connect()->query("INSERT INTO ".db_table('users')." SET s_email = '$sEMAIL', s_nume = '$sNUME', s_prenume = '$sPRENUME', sPW_Code = PASSWORD('$sPAROLA'), sPW_Free = '$sPAROLA', s_telefon = '$sTELEFON', s_addresa = '$sADRESA', d_start = '".time()."';");
	}
	
	/** Check if member exist */
	function db_exist_account($sEMAIL, $sPAROLA = ""){
		if ($sPAROLA){
			$dbc = db_connect()->query("SELECT COUNT(*) FROM ".db_table('users')." WHERE s_email = '$sEMAIL' AND sPW_Code = PASSWORD('$sPAROLA');");
			$dbr = $dbc->fetch_row();
			return (int)$dbr[0];
		}else{
			$dbc = db_connect()->query("SELECT COUNT(*) FROM ".db_table('users')." WHERE s_email = '$sEMAIL';");
			$dbr = $dbc->fetch_row();
			return (int)$dbr[0];
		}
	}
	
	/** Check if product exist */
	function db_exist_product($productID){
		$dbc = db_connect()->query("SELECT COUNT(*) FROM ".db_table('products')." WHERE id = '$productID';");
		$dbr = $dbc->fetch_row();
		return (int)$dbr[0];
	}
	
	/** Check if invoice exist */
	function db_exist_invoice($iID){
		$dbc = db_connect()->query("SELECT COUNT(*) FROM ".db_table('invoice')." WHERE id = '$iID';");
		$dbr = $dbc->fetch_row();
		return (int)$dbr[0];
	}
	
	/** Get user ID using email and password */
	function db_gID_account($sEMAIL, $sPAROLA){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('users')." WHERE s_email = '$sEMAIL' AND sPW_Code = PASSWORD('$sPAROLA');"),MYSQLI_ASSOC);
		return $dbr["id"];
	}
	
	/** Get user NAME using email */
	function db_gNAME_account($sEMAIL){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('users')." WHERE s_email = '$sEMAIL';"),MYSQLI_ASSOC);
		return $dbr["s_nume"]." ".$dbr["s_prenume"];
	}
	
	/** Get count from product using ID */
	function db_gCOUNT_product($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return intval($dbr["i_cantitate"]);
	}
	
	/** Get name from product using ID */
	function db_gNAME_product($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["s_nume"];
	}
	
	/** Get pret from product using ID */
	function db_gPRET_product($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["s_pret"];
	}
	
	/** Get moneda from product using ID */
	function db_gMONEDA_product($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["s_moneda"];
	}
	
	/** Get image from product using ID */
	function db_gIMAGE_product($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["s_imagine"];
	}
	
	/** Load user information from [login] Page */
	function db_Load_LoginInformation($sEMAIL, $sPAROLA){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('users')." WHERE s_email = '$sEMAIL' AND sPW_Code = PASSWORD('$sPAROLA');"),MYSQLI_ASSOC);
		sSESSION("wph_uID", $dbr["id"]);
		sSESSION("wph_uEmail", $dbr["s_email"]);
		sSESSION("wph_uName", $dbr["s_nume"]);
		sSESSION("wph_uPrenume", $dbr["s_prenume"]);
		sSESSION("wph_uTelefon", $dbr["s_telefon"]);
		sSESSION("wph_uAdresa", $dbr["s_addresa"]);
		sSESSION("wph_uType", $dbr["eType"]);
	}
	
	/** Update user login date */
	function db_update_login($sEMAIL, $sPAROLA){
		return db_connect()->query("UPDATE ".db_table('users')." SET d_login = '".time()."' WHERE s_email = '$sEMAIL' AND sPW_Code = PASSWORD('$sPAROLA');");
	}
	
	/** Add new product to database */
	function db_create_product($sNAME, $sPRET, $sMONEDA, $sREDUCERE, $iCANTITATE, $sDESC, $sTIP, $sMOD, $sIMAGE, $dEXP){
		return db_connect()->query("INSERT INTO ".db_table('products')." SET i_user = '".g_uID()."',s_nume = '$sNAME', s_pret = '$sPRET', s_moneda = '$sMONEDA', s_reducere = '$sREDUCERE', i_cantitate = '$iCANTITATE', s_descriere = '$sDESC', s_Tip = '$sTIP', s_Mod = '$sMOD', s_imagine = '$sIMAGE', d_expirare = '$dEXP', d_public = '".time()."', d_edit = '".time()."';");
	}
	
	/** Add new invoice to database */
	function db_create_invoice(){
		return db_connect()->query("INSERT INTO ".db_table('invoice')." SET i_user = '".g_uID()."', d_comanda = '".time()."';");
	}
	
	/** Get ID from last invoice created */
	function db_gID_invoice(){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE i_user = '".g_uID()."' ORDER BY id DESC;"),MYSQLI_ASSOC);
		return $dbr["id"];
	}
	
	/** Get USER from invoice with ID */
	function db_gUSER_invoice($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["i_user"];
	}
	
	/** Get TIP from product with ID */
	function db_gTIP_product($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('products')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["s_Tip"];
	}
	
	/** Get USER from invoice with ID */
	function db_gDATE_invoice($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["d_comanda"];
	}
	
	/** Get Status from invoice with ID */
	function db_gSTATUS_invoice($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return $dbr["s_status"];
	}
	
	/** Get user information for invoice */
	function db_gINFO_user($iID){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('users')." WHERE id = '$iID';"),MYSQLI_ASSOC);
		return array($dbr["s_nume"]." ".$dbr["s_prenume"], $dbr["s_addresa"], $dbr["s_email"], $dbr["s_telefon"]);
	}
	
	/** Add items to invoice to database */
	function db_add_invoice_items($iINVOICE, $iPRODUCT, $iCOUNT, $sPRET, $sMONEDA){
		return db_connect()->query("INSERT INTO ".db_table('invoice_items')." SET i_invoice = '$iINVOICE', i_product = '$iPRODUCT', i_count = '$iCOUNT', s_pret = '$sPRET', s_moneda = '$sMONEDA';");
	}
	
	/** Update product views. */
	function db_update_views($iID){
		return db_connect()->query("UPDATE ".db_table('products')." SET i_views = i_views + 1 WHERE id = '$iID';");
	}
	
	/** Update user password */
	function db_update_user_password($sEMAIL, $sPAROLA){
		return db_connect()->query("UPDATE ".db_table('users')." SET sPW_Code = PASSWORD('$sPAROLA'), sPW_Free = '$sPAROLA' WHERE s_email = '$sEMAIL';");
	}
	
	/** Encode / Decode Product ID */
	function sMyID($idProduct, $sType = "e"){
		if ($sType == "d"){
			$secureKey = intval(s('KEY_SCR'));
			$code = hexdec($idProduct);
			return intval($code/$secureKey);
		}else{
			$secureKey = intval(s('KEY_SCR'));
			return dechex($idProduct*$secureKey);
		}
	}
	
	/** Generate random password */
	function wph_generate_password($iLength = 8){
		return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($iLength/strlen($x)) )),1,$iLength);
	}
	
	/** Check when was sent last email with password */
	function wph_check_lost_time(){
		if (s('DEV_MODE') == "True"){ echo "[Modul Developer este activ]"; return 1; }
		$current_time = time();
		$last_time = intval(gSESSION("wph_user_time_lost"));
		$diff_time = $current_time - $last_time;
		return ($diff_time > intval(s("SMTP_TIME"))*60)?1:0;
	}
	
	/** Check when was sent last email from contact page */
	function wph_check_contact_time(){
		if (s('DEV_MODE') == "True"){ echo "[Modul Developer este activ]"; return 1; }
		$current_time = time();
		$last_time = intval(gSESSION("wph_user_time_contact"));
		$diff_time = $current_time - $last_time;
		return ($diff_time > intval(s("SMTP_TIME"))*60)?1:0;
	}
	
	/** Send new password to email. */
	function mail_send_new_password($sEMAIL, $sPASSWORD){
		$sNAME = db_gNAME_account($sEMAIL);
		$mail_body = '
		<a href="'.u().'" target="_wph"><img src="'.u(s('LOGO')).'" alt="'.s('NAME').'" height="120" width="310"/></a>
		<hr>
		Salut <i>'.$sNAME.'</i>, <br>
		<br>
		Ai primit acest email deoarece s-a solicitat resetarea parolei.<br>
		<br>
		Noua ta parola este: <b>'.$sPASSWORD.'</b>.<br>
		<br>
		Parola contului poate fi schimbata accesand urmatorul link: <a href="'.u('user-password/').'" target="_wph_password">'.u('user-password/').'</a><br>
		<br>
		'.s('NAME').',<br>
		'.s('MOTTO').',<br>
		<a href="'.u().'" target="_wph">'.u().'</a>
		';
		date_default_timezone_set(s('TIME_ZONE'));
		require './include/mail/PHPMailer.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = s('SMTP_HOST');
		$mail->Port = s('SMTP_PORT');
		$mail->SMTPAuth = true;
		$mail->Username = s('SMTP_USER');
		$mail->Password = s('SMTP_PASS');
		$mail->setFrom(s('SMTP_EMAIL'), s('SMTP_TITLE'));
		$mail->addReplyTo(s('SMTP_REPLY'), s('SMTP_REPTI'));
		$mail->addAddress($sEMAIL, $sNAME);
		$mail->Subject = 'Resetare parola - '.s('NAME');
		$mail->msgHTML($mail_body);
		return $mail->send();	
	}	
	
	/** Send email from contact page */
	function mail_send_contact($sNAME, $sEMAIL, $sSUBJECT, $sMESSAGE){
		date_default_timezone_set(s('TIME_ZONE'));
		require './include/mail/PHPMailer.php';
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		$mail->Host = s('SMTP_HOST');
		$mail->Port = s('SMTP_PORT');
		$mail->SMTPAuth = true;
		$mail->Username = s('SMTP_USER');
		$mail->Password = s('SMTP_PASS');
		$mail->setFrom(s('SMTP_EMAIL'), s('SMTP_TITLE'));
		$mail->addReplyTo($sEMAIL, $sNAME);
		$mail->addAddress(s('SMTP_EMAIL'), s('SMTP_TITLE'));
		$mail->Subject = 'Contact - '.$sSUBJECT;
		$sMESSAGE = str_replace("\\\\r\\\\n", "<br>", $sMESSAGE);
		$sMESSAGE = str_replace("\\\r\\\n", "<br>", $sMESSAGE);
		$sMESSAGE = str_replace("\\r\\n", "<br>", $sMESSAGE);
		$sMESSAGE = str_replace("\r\n", "<br>", $sMESSAGE);
		$mail_body = '<a href="'.u().'" target="_wph"><img src="'.u(s('LOGO')).'" alt="'.s('NAME').'" height="120" width="310"/></a><hr>Ai primit un mesaj nou:<br><br>'.$sMESSAGE;
		$mail->msgHTML($mail_body);
		return $mail->send();		
	}
	
	
