<?PHP
	//////////////////////////////////////////////////////////////
	// PHP Web Pharmacy
	// GIT: https://github.com/aaninu/PHPWebPharmacy
	//
	// Settings file
	//////////////////////////////////////////////////////////////
	
	$settings = array(
		/** Database information */
		'DB_HOST' 	=> "",
		'DB_USER'	=> "",
		'DB_PASS'	=> "",
		'DB_DATB'	=> "",
		'DB_TAGS'	=> "webph_",
		
		/** General information */
		//'URL'		=> "http://webpharmacy.aninu.xyz/",
		'URL'		=> "https://aninu.xyz/projects/webpharmacy/",
		'LOGO'		=> "public/images/Logo_V1.png",
		'ICON'		=> "public/images/Icon_V1.ico",
		'NAME'		=> "Web Pharmacy",
		'MOTTO'		=> "",
		'ADRESA'	=> "",
		'PHONE'		=> "",
		'COPPY'		=> "2018",
		
		'KEY_SCR'	=> "1",	
		'INVOICE'	=> "000",	
		'TVA'		=> "19",	
		
		'INVOICE_LIMIT'	=> "604800", // 60x60x24x7 >> 7 zile
		
		'FILE_DIR'	=> "./public/att/",	
		'FILE_SIZE'	=> "5",
		'FILE_URL'	=> "public/att/",
		
		'AVATAR'	=> "public/att/wph_avatar.png",
		
		/* Limita minima de medicamente din stoc */
		'LIM_CANT'	=> "15",
		
		/* Timil minim de valabilitate pentru un medicament. */
		'LIM_TIME'	=> "2592000",		// 60x60x24x30 >> Minim 30 de zile
		
		// Email settings 
		'EMAIL_PUBLIC'	=> '',

		'TIME_ZONE' 	=> 	"Europe/Bucharest",
		
		'SMTP_HOST' 	=> 	"",
		'SMTP_PORT' 	=> 	"",
		'SMTP_USER' 	=> 	"",
		'SMTP_PASS' 	=> 	"",
		// Send By
		'SMTP_EMAIL' 	=> 	"",
		'SMTP_TITLE' 	=> 	"",
		// Reply To
		'SMTP_REPLY' 	=> 	"",
		'SMTP_REPTI' 	=> 	"",
		
		'SMTP_TIME' 	=> 	"15",			// Minutes
		
		// Developer Mode
		'DEV_MODE'		=> 'True',
		
		// Invoice to PDF >> https://www.convertapi.com/a
		'PDF_KEY'		=> '',
		
		// PayPal Settings
		//'PAYPAL_EMAIL'	=> '',
		'PAYPAL_EMAIL'	=> '',
		
	);
	
