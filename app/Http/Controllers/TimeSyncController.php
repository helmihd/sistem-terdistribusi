<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class TimeSyncController extends Controller
{
    public function showSynchronization(Request $request)
    {
        $synchronization = $this->synchronizeTimeWithServer($request);

        return view('client.synchronization', [
            'synchronization' => $synchronization,
        ]);
    }

    function synchronizeTimeWithServer(Request $request)
    {
        $clientIP = $request->ip();
        $T1 = now()->timestamp; // T1: Waktu saat request dikirim dari client
        
        
        // Kirim request ke server
        $response = Http::get('http://192.168.100.228:8000/server-time');
        $serverIP = parse_url($response->effectiveUri(), PHP_URL_HOST);
        dd($response->body());

        $T4 = now()->timestamp; // T4: Waktu saat response diterima oleh client

        // Jika respons berhasil, ambil data T2 dan T3 dari server
        if ($response->successful()) {
            $T2 = $response->json()['T2'];
            $T3 = $response->json()['T3'];

            // Hitung delay dan waktu sinkronisasi
            $delay = ($T4 - $T1 - ($T3 - $T2)) / 2;
            $synchronizedTime = $T3 + $delay;

            return [
                'T1' => $T1,
                'T2' => $T2,
                'T3' => $T3,
                'T4' => $T4,
                'clientIP' => $clientIP,
                'serverIP' => $serverIP,
                'delay' => $delay,
                'synchronized_time' => $synchronizedTime,
            ];
        }

        return null;
    }

    public function getServerTime()
    {
        $T2 = now()->timestamp; // Waktu saat request diterima di server (T2)
        $T3 = now()->timestamp; // Waktu saat response dikirim dari server (T3)

        return response()->json([
            'T2' => $T2,
            'T3' => $T3,
        ]);
    }
}
