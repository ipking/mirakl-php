<?php

namespace Darty\Api;

use Darty\Core\Client;

class Orders extends Client {

	/**
	* Operation getOrders
	 * @param array $query
	*/
	public function getOrders($query = [])
	{
		return $this->send("/api/orders", [
		  'method' => 'GET',
		  'query'  => $query,
		]);
	}
}
