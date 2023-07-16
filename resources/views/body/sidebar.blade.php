<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index.html">
            <span class="align-middle">AdminKit</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Pages
            </li>

            <li class="sidebar-item {{ \Route::is('home') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ url('/home') }}">
                    <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Beranda</span>
                </a>
            </li>

            <li class="sidebar-item {{ \Route::is('masjid.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('masjid.create') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Masjid</span>
                </a>
            </li>

            <li class="sidebar-item {{ \Route::is('kas.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kas.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kas Masjid</span>
                </a>
            </li>

            <li class="sidebar-item {{ \Route::is('profil.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('profil.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Profil Masjid</span>
                </a>
            </li>

            <li class="sidebar-item {{ \Route::is('kategori.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kategori.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Kategori
                        Informasi</span>
                </a>
            </li>

            <li class="sidebar-item {{ \Route::is('informasi.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('informasi.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Informasi Masjid</span>
                </a>
            </li>

            <li class="sidebar-item {{ \Route::is('masjidbank.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('masjidbank.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Bank</span>
                </a>
            </li>

            <li
                class="sidebar-item {{ \Route::is('kurban.*') || \Route::is('kurbanhewan.*') || \Route::is('kurbanpeserta.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('kurban.index') }}">
                    <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data Kurban</span>
                </a>
            </li>


        </ul>

        <div class="sidebar-cta">
            <div class="sidebar-cta-content">
                <strong class="d-inline-block mb-2">Upgrade to Pro</strong>
                <div class="mb-3 text-sm">
                    Are you looking for more components? Check out our premium version.
                </div>
                <div class="d-grid">
                    <a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
                </div>
            </div>
        </div>
    </div>
</nav>
