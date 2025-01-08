<?php


// app/Services/ExternalApiService.php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class ExternalApiService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.external_api.url'); // Configuração no .env
        $this->apiKey = config('API_KEY'); // Configuração no .env
    }

    public function getData(string $endpoint, array $queryParams = [])
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->get("{$this->baseUrl}/{$endpoint}", $queryParams);

        if ($response->successful()) {
            return $response->json();
        }

        // Tratamento de erros
        throw new \Exception('Erro na chamada à API: ' . $response->body());
    }

    public function postData(string $endpoint, array $payload)
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer {$this->apiKey}",
        ])->post("{$this->baseUrl}/{$endpoint}", $payload);

        if ($response->successful()) {
            return $response->json();
        }

        // Tratamento de erros
        throw new \Exception('Erro na chamada à API: ' . $response->body());
    }
}
