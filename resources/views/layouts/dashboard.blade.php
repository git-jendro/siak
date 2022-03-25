<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="SMKN 4">
    <meta name="description" content="Sistem Informasi Akademik SMK Negeri 4">
    @csrf

    <title>{{ config('app.name') }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('logos/logo.ico') }}">


    <!-- Google / Search Engine Tags -->
    <meta itemprop="name" content="SIAKAD SMK Negeri 4">
    <meta itemprop="description" content="Sistem Informasi Akademik SMK Negeri 4">
    <meta itemprop="image" content="{{ asset('logos/logo.png') }}">

    <!-- Facebook Meta Tags -->
    <meta property="og:url" content="URL SIAKAD">
    <meta property="og:type" content="website">
    <meta property="og:title" content="SIAKAD SMK Negeri 4">
    <meta property="og:description" content="Sistem Informasi Akademik SMK Negeri 4">
    <meta property="og:image" content="{{ asset('logos/logo.png') }}">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="SIAKAD SMK Negeri 4">
    <meta name="twitter:description" content="Sistem Informasi Akademik SMK Negeri 4">
    <meta name="twitter:image" content="{{ asset('logos/logo.png') }}">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('sb-admin/css/sb-admin-2.css') }}" rel="stylesheet">

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
                <div class="sidebar-brand-icon">
                    <img class="img-fluid" src="{{ asset('logos/logo-brand.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">SMKN 4</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item" id="dashboard">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item" id="data-master">
                <a class="nav-link collapsed" id="master-dropdown" href="#" data-toggle="collapse" data-target="#dataMaster"
                    aria-expanded="true" aria-controls="dataMaster">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Data Master</span>
                </a>
                <div id="dataMaster" class="collapse" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" id="pelajaran" href="{{ route('pelajaran') }}">Pelajaran</a>
                        <a class="collapse-item" id="ruangan" href="{{ route('ruangan') }}">Ruangan</a>
                        <a class="collapse-item" id="tingkat-kelas" href="{{ route('tingkat-kelas') }}">Tingkat Kelas</a>
                        <a class="collapse-item" id="sub-kelas" href="{{ route('sub-kelas') }}">Sub Kelas</a>
                        <a class="collapse-item" id="jurusan" href="{{ route('jurusan') }}">Jurusan</a>
                        <a class="collapse-item" id="kelas" href="{{ route('kelas') }}">Kelas</a>
                        <a class="collapse-item" id="kurikulum" href="{{ route('kurikulum') }}">Kurikulum</a>
                        <a class="collapse-item" id="tahun-akademik" href="{{ route('tahun-akademik') }}">Tahun Akademik</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item" id="staff">
                <a class="nav-link" href="{{ route('staff') }}">
                    <i class="fas fa-fw fa-user-cog"></i>
                    <span>Staff</span></a>
            </li>
            <li class="nav-item" id="guru">
                <a class="nav-link" href="{{ route('guru') }}">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                    <span>Guru</span></a>
            </li>
            <li class="nav-item" id="peserta-didik">
                <a class="nav-link" href="{{ route('siswa') }}">
                    <i class="fas fa-fw fa-user-graduate"></i>
                    <span>Peserta Didik</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item" id="">
                <a class="nav-link" href="{{ route('walikelas') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Wali Kelas</span></a>
            </li>

            <li class="nav-item" id="">
                <a class="nav-link" href="{{ route('grup') }}">
                    <i class="fas fa-fw fa-layer-group"></i>
                    <span>Grup Kelas</span></a>
            </li>
            
            <li class="nav-item" id="">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#jadwal" aria-expanded="true"
                    aria-controls="jadwal">
                    <i class="fas fa-fw fa-calendar-alt"></i>
                    <span>Jadwal</span>
                </a>
                <div id="jadwal" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('jadwal-pelajaran') }}">Jadwal Pelajaran</a>
                        <a class="collapse-item" href="{{ route('jadwal-uts') }}">Jadwal UTS</a>
                        <a class="collapse-item" href="{{ route('jadwal-uas') }}">Jadwal UAS</a>
                    </div>
                </div>
            </li>

            <li class="nav-item" id="nilai">
                <a class="nav-link" href="{{ route('nilai') }}">
                    <i class="fas fa-fw fa-file-medical-alt"></i>
                    <span>Nilai</span></a>
            </li>

            <li class="nav-item" id="rapot">
                <a class="nav-link" href="{{ route('rapot') }}">
                    <i class="fas fa-fw fa-file-invoice"></i>
                    <span>Rapot</span></a>
            </li>

            <li class="nav-item" id="riwayat">
                <a class="nav-link" href="{{ route('riwayat') }}">
                    <i class="fas fa-fw fa-history"></i>
                    <span>Riwayat Kelas</span></a>
            </li>
            
            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item" id="">
                <a class="nav-link" href="{{ route('staff') }}">
                    <i class="fas fa-fw fa-file-invoice-dollar"></i>
                    <span>Pembayaran</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline mt-5">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="{{ asset('sb-admin/img/undraw_profile_1.svg') }}" alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="{{ asset('sb-admin/img/undraw_profile_2.svg') }}" alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle"
                                            src="{{ asset('sb-admin/img/undraw_profile_3.svg') }}" alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy
                                            with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because
                                            someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More
                                    Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    @if (Auth::user()->staff)
                                        {{ Auth::user()->staff->nama }}
                                    @elseif(Auth::user()->guru)
                                        {{ Auth::user()->guru->nama }}
                                    @elseif(Auth::user()->siswa)
                                        {{ Auth::user()->siswa->nama }}
                                    @elseif(Auth::user()->walimurid)
                                        {{ Auth::user()->walimurid->nama }}
                                    @endif
                                </span>
                                @if (Auth::user()->staff)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/'.Auth::user()->staff->foto) }}">
                                @elseif(Auth::user()->guru)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/'.Auth::user()->guru->foto) }}">
                                @elseif(Auth::user()->siswa)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/'.Auth::user()->siswa->foto) }}">
                                @elseif(Auth::user()->walimurid)
                                    <img class="img-profile rounded-circle"
                                        src="{{ asset('storage/'.Auth::user()->walimurid->foto) }}">
                                @endif
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>

                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        @yield('header')
                    </div>

                    @yield('contain')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; SMKN 4 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin ingin keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Klik tombol "Logout" jika ingin keluar.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>
    <script src="{{ asset('sb-admin/js/custome.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    @yield('plugins')

</body>

</html>
