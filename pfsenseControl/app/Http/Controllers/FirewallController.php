<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FirewallController extends Controller
{
    public function index()
    {
        try {
            // Configuração do cliente Guzzle
            $client = new Client([
                'base_uri' => getenv('services.external_api.url'),
                'verify' => false, // Desativa a verificação SSL (não recomendado para produção)
                'auth' => ['admin', '1234'], // Autenticação básica
                'headers' => [
                    'x-api-key' => getenv('API_KEY'),
                ],
            ]);

            $response = $client->get('/api/v2/firewall/rules', [
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

            // Retorna a view com os dados
            return view('firewall', ['firewallRules' => $firewallRules]);
        } catch (RequestException $e) {
            // Captura erros de requisição
            return view('firewall', [
                'firewallRules' => [],
                'error' => $e->getMessage(),
            ]);
        } catch (\Exception $e) {
            // Captura outros erros
            return view('firewall', [
                'firewallRules' => [],
                'error' => $e->getMessage(),
            ]);
        }
    }


    public function store(Request $request)
    {
        // Aqui você pode validar os dados
        $data = $request->validate([
            'type' => 'required|string',
            'ipprotocol' => 'required|string',
            'interface' => 'required|array',
            'source' => 'required|string',
            'destination' => 'required|string',
            'descr' => 'nullable|string',
        ]);

        // Aqui você faria a lógica para salvar no banco ou enviar para o pfSense, etc.
        // Por enquanto, vamos só retornar para a tela com sucesso:
        return redirect()->back()->with('success', 'Regra adicionada com sucesso!');
    }
}
