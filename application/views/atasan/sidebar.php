<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('atasan') ?>">
                <div class="sidebar-brand-icon">
                    <img class="rounded-circle mt-3" src="<?= base_url('assets/') ?>img/admin/logoPN.ico" alt="logo" style="height: 70px; width: 70px;">
                </div>
                <div class="sidebar-brand-text mx-3 mt-3">Siculi</div>


            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 mt-4">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan') ?>">
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
                        <a class="collapse-item" href="<?= base_url('atasan/pegawai') ?>"><b>Data Karyawan</b></a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Ketua Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/ketua') ?>">
                    <i class="fas fa-user-tie"></i>
                    <span href="<?= base_url('atasan/ketua') ?>">Ketua</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Data Ijin & Cuti
            </div>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/cuti') ?>">
                    <i class="fas fa-calendar"></i>
                    <span>Data Cuti</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/ijin') ?>">
                    <i class="fas fa-building"></i>
                    <span>Data Ijin</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Progress Ijin & Cuti
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/persetujuan_cuti') ?>">
                    <i class="fas fa-building"></i>
                    <span>Persetujuan Cuti</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/persetujuan_ijin') ?>">
                    <i class="fas fa-building"></i>
                    <span>Persetujuan Ijin</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Pengajuan Ijin & Cuti
            </div>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/pengajuan_cuti') ?>">
                    <i class="fas fa-building"></i>
                    <span>Pengajuan Cuti</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('atasan/ijin_keluar') ?>">
                    <i class="fas fa-building"></i>
                    <span>Pengajuan Ijin</span>
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