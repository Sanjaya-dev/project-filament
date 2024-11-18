<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class ApiProxyController extends Controller
{
    public function getTotalPerKasus(): JsonResponse
    {
        try {
            // Mengambil URL API dari file .env
            $apiUrl = env('API_TOTAL_PER_KASUS');

            // Mengambil data dari API eksternal
            $response = Http::get($apiUrl);

            // Cek apakah respons berhasil
            if ($response->successful()) {
                return response()->json($response->json());
            }

            // Jika ada error, kirimkan pesan error
            return response()->json([
                'message' => 'Failed to retrieve data from API.'
            ], 500);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
