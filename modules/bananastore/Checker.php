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
		try {
			$result = false;
			if ($this->dom != null 
				&& $this->dom->filter('.avilableproduct')->count() > 0
				&& !$this->dom->filter('.outofproduct')->count() > 0) {
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
			$result = $this->dom->filter('.menu-fav-detail a')->attr('onclick');
			preg_match('/(?:return\ addfavorite\((.*)\))/', $result, $matches);
			$raw = explode(',', $matches[1]);
			return (int)preg_replace("/([^0-9\\.])/i", "", $raw[1]);
		} catch (Exception $e) {
			return 0;
		}
	}


}

 ?>