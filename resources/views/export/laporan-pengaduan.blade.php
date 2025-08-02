<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pengaduan</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 13px;
            margin: 5px;
            padding: 0;
            color: #000;
        }

        .container-a4 {
            width: 210mm;
            min-height: 297mm;
            padding: 5mm;
            margin: auto;
            background: white;
        }

        .table th,
        .table td {
            vertical-align: top;
            padding: 6px;
        }

        .foto-item img {
            max-width: 100%;
            border: 1px solid #ccc;
        }

        .foto-caption {
            font-size: 12px;
            text-align: center;
            margin-top: 4px;
        }

        .page-break {
            page-break-before: always;
        }

        hr {
            border-top: 2px solid black;
            margin: 10px 0;
        }

        .btn-print {
            margin: 20px;
        }

        @media print {
            @page {
                size: A4;
                margin: 10mm;
            }

            body {
                margin: 0;
                padding: 0;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }

            .btn-print {
                display: none !important;
            }

            .container-a4 {
                padding: 10mm;
                width: auto;
                min-height: auto;
            }

            .page-break {
                display: block;
                page-break-before: always;
            }

            h4, h5, h6, p {
                margin-top: 10px;
                margin-bottom: 10px;
            }

            .table th,
            .table td {
                padding: 8px !important;
            }

            .foto-item {
                margin-bottom: 15px;
            }

            table {
                margin-top: 10px;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    <!-- Tombol Cetak -->
    <div class="text-center btn-print">
        <button onclick="window.print()" class="btn btn-primary">🖨️ Cetak Laporan</button>
    </div>

    <!-- Halaman 1: Detail Pengaduan -->
    <div class="container-a4">
        <div class="text-center mb-3">
            <img src="{{ asset('public/template/assets/logo/logo-polseknobk.png') }}" width="80" alt="Logo Polsek">
            <h4 class="mt-2 mb-0">LAPORAN PENGADUAN MASYARAKAT</h4>
            <h6 class="mb-3">Polsek Bukit Kapur</h6>
            <hr>
        </div>

        <table class="table table-bordered">
            <tr>
                <th width="30%">Nama Pelapor</th>
                <td>{{ $pengaduan->user->nama_lengkap }}</td>
            </tr>
            <tr>
                <th>Judul Pengaduan</th>
                <td>{{ $pengaduan->judul_pengaduan }}</td>
            </tr>
            <tr>
                <th>Tanggal</th>
                <td>{{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y, H:i') }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    @php $statusLabel = ['Pending', 'Proses', 'Selesai', 'Ditolak']; @endphp
                    {{ $statusLabel[$pengaduan->status] ?? 'Unknown' }}
                </td>
            </tr>
            <tr>
                <th>Lokasi Kejadian</th>
                <td>
                    @php
                        $lokasiParts = [];

                        if (!empty($pengaduan->lokasi)) {
                            $lokasiParts[] = $pengaduan->lokasi;
                        }

                        if (!empty($pengaduan->latitude) && !empty($pengaduan->longitude)) {
                            $lokasiParts[] = $pengaduan->latitude . ', ' . $pengaduan->longitude;
                        }

                        echo count($lokasiParts) ? implode(', ', $lokasiParts) : '-';
                    @endphp
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
                <td>{{ $pengaduan->keterangan_kejadian }}</td>
            </tr>
        </table>
    </div>

    <!-- Halaman 2: Lampiran Foto -->
    @if ($pengaduan->foto->count())
        <div class="page-break"></div>
        <div class="container-a4">
            <div class="text-center mb-3">
                <h5>Lampiran Foto Kejadian</h5>
                <p><strong>Nama Pelapor:</strong> {{ $pengaduan->user->nama_lengkap }}</p>
                <p><strong>Judul:</strong> {{ $pengaduan->judul_pengaduan }}</p>
                <p><strong>Tanggal:</strong> {{ \Carbon\Carbon::parse($pengaduan->created_at)->translatedFormat('d F Y, H:i') }}</p>
            </div>

            @foreach ($pengaduan->foto as $foto)
                <div class="foto-item mb-4">
                    <img src="{{ asset('storage/app/public/' . $foto->foto_kejadian) }}" alt="Foto Kejadian" class="img-fluid">
                    <div class="foto-caption">Foto Kejadian</div>
                </div>
            @endforeach

            <!-- Tanda Tangan -->
            <div class="text-end mt-5" style="margin-top: 100px;">
                <p>Hormat Saya,</p>
                <br><br><br>
                <p><strong>{{ Auth::user()->nama_lengkap ?? 'Nama Admin' }}</strong></p>
            </div>
        </div>
    @endif

</body>

</html>
