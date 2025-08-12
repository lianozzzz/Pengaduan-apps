@extends('layouts.main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="row justify-content-center g-4">
                <!-- Card Template -->
                @php
                    $cards = [
                        [
                            'color' => 'warning',
                            'icon' => 'fa-hourglass-half',
                            'count' => $countPending,
                            'label' => 'Menunggu Verifikasi',
                        ],
                        [
                            'color' => 'info',
                            'icon' => 'fa-cogs',
                            'count' => $countProses,
                            'label' => 'Sedang Diproses',
                        ],
                        [
                            'color' => 'success',
                            'icon' => 'fa-check-circle',
                            'count' => $countSelesai,
                            'label' => 'Selesai',
                        ],
                        [
                            'color' => 'danger',
                            'icon' => 'fa-times-circle',
                            'count' => $countDitolak,
                            'label' => 'Ditolak',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card border-0 shadow-sm rounded-3 bg-{{ $card['color'] }} text-white h-100">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="me-4">
                                    <i class="fa {{ $card['icon'] }} fa-2x text-white opacity-75"></i>
                                </div>
                                <div>
                                    <h3 class="mb-1 text-white fw-bold">{{ $card['count'] }}</h3>
                                    <p class="mb-0 fs-6">{{ $card['label'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <!-- Pengaduan Terbaru -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 text-white">5 Pengaduan Terbaru</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-bordered align-middle">
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Judul</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pengaduanTerbaru as $key => $p)
                                        <tr>
                                            <td class="text-center">{{ $key + 1 }}</td>
                                            <td>{{ $p->user->nama_lengkap ?? '-' }}</td>
                                            <td>{{ Str::limit($p->judul_pengaduan, 40) }}</td>

                                            <td class="text-center">
                                                {{ \Carbon\Carbon::parse($data->tanggal_kejadian)->translatedFormat('d F Y') }}</td>
                                            <td class="text-center">
                                                
                                                @php
                                                    $statusBadge = [
                                                        0 => 'warning',
                                                        1 => 'info',
                                                        2 => 'success',
                                                        3 => 'danger',
                                                    ];
                                                    $statusText = [
                                                        0 => 'Pending',
                                                        1 => 'Proses',
                                                        2 => 'Selesai',
                                                        3 => 'Ditolak',
                                                    ];
                                                @endphp
                                                <span class="badge bg-{{ $statusBadge[$p->status] ?? 'secondary' }}">
                                                    {{ $statusText[$p->status] ?? 'Tidak Diketahui' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada pengaduan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
