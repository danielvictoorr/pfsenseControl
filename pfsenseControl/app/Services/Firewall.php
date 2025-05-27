<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Psr\Http\Message\ResponseInterface;

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


    public function insertRules(object $rulesInformation): ?string
    {
        $requestBody =[
                "type"=> "pass",
                "interface"=> [
                  "lan"
                ],
                "ipprotocol"=> "inet",
                "protocol"=> "tcp/udp",
                "icmptype"=> [
                  "any"
                ],
                "source"=> "192.168.1.0/24",
                "source_port"=> "80",
                "destination"=> "8.8.8.8",
                "destination_port"=> "80",
                "descr"=> "Permitir consultas DNS para o Google DNS",
                "disabled"=> false,
                "log"=> true,
                "statetype"=> "keep state",
                "tcp_flags_any"=> true,
                "tcp_flags_out_of"=> [],
                "tcp_flags_set"=> [],
                "gateway"=> "defaultgw4",
                "sched"=> null,
                "dnpipe"=> null,
                "pdnpipe"=> null,
                "defaultqueue"=> null,
                "ackqueue"=> null,
                "floating"=> false,
                "quick"=> true,
                "direction"=> "in"
            ];

        $response = $this->client->post('/api/v2/firewall/rules',$requestBody);

        $this->logResponse($response);

        return $response->getBody()->getContents();

    }


    private function logResponse(ResponseInterface $response) {
        $statusCode = $response->getStatusCode();
        $responseBody = $response->getBody()->getContents();
        $responseHeaders = $response->getHeaders();
    
        // Log de debug
        Log::info('Requisição API bem-sucedida', [
            'status' => $statusCode,
            'headers' => $responseHeaders,
            'body' => $responseBody,
        ]);
    }


}