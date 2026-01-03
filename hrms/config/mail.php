<?php
/**
 * Mail Configuration File
 * Used globally across the HRMS mail system
 */

return [

	// 🔹 SMTP Server Settings
	'smtp' => [
		'host'       => 'smtp.gmail.com',
		'port'       => 587,
		'encryption' => 'tls', // tls or ssl
		'auth'       => true,
	],

	// 🔹 Authentication
	'credentials' => [
		'username' => 'hrms.odoo01@gmail.com',
		'password' => 'nooefcxuiamqkanx',
	],

	// 🔹 Default Sender Info
	'from' => [
		'email' => 'hrms.odoo01@gmail.com',
		'name'  => 'HRMS System',
	],

	// 🔹 Global Mail Flags
	'options' => [
		'enable_mail' => true,   // set false to disable all mails (testing)
		'debug'       => false,  // enable SMTP debug if needed
		'log_mail'    => true,   // log mail success/failure
	],

];
