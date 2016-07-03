<?php 
namespace App\modules\itcityonline;

/**
* IT City Online Checker Modules
*/

class Checker
{
	private $apiUrl = 'http://www.itcityonline.com/category/get_real_time_data';
	private $items;

	public function __construct($items = '')
	{
		$this->setItems($items);
	}
	public function setItems($items)
	{
		$this->items = $items;
	}
	public function getItems()
	{
		return $this->items;
	}

	public function getIds()
	{
		$result = [];
		foreach ($this->items as $key => $value) {
			preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:itcityonline.com)\/(?:item)\/([a-z0-9A-Z]*)?\/?/", $value['url'], $matches);
			$this->items[$key]['id'] = $matches[1];
		}
		return $this->getItems();
	}

	public function getAPIData()
	{
		$fields_string = '';
		foreach ($this->items as $key => $value) {
			$fields_string .= 'sm_seq_list[]'.'='.$value['id'].'&';
		}
		rtrim($fields_string, '&');
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->apiUrl);
		curl_setopt($ch, CURLOPT_POST, count($this->items));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);

		$result = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($result, true);
		return $result;
	}

}


 ?>