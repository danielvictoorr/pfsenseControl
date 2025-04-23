<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    use HasFactory;

    protected $table = 'servers'; // Se a tabela for exatamente "servers", pode até omitir isso

    // Função para buscar todos os registros
    public static function getAllServers()
    {
        return self::all();
    }
}
