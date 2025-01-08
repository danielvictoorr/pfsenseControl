<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class Firewall implements ExternalApiService
{

    public function getRules()
    {
        $endPoint = '/api/v2/firewall/rules?limit=0&offset=0';

        $response = $this->getData($endPoint);

        return $response;
    }



}