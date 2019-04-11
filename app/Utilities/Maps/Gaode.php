<?php

namespace App\Utilities\Maps;

use GuzzleHttp\Client;
use function GuzzleHttp\Psr7\build_query;

class Gaode implements MapContract
{
    private $key;
    private $guzzle;

    public function __construct(Client $guzzle)
    {
        $this->key = config('services.gaode.ws_api_key');
        $this->guzzle = $guzzle;
    }

    /**
     * @param $address
     * @param $city
     * @param $state
     * @return array
     */
    public function geocode($address, $city, $state)
    {

        $address = $state . $city . $address;
        $params = [
            'address' => $address,
            'key' => $this->key
        ];
        $url = 'https://restapi.amap.com/v3/geocode/geo?' . build_query($params);
        $res = json_decode($this->guzzle->get($url)->getBody());
        $lat = '';
        $lng = '';
        if ($res && $res->status && isset($res->geocodes) && isset($res->geocodes[0])) {
            list($lng, $lat) = explode(',', $res->geocodes[0]->location);
        }
        return compact('lat','lng');
    }
}
