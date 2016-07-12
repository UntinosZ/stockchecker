<?php 
namespace App;

require __dir__.'/bootstrap.php';
use App\helpers\Mail;
use App\helpers\Report;

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

	public function loadItems()
	{
		$result = [];
		$this->loadModule();
		foreach ($this->modules as $key => $value) {
			$module = new $value['controller'];
			foreach ($module->getDataFromJSON() as $k => $v) {
				array_push($result, $v);
			}
		}
		return $result;
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

	public function singleReport()
	{
		$report = [];
		$baseReport = $this->loadItems();
		foreach ($this->modules as $key => $value) {
			foreach ($this->loadReport($value['name']) as $k => $v) {
				if ($replaceKey = array_search($v['url'], array_column($baseReport, 'url') )) {
					$baseReport[$replaceKey] = $v;
				}
			}
		}
		$single = new Report($baseReport);
		$single->exportJSON('report.json');
	}

	public function start()
	{
		$this->loadModule();
		foreach ($this->modules as $key => $value) {
			$module = new $value['controller'];
			$module->run();
		}
		$this->singleReport();
		$this->sendReport();
	}


}

$checker = new StockChecker();
$checker->start();

 ?>