<?php 

namespace App\Http\Controllers;

use App\Models\Servers;

class ServersController extends Controller {

    public function index() {
        $servers = Servers::getAllServers();
        return view('servers', compact('servers'));
    }
}