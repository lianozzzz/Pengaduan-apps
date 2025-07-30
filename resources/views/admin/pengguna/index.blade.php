@extends('layouts.main')

@section('content')
    <div class="content-body">
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <div class="row page-titles">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Manajemen Akun</a></li>
                    <li class="breadcrumb-item active"><a href="#">Pengguna</a></li>
                </ol>
            </div>



            <!-- Tabel -->
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Daftar Akun Pengguna</h5>
                            <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                                data-bs-target="#modalTambahUser">
                                <i class="fa fa-plus me-1"></i> Tambah +
                            </button>


                        </div>

                        <div class="card-body">
                            <!-- Filter -->
                            <form method="GET" action="{{ route('pengguna.index') }}">
                                <div class="row mb-3">
                                    <div class="col-lg-3 col-md-4 col-sm-6">
                                        <label class="form-label fw-bold">Filter Berdasarkan Role</label>
                                        <select name="role" class="form-select" onchange="this.form.submit()">
                                            <option value="">Semua</option>
                                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin
                                            </option>
                                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>User
                                            </option>
                                            <!-- Tambah role lain jika ada -->
                                        </select>
                                    </div>
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table id="example" class="table table-bordered table-striped">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Lengkap</th>
                                            <th>Username</th>
                                            <th>Role</th>
                                            <th>Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $index => $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->nama_lengkap }}</td>
                                                <td>{{ $user->username }}</td>
                                                <td>{{ $user->role }}</td>
                                                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
                                                <td>
                                                    <!-- Reset Password -->
                                                    <form action="{{ route('pengguna.resetPassword', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning"
                                                            onclick="return confirm('Reset password untuk {{ $user->nama_lengkap }}?')">
                                                            Reset
                                                        </button>
                                                    </form>

                                                    <!-- Hapus -->
                                                    <form action="{{ route('pengguna.destroy', $user->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Yakin ingin menghapus akun ini?')">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center">Tidak ada akun ditemukan.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <!-- Modal Tambah Pengguna -->
                            <div class="modal fade" id="modalTambahUser" tabindex="-1"
                                aria-labelledby="modalTambahUserLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form action="{{ route('pengguna.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Tutup"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mb-3">
                                                    <label class="form-label">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap"
                                                        class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                        value="{{ old('nama_lengkap') }}" placeholder="Masukkan nama lengkap">
                                                    @error('nama_lengkap')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Jenis Kelamin</label>
                                                    <select name="jenis_kelamin"
                                                        class="form-select @error('jenis_kelamin') is-invalid @enderror">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="Laki-Laki"
                                                            {{ old('jenis_kelamin') == 'Laki-Laki' ? 'selected' : '' }}>
                                                            Laki-Laki</option>
                                                        <option value="Perempuan"
                                                            {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                                            Perempuan</option>
                                                    </select>
                                                    @error('jenis_kelamin')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir"
                                                        class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                                        value="{{ old('tanggal_lahir') }}">
                                                    @error('tanggal_lahir')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">No HP</label>
                                                    <input type="text" name="no_hp"
                                                        class="form-control @error('no_hp') is-invalid @enderror"
                                                        value="{{ old('no_hp') }}" placeholder="Masukkan no hp">
                                                    @error('no_hp')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Username</label>
                                                    <input type="text" name="username"
                                                        class="form-control @error('username') is-invalid @enderror"
                                                        value="{{ old('username') }}" placeholder="Masukkan username">
                                                    @error('username')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Password</label>
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror" placeholder="Masukkan assword">
                                                    @error('password')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Role</label>
                                                    <select name="role"
                                                        class="form-select @error('role') is-invalid @enderror">
                                                        <option value="">-- Pilih --</option>
                                                        <option value="admin"
                                                            {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                                        <option value="user"
                                                            {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
