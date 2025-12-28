<!-- Menu -->

@if (isset($user))
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="{{ route('home') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="" alt="">
                </span>
                <span class="app-brand-text menu-text text-center fs-4 fw-bolder ms-2">PROGRAM PSG <br> SMK Nusantara 1</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-gauge"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            <!-- Layouts -->
            @php
                $formulirActive = request()->routeIs(
                    'formulir_siswa',
                    'formulir_orang_tua',
                    'formulir_periodik',
                    'formulir_nilai_raport'
                );
            @endphp
            <li class="menu-item {{ $formulirActive ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons fa-solid fa-table-columns"></i>
                    <div data-i18n="Layouts">Formulir</div>
                </a>

                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('formulir_siswa') ? 'active' : '' }}">
                        <a href="{{ route('formulir_siswa') }}" class="menu-link">
                            <div data-i18n="Without menu">Data Siswa</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('formulir_orang_tua') ? 'active' : '' }}">
                        <a href="{{ route('formulir_orang_tua') }}" class="menu-link">
                            <div data-i18n="Without navbar">Data Orang Tua</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('formulir_periodik') ? 'active' : '' }}">
                        <a href="{{ route('formulir_periodik') }}" class="menu-link">
                            <div data-i18n="Without navbar">Data Periodik</div>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('formulir_nilai_raport') ? 'active' : '' }}">
                        <a href="{{ route('formulir_nilai_raport') }}" class="menu-link">
                            <div data-i18n="Without navbar">Data Raport</div>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-item {{ request()->routeIs('upload_berkas') ? 'active' : '' }}">
                <a href="{{ route('upload_berkas') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-upload"></i>
                    <div data-i18n="Account Settings">Upload Berkas</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('formulir_registrasi') ? 'active' : '' }}">
                <a href="{{ route('formulir_registrasi') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-file"></i>
                    <div data-i18n="Account Settings">Registrasi</div>
                </a>
            </li>

            {{-- <li class="menu-item">
                <a href="{{ route('id_card') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-id-card"></i>
                    <div data-i18n="Account Settings">ID Card</div>
                </a>
            </li> --}}

            <li class="menu-item {{ request()->routeIs('akun') ? 'active' : '' }}">
                <a href="{{ route('akun') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                    <div data-i18n="Analytics">Profile</div>
                </a>
            </li>
        </ul>
    </aside>
    <!-- / Menu -->
@elseif (isset($admin))
    <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
            <a href="{{ route('admin.dashboard') }}" class="app-brand-link">
                <span class="app-brand-logo demo">
                    <img src="" alt="">
                </span>
                <span class="app-brand-text menu-text text-center fs-4 fw-bolder ms-2">PROGRAM PSG <br> SMK Nusantara 1</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
            <!-- Dashboard -->
            <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-gauge"></i>
                    <div data-i18n="Analytics">Dashboard</div>
                </a>
            </li>

            @php
                $grafikActive = request()->routeIs(
                    'admin.grafik'
                );
            @endphp
            <!-- Layouts -->
            <li class="menu-item {{ $grafikActive ? 'active' : '' }}">
                <a href="{{ route('admin.grafik') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-chart-area"></i>
                    <div data-i18n="Account Settings">Grafik</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.pendaftar') ? 'active' : '' }}">
                <a href="{{ route('admin.pendaftar') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                    <div data-i18n="Account Settings">Calon Pendaftar</div>
                </a>
            </li>

            <li class="menu-item {{ request()->routeIs('admin.data_pendaftar') ? 'active' : '' }}">
                <a href="{{ route('admin.data_pendaftar') }}" class="menu-link">
                    <i class="menu-icon tf-icons fa-solid fa-user"></i>
                    <div data-i18n="Account Settings">Data Pendaftar</div>
                </a>
            </li>
        </ul>
    </aside>
    <!-- / Menu -->
@endif




