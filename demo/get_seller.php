<?php

include '.config.php';

$api = new \Darty\Api\Account();
$api->setApiKey($options['api_key']);
$api->setShopId($options['shop_id']);
$api->setEndpoint($options['endpoint']);

$rsp = $api->getShopInformation();
if(!$api->isSuccess()){
	print_r($rsp);
	die();
}

print_r($rsp);