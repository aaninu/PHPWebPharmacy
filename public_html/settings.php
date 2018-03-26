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
		'URL'		=> "http://webpharmacy.aninu.xyz/",
		'LOGO'		=> "public/images/Logo_V1.png",
		'NAME'		=> "Web Pharmacy",
		'MOTTO'		=> "Impreuna pentru o viata mai buna.",
		'ADRESA'	=> "",
		'PHONE'		=> "",
		
		'KEY_SCR'	=> "1",	
		'INVOICE'	=> "000",	
		'TVA'		=> "19",	
		
		'FILE_DIR'	=> "./public/att/",	
		'FILE_SIZE'	=> "5",
		'FILE_URL'	=> "public/att/",
		
		'LIM_TIME'	=> "2592000",		// 60x60x24x30 >> Minim 30 de zile
		
		// Email settings 
		'EMAIL_PUBLIC'	=> '',

		'TIME_ZONE' 	=> 	"Europe/Bucharest",
		
		'SMTP_HOST' 	=> 	"mx1.hostinger.ro",
		'SMTP_PORT' 	=> 	"587",
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
		
	);
	
