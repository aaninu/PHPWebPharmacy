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

	/** Get content from [$_POST] */
	function gPOST($val){
		global $_POST;
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
	
	/** Get user ID using email and password */
	function db_gID_account($sEMAIL, $sPAROLA){
		$dbr=mysqli_fetch_array(mysqli_query(db_connect(), "SELECT * FROM ".db_table('users')." WHERE s_email = '$sEMAIL' AND sPW_Code = PASSWORD('$sPAROLA');"),MYSQLI_ASSOC);
		return $dbr["id"];
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
	
	
	
	
	
