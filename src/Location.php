<?php

namespace Soltivo\Location;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * A simple API to interact with ip-api.com
 * @author Cemil Akkoc <cemil@akko.cc>
 */
class Location {

    /**
     * This is used for testing purposes, used to test for the cases when ip-api.com goes down.
     * 
     * @var bool
     */
    public $test = false;

    /**
     * Status of the connection between you and the ip-api.com
     * 
     * @var bool
     */
    public $badConnection = false;
    
    /**
     * IP address of the user.
     * 
     * @var string
     */
    public $ip;

    /**
     * Response that is returned from the ip-api.com
     * 
     * @var object
     */
    public $data;

    /**
     * Fields
     * 
     * @see https://ip-api.com/docs/api:json 
     * 
     * @var array
     */
    public $fields;
    
    /*
     * Load the options.
     * 
     * @param array $options Options to be used when checking the ip address.
     * 
     * @return void
     */
    public function __construct(array $options = []) {
        $this->ip = $options["ip"];
        $this->test = $options["test"] ?? false;
        $this->lang = $options["lang"] ?? "en";
        $fields = ( $options["fields"] ?? [] ) + [ 
            "country", 
            "countryCode", 
            "region", 
            "regionName",
            "city", 
            "zip", 
            "proxy",
            "currency",
            "timezone",
            "continent",
            "continentCode",
            "district"
        ];

        $this->fields = implode(",", $fields);

        $this->load();
    }

    /**
     * Load IP data.
     *  
     * @see https://ip-api.com/docs/api:serialized_php
     * 
     * @return void
     */
    public function load() {
        // To simulate the situation where http://ip-api.com
        // I'll use a random website address which doesn't work at all.
        $baseuri = $this->test ? "http://cemil.akko.cc" : "http://ip-api.com/";
    
        try {
            $client = new Client(["base_uri" => $baseuri]);
    
            $response = $client->request('GET', "/json/$this->ip", [
                'query' => [
                    "lang" => $this->lang,
                    "fields" => $this->fields
                ]
            ]);
            
            $this->data = json_decode($response->getBody()->getContents(), true);

        } catch(RequestException $e) {
            $this->badConnection = true;
        }
        
    }

    /**
     * Format the values.
     * 
     * @return string|null
     */
    public function val($key) {
        return $this->data[$key] ?? null;
    }
    
    /**
     * Get ip address information.
     * 
     * @return string
     */
    public function __get($key) {
        // Return null if anything wrong goes with https://ip-api.com
        if($this->badConnection) {
            return null;
        }

        // Formatted names.
        switch($key) {
            default: 
                return $this->data[$key] ?? null;
                break;
            case "country":
            case "countryName":
            case "countryname":
            case "country_name":
                return $this->val("country");
                break;
            case "countryCode":
            case "countrycode":
            case "country_code":
            case "countrya2":
                return $this->val("countryCode");
                break;
            case "state":
            case "stateName":
            case "statename":
            case "region":
            case "regionName":
            case "regionname":
            case "region_name":
                return $this->val("regionName");
                break;
            case "stateCode":
            case "statecode":
            case "regionCode":
            case "regioncode":
            case "region_code":
                return $this->val("region");
                break;
            case "zip":
            case "zipCode":
            case "zipcode":
            case "zip_code":
            case "postalCode":
            case "postalcode":
            case "postal_code":
            case "postal":
                return $this->val("zip");
                break;
            case "timeZone":
            case "timezone":
            case "time_zone":
                return $this->val("timezone");
                break;
            case "currency":
            case "money":
                return $this->val("currency");
                break;            
        }
        
    }
}