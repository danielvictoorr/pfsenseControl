<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    use HasFactory;

    protected $table = 'servers'; 

    protected $fillable = [
        'nickname',
        'ip',
        'x_api_key',
        'client_id',
        'client_secret'
    ];

    public static function getAllServers(): object
    {
        return self::all();
    }

    public static function insertServer($data):object
    {
        return self::create($data);
    }
}
