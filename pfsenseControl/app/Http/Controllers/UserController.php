<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Busca todos os usuários
        return view('users', compact('users'));
    }
}
