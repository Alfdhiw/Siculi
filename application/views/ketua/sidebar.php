<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('ketua') ?>">
                <div class="sidebar-brand-icon">
                    <img class="rounded-circle mt-3" src="<?= base_url('assets/') ?>img/admin/logoPN.ico" alt="logo" style="height: 70px; width: 70px;">
                </div>
                <div class="sidebar-brand-text mx-3 mt-3">Siculi</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0 mt-4">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ketua') ?>">
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
                <a class="nav-link collapsed" href="<?= base_url('ketua/pegawai') ?>">
                    <i class="fas fa-user-friends"></i>
                    <span>Karyawan</span>
                </a>
            </li>

            <!-- Nav Item - Ketua Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ketua/kepegawaian') ?>">
                    <i class="fas fa-user-tie"></i>
                    <span>Kepegawaian</span>
                </a>
            </li>

            <!-- Nav Item - Ketua Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ketua/atasan') ?>">
                    <i class="fas fa-user-tie"></i>
                    <span>Atasan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Divisi
            </div>

            <!-- Nav Item - Departement Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('ketua/departement') ?>">
                    <i class="fas fa-solid fa-building-user"></i>
                    <span>Golongan</span>
                </a>
            </li>

            <!-- Nav Item - Ketua Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('ketua/jabatan') ?>">
                    <i class="fas fa-briefcase"></i>
                    <span>Jabatan</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Progress Cuti & Ijin
            </div>

            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ketua/cuti') ?>">
                    <i class="fas fa-calendar"></i>
                    <span>Data Cuti</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ketua/ijin') ?>">
                    <i class="fas fa-building"></i>
                    <span>Data Ijin</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('ketua/persetujuan_cuti') ?>">
                    <i class="fas fa-check"></i>
                    <span>Persetujuan Cuti</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->