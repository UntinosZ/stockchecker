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
  ),
  'mail' => array(
  	'smtp_debug'	=> false,
  	'smtp_host' 	=> 'smtp.gmail.com',
  	'smtp_auth' 	=> true,
  	'username' 		=> 'username',
  	'password' 		=> 'password',
  	'smtp_secure' => 'tls',
  	'smtp_port' 	=> 587,
  	'sender_email'=> 'example@mail.com',
  	'sender_name'	=> 'Stock checker',
  	'receiver_email'=> 'receiver@email.com',
  	'receiver_name'=> 'Hier pooo',
  	'is_html' => true,
  ),
);
