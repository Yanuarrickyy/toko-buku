<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu"
        aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">
                TOKO Buku 2024
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu"
                aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2 active" aria-current="page"
                        href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door"></i>
                        Dashboard
                    </a>
                </li>
            </ul>

            <h6
                class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-body-secondary text-uppercase">
                <span>Data Master</span>
                <a class="link-secondary" href="#" aria-label="Add a new report">
                    <i class="bi bi-plus-circle"></i>
                </a>
            </h6>

            <ul class="nav flex-column mb-auto">
                @if (Auth::check() && (Auth::user()->role === 'super_admin' || Auth::user()->role === 'admin'))
                    <!-- Cek apakah pengguna adalah 'admin' atau 'super admin' -->
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2"
                            href="{{ route('master.data.kategori.index') }}">
                            <i class="bi bi-file-earmark-text"></i>
                            Kategori
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2"
                            href="{{ route('master.data.buku.index') }}">
                            <i class="bi bi-book"></i>
                            Buku
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2"
                            href="{{ route('master.data.user.index') }}">
                            <i class="bi bi-person-circle"></i>
                            User
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2"
                        href="{{ route('master.data.penjualan.index') }}">
                        <i class="bi bi-cart-fill"></i>
                        Transaksi
                    </a>
                </li>
            </ul>

            <hr class="my-3" />

            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link d-flex align-items-center gap-2" href="{{ route('profil.index') }}">
                        <i class="bi bi-gear-wide-connected"></i>
                        Settings
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit"
                            class="nav-link d-flex align-items-center gap-2 btn-link text-decoration-none">
                            <i class="bi bi-door-closed"></i>
                            Sign out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
