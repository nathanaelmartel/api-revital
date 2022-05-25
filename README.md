# api-revital
Wraper pour l'API Revital Assurance et Social Assur


## How to use: 
```php
require_once('_api.php');
$data = [
    "firstname" => "test43",
    "lastname" => "test43",
    "tel" => "0625010101",
    "email" => "test@test.com",
    /* ... */
];
$api = new retitalwrapper([
    'key' => '[api_key]',
    'url' => 'https://revital-gestion.com/api'
]);
$api->createProspect($utm_source, $assurance_type = '1', $data, $utm_campaign = '', $group = 1);
```

* $utm_source is required
* $assurance_type : id of type, see reference table bellow
* $data is an array containing all user informations fields
* $data **need** to contain those keys: 'firstname', 'lastname', 'tel' and 'email'
* $utm_campaign is optionnal
* $group is optionnal the id of the group who will receive the lead.

### Assurance Types

| id |                       name                       |
|:--:|:------------------------------------------------:|
| 1  | Asurance Auto                                    |
| 2  | Mutuelle (Santé Individuelle)                    |
| 3  | Habitation (MRH)                                 |
| 4  | RC Décennale                                     |
| 5  | ok                                               |
| 6  | quatre                                           |
| 7  | Prévoyance TNS                                   |
| 8  | Inconnu                                          |
| 9  | Indemnités Journalières (IJ - Prévoyance)        |
| 10 | Surco (Santé Individuelle)                       |
| 11 | Dépendance (Prévoyance)                          |
| 12 | Ass. Animaux (Chiens & Chats)                    |
| 13 | Protection Juridique (PJ)                        |
| 14 | Dommages Ouvrages (DO)                           |
| 15 | Garantie Accidents de la Vie (GAV)               |
| 16 | Décès & Tempo Décès                              |
| 17 | Obsèques                                         |
| 18 | Assurance MOTO                                   |
| 19 | Mutuelle santé (collective)                      |
| 20 | Multirisque pro                                  |
| 21 | Assurance scolaire                               |
| 22 | Garantie Prud'homale                             |
| 23 | Tous risques bureaux                             |
| 24 | Tous risques chantiers (TRC)                     |
| 25 | Responsabilité civile du maître d'ouvrage (RCMO) |
| 26 | RC PRO (seul)                                    |
| 27 | Assurance Auto Tempo                             |
| 28 | Assurance Quad                                   |

## Response

If you have no key, or the key is wrong or disable you will get : `401 Unauthorized`

Else, you will have `201 Created`, that means we create the prospect on our side.


## With Curl
```
curl --location --request post 'https://revital-gestion.com/api/prospect/new' \
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
