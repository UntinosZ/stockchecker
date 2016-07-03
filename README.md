# Stock Checker

## Installation
```
composer install
```

## Configuration

### SMTP Configuration
please config before start program
```
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
```

and run command to start process

```
php start.php
```

Develop By Nopparid Mokpradab
