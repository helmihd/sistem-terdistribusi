<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unggah Log Apache</title>
</head>
<body>
    <h1>Unggah Log Apache</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="/upload-log" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="log_file">File Log (.txt):</label>
            <input type="file" name="log_file" id="log_file" required>
        </div>

        <div>
            <label for="start_date">Tanggal Mulai:</label>
            <input type="date" name="start_date" id="start_date" required>
        </div>

        <div>
            <label for="end_date">Tanggal Akhir:</label>
            <input type="date" name="end_date" id="end_date" required>
        </div>

        <button type="submit">Unggah dan Simpan Log</button>
    </form>

    <h2>Daftar Log Apache</h2>
    <form action="/clear-logs" method="POST">
        @csrf
        <button type="submit">Hapus Semua Log</button>
    </form>

    <!-- Tombol untuk mengunduh log sebagai XML -->
    <form action="/export-logs" method="POST" style="display: inline;">
        @csrf
        <button type="submit">Unduh Log sebagai XML</button>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Id</th>
                <th>IP Address</th>
                <th>Tanggal</th>
                <th>Waktu</th>
                <th>HTTP Method</th>
                <th>Request URL</th>
                <th>HTTP Protocol</th>
                <th>Status Code</th>
                <th>Response Size</th>
                <th>User Agent</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
                <tr>
                    <td>{{ $log->id }}</td>
                    <td>{{ $log->ip_address }}</td>
                    <td>{{ $log->date }}</td>
                    <td>{{ $log->time }}</td>
                    <td>{{ $log->http_method }}</td>
                    <td>{{ $log->request_url }}</td>
                    <td>{{ $log->http_protocol }}</td>
                    <td>{{ $log->status_code }}</td>
                    <td>{{ $log->response_size }}</td>
                    <td>{{ $log->user_agent }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Tidak ada log yang tersedia.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $logs->links() }}
</body>
</html>
