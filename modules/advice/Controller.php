<?php 
namespace App\modules\advice;

require __dir__.'/../../bootstrap.php';
use App\modules\advice\Checker;
use App\helpers\Mail;
use App\helpers\Report;
use GuzzleHttp\Exception\RequestException;

/**
* Advice Checker Modules
*/

class Controller
{
	private $itemFile = __dir__ . '/items.json';

	public function run()
	{
		try {
			echo date('Y-m-d H:i:s')."[INFO]: Advice Checking...\n";

			$data = $this->getDataFromJSON($this->itemFile);
			$result = $this->getReason($data);

			if (!empty($result)) {
				$report = new Report($result);
				$report->exportJSON('advice.json');
			}
			
		} catch (RequestException $e) {
			echo date('Y-m-d H:i:s')."[ERROR]: Advice Error.\n";
		}
	}

	private function getReason($data)
	{
		$result = [];
		foreach ($data as $key => $value) {
			$checker = new Checker($value['url']);
			if (!$checker->getInstock()) {
				$value['reason'] = 'Out of Stock';
				array_push($result, $value);
			}else if(($price = $checker->getPrice()) != $value['price']){
				$value['reason'] = 'Price Change';
				$value['currentPrice'] = $price;
				array_push($result, $value);				
			}
		}
		return $result;
	}

	public function getDataFromJSON($filePath = '')
	{
		if (empty($filePath)) {
			$filePath = $this->itemFile;
		}
		$content = file_get_contents($filePath);
		$result = json_decode($content, true);
		return $result;
	}
}

 ?>