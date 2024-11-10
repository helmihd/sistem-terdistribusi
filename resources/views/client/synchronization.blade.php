<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Waktu Sinkronisasi Client</title>
</head>
<body>
    <h1>Hasil Sinkronisasi Waktu</h1>

    @if ($synchronization)
        <p><strong>IP Client:</strong> {{ $synchronization['clientIP'] }}</p>
        <p><strong>IP Server:</strong> {{ $synchronization['serverIP'] }}</p>
        <p><strong>T1:</strong> {{ $synchronization['T1'] }}</p>
        <p><strong>T2:</strong> {{ $synchronization['T2'] }}</p>
        <p><strong>T3:</strong> {{ $synchronization['T3'] }}</p>
        <p><strong>T4:</strong> {{ $synchronization['T4'] }}</p>
        <p><strong>Delay:</strong> {{ $synchronization['delay'] }} detik</p>
        <p><strong>Waktu Sinkronisasi:</strong> {{ $synchronization['synchronized_time'] }}</p>
    @else
        <p>Gagal mendapatkan waktu sinkronisasi dari server.</p>
    @endif
</body>
</html>
