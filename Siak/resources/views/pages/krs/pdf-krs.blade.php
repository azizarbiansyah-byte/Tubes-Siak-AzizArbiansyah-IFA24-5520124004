<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>KRS - {{ $mahasiswa->npm ?? '' }}</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h2, h4 { text-align: center; margin: 0; }
        .info { margin: 15px 0; }
        .info td { padding: 3px 10px 3px 0; }
        table.krs { width: 100%; border-collapse: collapse; margin-top: 15px; }
        table.krs th, table.krs td { border: 1px solid #333; padding: 6px 8px; }
        table.krs th { background-color: #f0f0f0; text-align: left; }
        table.krs tfoot td { font-weight: bold; }
        .ttd { margin-top: 40px; text-align: right; }
    </style>
</head>
<body>
    <h2>Kartu Rencana Studi (KRS)</h2>
    <h4>Universitas Suryakancana Cianjur</h4>

    <table class="info">
        <tr>
            <td>Nama</td>
            <td>: {{ $mahasiswa->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td>NPM</td>
            <td>: {{ $mahasiswa->npm ?? '-' }}</td>
        </tr>
        <tr>
            <td>Dosen Wali</td>
            <td>: {{ $mahasiswa->dosen->nama ?? '-' }}</td>
        </tr>
    </table>

    <table class="krs">
        <thead>
            <tr>
                <th width="40">No</th>
                <th>Kode MK</th>
                <th>Nama Mata Kuliah</th>
                <th width="50">SKS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($krs as $index => $k)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $k->kode_matakuliah }}</td>
                <td>{{ $k->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $k->matakuliah->sks ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="text-align: right;">Total SKS</td>
                <td>{{ $krs->sum(fn($k) => $k->matakuliah->sks ?? 0) }}</td>
            </tr>
        </tfoot>
    </table>

    <div class="ttd">
        <p>Cianjur, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
        <br><br><br>
        <p>Dosen Wali</p>
        <p><strong>{{ $mahasiswa->dosen->nama ?? '-' }}</strong></p>
    </div>

</body>
</html>