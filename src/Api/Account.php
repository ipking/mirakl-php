<?php

namespace Mirakl\Api;

use Mirakl\Core\Client;

class Account extends Client {

	/**
	* Operation getShopInformation
	*/
	public function getShopInformation()
	{
		return $this->send("/api/account", [
		  'method' => 'GET',
		]);
	}
}
