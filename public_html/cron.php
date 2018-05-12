<?PHP
	//////////////////////////////////////////////////////////////
	// PHP Web Pharmacy
	// GIT: https://github.com/aaninu/PHPWebPharmacy
	//
	// Index file
	//////////////////////////////////////////////////////////////
	
	/** Import file [functions.php]*/
	require('./include/functions.php');
	
	/** Variables used */
	$db_conn = db_connect();
	$time_now = time();
	$time_limit = $time_now - s('INVOICE_LIMIT');
	
	/** Check order limit time */
	if ($db_conn){
		echo "Verificarea timpului dupa facturi: <br>";
		$total = 0;
		if ($dbcon = mysqli_query(db_connect(), "SELECT * FROM ".db_table('invoice')." WHERE s_status = 'UNPAID';")){
			while ($info=mysqli_fetch_object($dbcon)){ 
				if ($info->d_comanda <= $time_limit){
					$total++;
					if (db_update_invoice($info->id, "Actualizare automata. A expirat limita de timp.")){
						echo " Factura cu numarul {".$info->id."} a fost anulata. <br>";
					}else{
						echo " Factura cu numarul {".$info->id."} nu a fost actualizata. <br>";
					}
				}
			}
		}
		if (!$total){ echo "Nu exista facturi disponibile. <br>"; }
	}else{ echo "Nu se poate conecta la baza de date ... <br>"; }
	
	/** Verifica valoare curenta RON-EURO */
	{
		$from = "RON";
		$to = "EUR";
		$conv_id = "{$from}_{$to}";
		$string = file_get_contents("http://free.currencyconverterapi.com/api/v3/convert?q=$conv_id&compact=ultra");
		$json_a = json_decode($string, true);
		$valoare =  round($json_a[$conv_id], 4);
		$cron_value = fopen("include/cron/currency_RON_EURO.txt", "w");
		fwrite($cron_value, $valoare);
		fclose($cron_value);
		echo "Valoarea euro a fost actualizata { $valoare } <b>include/cron/currency_RON_EURO.txt</b> ...<br>";
	}