<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApiController extends Controller
{
    public function memanggilAPI()
    {
        $token = '5|WAXxiM5PdUMibuv3LSVxFRJB8mucfITlNLrxVNQJ';
        $respone = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token
        ])
        ->get('http://localhost/laravel-new/public/api/getAllUsersToo');

        $jsonData = $respone->json();

        return response()->json($jsonData, $respone->getStatusCode());
    }
}
