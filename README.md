# api-revital
Wraper pour l'API revital assurance et social assur


## How to use: 
```php
require_once('_api.php');
$api = new RetitalWrapper(array('key' => $key, 'url' => 'https://revital.adsolue.com/api'));
$api->createProspect($supplier_id, $assurance_type = 'auto', $data, $utm_campaign);
```

* $supplier_id is the utm_source used to identify the supplier
* $assurance_type could be anything : 'auto', 'habitation'…
* $data is an array containing all user informations fields
* $data **need** to contain those keys: 'firstname', 'lastname', 'tel' and 'email'
* $utm_campaign is optionnal

## Response

If you have no key, or the key is wrong or disable you will get :
"error 401: Unauthorized, you need to set an authorization key" with a 401 http header

If one of the field "firstname", "lastname", "tel" or "email" is missing in the $data array, your will get : "error"

Else, you will have "success", that means we create the prospect on our side.
