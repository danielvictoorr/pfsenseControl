<?php

namespace App\Http\Controllers;

use App\Services\Firewall;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class FirewallController extends Controller
{
    public function index()
    {
        try {
            $firewallRules = new Firewall();

            return view('firewall', ['firewallRules' => $firewallRules->getRules()]);
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


    public function insertRules(object $data)
    {
        try{
            $firewallRules = new Firewall();

            $data = $firewallRules->insertRules($data);

            return view('firewall', ['firewallResponse' => $data]);

        }
        catch (\Exception $e) {
            view('firewall', ['firewallResponse' => $e->getMessage()]);
        }
    }
}
