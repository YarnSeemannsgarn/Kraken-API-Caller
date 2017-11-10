<?php

require_once 'kraken-api-client/php/KrakenAPIClient.php';

$ini_array = parse_ini_file('api.ini');
$kraken = new \Payward\KrakenAPI($ini_array['API_KEY'], $ini_array['API_PRIVATE_KEY']);

$request = array(
    'pair'  => "XETHZEUR"
);

// $res = $kraken->QueryPublic('AssetPairs');
// $res = $kraken->QueryPublic('Ticker', $request);

$res = $kraken->QueryPrivate('TradeBalance', array('asset' => 'ZEUR'));

print_r($res);

?>
