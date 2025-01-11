<?php

// app/Http/Controllers/ApiController.php
namespace App\Http\Controllers;

use App\Services\ExternalApiService;

class ApiController extends Controller
{
    protected $apiService;

    public function __construct(ExternalApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        try {
            $data = $this->apiService->getData('endpoint_aqui', ['param1' => 'valor']);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
