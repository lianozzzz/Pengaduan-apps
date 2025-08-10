@extends('layouts.main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Data Pengaduan</a></li>
                </ol>
            </div>
            <!-- Tabel Pengaduan -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Daftar Pengaduan</h5>
                            <button type="button" class="btn btn-primary  mb-2" data-bs-toggle="modal"
                                data-bs-target="#modalTambahPengaduan">
                                Tambah +
                            </button>
                        </div>

                        <div class="card-body">
                            <div class="col-md-12">
                                <form method="GET" action="{{ route('index.pengaduan') }}">
                                    <div class="row justify-content-center gy-2 gx-3 mb-4">
                                        <div class="col-lg-2 col-md-3 col-sm-6">
                                            <label class="form-label fw-bold">Status</label>
                                            <select name="status" class="form-select" onchange="this.form.submit()">
                                                <option value="">Semua</option>
                                                <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>
                                                    Proses</option>
                                                <option value="2" {{ request('status') == '2' ? 'selected' : '' }}>
                                                    Selesai</option>
                                                <option value="3" {{ request('status') == '3' ? 'selected' : '' }}>
                                                    Ditolak</option>
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-3 col-sm-6">
                                            <label class="form-label fw-bold">Bulan</label>
                                            <select name="bulan" class="form-select" onchange="this.form.submit()">
                                                <option value="">Semua</option>
                                                @for ($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ request('bulan') == $i ? 'selected' : '' }}>
                                                        {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-3 col-sm-6">
                                            <label class="form-label fw-bold">Tanggal</label>
                                            <select name="tanggal" class="form-select" onchange="this.form.submit()">
                                                <option value="">Semua</option>
                                                @for ($i = 1; $i <= 31; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ request('tanggal') == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="col-lg-2 col-md-3 col-sm-6">
                                            <label class="form-label fw-bold">Tahun</label>
                                            <select name="tahun" class="form-select" onchange="this.form.submit()">
                                                <option value="">Semua</option>
                                                @for ($y = date('Y'); $y >= 2020; $y--)
                                                    <option value="{{ $y }}"
                                                        {{ request('tahun') == $y ? 'selected' : '' }}>
                                                        {{ $y }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>

                                    </div>
                                </form>
                            </div>




                            <div class="table-responsive">
                                <table id="example"
                                    class="table table-bordered table-hover align-middle custom-border-black">
                                    <thead class="table-secondary text-center">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Judul Laporan</th>
                                            <th>Alamat Kejadian</th>
                                            <th>Gambar</th>
                                            <th>Tanggal Aduan</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pengaduan as $data)
                                            <tr class="text-center">
                                                <td>{{ $loop->iteration }}</td>

                                                <td class="text-start">
                                                    {{ $data->user->nama_lengkap ?? '-' }}
                                                </td>

                                                <td class="text-start">
                                                    {{ $data->judul_pengaduan }}
                                                </td>

                                                <td>
                                                    @php
                                                        // Ambil lokasi dari database
                                                        $lokasi = $data->lokasi;

                                                        // Kalau mengandung koma dan angka desimal, kemungkinan besar koordinat
                                                        if (preg_match('/^-?\d+\.\d+,\s*-?\d+\.\d+$/', trim($lokasi))) {
                                                            $alamatManual = '-'; // Kosongkan kalau murni koordinat
                                                        } else {
                                                            // Hilangkan koordinat kalau formatnya gabungan alamat + koordinat
                                                            $alamatManual = preg_replace('/\(\s*-?\d+\.\d+,\s*-?\d+\.\d+\s*\)/', '', $lokasi);
                                                        }
                                                    @endphp

                                                    {{ trim($alamatManual) }}
                                                </td>

                                                <td class="text-start">
                                                    @if ($data->foto->count())
                                                        @foreach ($data->foto as $f)
                                                            <div>
                                                                <a href="{{ asset('storage/app/public/' . $f->foto_kejadian) }}"
                                                                    target="_blank">
                                                                    Gambar {{ $loop->iteration }}
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <small class="text-muted">Tidak ada</small>
                                                    @endif
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($data->created_at)->locale('id')->translatedFormat('d F Y') }}
                                                </td>

                                                <td>
                                                    @php
                                                        $statusClass = [
                                                            0 => 'warning',
                                                            1 => 'info',
                                                            2 => 'success',
                                                            3 => 'danger',
                                                        ];
                                                        $statusLabel = [
                                                            0 => 'Pending',
                                                            1 => 'Proses',
                                                            2 => 'Selesai',
                                                            3 => 'Ditolak',
                                                        ];
                                                    @endphp
                                                    <span
                                                        class="badge bg-{{ $statusClass[$data->status] ?? 'secondary' }}">
                                                        {{ $statusLabel[$data->status] ?? 'Tidak Diketahui' }}
                                                    </span>
                                                </td>

                                                <td>
                                                    @if ($data->status == 0)
                                                        <!-- Tombol Edit -->
                                                        <button class="btn btn-sm btn-warning border-0 rounded-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEditPengaduan{{ $data->id_pengaduan }}">
                                                            Edit
                                                        </button>

                                                        <!-- Tombol Hapus -->
                                                        <form
                                                            action="{{ route('destroy.pengaduan', $data->id_pengaduan) }}"
                                                            method="POST" class="d-inline-block"
                                                            onsubmit="return confirm('Yakin ingin menghapus?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="btn btn-sm btn-danger border-0 rounded-0">Hapus</button>
                                                        </form>
                                                    @endif


                                                    @if ($data->status == 0 || $data->status == 1)
                                                        <!-- Tombol buka modal ubah status -->
                                                        <button class="btn btn-sm btn-primary border-0 rounded-0"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalStatusPengaduan{{ $data->id_pengaduan }}">
                                                            Status
                                                        </button>
                                                    @endif


                                                    <a href="{{ route('laporan.export', $data->id_pengaduan) }}"
                                                        class="btn btn-sm btn-secondary border-0 rounded-0" target="_blank">
                                                        Cetak
                                                    </a>

                                                </td>
                                                {{-- modal status --}}
                                                <div class="modal fade" id="modalStatusPengaduan{{ $data->id_pengaduan }}"
                                                    tabindex="-1"
                                                    aria-labelledby="modalStatusLabel{{ $data->id_pengaduan }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content border-primary">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title"
                                                                    id="modalStatusLabel{{ $data->id_pengaduan }}">
                                                                    Ubah Status Pengaduan
                                                                </h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form
                                                                action="{{ route('pengaduan.updateStatus', $data->id_pengaduan) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-body">
                                                                    <div class="mb-3">
                                                                        <label for="status" class="form-label">Status
                                                                            Pengaduan</label>
                                                                        <select name="status" class="form-select" required>
                                                                            <option value="0"
                                                                                {{ $data->status == 0 ? 'selected' : '' }}>
                                                                                Pending</option>
                                                                            <option value="1"
                                                                                {{ $data->status == 1 ? 'selected' : '' }}>
                                                                                Proses</option>
                                                                            <option value="2"
                                                                                {{ $data->status == 2 ? 'selected' : '' }}>
                                                                                Selesai</option>
                                                                            <option value="3"
                                                                                {{ $data->status == 3 ? 'selected' : '' }}>
                                                                                Ditolak</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-primary">Ubah
                                                                        Status</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- modal status --}}
                                                {{-- modal edit --}}
                                                <div class="modal fade" id="modalEditPengaduan{{ $data->id_pengaduan }}"
                                                    tabindex="-1"
                                                    aria-labelledby="modalEditLabel{{ $data->id_pengaduan }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                                        <div class="modal-content border-dark">
                                                            <div class="modal-header bg-warning text-dark">
                                                                <h5 class="modal-title"
                                                                    id="modalEditLabel{{ $data->id_pengaduan }}">Edit
                                                                    Pengaduan</h5>
                                                                <button type="button" class="btn-close btn-close-white"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <form
                                                                action="{{ route('update.pengaduan', $data->id_pengaduan) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
                                                                @method('PUT')

                                                                <div class="modal-body"
                                                                    style="max-height: 70vh; overflow-y: auto;">
                                                                    <!-- Judul -->
                                                                    <div class="mb-3">
                                                                        <label for="judul_pengaduan"
                                                                            class="form-label">Judul Pengaduan</label>
                                                                        <input type="text" name="judul_pengaduan"
                                                                            class="form-control"
                                                                            value="{{ $data->judul_pengaduan }}" required>
                                                                    </div>

                                                                    <!-- Tambahan di dalam form modal EDIT -->
                                                                    <!-- Pilihan Metode Lokasi -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Metode Lokasi</label>
                                                                        <select class="form-select lokasiMethodEdit"
                                                                            data-id="{{ $data->id_pengaduan }}" required>
                                                                            <option value="" disabled>Pilih metode
                                                                                lokasi</option>
                                                                            <option value="alamat"
                                                                                {{ $data->lokasi && !$data->latitude && !$data->longitude ? 'selected' : '' }}>
                                                                                Alamat Manual
                                                                            </option>
                                                                            <option value="koordinat"
                                                                                {{ !$data->lokasi && $data->latitude && $data->longitude ? 'selected' : '' }}>
                                                                                Koordinat (Map)
                                                                            </option>
                                                                            <option value="alamat_koordinat"
                                                                                {{ $data->lokasi && $data->latitude && $data->longitude ? 'selected' : '' }}>
                                                                                Alamat dan Koordinat
                                                                            </option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Lokasi Manual -->
                                                                    <div class="mb-3 alamatInputEdit-{{ $data->id_pengaduan }}"
                                                                        style="display: {{ $data->lokasi ? 'block' : 'none' }};">
                                                                        <label for="lokasi" class="form-label">Alamat
                                                                            Kejadian</label>
                                                                        <input type="text" name="lokasi"
                                                                            class="form-control"
                                                                            value="{{ $data->lokasi }}">
                                                                    </div>

                                                                    <!-- Latitude & Longitude -->
                                                                    <div class="row koordinatInputEdit-{{ $data->id_pengaduan }}"
                                                                        style="display: {{ $data->latitude && $data->longitude ? 'flex' : 'none' }};">
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="latitude"
                                                                                class="form-label">Latitude</label>
                                                                            <input type="text" class="form-control"
                                                                                name="latitude"
                                                                                value="{{ $data->latitude }}">
                                                                        </div>
                                                                        <div class="col-md-6 mb-3">
                                                                            <label for="longitude"
                                                                                class="form-label">Longitude</label>
                                                                            <input type="text" class="form-control"
                                                                                name="longitude"
                                                                                value="{{ $data->longitude }}">
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3 koordinatInputEdit-{{ $data->id_pengaduan }}"
                                                                        style="display: {{ $data->latitude && $data->longitude ? 'block' : 'none' }};">
                                                                        <label class="form-label">Tandai Lokasi pada
                                                                            Peta</label>
                                                                        <div id="map-edit-{{ $data->id_pengaduan }}"
                                                                            style="height: 300px;"></div>
                                                                    </div>

                                                                    <!-- Status -->
                                                                    <div class="mb-3">
                                                                        <label for="status"
                                                                            class="form-label">Status</label>
                                                                        <select name="status" class="form-select"
                                                                            required>
                                                                            <option value="0"
                                                                                {{ $data->status == 0 ? 'selected' : '' }}>
                                                                                Pending</option>
                                                                            <option value="1"
                                                                                {{ $data->status == 1 ? 'selected' : '' }}>
                                                                                Proses</option>
                                                                            <option value="2"
                                                                                {{ $data->status == 2 ? 'selected' : '' }}>
                                                                                Selesai</option>
                                                                            <option value="3"
                                                                                {{ $data->status == 3 ? 'selected' : '' }}>
                                                                                Ditolak</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Keterangan -->
                                                                    <div class="mb-3">
                                                                        <label for="keterangan_kejadian"
                                                                            class="form-label">Keterangan Kejadian</label>
                                                                        <textarea name="keterangan_kejadian" class="form-control" rows="5">{{ $data->keterangan_kejadian }}</textarea>
                                                                    </div>

                                                                    <!-- Upload Foto Tambahan -->
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Tambah Foto Kejadian
                                                                            (opsional)
                                                                        </label>
                                                                        <input type="file" name="foto_kejadian[]"
                                                                            class="form-control" accept="image/*"
                                                                            multiple>
                                                                        <small class="text-muted">Biarkan kosong jika tidak
                                                                            ingin menambah foto.</small>
                                                                    </div>
                                                                </div>

                                                                <!-- Footer -->
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-warning">Simpan
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- modal edit --}}
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Belum ada data
                                                    pengaduan.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Tambah Pengaduan -->

            <!-- Modal Tambah Pengaduan -->
            <div class="modal fade" id="modalTambahPengaduan" tabindex="-1" aria-labelledby="modalTambahLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-dark">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahLabel">Form Tambah Pengaduan</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>

                        <form action="{{ route('store.pengaduan') }}" method="POST" enctype="multipart/form-data"
                            onsubmit="prepareFormSubmission()">
                            @csrf
                            <div class="modal-body">

                                <!-- Judul -->
                                <div class="mb-3">
                                    <label for="judul_pengaduan" class="form-label">Judul Pengaduan</label>
                                    <input type="text" name="judul_pengaduan" class="form-control" required>
                                </div>

                                <!-- Metode Lokasi -->
                                <div class="mb-3">
                                    <label class="form-label">Metode Lokasi</label>
                                    <select class="form-select" id="lokasiMethod" onchange="toggleLokasiInput()"
                                        required>
                                        <option value="" selected disabled>Pilih metode lokasi</option>
                                        <option value="alamat">Alamat Manual</option>
                                        <option value="koordinat">Koordinat (Map)</option>
                                        <option value="alamat_koordinat">Alamat dan Koordinat</option>
                                    </select>
                                </div>

                                <!-- Alamat -->
                                <div class="mb-3" id="alamatInput" style="display: none;">
                                    <label for="lokasi" class="form-label">Alamat Kejadian</label>
                                    <input type="text" name="lokasi" class="form-control"
                                        placeholder="Contoh: Jl. Soekarno Hatta No. 13">
                                </div>

                                <!-- Koordinat -->
                                <div id="koordinatInput" style="display: none;">
                                    <div class="mb-3">
                                        <label for="latitude" class="form-label">Latitude</label>
                                        <input type="text" class="form-control" name="latitude" id="latitude"
                                            placeholder="Contoh: -1.234567">
                                    </div>

                                    <div class="mb-3">
                                        <label for="longitude" class="form-label">Longitude</label>
                                        <input type="text" class="form-control" name="longitude" id="longitude"
                                            placeholder="Contoh: 101.234567">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Tandai Lokasi pada Peta</label>
                                        <div id="map" style="height: 300px;"></div>
                                    </div>
                                </div>

                                <!-- Foto -->
                                <div class="mb-3">
                                    <label class="form-label">Foto Kejadian (maks 5)</label>
                                    <div id="foto-wrapper">
                                        <div class="input-group mb-2">
                                            <input type="file" name="foto_kejadian[]" class="form-control"
                                                accept="image/*" required>
                                        </div>
                                    </div>
                                    <button type="button" id="tambah-foto" class="btn btn-sm btn-success">+ Tambah
                                        Foto</button>
                                </div>

                                <!-- Status -->
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" class="form-select" required>
                                        <option value="0">Pending</option>
                                        <option value="1">Proses</option>
                                        <option value="2">Selesai</option>
                                        <option value="3">Ditolak</option>
                                    </select>
                                </div>

                                <!-- Keterangan -->
                                <div class="mb-3">
                                    <label for="keterangan_kejadian" class="form-label">Keterangan Kejadian</label>
                                    <textarea name="keterangan_kejadian" class="form-control" rows="6" required></textarea>
                                </div>

                            </div>

                            <!-- Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Leaflet CSS & JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />



    <script>
        let map, marker;

        function toggleLokasiMethod() {
            const metode = document.getElementById('lokasiMethod').value;
            const alamatGroup = document.getElementById('alamatGroup');
            const koordinatGroup = document.getElementById('koordinatGroup');

            alamatGroup.style.display = metode === 'manual' ? 'block' : 'none';
            koordinatGroup.style.display = metode === 'maps' ? 'block' : 'none';
        }


        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('modalTambahPengaduan');

            modal.addEventListener('shown.bs.modal', function() {
                if (!map) {
                    const defaultLat = 1.538072;
                    const defaultLng = 101.383241;

                    map = L.map('map').setView([defaultLat, defaultLng], 15);
                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '© OpenStreetMap'
                    }).addTo(map);

                    marker = L.marker([defaultLat, defaultLng], {
                        draggable: true
                    }).addTo(map);

                    marker.on('dragend', function(e) {
                        const latlng = marker.getLatLng();
                        document.getElementById('latitude').value = latlng.lat.toFixed(6);
                        document.getElementById('longitude').value = latlng.lng.toFixed(6);
                    });

                    document.getElementById('latitude').value = defaultLat;
                    document.getElementById('longitude').value = defaultLng;
                } else {
                    setTimeout(() => map.invalidateSize(), 300);
                }
            });

        });

        // Kosongkan field yang tidak diperlukan sebelum form dikirim
        function prepareFormSubmission() {
            const method = document.getElementById('lokasiMethod').value;

            if (method === 'alamat') {
                document.getElementById('latitude').value = '';
                document.getElementById('longitude').value = '';
            } else if (method === 'koordinat') {
                const lokasiInput = document.querySelector('input[name="lokasi"]');
                if (lokasiInput) lokasiInput.value = '';
            }
            // Jika alamat_koordinat, tidak perlu hapus apapun
        }
    </script>



    <script>
        function toggleLokasiInput() {
            const method = document.getElementById('lokasiMethod').value;
            const alamatInput = document.getElementById('alamatInput');
            const koordinatInput = document.getElementById('koordinatInput');

            alamatInput.style.display = 'none';
            koordinatInput.style.display = 'none';

            if (method === 'alamat') {
                alamatInput.style.display = 'block';
            } else if (method === 'koordinat') {
                koordinatInput.style.display = 'block';
            } else if (method === 'alamat_koordinat') {
                alamatInput.style.display = 'block';
                koordinatInput.style.display = 'block';
            }
        }
    </script>


    <script>
        let maxFoto = 5;
        let fotoCount = 1;

        document.getElementById('tambah-foto').addEventListener('click', function() {
            if (fotoCount < maxFoto) {
                fotoCount++;

                const wrapper = document.getElementById('foto-wrapper');

                const inputGroup = document.createElement('div');
                inputGroup.className = 'input-group mb-2';

                const input = document.createElement('input');
                input.type = 'file';
                input.name = 'foto_kejadian[]';
                input.className = 'form-control';
                input.accept = 'image/*';
                input.required = true;

                const btnRemove = document.createElement('button');
                btnRemove.type = 'button';
                btnRemove.className = 'btn btn-danger btn-sm ms-2';
                btnRemove.textContent = '×';
                btnRemove.onclick = function() {
                    wrapper.removeChild(inputGroup);
                    fotoCount--;
                };

                inputGroup.appendChild(input);
                inputGroup.appendChild(btnRemove);

                wrapper.appendChild(inputGroup);
            } else {
                alert('Maksimal 5 foto dapat diunggah.');
            }
        });
    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selects = document.querySelectorAll('.lokasiMethodEdit');

            selects.forEach(select => {
                select.addEventListener('change', function() {
                    const id = this.dataset.id;
                    const selected = this.value;

                    const alamatInput = document.querySelector('.alamatInputEdit-' + id);
                    const koordinatInput = document.querySelector('.koordinatInputEdit-' + id);

                    // Reset
                    alamatInput.style.display = 'none';
                    koordinatInput.style.display = 'none';

                    if (selected === 'alamat') {
                        alamatInput.style.display = 'block';
                    } else if (selected === 'koordinat') {
                        koordinatInput.style.display = 'flex';
                    } else if (selected === 'alamat_koordinat') {
                        alamatInput.style.display = 'block';
                        koordinatInput.style.display = 'flex';
                    }
                });
            });
        });
    </script>



    <script>
        const editMaps = {}; // untuk menyimpan instance map berdasarkan ID

        document.addEventListener('DOMContentLoaded', function() {
            const allModals = document.querySelectorAll('[id^="modalEditPengaduan"]');

            allModals.forEach(modalEl => {
                modalEl.addEventListener('shown.bs.modal', function() {
                    const id = modalEl.id.replace('modalEditPengaduan', '');
                    const mapContainerId = `map-edit-${id}`;
                    const latInput = modalEl.querySelector('input[name="latitude"]');
                    const lngInput = modalEl.querySelector('input[name="longitude"]');

                    const defaultLat = parseFloat(latInput.value) || 1.556573;
                    const defaultLng = parseFloat(lngInput.value) || 101.383306;

                    if (!editMaps[id]) {
                        const map = L.map(mapContainerId).setView([defaultLat, defaultLng], 15);
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '© OpenStreetMap'
                        }).addTo(map);

                        const marker = L.marker([defaultLat, defaultLng], {
                            draggable: true
                        }).addTo(map);

                        marker.on('dragend', function(e) {
                            const latlng = marker.getLatLng();
                            latInput.value = latlng.lat.toFixed(6);
                            lngInput.value = latlng.lng.toFixed(6);
                        });

                        editMaps[id] = map;
                    } else {
                        setTimeout(() => {
                            editMaps[id].invalidateSize();
                        }, 300);
                    }
                });
            });
        });
    </script>

@endsection
