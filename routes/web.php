<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\TimeSyncController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/upload-log', [LogController::class, 'showForm']);
Route::post('/upload-log', [LogController::class, 'storeLogs']);
Route::get('/logs', [LogController::class, 'showLogs']); // Route untuk menampilkan log
Route::post('/clear-logs', [LogController::class, 'clearLogs']); // Route untuk menghapus log
Route::post('/export-logs', [LogController::class, 'exportLogsToXML']);
Route::get('/sync-time', [TimeSyncController::class, 'showSynchronization']);
Route::get('/server-time', [TimeSyncController::class, 'getServerTime']);

