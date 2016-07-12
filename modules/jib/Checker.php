<?php 
namespace App\modules\jib;

use App\helpers\Request;

/**
* JIB Checker Modules
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
		$result = $this->dom->filter('a.btn-danger');
		return $result->count() > 0 ? true : false;
	}

	public function getPrice()
	{
		$result = $this->dom->filter('.pro_price span')->text();
		return (int)preg_replace("/([^0-9\\.])/i", "", $result);
	}
}

 ?>