<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\ApacheLog;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    // Menampilkan form unggah log
    public function showForm()
    {
        $logs = ApacheLog::paginate(50); // Mengambil 50 log per halaman
        return view('upload-log', compact('logs'));
    }

    // Memproses log dan menyimpannya ke database
    public function storeLogs(Request $request)
    {
        $request->validate([
            'log_file' => 'required|file|mimes:txt',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date'
        ]);

        $file = $request->file('log_file');
        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        // Membaca isi file log
        $logContents = file($file);

        foreach ($logContents as $logLine) {
            // Parsing setiap baris log

            preg_match('/^(\S+) - - \[(.*?)\] "(.*?)" (\d+) (\d+) "(.*?)" "(.*?)"/', $logLine, $matches);

            if ($matches) {
                $logDate = Carbon::createFromFormat('d/M/Y:H:i:s O', $matches[2]);
                
                // Memfilter berdasarkan rentang tanggal
                if ($logDate->between($startDate, $endDate)) {
                    ApacheLog::create([
                        'ip_address' => $matches[1],
                        'date' => $logDate->format('Y-m-d'),
                        'time' => $logDate->format('H:i:s'),
                        'http_method' => explode(' ', $matches[3])[0],
                        'request_url' => explode(' ', $matches[3])[1],
                        'http_protocol' => explode(' ', $matches[3])[2],
                        'status_code' => $matches[4],
                        'response_size' => $matches[5],
                        'user_agent' => $matches[7]
                    ]);
                }
            }
        }

        return back()->with('success', 'Log berhasil dimasukkan ke database berdasarkan rentang tanggal!');
    }

    // Menghapus semua log
    public function clearLogs()
    {
        ApacheLog::truncate(); // Menghapus semua data dalam tabel
        return back()->with('success', 'Semua log berhasil dihapus!');
    }

    public function exportLogsToXML()
    {
        $logs = ApacheLog::all();
    
        // Membuat elemen XML root
        $xml = new \SimpleXMLElement('<logs/>');
    
        foreach ($logs as $log) {
            // Menambahkan elemen log baru untuk setiap entri
            $logEntry = $xml->addChild('log');
            $logEntry->addChild('ip_address', htmlspecialchars($log->ip_address));
            $logEntry->addChild('date', htmlspecialchars($log->date));
            $logEntry->addChild('time', htmlspecialchars($log->time));
            $logEntry->addChild('http_method', htmlspecialchars($log->http_method));
            $logEntry->addChild('request_url', htmlspecialchars($log->request_url));
            $logEntry->addChild('http_protocol', htmlspecialchars($log->http_protocol));
            $logEntry->addChild('status_code', htmlspecialchars($log->status_code));
            $logEntry->addChild('response_size', htmlspecialchars($log->response_size));
            $logEntry->addChild('user_agent', htmlspecialchars($log->user_agent));
            
            // Menambahkan newline (jika diperlukan) sebagai bagian dari struktur
            // Namun, biasanya XML tidak menggunakan newline dalam struktur
        }
    
        // Mengatur header untuk unduhan file XML
        $filename = 'apache_logs_' . date('Y-m-d_H-i-s') . '.xml';
        return response($xml->asXML(), 200, [
            'Content-Type' => 'application/xml',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ]);
    }

}
