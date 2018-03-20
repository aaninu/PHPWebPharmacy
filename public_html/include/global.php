<?PHP
	//////////////////////////////////////////////////////////////
	// PHP Web Pharmacy
	// GIT: https://github.com/aaninu/PHPWebPharmacy
	//
	// Global file
	//////////////////////////////////////////////////////////////
	
	/** Enable SESSION */
	session_start();
	
	/** Import file [functionso.php] */
	require('functions.php');
	
	/** Check database connection */
	db_connect();
	
	/** [login] Page */
	if (p(1) == "login"){
		if (g_uID()) r("user/", 0);
		$wph_email = "";
		$wph_password = "";
		$wph_msg = "";
		$wph_login = gPOST('wph_login');
		if ($wph_login == "Conectare"){
			$wph_email = gPOST('wph_email');
			$wph_password = gPOST('wph_password');
			if ($wph_email and $wph_password){
				if(db_exist_account($wph_email, $wph_password)){
					$uID = db_gID_account($wph_email, $wph_password);
					if ($uID){
						db_Load_LoginInformation($wph_email, $wph_password);
						db_update_login($wph_email, $wph_password);
						$wph_email = "";
						$wph_password = "";
						$wph_msg = "Ai fost conectat cu succes.";
						r('user/');
					}else{ $wph_msg = "Ceva nu a functionat. Te rugam sa incerci mai tarziu."; }
				}else{ $wph_msg = "Contul introdus nu se gaseste in baza de date."; }
			}else{ $wph_msg = "Nu ati completat toate spatiile obligatorii."; }
		}
	}
	
	/** [logout] Page */
	if (p(1) == "logout"){
		session_destroy();
		r("login/", 0);
	}
	
	/** [register] Page */
	if (p(1) == "register"){
		if (g_uID()) r("user/", 0);
		$wph_email = "";
		$wph_nume = "";
		$wph_prenume = "";
		$wph_password = "";
		$wph_telefon = "";
		$wph_adresa = "";
		$wph_msg = "";
		$wph_register = gPOST('wph_register');
		if ($wph_register == "Inregistrare"){
			$wph_email = gPOST('wph_email');
			$wph_nume = gPOST('wph_nume');
			$wph_prenume = gPOST('wph_prenume');
			$wph_password = gPOST('wph_password');
			$wph_telefon = gPOST('wph_telefon');
			$wph_adresa = gPOST('wph_adresa');
			if ($wph_email and $wph_nume and $wph_prenume and $wph_password and $wph_telefon and $wph_adresa){
				if (filter_var($wph_email, FILTER_VALIDATE_EMAIL)){
					if (strlen($wph_password) >= 8){
						if (!db_exist_account($wph_email)){
							if (db_create_account($wph_email, $wph_nume, $wph_prenume, $wph_password, $wph_telefon, $wph_adresa)){
								$wph_email = "";
								$wph_nume = "";
								$wph_prenume = "";
								$wph_password = "";
								$wph_telefon = "";
								$wph_adresa = "";
								$wph_msg = "Contul a fost inregistrat cu success.";
							}else{ $wph_msg = "Contul nu a fost inregistrat. Te rugam sa incerci mai tarziu."; }
						}else{ $wph_msg = "Adresa de email a fost deja folosita.";}
					}else{ $wph_msg = "Parola trebuie sa contina cel putin 8 caractere."; }
				}else{ $wph_msg = "Adresa de email nu este valida."; }
			}else{ $wph_msg = "Nu ati completat toate spatiile obligatorii."; }
		}
	}
	
	/** [user] Page */
	if (p(1) == "user"){
		if (!g_uID()) r("login/", 0);
		
		
	}
	
	/** [product] Page */
	if (p(1) == "product"){
		$productID = sMyID(p(2), "d");
		if (!db_exist_product($productID)) r('products/', 0);
	}
	
	
	/** [admin/products-add] Page */
	if (p(1) == "admin" and p(2) == "products-add"){
		$wph_msg = "";
		$wph_s_nume = "";
		$wph_s_pret = "";
		$wph_s_moneda = "";
		$wph_i_cantitate = "";
		$wph_s_descriere = "";
		$wph_s_Tip = "";
		$wph_s_Mod = "";
		$wph_d_expirare = "";
		$wph_addproduct = gPOST('wph_addproduct');
		if ($wph_addproduct == "Adauga medicamentul"){
			$wph_s_nume = gPOST('wph_s_nume');
			$wph_s_pret = gPOST('wph_s_pret');
			$wph_s_moneda = gPOST('wph_s_moneda');
			$wph_i_cantitate = gPOST('wph_i_cantitate');
			$wph_s_descriere = gPOST('wph_s_descriere');
			$wph_s_Tip = gPOST('wph_s_Tip');
			$wph_s_Mod = gPOST('wph_s_Mod');
			$wph_d_expirare = gPOST('wph_d_expirare');
			
			
		}
	}
	/** Import pages */
	if (p(1) == "admin"){
		if (g_uType() == "ADMIN" or g_uType() == "PHARMACY"){
			if(p(2) == "" or p(2) == "index") 
				require_once(realpath('./include/admin/')."/index.php");
			elseif(file_exists(realpath('./include/admin/')."/".p(2).".php")) 
				require_once(realpath('./include/admin/')."/".p(2).".php");
			else
				require_once(realpath('./include/admin/').'/error.php');
		}else{ r("", 0); }
	}else{
		if(p(1) == "" or p(1) == "index") 
			require_once(realpath('./include/guest/')."/index.php");
		elseif(file_exists(realpath('./include/guest/')."/".p(1).".php")) 
			require_once(realpath('./include/guest/')."/".p(1).".php");
		else
			require_once(realpath('./include/guest/').'/error.php');
	}
	
