<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="dropdown header-profile">
                <a class="nav-link" href="{{ route('dashboard.admin') }}" role="button" data-bs-toggle="dropdown">
                    {{-- profile foto --}}
                    <img src="{{ asset('public/template/assets/logo/logo-polsek.jpg') }}" width="20" alt="" />
                    {{-- profile foto --}}
                    <div class="header-info ms-3">
                        <span class="font-w600 ">Hi,<b>{{ $userName->username }}</b></span>
                        <small class="text-end font-w400">{{ $userName->nama_lengkap }}</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="{{ route('akun.admin') }}" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <!-- Form Logout -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <!-- Tautan Dropdown Logout -->
                    <a href="#" class="dropdown-item ai-icon"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout</span>
                    </a>

                </div>
            </li>
            <ul class="metismenu" id="menu">
                <li>
                    <a href="{{ route('dashboard.admin') }}">
                        <i class="flaticon-025-dashboard"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('pengguna.index') }}" aria-expanded="false">
                        <i class="flaticon-043-menu"></i>
                        <span class="nav-text">Kelola Pengguna</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('index.pengaduan') }}" aria-expanded="false">
                        <i class="flaticon-050-info"></i>
                        <span class="nav-text">Informasi Pengaduan</span>
                    </a>
                </li>
            </ul>

        </ul>
        <div class="copyright">
            <p><strong>Polsek Bukit Kapur</strong> © 2025 All Rights Reserved</p>
        </div>
    </div>
</div>
