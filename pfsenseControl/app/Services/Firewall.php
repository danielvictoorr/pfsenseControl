<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Firewall extends ExternalApiService
{

    public function getRules()
    {
        $endPoint = '/api/v2/firewall/rules?limit=0&offset=0';

        $response = self::getData($endPoint);

        return $response;
    }



}