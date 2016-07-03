<?php 
namespace App\modules\itcityonline;

require __dir__.'/../../bootstrap.php';
use App\modules\itcityonline\Checker;
use App\helpers\Mail;
use App\helpers\Report;

/**
* JIB Checker Modules
*/

class Controller
{
	private $itemFile = __dir__ . '/items.json';

	public function run()
	{
		echo date('Y-m-d H:i:s')."[INFO]: ITCity Online Checking...\n";
		$data = $this->getDataFromJSON($this->itemFile);
		$result = $this->getReason($data);

		if (!empty($result)) {
			$report = new Report($result);
			$report->exportJSON('itcityonline.json');
		}
	}

	private function getReason($data)
	{
		$checker = new Checker($data);
		$checkerData = $checker->getIds();
		$apiData = $checker->getAPIData();
		$result = [];
		foreach ($checkerData as $key => $value) {
			$info = $apiData['data'][$value['id']]['market_info'];
			if ($info['quantity'] < 1) {
				$value['reason'] = 'Out of Stock';
				array_push($result, $value);
			}else if(($price = (int)preg_replace("/([^0-9\\.])/i", "", $info['price']['final_price']['price'])) != $value['price']){
				$value['reason'] = 'Price Change';
				$value['currentPrice'] = $price;
				array_push($result, $value);				
			}
		}
		return $result;
	}

	public function getDataFromJSON($filePath='')
	{
		$content = file_get_contents($filePath);
		$result = json_decode($content, true);
		return $result;
	}
}
 ?>