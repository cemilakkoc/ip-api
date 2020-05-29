<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Soltivo\IPApi\Location;
use GuzzleHttp\Client;


$location = new Location([
    "ip" => "215.235.124.53",
]);

echo "========================================== \n";
echo $location->country         . " <-- country \n";
echo "========================================== \n";
echo $location->countryName     . " <-- countryName \n";
echo "========================================== \n";
echo $location->countryCode     . " <-- countryCode \n";
echo "========================================== \n";
echo $location->state           . " <-- state \n";
echo "========================================== \n";
echo $location->stateName       . " <-- stateName \n";
echo "========================================== \n";
echo $location->region          . " <-- region \n";
echo "========================================== \n";
echo $location->stateCode       . " <-- stateCode \n";
echo "========================================== \n";
echo $location->regionCode      . " <-- regionCode \n";
echo "========================================== \n";
echo $location->zip             . " <-- zip \n";
echo "========================================== \n";
echo $location->postal_code     . " <-- postal_code \n";
echo "========================================== \n";
echo $location->postal          . " <-- postal \n";
echo "========================================== \n";
echo $location->timezone        . " <-- timezone \n";
echo "========================================== \n";
echo $location->currency        . " <-- currency \n";
echo "========================================== \n";