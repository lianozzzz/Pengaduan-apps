@extends('layouts.main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a>Data Akun</a></li>

                </ol>
            </div>

            <!-- Data Akun -->
            <div class="row">
                <div class="col-md-12"> {{-- Full responsive --}}
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between">
                            <h4 class="mb-0">Data Akun</h4>
                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalEditAkun">
                                Edit Akun
                            </button>
                        </div>

                        <div class="card-body">
                            <form>
                                <div class="mb-3">
                                    <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap"
                                        value="{{ $userName->nama_lengkap }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username"
                                        value="{{ $userName->username }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                    <input type="text" class="form-control" id="jenis_kelamin"
                                        value="{{ $userName->jenis_kelamin }}" readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="text" class="form-control" id="tanggal_lahir"
                                        value="{{ \Carbon\Carbon::parse($userName->tanggal_lahir)->format('d-m-Y') }}"
                                        readonly>
                                </div>

                                <div class="mb-3">
                                    <label for="no_hp" class="form-label">Nomor HP</label>
                                    <input type="text" class="form-control" id="no_hp" value="{{ $userName->no_hp }}"
                                        readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit Akun -->
            <div class="modal fade" id="modalEditAkun" tabindex="-1" aria-labelledby="modalEditAkunLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('update.admin', $userName->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-header bg-warning">
                                <h5 class="modal-title" id="modalEditAkunLabel">Edit Data Akun</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Username</label>
                                    <input type="text" name="username" class="form-control"
                                        value="{{ $userName->username }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Nomor HP</label>
                                    <input type="text" name="no_hp" class="form-control"
                                        value="{{ $userName->no_hp }}" required>
                                </div>
                                <div class="mb-3">
                                    <label>Password Baru <small class="text-muted">(Opsional)</small></label>
                                    <input type="password" name="password" class="form-control"
                                        placeholder="Kosongkan jika tidak diubah">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
