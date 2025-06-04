<?php 

namespace App\Http\Controllers;

use App\Models\Servers;
use Illuminate\Http\Request;

class ServersController extends Controller {

    public function index() {
        $servers = Servers::getAllServers();
        return view('servers', compact('servers'));
    }

    public function insertServer(Request $request) {
        {
            // Validação básica
            $validatedData = $request->validate([
                'nickname' => 'required|string|max:255',
                'ip' => 'required|ip',
                'apikey' => 'required|string|max:255',
                'usuario' => 'required|string|max:255',
                'password' => 'required|string|max:255',
            ]);
            
            // Inserção no banco usando a Model
            Servers::insertServer($validatedData);
    
            // Redireciona com mensagem de sucesso (ou customize como quiser)
            return redirect()->back()->with('success', 'Servidor cadastrado com sucesso!');
        }
    }
}