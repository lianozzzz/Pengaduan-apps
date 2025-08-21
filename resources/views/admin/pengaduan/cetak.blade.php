<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        *{box-sizing:border-box}
        body{font-family:Arial,sans-serif;font-size:13px;margin:5px;color:#000}
        .container-a4{width:210mm;min-height:297mm;padding:5mm;margin:auto;background:#fff}
        .page-break{page-break-before:always}
        @media print{
            @page{size:A4;margin:10mm}
            .btn-print{display:none!important}
            .container-a4{padding:10mm;width:auto;min-height:auto}
            .page-break{display:block;page-break-before:always}
        }
    </style>
</head>
<body>

<div class="text-center btn-print my-3">
    <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Laporan</button>
</div>

{{-- Ringkasan Filter --}}
<div class="container-a4 mb-3">
    <div class="text-center mb-2">
        <img src="{{ asset('public/template/assets/logo/logo-polseknobk.png') }}" width="70" alt="Logo">
        <h4 class="mt-2 mb-0">LAPORAN PENGADUAN MASYARAKAT</h4>
        <h6 class="mb-2">Polsek Bukit Kapur</h6>
        <hr>
        <p class="mb-0">
            <strong>Filter:</strong>
            Judul: {{ $filters['judul_pengaduan'] ?? 'Semua' }} |
            Tahun: {{ $filters['tahun'] ?? 'Semua' }} |
            Bulan: {{ $filters['bulan'] ?? 'Semua' }} |
            Tanggal: {{ $filters['tanggal'] ?? 'Semua' }} |
            Status: @php
                $statusLabel=[0=>'Pending',1=>'Proses',2=>'Selesai',3=>'Ditolak'];
                echo isset($filters['status']) && $filters['status'] !== '' ? ($statusLabel[$filters['status']] ?? $filters['status']) : 'Semua';
            @endphp
        </p>
        <p class="text-muted">Total data: {{ $pengaduans->count() }}</p>
    </div>
</div>

@forelse($pengaduans as $idx => $p)
    @if($idx>0)<div class="page-break"></div>@endif
    <div class="container-a4">
        <div class="mb-2">
            <table class="table table-bordered">
                <tr><th width="30%">Nama Pelapor</th><td>{{ $p->user->nama_lengkap ?? '-' }}</td></tr>
                <tr><th>Judul Pengaduan</th><td>{{ $p->judul_pengaduan }}</td></tr>
                <tr><th>Tanggal Kejadian</th><td>
                    @if(!empty($p->tanggal_kejadian))
                        {{ \Carbon\Carbon::parse($p->tanggal_kejadian)->translatedFormat('d F Y') }}
                    @else
                        {{ \Carbon\Carbon::parse($p->created_at)->translatedFormat('d F Y, H:i') }}
                    @endif
                </td></tr>
                <tr><th>Status</th><td>{{ ['Pending','Proses','Selesai','Ditolak'][$p->status] ?? '-' }}</td></tr>
                <tr><th>Lokasi Kejadian</th><td>
                    @php
                        $lokasiParts=[];
                        if(!empty($p->lokasi)) $lokasiParts[]=$p->lokasi;
                        if(!empty($p->latitude) && !empty($p->longitude)) $lokasiParts[]=$p->latitude.', '.$p->longitude;
                        echo count($lokasiParts)?implode(', ',$lokasiParts):'-';
                    @endphp
                </td></tr>
                <tr><th>Keterangan</th><td>{{ $p->keterangan_kejadian }}</td></tr>
            </table>
        </div>

        @if ($p->foto && $p->foto->count())
            <h6 class="mt-4 mb-2">Lampiran Foto Kejadian</h6>
            @foreach ($p->foto as $foto)
                <div class="mb-3">
                    <img src="{{ asset('storage/app/public/'.$foto->foto_kejadian) }}" alt="Foto Kejadian" class="img-fluid" style="max-width:100%;">
                </div>
            @endforeach
        @endif

        <div class="text-end mt-5">
            <p>Hormat Saya,</p><br><br>
            <p><strong>{{ Auth::user()->nama_lengkap ?? 'Nama Admin' }}</strong></p>
        </div>
    </div>
@empty
    <div class="container-a4">
        <p class="text-center">Tidak ada data sesuai filter.</p>
    </div>
@endforelse

</body>
</html>
