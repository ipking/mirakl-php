<?php

namespace Mirakl\Core;

abstract class Client{
	
	
	const METHOD_GET = 'GET';
	const METHOD_POST = 'POST';
	const METHOD_PUT = 'PUT';
	
	private static $success_codes = [200,201,204];
	
	protected static $callback;
	
	protected $method;
	
	protected $endpoint;
	
	protected $url;
	
	protected $client_response;
	
	protected $response_code;
	
	protected $api_key;
	
	protected $shop_id;
	
	/**
	 * @param $cb
	 */
	public static function setSendCallback($cb){
		self::$callback = $cb;
	}
	
	
	/**
	 * @return string
	 */
	public function getMethod(){
		return $this->method;
	}
	
	/**
	 * @return string
	 */
	public function getUrl(){
		return $this->url;
	}
	
	/**
	 * @return string
	 */
	public function getResponse(){
		return $this->client_response;
	}
	
	/**
	 * @param string $endpoint 请求接入点域名(xx.[https://drt-prod.mirakl.net)
	 */
	public function setEndpoint($endpoint)
	{
		$this->endpoint = $endpoint;
	}
	
	/**
	 * @param string $api_key
	 */
	public function setApiKey($api_key){
		$this->api_key = $api_key;
	}
	
	/**
	 * @param string $shop_id
	 */
	public function setShopId($shop_id){
		$this->shop_id = $shop_id;
	}
	
	/**
	 * @param string $uri
	 * @param array $requestOptions
	 * @return array
	 * @throws HttpException|\Exception
	 */
	protected function send($uri, $requestOptions = []){
		$this->method = strtoupper($requestOptions['method']);
		$this->url = $this->endpoint.$uri;
		
		if($this->shop_id){
			$requestOptions['query']['shop_id'] = $this->shop_id;
		}
		
		if (isset($requestOptions['query'])) {
			$this->url .= '?' . http_build_query($requestOptions['query']);
		}
		
		$header_arr = [];
		if($this->api_key){
			$header_arr[] = 'Authorization: '.$this->api_key;
		}
		
		switch($this->method){
			case self::METHOD_GET:
				$opt = array(
					CURLOPT_HTTPHEADER     => $header_arr,
				);
				
				return $this->execute($this->url,$opt);
			case self::METHOD_POST:
				$data = [];
				if($requestOptions['json']){
					$data = json_encode($requestOptions['json']);
					$header_arr[] = 'Content-Type: application/json';
				}
				$opt = array(
					CURLOPT_POST           => true,
					CURLOPT_HTTPHEADER     => $header_arr,
					CURLOPT_POSTFIELDS     => $data,
				);
				return $this->execute($this->url,$opt);
			case self::METHOD_PUT:
				$data = [];
				if($requestOptions['json']){
					$data = json_encode($requestOptions['json']);
					$header_arr[] = 'Content-Type: application/json';
				}
				$opt = array(
					CURLOPT_CUSTOMREQUEST  => self::METHOD_PUT,
					CURLOPT_HTTPHEADER     => $header_arr,
					CURLOPT_POSTFIELDS     => $data,
				);
				return $this->execute($this->url,$opt);
			default :
				throw new \Exception('Not support method :'.$this->method);
		}
		
	}
	
	/**
	 * @param string $url
	 * @param array $opt
	 * @return array|mixed
	 * @throws HttpException
	 */
	public function execute($url, $opt){
		$this->response_code = '';
		$this->client_response = Curl::execute($url,$opt);
		list($response_body,$response_code) = $this->client_response;
		$this->response_code = $response_code;
		
		if(is_callable(self::$callback)){
			$callback = self::$callback;
			$callback($this);
		}
		
		return $response_body?json_decode($response_body, true):'';
	}
	
	/**
	 * @return bool
	 */
	public function isSuccess(){
		return in_array($this->response_code,self::$success_codes);
	}
}