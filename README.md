# api-revital
Wraper pour l'API Revital Assurance et Social Assur


## How to use: 
```php
require_once('_api.php');
$api = new RetitalWrapper(array('key' => $key, 'url' => 'https://revital.adsolue.com/api'));
$api->createProspect($utm_source, $assurance_type = 'auto', $data = array(), $utm_campaign = '', $group = 1);
```

* $utm_source is required
* $assurance_type could be anything : 'auto', 'habitation'…
* $data is an array containing all user informations fields
* $data **need** to contain those keys: 'firstname', 'lastname', 'tel' and 'email'
* $utm_campaign is optionnal
* $group is optionnal the id of the group who will receive the lead.

## Response

If you have no key, or the key is wrong or disable you will get :
"error 401: Unauthorized, you need to set an authorization key" with a 401 http header

If one of the field "firstname", "lastname", "tel" or "email" is missing in the $data array, your will get : **"Bad Request" ** with 400 http header and somme details in json

Else, you will have **"Created"** with 201 http header, that means we create the prospect on our side.


## With Curl
```
curl --location --request post 'https://revital.adsolue.com/api/prospect/new' \
--header 'authorization: bearer [api_key]' \
--header 'content-type: application/json' \
--data-raw '{
    "ip": "",
    "origin": "",
    "utm_source": "",
    "utm_campaign": "",
    "group": 1,
    "type": "auto",
    "form_datas": {
        "firstname": "test43",
        "lastname": "test43",
        "tel": "0625010101",
        "email": "test@test.com",
        "notes":[
          {"title":"appel","date":"2021-04-30 16:54:33","content":"lorem"},
          {"title":"appel","date":"2021-04-30 18:54:33","content":"ipsum"}
        ],
        "audio":"https://exemple.com/audio.wav",
    }
}'
```
