<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo site_url('admin'); ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Portal Admin CSL</div>
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
        <a class="nav-link" href="<?= site_url('admin') ?>">
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
        <a class="nav-link" href="<?php echo site_url('admin/data-karyawan'); ?>">
            <i class="fas fa-fw fa-users"></i>
            <span>Kelola Data Karyawan</span>
        </a>
    </li>
    <!-- Nav Item - Metrics -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/data-absensi'); ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Data Absensi</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url('admin/data-jabatan'); ?>">
            <i class="fas fa-fw fa-list"></i>
            <span>Kelola Data Jabatan</span>
        </a>
    </li>

    <!-- Nav Item - Data User Management -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url(''); ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Data Admin</span>
        </a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>