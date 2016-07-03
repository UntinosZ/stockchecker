<?php 
namespace App\helpers;

/**
* Mail System
*/
class Mail
{
	private $configs;
	function __construct()
	{
		$this->configs = require __dir__.'/../config.php';
	}

	public function extractData($data='')
	{
		$result = '';
		foreach ($data as $key => $value) {
			$currentPrice = isset($value['currentPrice']) ? $value['currentPrice'] : $value['price'];
			$result .= "
				<tr>
					<td>{$value['name']}</td>
					<td>{$value['url']}</td>
					<td>{$value['price']}</td>
					<td>{$value['reason']}</td>
					<td>{$currentPrice}</td>
				</tr>
			";
		}
		return $result;
	}
	public function toHtml($data='')
	{
		$html = '
			<h2>Vendor: <span>'.$data["vendor"].'</span></h2>
			<br>
			<table border="1" cellpadding="2" cellspacing="0">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Url</th>
						<th>Price</th>
						<th>Reason</th>
						<th>Last Price</th>
					</tr>
				</thead>
				<tbody>
					'.$this->extractData($data["data"]).'
				</tbody>
			</table>
			<br>
		';
		return $html;
	}

	public function send($html='')
	{
		$config = $this->configs['mail'];
		$result = false;
		$mail = new \PHPMailer;

		$mail->SMTPDebug = $config['smtp_debug'];

		$mail->isSMTP();
		$mail->Host = $config['smtp_host'];
		$mail->SMTPAuth = $config['smtp_auth'];
		$mail->Username = $config['username'];
		$mail->Password = $config['password'];
		$mail->SMTPSecure = $config['smtp_secure'];
		$mail->Port = $config['smtp_port'];

		$mail->setFrom($config['sender_email'], $config['sender_name']);
		$mail->addAddress($config['receiver_email'], $config['receiver_name']);

		$mail->isHTML($config['is_html']);

		$mail->Subject = 'Report Predator Stock of '.date('d/m/Y');
		$mail->Body    = $html;

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		    $result = false;
		} else {
		    echo 'Message has been sent';
		    $result = true;
		}
		return $result;
	}
}
 ?>