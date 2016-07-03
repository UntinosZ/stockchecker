<?php 
namespace App\modules\bananastore;

use App\helpers\Request;

/**
* Banana Store Checker Modules
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
		$result = false;
		if ($this->dom->filter('.avilableproduct')->count() > 0
			&& !$this->dom->filter('.outofproduct')->count() > 0) {
			$result = true;
		}
		return $result;
	}

	public function getPrice()
	{
		$result = $this->dom->filter('.menu-fav-detail a')->attr('onclick');
		print_r($result)
		return (int)preg_replace("/([^0-9\\.])/i", "", $result);
	}


}

 ?>