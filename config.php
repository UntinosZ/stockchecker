<?php

return array(
  'modules' => array(
		[
			'name' => 'lazada',
			'controller' => 'App\\modules\\lazada\\Controller',
			'mail_alert' => true,
		],
		[
			'name' => 'jib',
			'controller' => 'App\\modules\\jib\\Controller',
			'mail_alert' => true,
		],
		[
			'name' => 'itcityonline',
			'controller' => 'App\\modules\\itcityonline\\Controller',
			'mail_alert' => true,
		],
		[
			'name' => 'bananastore',
			'controller' => 'App\\modules\\bananastore\\Controller',
			'mail_alert' => true,
		],

  ),
  'mail' => array(
  	'smtp_debug'	=> false,
  	'smtp_host' 	=> 'smtp.gmail.com',
  	'smtp_auth' 	=> true,
  	'username' 		=> 'predatorchecker@gmail.com',
  	'password' 		=> 'Kj2C3TyQ2JChUgs5',
  	'smtp_secure' => 'tls',
  	'smtp_port' 	=> 587,
  	'sender_email'=> 'predatorchecker@gmail.com',
  	'sender_name'	=> 'Predator Stock checker',
  	'receiver_email'=> 'tonuntinosz@gmail.com',
  	'receiver_name'=> 'Nopparid Mokpradab',
  	'is_html' => true,
  ),
);
