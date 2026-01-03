<?php
/**
 * Mail Configuration File
 * Used globally across the HRMS mail system
 * 
 * IMPORTANT: For Gmail, you must use an App Password (not your regular password)
 * 1. Enable 2-Step Verification in your Google Account
 * 2. Go to: https://myaccount.google.com/apppasswords
 * 3. Generate an App Password for "Mail" on "Windows Computer"
 * 4. Use that 16-character password below (without spaces)
 */

return [

	// 🔹 SMTP Server Settings
	'smtp' => [
		'host' => 'smtp.gmail.com',
		'port' => 587,
		'encryption' => 'tls', // tls or ssl
		'auth' => true,
	],

	// 🔹 Authentication
	// NOTE: Use Gmail App Password, not your regular password!
	'credentials' => [
		'username' => 'hrms.odoo01@gmail.com',
		'password' => 'nooefcxuiamqkanx', 
	],

	// 🔹 Default Sender Info
	'from' => [
		'email' => 'ruchitdoshi62@gmail.com',
		'name' => 'Dayflow HRMS',
	],

	// 🔹 Global Mail Flags
	'options' => [
		'enable_mail' => true,   // set false to disable all mails (testing)
		'debug' => true,         // enable SMTP debug to troubleshoot
		'log_mail' => true,      // log mail success/failure
	],

];
