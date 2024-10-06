<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="/" class="logo">
                <img src="assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content d-flex flex-column" style="height: 100vh;">
            <!-- Menambahkan flexbox dan tinggi penuh -->
            <ul class="nav nav-secondary flex-grow-1"> <!-- Tambahkan flex-grow-1 -->
                <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
                    <a href="/" aria-expanded="false">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ Route::currentRouteName() == 'data.barang' ? 'active' : '' }}">
                    <a href="{{ route('data.barang') }}">
                        <i class="fas fa-boxes"></i>
                        <p>Data Barang</p>
                    </a>
                </li>
                <li
                    class="nav-item {{ Route::currentRouteName() == 'barang.masuk' || Route::currentRouteName() == 'barang.keluar' ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#kelolaBarang">
                        <i class="fas fa-retweet"></i>
                        <p>Kelola Barang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="kelolaBarang">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('barangMasuk.index') }}">
                                    <span class="sub-item">Barang Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('barangKeluar.index') }}">
                                    <span class="sub-item">Barang Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#laporan">
                        <i class="fas fa-pen-square"></i>
                        <p>Laporan Barang</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="laporan">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('laporanMasuk.index') }}">
                                    <span class="sub-item">laporan Masuk</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('laporanKeluar.index') }}">
                                    <span class="sub-item">laporan Keluar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data.pegawai') }}">
                        <i class="fas fa-users"></i>
                        <p>Data Pegawai</p>
                    </a>
                </li>
            </ul>

            <!-- Log Out -->
            <ul class="nav">
                <li class="nav-item" id="logoutButton">
                    <a href="{{ route('logout') }}">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#logoutButton').on('click', function(event) {
                event.preventDefault(); // Mencegah form default submit

                // Konfirmasi logout
                Swal.fire({
                    title: 'Konfirmasi Logout',
                    text: 'Apakah Anda yakin ingin logout?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Logout',
                    cancelButtonText: 'Tidak'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Jika pengguna mengonfirmasi logout
                        $.ajax({
                            url: "{{ route('logout') }}",
                            type: 'POST',
                            data: {
                                _token: "{{ csrf_token() }}", // Sertakan token CSRF
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Logout Berhasil',
                                    text: response.message ||
                                        'Anda telah berhasil logout.',
                                    icon: 'success',
                                }).then(() => {
                                    window.location.href =
                                        "{{ route('login') }}"; // Redirect ke halaman login
                                });
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: xhr.responseJSON.message ||
                                        'Terjadi kesalahan saat logout.',
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

</div>
