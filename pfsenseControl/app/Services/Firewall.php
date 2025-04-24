<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class Firewall extends ExternalApiService
{
    private $client;
    public function __construct() {
        $this->client = new Client([
            'base_uri' => getenv('services.external_api.url'),
            'verify' => false, // Desativa a verificação SSL (não recomendado para produção)
            'auth' => ['admin', '1234'], // Autenticação básica
            'headers' => [
                'x-api-key' => getenv('API_KEY'),
            ],
        ]);
    }
    public function getRules() :array
    {

        $response = $this->client->get('/api/v2/firewall/rules', [
            'query' => [
                'limit' => 0,
                'offset' => 0,
            ],
        ]);

                  // Debugando a resposta
                  $statusCode = $response->getStatusCode();
                  $responseBody = $response->getBody()->getContents();
                  $responseHeaders = $response->getHeaders();
      
                  // Log de debug
                  Log::info('Requisição API bem-sucedida', [
                      'status' => $statusCode,
                      'headers' => $responseHeaders,
                      'body' => $responseBody,
                  ]);

        // Verifica o status da resposta
        if ($response->getStatusCode() === 200) {
            $data = json_decode($response->getBody(), true); // Decodifica o JSON para um array associativo
            $firewallRules = $data['data'] ?? []; // Captura os dados ou define um array vazio
        } else {
            $firewallRules = []; // Define um array vazio se a resposta não for bem-sucedida
        }

        return $firewallRules;
    }


    public function insertRules(object $rulesInformation)
    {
        
    }


}