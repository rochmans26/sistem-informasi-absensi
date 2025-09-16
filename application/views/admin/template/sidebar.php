<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center"
        href="<?php echo site_url('admin/dashboard'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-weight"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Prediksi Obesitas</div>
    </a>
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Obscu App</div>
    </a> -->

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?= site_url('admin/dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Fitur
    </div>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/predict'); ?>">
            <i class="fas fa-fw fa-calculator"></i>
            <span>Prediksi</span>
        </a>
    </li>
    <!-- Nav Item - Metrics -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/metrics'); ?>">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Metrik Model</span>
        </a>
    </li>

    <!-- Nav Item - Data Management -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/manage_dataset'); ?>">
            <i class="fas fa-fw fa-database"></i>
            <span>Manajemen Data</span>
        </a>
    </li>
    <!-- Nav Item - Data User Management -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/manage_users'); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Pengguna</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/riwayat-checkup'); ?>">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Riwayat CheckUp</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>