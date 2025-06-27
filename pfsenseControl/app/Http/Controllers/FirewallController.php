<?php

namespace App\Http\Controllers;

use App\Models\Servers;
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
            $servers = new Servers();

            return view('firewall', ['firewallRules' => $firewallRules->getRules(), 'interfaces' => $servers->getAllServers()]);
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


    public function insertRules(Request $request)
    {
        try{
            $type = $request->input('type');
            $ipprotocol = $request->input('ipprotocol');
            $interfaces = $request->input('interface'); // array
            $source = $request->input('source');
            $destination = $request->input('destination');
            $descr = $request->input('descr');

            $data = [
                'type' => $type,
                'ipprotocol' => $ipprotocol,
                'interfaces' => $interfaces,
                'source' => $source,
                'destination' => $destination,
                'descr' => $descr,
            ];


            $firewallRules = new Firewall();

            $data = $firewallRules->insertRules($data);

            return view('firewall', ['firewallResponse' => $data]);

        }
        catch (\Exception $e) {
            view('firewall', ['firewallResponse' => $e->getMessage()]);
        }
    }

    public function deleteRule(int $id){
        try{
            $firewallRules = new Firewall();
            $firewallRules->deleteRules($id);

            return $this->index();
        }
        catch (\Exception $e) {
            view('firewall', ['firewallResponse' => $e->getMessage()]);
        }
        
    }
}
