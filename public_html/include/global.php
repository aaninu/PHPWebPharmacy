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
	
	/** Global Discounts */
	$GLOBAL_discount = db_gINFO_tag('discount');
	
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
						$wph_msg = "<font color='green'>Ai fost conectat cu succes.</font>";
						r('user/',0);
					}else{ $wph_msg = "<font color='red'>Ceva nu a functionat. Te rugam sa incerci mai tarziu.</font>"; }
				}else{ $wph_msg = "<font color='red'>Contul introdus nu se gaseste in baza de date.</font>"; }
			}else{ $wph_msg = "<font color='red'>Nu ati completat toate spatiile obligatorii.</font>"; }
		}
	}
	
	/** [lost-password] Page */
	if (p(1) == "lost-password"){
		if (g_uID()) r("user/", 0);
		$wph_email = "";
		$wph_msg = "";
		$wph_lost_password = gPOST('wph_lost_password');
		if ($wph_lost_password == "Reseteaza parola"){
			$wph_email = gPOST('wph_email');
			if ($wph_email){
				if (wph_check_lost_time()){
					if (db_exist_account($wph_email)){
						$newPass = wph_generate_password();
						if (db_update_user_password($wph_email, $newPass)){
							if (mail_send_new_password($wph_email, $newPass)){
								sSESSION("wph_user_time_lost", time());
								$wph_msg = "<font color='green'>Un email cu noua parola a fost trimis la adresa: <u><i>".$wph_email."</i></u></font>";
								$wph_email = "";
							}else{ $wph_msg = "<font color='red'>Ceva nu a mers bine. Email-ul nu a fost trimis, dar parola a fost modificata. Te rugam sa incerci mai tarziu.</font>"; }
						}else{ $wph_msg = "<font color='red'>Ceva nu a mers bine. Parola nu a fost actualizata. Te rugam sa incerci mai tarziu.</font>"; }
					}else{ $wph_msg = "<font color='red'>Adresa de email nu a fost gasita in platforma noastra.</font>"; }
				}else{ $wph_msg = "<font color='red'>Ai trimis deja un email. Mai poti trimite un nou email peste ".s("SMTP_TIME")." minute.</font>"; }
			}else{ $wph_msg = "<font color='red'>Nu ati completat toate spatiile obligatorii.</font>"; }
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
								$wph_msg = "<font color='green'>Contul a fost inregistrat cu success.</font>";
							}else{ $wph_msg = "<font color='red'>Contul nu a fost inregistrat. Te rugam sa incerci mai tarziu.</font>"; }
						}else{ $wph_msg = "<font color='red'>Adresa de email a fost deja folosita.</font>";}
					}else{ $wph_msg = "<font color='red'>Parola trebuie sa contina cel putin 8 caractere.</font>"; }
				}else{ $wph_msg = "<font color='red'>Adresa de email nu este valida.</font>"; }
			}else{ $wph_msg = "<font color='red'>Nu ati completat toate spatiile obligatorii.</font>"; }
		}
	}
	
	/** [user] Page */
	if (p(1) == "user"){
		if (!g_uID()) r("login/", 0);
		
		
	}
	
	/** [user-password] Page */
	if (p(1) == "user-password"){
		if (!g_uID()) r("login/", 0);
		$wph_msg = "";
		$wph_password = "";
		$wph_password_new = "";
		$wph_password_repeat = "";		
		$wph_change = gPOST('wph_change');
		if ($wph_change == "Schimba parola"){
			$wph_password = gPOST('wph_password');
			$wph_password_new = gPOST('wph_password_new');
			$wph_password_repeat = gPOST('wph_password_repeat');
			if ($wph_password and $wph_password_new and $wph_password_repeat){
				if (strlen($wph_password_new) >= 8){
					if ($wph_password_new == $wph_password_repeat){
						if(db_exist_account(g_uEMAIL(), $wph_password)){
							if (db_update_password(g_uEMAIL(), $wph_password_new)){
								$wph_msg = "<font color='green'>Parola contului a fost actualizata cu succes.</font>";
							}else{ $wph_msg = "<font color='red'>S-a produs o eroare. Parola nu se poate actualiza. Te rugam sa incerci mai tarziu.</font>"; }
						}else{ $wph_msg = "<font color='red'>Parola curenta nu a fost introdusa corect.</font>"; }
					}else{ $wph_msg = "<font color='red'>Cele doua parole trebuie sa fie identice.</font>"; }
				}else{ $wph_msg = "<font color='red'>Parola noua trebuie sa contina cel putin 8 caractere.</font>"; }
			}else{ $wph_msg = "<font color='red'>Nu ati completat toate spatiile obligatorii.</font>"; }
		}
	}
	
	/** [user-settings] Page */
	if (p(1) == "user-settings"){
		if (!g_uID()) r("login/", 0);
		$wph_msg = "";
		$wph_nume = g_uNUME();
		$wph_prenume = g_uPRENUME();
		$wph_addr = g_uADDR();
		$wph_phone = g_uPHONE();
		$wph_change = gPOST('wph_change');
		if ($wph_change == "Schimba informatiile"){
			$wph_nume = gPOST('wph_nume');
			$wph_prenume = gPOST('wph_prenume');
			$wph_addr = gPOST('wph_addr');	
			$wph_phone = gPOST('wph_phone');	
			if ($wph_nume and $wph_prenume and $wph_addr and $wph_phone){
				if (db_update_info(g_uEMAIL(), $wph_nume, $wph_prenume, $wph_addr, $wph_phone)){
					$wph_msg = "<font color='green'>Informatiile au fost actualizate cu succes.</font>";
				}else{ $wph_msg = "<font color='red'>S-a produs o eroare. Te rugam sa incerci mai tarziu.</font>"; }
			}else{ $wph_msg = "<font color='red'>Nu ati completat toate spatiile obligatorii.</font>"; }
		}
	}
	
	/** [user-invoices] Page */
	if (p(1) == "user-invoices"){
		if (!g_uID()) r("login/", 0);
	}
	
	/** [user-settings] Page */
	if (p(1) == "user-settings"){
		if (!g_uID()) r("login/", 0);
	}
	
	/** [product] Page */
	if (p(1) == "product"){
		$productID = sMyID(p(2), "d");
		if (!db_exist_product($productID)) r('products/', 0);
		db_update_views($productID);
	}
	
	/** [products] Page */
	if (p(1) == "products"){
		$itemPage = 20;
		$totalProd = db_total_products();
		$pageNum = sMyID(p(2), "d");
		$lastPageFloat = $totalProd / $itemPage;
		$lastPage = intval($totalProd / $itemPage);
		if ($lastPageFloat > $lastPage){ $lastPage += 1; }
		if ($pageNum > $lastPage){ $pageNum = $lastPage; }
		if ($pageNum <= 0){
			$startWith = 0;
		}else{
			$startWith = ($pageNum - 1) * $itemPage;
		}
	}
	
	/** [discounts] Page */
	if (p(1) == "discounts"){
		$itemPage = 20;
		$totalProd = db_total_products_discounts();
		$pageNum = sMyID(p(2), "d");
		$lastPageFloat = $totalProd / $itemPage;
		$lastPage = intval($totalProd / $itemPage);
		if ($lastPageFloat > $lastPage){ $lastPage += 1; }
		if ($pageNum > $lastPage){ $pageNum = $lastPage; }
		if ($pageNum <= 0){
			$startWith = 0;
		}else{
			$startWith = ($pageNum - 1) * $itemPage;
		}
	}
	
	/** [invoice] Page */
	if (p(1) == "invoice"){
		$iINVOICE = p(2);
		$invID = sMyID($iINVOICE, "d");
		if (!db_exist_invoice($invID)) r('', 0);
		$iUSER = db_gUSER_invoice($invID);
		if (g_uType() == "ADMIN" or g_uType() == "PHARMACY" or $iUSER == g_uID()){ 
			$aUSER = db_gINFO_user($iUSER);
			$dCOMANDA = db_gDATE_invoice($invID);
			$sSTATUS = db_gSTATUS_invoice($invID);
			$sPAYM = db_gPAYM_invoice($invID);
			$sPAYD = db_gPAYD_invoice($invID);
			$sPAYT = db_gPAYT_invoice($invID);
			$sORDER = db_gDORDER_invoice($invID);
			$sPHARM = db_gPHARMACY_invoice($invID);
			require __DIR__.'/code/Code128.php';
			// Payment success
			if (p(3) == "pay-success" and $sSTATUS != "PAID"){
				$item_number = gPOST('item_number');
				$payment_status = gPOST('payment_status'); 
				$payer_email = gPOST('payer_email'); 
				$mc_gross = gPOST('mc_gross'); 
				$mc_currency = gPOST('mc_currency'); 
				$first_name = gPOST('first_name'); 
				$last_name = gPOST('last_name'); 
				$payment_date = gPOST('payment_date'); 
				$payer_id = gPOST('payer_id'); 
				$txn_id = gPOST('txn_id'); 
				if(($item_number=="") or ($payment_status=="") or ($payer_email=="") or ($mc_gross=="") or ($mc_currency=="") or ($first_name=="") or ($last_name=="") or ($payment_date=="") or ($payer_id=="") or ($txn_id=="")){
					$types = "red";
					$message_1 = "Eroare de plata";
					$message_2 = "Nu am reusit sa extragem datele importante! Mai incearca!";
				}if($mc_gross < gSESSION("wph_invoice_euro")){
					$types = "red";
					$message_1 = "Eroare de plata";
					$message_2 = "Suma platita nu este egala cu suma existenta pe factura.";
				}else{
					$name_pp = $first_name." ".$last_name;
					db_update_invoice_status_PayPal($invID, $txn_id);
					update_invoice_products($invID);
					$types = "green";
					$message_1 = "Plata acceptata";
					$message_2 = "Factura a fost platita cu succes. Va rugam sa va prezentati in magazinul nostru pentru ridicarea produselor.";
				}
				$_SESSION["wph_invoice_euro"] = "";
			}
		}else{
			r('not-for-you/', 0);
		}
	}
	
	/** [reports] Page */
	if (p(1) == "reports"){
		$limit_start = intval(p(2));
		$limit_stop = intval(p(3));
		if ($limit_start and $limit_stop){
			$limit = time();
			$limit_day = 24*60*60;
			$limit_time = $limit + $limit_day;
			if (($limit_stop < $limit_time) and ($limit_start < $limit) and ($limit_stop > $limit_start)){
				require __DIR__.'/code/Code128.php';
				
				
			}else{ r('admin/reports/', 0); }
		}else{ r('admin/reports/', 0); }
		
	}
	
	/** [pdf] Page */
	if (p(1) == "pdf"){
		
		echo "In progress";
	}
	
	/** [find] Page */
	{
		$wph_search_value = (gSEARCH())?gSEARCH():"";
		$wph_msg_find = "";
		$wph_search = gPOST('wph_search');
		if ($wph_search == "Cautare"){
			$wph_search_value = gPOST('wph_search_value');
			$wph_search_sortare = gPOST('wph_search_sortare');
			if ($wph_search_value){
				if ($wph_search_sortare)
					r("find/".$wph_search_sortare."/&search=".$wph_search_value."",0);
				else
					r("find/&search=".$wph_search_value."",0);
			}else{ $wph_msg_find = "<center><font color='red'><b>Introduceti cateva informatii despre medicamentul cautat.</b></font></center>"; }
		}
	}
	
	/** [contact] Page */
	if (p(1) == "contact"){
		$wph_msg = "";
		$wph_email = "";
		$wph_nume_prenume = "";
		$wph_subiect = "";
		$wph_message = "";
		$wph_contact = gPOST('wph_contact');
		if ($wph_contact == "Trimite"){
			$wph_email = gPOST('wph_email');
			$wph_nume_prenume = gPOST('wph_nume_prenume');
			$wph_subiect = gPOST('wph_subiect');
			$wph_message = str_replace("\\\\r\\\\n", "\n", gPOST('wph_message'));
			$wph_message = str_replace("\r\n", "\n", $wph_message);
			if ($wph_email and $wph_nume_prenume and $wph_subiect and $wph_message){
				if (wph_check_contact_time()){
					if (mail_send_contact($wph_nume_prenume, $wph_email, $wph_subiect, $wph_message)){
						sSESSION("wph_user_time_contact", time());
						$wph_email = "";
						$wph_nume_prenume = "";
						$wph_subiect = "";
						$wph_message = "";
						$wph_msg = "Un email a fost trimis la adresa: ".s("EMAIL_PUBLIC").".";
					}else{ $wph_msg = "Ceva nu a mers bine. Email-ul nu a fost trimis. Te rugam sa incerci mai tarziu."; }
				}else{ $wph_msg = "Ai trimis deja un email. Mai poti trimite un nou email peste ".s("SMTP_TIME")." minute."; }
			}else{ $wph_msg = "Nu ati completat toate spatiile obligatorii."; }
		}
	}
	
	/** [cart-add] Page */
	if (p(1) == "cart-add"){
		$productID = sMyID(p(2), "d");
		// Verifica daca produsul exista
		if ($productID == 0) r('cart/', 0);
		if (!db_exist_product($productID)) r('products/', 0);
		// Verifica limita maxima de produse disponibile
		$countMAX = db_gCOUNT_product($productID);
		if ($countMAX == 0){ r('product/'.p(2).'/', 0); exit(); }
 		$countPROD = intval(p(3));
		if ($countPROD > $countMAX) $countPROD = $countMAX;
		elseif ($countPROD < 1) $countPROD = 1;
		// Daca produsul exista in cos se va modifica cantitatea
		$aCART = gSESSION("wph_cart");
		$aNewCART = array();
		$noEXIST = true;
		foreach($aCART as $id => $info){
			if ($info[0] == $productID){
				if (p(4)){
					$info[1] = $info[1] - $countPROD;
					if ($info[1] < 1) $info[1] = 1;
				}else{
					$info[1] = $info[1] + $countPROD;
					if ($info[1] > $countMAX) $info[1] = $countMAX;
				}
				$noEXIST = false;
			}
			// Verifica daca produsul dic cos mai exista in stoc
			$cantitateSTOC = db_gCOUNT_product($info[0]);
			$eroare = 1;
			if ($cantitateSTOC == 0) $eroare = 0;
			elseif ($cantitateSTOC < $info[1]) $eroare = -1;
			array_push($aNewCART, array($info[0], $info[1], $eroare)); 
		}
		// Daca produsul nu exista in cos se va adauga
		if ($noEXIST){
			$prodInfo = array($productID, $countPROD, 1);
			array_push($aNewCART, $prodInfo);
		}
		// Actualizeaza cosul principal
		sSESSION("wph_cart", $aNewCART);
		r('cart/', 0);
	}
	
	/** [cart-remove] Page */
	if (p(1) == "cart-remove"){
		$productID = sMyID(p(2), "d");
		// Verifica daca produsul exista
		if ($productID == 0) r('cart/', 0);
		$aCART = gSESSION("wph_cart");
		$aNewCART = array();		
		$noEXIST = true;
		foreach($aCART as $id => $info){
			$noEXIST = true;
			if ($info[0] == $productID){ $noEXIST = false;}
			if ($noEXIST){ array_push($aNewCART, $info); }
		}
		// Actualizeaza cosul principal
		sSESSION("wph_cart", $aNewCART);
		r('cart/', 0);
	}
	
	/** [cart-finish] Page */
	if (p(1) == "cart-finish"){
		$aCART = gSESSION("wph_cart");
		$changes = false;
		$aNewCART = array();
		$eroare = 1;
		foreach($aCART as $id => $info){
			$eroare = 1;
			$cantitateSTOC = db_gCOUNT_product($info[0]);
			$cantitateCERUTA = $info[1];
			if ($cantitateSTOC == 0){
				$changes = true;
				$eroare = 0;
			}elseif($cantitateSTOC < $cantitateCERUTA){
				$changes = true;
				$eroare = -1;
			}
			array_push($aNewCART, array($info[0], $info[1], $eroare)); 
		}
		if ($changes){
			sSESSION("wph_cart", $aNewCART);
			r('cart/', 0);
		}else{
			db_create_invoice();
			$iINVOICE = db_gID_invoice();
			foreach($aCART as $id => $info){
				db_add_invoice_items($iINVOICE, $info[0], $info[1], db_gPRET_product($info[0], 1), db_gPRET_product($info[0]), db_gMONEDA_product($info[0]));
			}
			sSESSION("wph_cart", array());
			r('invoice/'.sMyID($iINVOICE).'/', 0);
		}
	}
	
	/** [cart-clear] Page */
	if (p(1) == "cart-clear"){
		sSESSION("wph_cart", array());
		r('cart/', 0);
	}
	
	/** Check [admin] full warnings */
	if (p(1) == "admin"){
		$readError = db_check_q_products();
		$msgTitle = "";
		$msgError = "";
		$msgIcon = "";	// [warning / error]
		// Set text for popup toaster
		if ($readError == 1){ 
			$msgTitle = "Stocuri de medicamente.";
			$msgError = 'In stoc exista produse a caror cantitate este mai mica decat limita impusa.';
			$msgIcon = "warning";
		}elseif ($readError == 2){
			$msgTitle = "Stocuri de medicamente.";
			$msgError = 'In stoc exista produse a caror cantitate este mai mica decat limita impusa.';
			$msgIcon = "error";
		}
		
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
		if ($wph_addproduct == "Adauga produsul"){
			$msgTitle = "Adauga medicamente";
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
											$msgIcon = "success";
											$msgError =  'Medicamentul a fost adaugat cu succes.'; 
										}else{
											$msgIcon = "error";
											$msgError = 'S-a produs o eroare. Te rugam sa incerci mai tarziu. '; 
										}
									}else{ 
										$msgIcon = "warning";
										$msgError = "Medicamentul trebuie sa fie disponibil pentru cel putin ".(s('LIM_TIME')/60/60/24)." (de) zile"; 
									}
								}else{
									$msgIcon = "warning";
									$msgError = "Cantitatea trebuie sa fie o valoare pozitiva mai mare ca 0."; 
								}
							}else{ 
								$msgIcon = "warning";
								$msgError = "Moneda selectata nu este valida! Monede disponibile: RON, EURO."; 
							}
						}else{ 
							$msgIcon = "warning";
							$msgError = "Imaginea selectata depaseste limita impusa! (Maxim ".s('FILE_SIZE')."MB)."; 
						}
					}else{ 
						$msgIcon = "warning";
						$msgError = "Fisierul selectat nu respecta extensiile standard (png, jpg, jpeg, gif)."; 
					}
				}else{ 
					$msgIcon = "error";
					$msgError = "Fisierul selectat nu a fost acceptat! Te rugam sa alegi alta imagine.";
				}
			}else{ 
				$msgIcon = "error";
				$msgError = "Nu ati completat toate spatiile obligatorii.";
			}
		}
	}
	
	/** [admin/products-edit] Page */
	if (p(1) == "admin" and p(2) == "products-edit"){
		$productID = sMyID(p(3), "d");
		if (!db_exist_product($productID)) r('products/', 0);
		$productINFO = db_gINFO_product($productID);
		$wph_s_nume = $productINFO[0];
		$wph_s_pret = $productINFO[1];
		$wph_s_moneda = $productINFO[2];
		$wph_i_cantitate = $productINFO[3];
		$wph_i_reducere = $productINFO[4];
		$wph_s_descriere = $productINFO[5];
		$wph_s_Tip = $productINFO[6];
		$wph_s_Mod = $productINFO[7];
		$wph_d_expirare = date("Y-m-d", $productINFO[8]);
		$wph_editproduct = gPOST('wph_editproduct');	
		if ($wph_editproduct == "Salveaza modificarile"){
			$msgTitle = "Salveaza modificarile";
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
			// Verifica daca se modifica imaginea.
			if ($wph_image["name"]){
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
										if (move_uploaded_file($wph_image["tmp_name"], $save_to) and db_update_product($productID, $wph_s_nume, $wph_s_pret, $wph_s_moneda, $wph_i_reducere, $wph_i_cantitate, $wph_s_descriere, $wph_s_Tip, $wph_s_Mod, strtotime($wph_d_expirare), $db_save)) {
											$msgIcon = "success";
											$msgError =  'Medicamentul a fost actualizat cu succes.'; 
										}else{ 
											$msgIcon = "error";
											$msgError = 'S-a produs o eroare. Te rugam sa incerci mai tarziu. '; 
										}
									}else{ 
										$msgIcon = "warning";
										$msgError = "Medicamentul trebuie sa fie disponibil pentru cel putin ".(s('LIM_TIME')/60/60/24)." (de) zile"; 
									}
								}else{ 
									$msgIcon = "warning";
									$msgError = "Cantitatea trebuie sa fie o valoare pozitiva mai mare ca 0."; 
								}
							}else{ 
								$msgIcon = "warning";
								$msgError = "Moneda selectata nu este valida! Monede disponibile: RON, EURO."; 
							}
						}else{
							$msgIcon = "warning";
							$msgError = "Imaginea selectata depaseste limita impusa! (Maxim ".s('FILE_SIZE')."MB)."; 
						}
					}else{ 
						$msgIcon = "warning";
						$msgError = "Fisierul selectat nu respecta extensiile standard (png, jpg, jpeg, gif)."; 
					}
				}else{ 
					$msgIcon = "warning";
					$msgError = "Fisierul selectat nu a fost acceptat! Te rugam sa alegi alta imagine.";
				}
			}else{
				if ($wph_s_nume and $wph_s_pret and $wph_s_moneda and $wph_i_cantitate and $wph_s_descriere and $wph_s_Tip and $wph_s_Mod and $wph_d_expirare){
					// Check [Moneda] {RON/EURO}
					if ($wph_s_moneda == "RON" or $wph_s_moneda == "EURO"){
						// Check [Cantitate] {>0}
						if ($wph_i_cantitate > 0){
							// Check [Expirare] {>30day}
							if (strtotime($wph_d_expirare) > time()+s('LIM_TIME')){
								// Updte information to database
								if (db_update_product($productID, $wph_s_nume, $wph_s_pret, $wph_s_moneda, $wph_i_reducere, $wph_i_cantitate, $wph_s_descriere, $wph_s_Tip, $wph_s_Mod, strtotime($wph_d_expirare))) {
									$msgIcon = "success";
									$msgError =  'Medicamentul a fost actualizat cu succes.'; 
								}else{ 
									$msgIcon = "error";
									$msgError = 'S-a produs o eroare. Te rugam sa incerci mai tarziu. '; 
								}
							}else{ 
								$msgIcon = "warning";
								$msgError = "Medicamentul trebuie sa fie disponibil pentru cel putin ".(s('LIM_TIME')/60/60/24)." (de) zile"; 
							}
						}else{ 
							$msgIcon = "warning";
							$msgError = "Cantitatea trebuie sa fie o valoare pozitiva mai mare ca 0."; 
						}
					}else{
						$msgIcon = "warning";
						$msgError = "Moneda selectata nu este valida! Monede disponibile: RON, EURO."; 
					}
				}else{
					$msgIcon = "error";
					$msgError = "Nu ati completat toate spatiile obligatorii.";
				}
			}
		}
	}
	
	/** [admin/invoice-edit] Page */
	if (p(1) == "admin" and p(2) == "invoice-edit"){
		$iINVOICE = p(3);
		$invID = sMyID($iINVOICE, "d");
		if (!db_exist_invoice($invID)) r('admin/invoices/', 0);
		$wph_info = "";
		$wph_editinvoice = gPOST('wph_editinvoice');	
		if ($wph_editinvoice == "Salveaza modificarile"){
			$msgTitle = "Salveaza modificarile";
			$wph_s_status = gPOST('wph_s_status');
			$wph_s_comanda = gPOST('wph_s_comanda');
			$wph_info = gPOST('wph_info');
			if ($wph_s_status){
				if ($wph_s_status == 1) $wph_s_status = "PAID";
				elseif ($wph_s_status == 2) $wph_s_status = "UNPAID";
				else $wph_s_status = "CANCELED";
				if ($wph_s_comanda == 1) $wph_s_comanda = "OK";
				else $wph_s_comanda = "WAIT";
				if (db_update_invoice_status($invID, $wph_s_status, $wph_s_comanda, $wph_info)){
					update_invoice_products($invID);
					$msgIcon = "success";
					$msgError = 'Factura curenta a fost actualizata cu succes.'; 					
				}else{
					$msgIcon = "error";
					$msgError = 'S-a produs o eroare. Te rugam sa incerci mai tarziu. '; 
				}
			}else{
				$msgIcon = "error";
				$msgError = "Nu ati completat toate spatiile obligatorii.";
			}
		}
		$invSTATUS = db_gSTATUS_invoice($invID);
		$invORDER = db_gORDER_invoice($invID);
	}
	
	/** [admin/products-info] Page */
	if (p(1) == "admin" and p(2) == "products-info"){
		$productID = sMyID(p(3), "d");
		if (!db_exist_product($productID)) r('admin/products/', 0);
	}
	
	/** [admin/products] Page */
	if (p(1) == "admin" and p(2) == "products"){
		$itemPage = 15;
		$totalProd = db_total_products();
		$pageNum = sMyID(p(3), "d");
		$lastPageFloat = $totalProd / $itemPage;
		$lastPage = intval($totalProd / $itemPage);
		if ($lastPageFloat > $lastPage){ $lastPage += 1; }
		if ($pageNum > $lastPage){ $pageNum = $lastPage; }
		if ($pageNum <= 0){
			$startWith = 0;
		}else{
			$startWith = ($pageNum - 1) * $itemPage;
		}
	}
	
	/** [admin/invoices] Page */
	if (p(1) == "admin" and p(2) == "invoices"){
		$itemPage = 15;
		$totalProd = db_total_invoices();
		$pageNum = sMyID(p(3), "d");
		$lastPageFloat = $totalProd / $itemPage;
		$lastPage = intval($totalProd / $itemPage);
		if ($lastPageFloat > $lastPage){ $lastPage += 1; }
		if ($pageNum > $lastPage){ $pageNum = $lastPage; }
		if ($pageNum <= 0){
			$startWith = 0;
		}else{
			$startWith = ($pageNum - 1) * $itemPage;
		}
	}

	/** [admin/settings] Page */
	if (p(1) == "admin" and p(2) == "settings"){
		$wph_discount = $GLOBAL_discount;
		$wph_about = db_gINFO_tag('about');
		$wph_carrers = db_gINFO_tag('carrers');
		$wph_replati = db_gINFO_tag('reservations-payments');
		$wph_about = str_replace("<br>","&#10;", $wph_about);
		$wph_carrers = str_replace("<br>","&#10;", $wph_carrers);
		$wph_replati = str_replace("<br>","&#10;", $wph_replati);
		$wph_change = gPOST('wph_change');	
		if ($wph_change == "Salveaza modificarile"){
			$msgTitle = "Setari generale";
			$wph_discount = gPOST('wph_discount');
			$wph_about = wph_newline(gPOST('wph_about'));
			$wph_carrers = wph_newline(gPOST('wph_carrers'));
			$wph_replati = wph_newline(gPOST('wph_replati'));
			if ($wph_about and $wph_carrers and $wph_replati){
				if (is_numeric($wph_discount) and strlen($wph_discount) <= 5){
					if(db_update_settings($wph_discount ,$wph_about, $wph_carrers ,$wph_replati)){
						$msgIcon = "success";
						$msgError = 'Setarile au fost actualizate cu succes.'; 	
					}else{
						$msgIcon = "error";
						$msgError = 'S-a produs o eroare. Te rugam sa incerci mai tarziu. '; 
					}
				}else{
					$msgIcon = "warning";
					$msgError = "Valoarea introdusa pentru discount nu este valida!";
				}
			}else{
				$msgIcon = "error";
				$msgError = "Nu ati completat toate spatiile obligatorii.";
			}
		}
	}
	
	/** [admin/reports] Page */
	if (p(1) == "admin" and p(2) == "reports"){
		$wph_d_start = "";
		$wph_d_stop = "";
		$wph_get = gPOST('wph_get');
		if ($wph_get == "Genereaza raport"){
			$msgTitle = "Rapoarte de vanzari";
			$wph_d_start = gPOST('wph_d_start');
			$wph_d_stop = gPOST('wph_d_stop');
			if($wph_d_start and $wph_d_stop){
				$limit = time();
				$limit_time = $limit + 24*60*60;
				$limit_stop = strtotime($wph_d_stop);
				$limit_start = strtotime($wph_d_start);
				if ($limit_stop < $limit_time){
					if ($limit_start < $limit){
						if ($limit_stop > $limit_start){
							r('reports/'.$limit_start.'/'.$limit_stop.'/', 0);
						}else{
							$msgIcon = "warning";
							$msgError = "Data de start trebuie sa fie mai mare decat cea de stop.";
						}
					}else{
						$msgIcon = "warning";
						$msgError = "Nu putem crea raport pentru data selectata (Start Date).";
					}
				}else{
					$msgIcon = "warning";
					$msgError = "Nu putem crea raport pentru data selectata (Stop Date).";
				}
			}else{ 
				$msgIcon = "error";
				$msgError = "Nu ati completat toate spatiile obligatorii.";
			}
		}
	}
	
	/** [admin/imports] Page */
	if (p(1) == "admin" and p(2) == "imports"){
        if (p(3) == "s"){
            $msgTitle = "Incarca medicamentel";
            $msgIcon = "success";
            $msgError =  'Medicamentele au fost adaugate cu succes in platforma.'; 
        }
		$msg_info = "";
		$wph_get = gPOST('wph_get');
		if ($wph_get == "Incarca medicamentele"){
			$msgTitle = "Incarca medicamentel";
			$wph_upload = gFILES("upload");
			$check = upload_check_extension($wph_upload);
			if($check[0] == True){
				$xmlNo = upload_check_multiple_xml($wph_upload);
				if ($xmlNo == 1){
					$xmlFile = upload_get_xml_file($wph_upload);
					if ($xmlFile){
						$INFO = upload_get_info($xmlFile);
                        if (count($INFO)){
                            $checkInf = upload_check_selected_all_images($wph_upload, $INFO);
                            if($checkInf[0]){
                                $fileche = upload_files_to_server($wph_upload, $INFO);
                                if($fileche){
                                    $newChe = upload_save_to_database($INFO, $fileche[1]);
                                    if ($newChe[0]){
                                        r('admin/imports/s/', 0);
                                        $msgIcon = "success";
                                        $msgError =  'Medicamentele au fost adaugate cu succes in platforma.'; 
                                    }else{
                                        $msgIcon = "warning";
                                        $msgError = "Urmatoarele medicamente nu au fost importate: ";
                                        for($ii = 0; $ii < count ($newChe[1]); $ii++){ $msgError .= $newChe[1][$ii].', '; }
                                        $msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
                                    }
                                }else{
                                    $msgIcon = "warning";
                                    $msgError = "Urmatoarele fisiere nu au fost incarcate: ";
                                    for($ii = 0; $ii < count ($fileche[1]); $ii++){ $msgError .= $fileche[1][$ii].', '; }
                                    $msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
                                }
                            }else{
                                $msgIcon = "warning";
                                $msgError = "Nu au fost selectate toate imaginile declarate in fisierul de tip XML. Lipsesc fisierele: ";
                                for($ii = 0; $ii < count ($checkInf[1]); $ii++){ $msgError .= $checkInf[1][$ii].', '; }
                                $msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
                            }
                        }else{
                            $msgIcon = "warning";
                            $msgError = "Fisierul de tip XML nu contine inregistrari corespunzatoare.";
                            $msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
                        }
					}else{
						$msgIcon = "warning";
						$msgError = "Nu a fost gasit nici un fisier de tip XML.";
						$msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
					}
				}elseif ($xmlNo == 0){
					$msgIcon = "warning";
					$msgError = "Nu a fost gasit nici un fisier de tip XML.";
					$msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
				}else{
					$msgIcon = "warning";
					$msgError = "Ati selectat mai multe fisiere de tip XML.";
					$msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
				}
			}else{
				$msgIcon = "warning";
				$msgError = "Exista fisiere a caror extensie nu este acceptata: ";
				for($ii = 0; $ii < count ($check[1]); $ii++){ $msgError .= $check[1][$ii].', '; }
				$msgError .= "aceste fisiere nu trebuie selectate.";
				$msg_info = "<hr><font color='red'>".$msgError."</font><hr>";
			}
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
	
