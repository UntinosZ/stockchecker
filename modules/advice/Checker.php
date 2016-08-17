<?php 
namespace App\modules\advice;

use App\helpers\Request;

/**
* Advice Store Checker Modules
*/

class Checker
{
	private $dom;

	public function __construct($url)
	{
		$client = new Request($url);
		$this->dom = $client->getDom();
	}

	public function getDom()
	{
		return $this->dom;
	}

	public function getInstock()
	{
		try {
			$result = false;
			if ($this->dom != null 
				&& $this->dom->filter('#pri-pro .btn-addcart')->count() > 0) {
				$result = true;
			}
			return $result;
			
		} catch (Exception $e) {
			return false;
		}
	}

	public function getPrice()
	{
		try {
			$result = $this->dom->filter('#pri-pro .btn-addcart')->attr('data-price');
			return (int)$result;
		} catch (Exception $e) {
			return 0;
		}
	}


}

 ?>