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
		$wph_i_cantitate = 0;
		$wph_i_reducere = 0;
		$wph_s_descriere = "";
		$wph_s_Tip = "";
		$wph_s_Mod = "";
		$wph_d_expirare = "";
		$wph_addproduct = gPOST('wph_addproduct');
		if ($wph_addproduct == "Adauga medicamentul"){
			$wph_s_nume = gPOST('wph_s_nume');
			$wph_s_pret = gPOST('wph_s_pret');
			$wph_s_moneda = gPOST('wph_s_moneda');
			$wph_i_cantitate = intval(gPOST('wph_i_cantitate'));
			$wph_i_reducere = gPOST('wph_i_reducere');
			$wph_s_descriere = gPOST('wph_s_descriere');
			$wph_s_Tip = gPOST('wph_s_Tip');
			$wph_s_Mod = gPOST('wph_s_Mod');
			$wph_d_expirare = gPOST('wph_d_expirare');
			$wph_image = gFILES("wph_image");
			// Check empty fields
			if ($wph_s_nume and $wph_s_pret and $wph_s_moneda and $wph_i_cantitate and $wph_s_descriere and $wph_s_Tip and $wph_s_Mod and $wph_d_expirare and $wph_image["name"]){
				// Check file error
				if($wph_image["error"] == 0){
					$target_file = s('FILE_DIR').basename($wph_image["name"]);
					$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
					$aux_ext = strtolower($imageFileType);
					// Check file extension
					if ($aux_ext == "png" or $aux_ext == "jpg" or $aux_ext == "jpeg" or $aux_ext == "gif"){
						$im_size = $wph_image["size"];
						// Check Image size
						if ($im_size <= s('FILE_SIZE')*1024*1024){
							// Save image on server with name {USER_ID}_{TIME_NOW}_{md5(FILE_NAME)}.{EXTENSIE}
							$save_name = g_uID()."_".time()."_".md5(basename($wph_image["name"])).".".$imageFileType;
							$save_to = s('FILE_DIR').$save_name;
							$db_save = u(s('FILE_URL').$save_name);
							// Check [Moneda] {RON/EURO}
							if ($wph_s_moneda == "RON" or $wph_s_moneda == "EURO"){
								// Check [Cantitate] {>0}
								if ($wph_i_cantitate > 0){
									// Check [Expirare] {>30day}
									if (strtotime($wph_d_expirare) > time()+s('LIM_TIME')){
										// Check upload and save on database
										if (move_uploaded_file($wph_image["tmp_name"], $save_to) and db_create_product($wph_s_nume, $wph_s_pret, $wph_s_moneda, $wph_i_reducere, $wph_i_cantitate, $wph_s_descriere, $wph_s_Tip, $wph_s_Mod, $db_save, strtotime($wph_d_expirare))) {
											$wph_s_nume = "";
											$wph_s_pret = "";
											$wph_s_moneda = "";
											$wph_i_cantitate = 0;
											$wph_i_reducere = 0;
											$wph_s_descriere = "";
											$wph_s_Tip = "";
											$wph_s_Mod = "";
											$wph_d_expirare = "";
											$wph_msg =  'Medicamentul a fost adaugat cu succes.'; 
										}else{ $wph_msg = 'S-a produs o eroare. Te rugam sa incerci mai tarziu. '; }
									}else{ $wph_msg = "Medicamentul trebuie sa fie disponibil pentru cel putin ".(s('LIM_TIME')/60/60/24)." (de) zile"; }
								}else{ $wph_msg = "Cantitatea trebuie sa fie o valoare pozitiva mai mare ca 0."; }
							}else{ $wph_msg = "Moneda selectata nu este valida! Monede disponibile: RON, EURO."; }
						}else{ $wph_msg = "Imaginea selectata depaseste limita impusa! (Maxim ".s('FILE_SIZE')."MB)."; }
					}else{ $wph_msg = "Fisierul selectat nu respecta extensiile standard (png, jpg, jpeg, gif)."; }
				}else{ $wph_msg = "Fisierul selectat nu a fost acceptat! Te rugam sa alegi alta imagine.";}
			}else{ $wph_msg = "Nu ati completat toate spatiile obligatorii.";}
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
	
