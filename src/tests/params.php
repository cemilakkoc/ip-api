<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Soltivo\Location\Location;
use JakubOnderka\PhpConsoleColor\ConsoleColor;

$location = new Location([
    "ip" => "215.235.124.53",
]);

$params = [
"country",
"countryName",
"countryname",
"country_name",
"----",
"countryCode",
"countrycode",
"country_code",
"countrya2",
"----",
"state",
"stateName",
"statename",
"region",
"regionName",
"regionname",
"region_name",
"----",
"stateCode",
"statecode",
"regionCode",
"regioncode",
"region_code",
"----",
"zip",
"zipCode",
"zipcode",
"zip_code",
"postalCode",
"postalcode",
"postal_code",
"postal",
"----",
"timeZone",
"timezone",
"time_zone",
"----",
"currency",
"money",
];

$consoleColor = new ConsoleColor();

foreach($params as $param) {
    if($param == "----") {
        echo "====================== \n";
        continue;
    }
    echo $consoleColor->apply("color_184", $param) . " : ";
    echo $consoleColor->apply("color_105", $location->{$param}) . "\n";
}