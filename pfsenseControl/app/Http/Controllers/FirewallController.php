<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FirewallController extends Controller
{
    public function index()
    {
        try {
            // Fazendo a requisição à API externa
            $url = getenv('EXTERNAL_API_URL');
            $response = Http::get($url.'/api/v2/firewall/rules?limit=0&offset=0');
            $firewallRules = $response->json(); // Assumindo que a API retorna JSON

            return view('firewall.index', compact('firewallRules'));
        } catch (\Exception $e) {
            // Caso a API falhe
            return view('firewall.index', ['firewallRules' => [], 'error' => $e->getMessage()]);
        }
    }
}
