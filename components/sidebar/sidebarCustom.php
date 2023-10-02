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
                <li class="nav-item">
                    <a href="javascript:void()" onclick="loadContent('on_progress')" class="nav-link" id="on_progress">
                        <i class="nav-icon fas fa-calendar-check"></i>
                        <p>
                            Progress Data
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="javascript:void()" onclick="loadContent('keuangan_invoice')" class="nav-link" id="keuangan_invoice">
                        <i class="fas fa-book nav-icon"></i>
                        <p>Invoice</p>
                    </a>
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