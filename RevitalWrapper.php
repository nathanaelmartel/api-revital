<?php
/**
 *
 * How to use: 
 *     require_once('RevitalWrapper.php');
 *     $api = new RetitalWrapper(array('key' => $key, 'url' => 'https://revital.adsolue.com/api'));
 *     $api->createProspect($supplier_id, $assurance_type = 'auto', $data);
 *
 * $supplier_id is the utm_source used to identify the supplier
 * $assurance_type could be anything : 'auto', 'habitation'…
 * $data is an array that should contain those keys: 'firstname', 'lastname', 'tel' (or 'phone', 'tel_1', 'tel_2'), 'email' (or 'mail')… and all other usefull fields
 */

class RetitalWrapper {

    var $url;
    var $key;

    public function __construct($params)
    {
        if (isset($params['key'])) {
            $this->key = $params['key'];
        }
        $this->url = 'https://revital.adsolue.com/api';
        if (isset($params['url'])) {
            $this->url = $params['url'];
        }
    }

    public function getServices()
    {
        return $this->call('/');
    }

    public function createProspect($utm_source = '', $type = 'auto', $datas = array(), $utm_campaign = '', $group = '1')
    {
        $post['ip'] = $_SERVER['REMOTE_ADDR'];
        $post['origin'] = $_SERVER['SERVER_NAME'];
        $post['utm_source'] = $utm_source;
        $post['utm_campaign'] = $utm_campaign;
        $post['type'] = $type;
        $post['group'] = $group;
        $post['form_datas'] = json_encode($datas);

        return $this->call('/prospect/new', $post);
    }

    public function call($service, $post)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(sprintf('Authorization: Bearer %s', $this->key)));
        curl_setopt($ch, CURLOPT_URL, $this->url.$service);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
/*
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        $verbose = fopen('php://temp', 'w+');
        curl_setopt($ch, CURLOPT_STDERR, $verbose);*/

        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

        /*$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if ($http_code == 200) {
            return json_decode($result, true);
        }*/

        /*rewind($verbose);
        $verboseLog = stream_get_contents($verbose);
        var_dump($verboseLog);*/

        /*return json_encode(array(
            'error' => $http_code,
        ));*/
    }
}
