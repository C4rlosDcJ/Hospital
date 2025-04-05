<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

class OximetroController extends Controller
{
    public function index()
    {
        try {
            $response = Http::get('http://192.168.0.20:5000/data/all'); // Cambia la URL por la de tu API

            if ($response->successful()) {
                $json = $response->json();

                if ($json['status'] === 'success') {
                    $lecturas = collect($json['data'])
                        ->sortByDesc('received_at') // Ordenar de más reciente a más antigua
                        ->map(function ($lectura) {
                            $lectura['spo2_class'] = $this->getSpo2Status($lectura['spo2']);
                            $lectura['bpm_class'] = $this->getBpmStatus($lectura['bpm']);
                            return $lectura;
                        });

                    return view('oximetro.index', compact('lecturas'));
                } else {
                    return view('oximetro.index', ['error' => $json['message']]);
                }
            } else {
                return view('oximetro.index', ['error' => 'Error al consumir la API']);
            }
        } catch (\Exception $e) {
            return view('oximetro.index', ['error' => $e->getMessage()]);
        }
    }

    private function getSpo2Status($spo2)
    {
        if ($spo2 >= 95) return 'spo2-normal';
        if ($spo2 >= 90) return 'spo2-warning';
        return 'spo2-danger';
    }

    private function getBpmStatus($bpm)
    {
        if ($bpm >= 60 && $bpm <= 100) return 'bpm-normal';
        if ($bpm >= 50 && $bpm <= 110) return 'bpm-warning';
        return 'bpm-danger';
    }
}
