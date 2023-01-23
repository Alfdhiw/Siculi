<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img class="rounded-circle mt-3" src="<?= base_url('assets/') ?>img/admin/logoPN.ico" alt="logo" style="height: 70px; width: 70px;">
                </div>
                <div class="sidebar-brand-text mx-3 mt-3">Siculi</div>


            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 mt-4">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kepegawaian') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data
            </div>

            <!-- Nav Item - Karyawan Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#karyawan" aria-expanded="true" aria-controls="karyawan">
                    <i class="fas fa-user-friends"></i>
                    <span>Karyawan</span>
                </a>
                <div id="karyawan" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="<?= base_url('kepegawaian/pegawai') ?>"><b>Data Karyawan</b></a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Ketua Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kepegawaian/ketua') ?>">
                    <i class="fas fa-user-tie"></i>
                    <span href="<?= base_url('kepegawaian/ketua') ?>">Ketua</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Cuti
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kepegawaian/cuti') ?>">
                    <i class="fas fa-calendar"></i>
                    <span>Data Cuti</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Progress Cuti
            </div>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('kepegawaian/persetujuan_cuti') ?>">
                    <i class="fas fa-check"></i>
                    <span>Persetujuan Cuti</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->