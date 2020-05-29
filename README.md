# cemilakkoc/ip-api

With the help of this simple library, you can get Country, State, City, and many other pieces of information about your users.

This library uses the [ip-api](https://google.com) to retrieve IP location data.

## Installation


```bash
composer require cemilakkoc/ip-api
```

## Usage

```php
$options = [
   "ip" => "127.0.0.1", 
   "lang" => "en",      
   "fields" => [        
       "isp", "org", "as", 
    ]
];

$location = new \Soltivo\IPApi\Location($options);

$countryaa2 = $location->countryCode;
$state = $location->stateName;
$city = $location->city;
```

### Options
```php
$options = [
   "ip" => "",
   "fields" => [],
   "lang" => ""
];
```
The works component can be appended to other resources.

| parameter                   | type | description | required | see |
|:----------------------------|:-----|:------------|:----| :---- |
| ip | string | IP address of the user.| true | |
| fields | array | Fields to retrieve. | false| [Fields List](https://ip-api.com/docs/api:json#fieldsTable) |
| lang | string | Language to retrieve data | false | [Localization](https://ip-api.com/docs/api:json#generatedData)

### Default values
```php
$lang = "en";
$fields = [
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
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

## License
[MIT](https://choosealicense.com/licenses/mit/)
