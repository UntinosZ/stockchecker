<?php 
namespace App\modules\lazada;

use App\helpers\Request;

/**
* Lazada Checker Modules
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
		$result = $this->dom->filter('#AddToCart');
		return $result->count() > 0 ? true : false;
	}

	public function getPrice()
	{
		$result = $this->dom->filter('#special_price_box')->text();
		return (int)preg_replace("/([^0-9\\.])/i", "", $result);
	}
}

 ?>