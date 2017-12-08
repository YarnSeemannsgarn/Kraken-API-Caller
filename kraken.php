<?php

require_once 'kraken-api-client/php/KrakenAPIClient.php';

// Handle command line input
$help = "usage: php kraken.php <command> [<options>]

Commands:
 p            Shows pairs
";

if(count($argv) < 2 || $argv[1] != 'p') {
    echo $help;
    exit;
}


// Initialization
$ini_array = parse_ini_file('api.ini');
$kraken = new \Payward\KrakenAPI($ini_array['API_KEY'], $ini_array['API_PRIVATE_KEY']);

// Pairs
if($argv[1] == 'p') {
    while(true) {
        try {
            $res = $kraken->QueryPublic('AssetPairs');
            break;
        }
        catch (Payward\KrakenAPIException $e) {
            echo "Exception during querying... Trying again!\n";
        }
    }
    
    $pairs = array();
    foreach (array_keys($res['result']) as $pair) {
        if(strpos($pair, 'EUR') !== false) {
            array_push($pairs, $pair);
        }
    }
    
    print_r($pairs);    
}


//$res = $kraken->QueryPublic('Ticker', $request);
//$res = $kraken->QueryPrivate('TradeBalance', array('asset' => 'ZEUR'));

?>
