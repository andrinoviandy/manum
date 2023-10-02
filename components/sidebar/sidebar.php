<aside class="main-sidebar sidebar-dark-success elevation-4" style="background: url('dist/img/sidebar.jpg'); background-repeat: no-repeat; background-position: center; background-size: cover">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center" style="background: rgba(0, 0, 0, 0.7);">
        <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
        <span class="brand-text" style="font-weight: bold;">
            <img src="dist/img/navigasi.png" class="col-12 m-0 pl-5 pr-5">
        </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style="background: rgba(0, 0, 0, 0.7);">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex" style="justify-content: center;">
            <div class="image">
                <img src="dist/img/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <div class="d-block text-bold text-white"><?php echo ucwords($_SESSION['nama']); ?></div>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="javascript:void()" onclick="loadContent('beranda')" class="nav-link" id="beranda">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['role_id'] == 1) { ?>
                    <li class="nav-item">
                        <a href="javascript:void()" onclick="loadContent('paket_umrah')" class="nav-link" id="paket_umrah">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Paket Umrah/Haji
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item">
                    <a href="javascript:void()" onclick="loadContent('pendaftaran_jamaah')" class="nav-link" id="pendaftaran_jamaah">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Pendaftaran Jamaah
                            <!-- <span class="right badge badge-danger">10</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()" onclick="loadContent('data_jamaah')" class="nav-link" id="data_jamaah">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Data Jamaah
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()" onclick="loadContent('on_progress')" class="nav-link" id="on_progress">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Progress Data
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <?php if ($_SESSION['role_id'] == 1) { ?>
                    <li class="nav-item">
                        <a href="javascript:void()" onclick="loadContent('master_cabang')" class="nav-link" id="master_cabang">
                            <i class="nav-icon fas fa-database"></i>
                            <p>
                                Master Cabang
                                <!-- <span class="right badge badge-danger">New</span> -->
                            </p>
                        </a>
                    </li>
                <?php } ?>
                <li class="nav-item" id="keuangan">
                    <a href="#" class="nav-link" id="keuangan2">
                        <i class="nav-icon fas fa-balance-scale"></i>
                        <p>
                            Keuangan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <?php //if ($_SESSION['role_id'] == 1) { ?> -->
                        <li class="nav-item">
                            <a href="javascript:void()" onclick="loadContent('keuangan_ringkasan')" class="nav-link" id="keuangan_ringkasan">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Ringkasan Laba Rugi</p>
                            </a>
                        </li>
                        <!-- <?php //} ?> -->
                        <li class="nav-item">
                            <a href="javascript:void()" onclick="loadContent('keuangan_kas')" class="nav-link" id="keuangan_kas">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Kas / Bank</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role_id'] == 1) { ?>
                            <li class="nav-item">
                                <a href="javascript:void()" onclick="loadContent('keuangan_invoice')" class="nav-link" id="keuangan_invoice">
                                    <i class="far fa-circle nav-icon ml-2"></i>
                                    <p>Invoice</p>
                                </a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a href="javascript:void()" onclick="loadContent('keuangan_reimburse')" class="nav-link" id="keuangan_reimburse">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Reimburse</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void()" onclick="loadContent('keuangan_penerimaan')" class="nav-link" id="keuangan_penerimaan">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Penerimaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:void()" onclick="loadContent('keuangan_pengeluaran')" class="nav-link" id="keuangan_pengeluaran">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Pengeluaran</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role_id'] == 1) { ?>
                            <li class="nav-item">
                                <a href="javascript:void()" onclick="loadContent('keuangan_kategori')" class="nav-link" id="keuangan_kategori">
                                    <i class="far fa-circle nav-icon ml-2"></i>
                                    <p>Master Kategori</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item" id="pengaturan">
                    <a href="#" class="nav-link" id="pengaturan2">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Pengaturan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="javascript:void()" onclick="loadContent('pengaturan_users')" class="nav-link" id="pengaturan_users">
                                <i class="far fa-circle nav-icon ml-2"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <?php if ($_SESSION['role_id'] == 1) { ?>
                            <li class="nav-item">
                                <a href="javascript:void()" onclick="loadContent('pengaturan_provinsi')" class="nav-link" id="pengaturan_provinsi">
                                    <i class="far fa-circle nav-icon ml-2"></i>
                                    <p>Provinsi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void()" onclick="loadContent('pengaturan_kabupaten')" class="nav-link" id="pengaturan_kabupaten">
                                    <i class="far fa-circle nav-icon ml-2"></i>
                                    <p>Kabupaten</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="javascript:void()" onclick="loadContent('pengaturan_marketing')" class="nav-link" id="pengaturan_marketing">
                                    <i class="far fa-circle nav-icon ml-2"></i>
                                    <p>Marketing</p>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()" onclick="exit()" class="nav-link">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>