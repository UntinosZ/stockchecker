<?php 
namespace App;

require __dir__.'/bootstrap.php';
use App\helpers\Mail;

/**
* Initialize Bot Checker product status
*/
class StockChecker
{
	private $modules;
	private $configs;

	function __construct()
	{
		$this->configs = require __dir__ . '/config.php';
	}

	private function loadModule()
	{
		$this->modules = $this->configs['modules'];
	}

	public function loadReport($moduleName='')
	{
		$data = file_get_contents(__dir__.'/report/'.$moduleName.'.json');
		return json_decode($data, true);
	}

	public function sendReport()
	{
		$mailHtml = '';
		$mail = new Mail;
		foreach ($this->modules as $key => $value) {
			if ($value['mail_alert'] == true) {
				$report['vendor'] = $value['name'];
				$report['data'] = $this->loadReport($value['name']);
				$mailHtml .= $mail->toHtml($report);
			}
		}
		if (!empty($mailHtml)) {
			$mail->send($mailHtml);
		}
	}

	public function start()
	{
		$this->loadModule();
		foreach ($this->modules as $key => $value) {
			$module = new $value['controller'];
			$module->run();
		}
		$this->sendReport();
	}


}

$checker = new StockChecker();
$checker->start();

 ?>