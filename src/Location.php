<?php

namespace Soltivo\IPApi;

use GuzzleHttp\Client;

/**
 * A simple API to interact with ip-api.com
 * @author Cemil Akkoc <cemil@akko.cc>
 */
class Location {    
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
     * Load IP address and the options.
     * 
     * @param string $ip IP address of the user.
     * @param array $options Options to be used when checking the ip address.
     * 
     * @return void
     */
    public function __construct(array $options = []) {
        $this->ip = $options["ip"];
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
        $client = new Client(["base_uri" => "http://ip-api.com/json"]);

        $response = $client->request('GET', "/json/$this->ip", [
            'query' => [
                "lang" => $this->lang,
                "fields" => $this->fields
            ]
        ]);
        
        $this->data = json_decode($response->getBody()->getContents(), true);
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
        // Formatted names.
        $data = $this->data;
        $formatted = [
            "countryName" => $this->val("country"),
            "countryName" => $this->val("country"),
            "countryCode" => $this->val("countryCode"),
            "state" => $this->val("regionName"),
            "stateName" => $this->val("regionName"),
            "stateCode" => $this->val("region"),
            "regionCode" => $this->val("region"),
            "city" => $this->val("city"),
            "zip" => $this->val("zip"),
            "postal_code" => $this->val("zip"),
            "postal" => $this->val("zip"),
            "timezone" => $this->val("timezone")
        ];

        return $formatted[$key] ?? $this->data[$key] ?? null;
        
    }
}