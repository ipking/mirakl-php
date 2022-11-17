<?php

namespace Mirakl\Api;

use Mirakl\Core\Client;

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
	
	/**
	 * Operation Accept or refuse order lines
	 * @param string $order_id
	 * @param array $body
	 */
	public function accept($order_id,$body = [])
	{
		return $this->send("/api/orders/".$order_id."/accept", [
			'method' => 'PUT',
			'json'   => $body,
		]);
	}
	
	/**
	 * Operation tracking
	 * @param string $order_id
	 * @param array $body
	 */
	public function tracking($order_id,$body = [])
	{
		return $this->send("/api/orders/".$order_id."/tracking", [
			'method' => 'PUT',
			'json'   => $body,
		]);
	}
	
	/**
	 * Operation ship
	 * @param string $order_id
	 */
	public function ship($order_id)
	{
		return $this->send("/api/orders/".$order_id."/ship", [
			'method' => 'PUT'
		]);
	}
}
