<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    /**
     * Proxy hacia la API de Open-Meteo para evitar problemas de CORS.
     */
    public function forecast(Request $request)
    {
        $validated = $request->validate([
            'latitude' => ['required', 'numeric'],
            'longitude' => ['required', 'numeric'],
            'hourly' => ['required', 'string'],
        ]);

        $response = Http::withOptions(['verify' => false])->get('https://api.open-meteo.com/v1/forecast', [
            'latitude' => $validated['latitude'],
            'longitude' => $validated['longitude'],
            'hourly' => $validated['hourly'],
        ]);

        return response()->json(
            $response->json(),
            $response->status()
        );
    }
}
