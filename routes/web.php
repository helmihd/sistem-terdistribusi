<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload-log', [LogController::class, 'showForm']);
Route::post('/upload-log', [LogController::class, 'storeLogs']);
Route::get('/logs', [LogController::class, 'showLogs']); // Route untuk menampilkan log
Route::post('/clear-logs', [LogController::class, 'clearLogs']); // Route untuk menghapus log
Route::post('/export-logs', [LogController::class, 'exportLogsToXML']);

