<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
        <img src="{{asset('images/logo-rshusada.png')}}" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
        <span class="brand-text font-weight-light">RS Citra Husada</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-gauge-high"></i></div>
                            <div class="col-10">
                                <p>
                                    Dashboard
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/pasien/" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-bed-pulse"></i></div>
                            <div class="col-10"><p>Pasien</p></div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/admin" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-user-tie"></i></div>
                            <div class="col-10">
                                <p>
                                    Admin
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/petugas/view" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-id-card"></i></div>
                            <div class="col-10">
                                <p>
                                    Petugas
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/doctor/view" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-user-doctor"></i></div>
                            <div class="col-10">
                                <p>
                                    Doctor
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/medrec/view" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-file-medical"></i></div>
                            <div class="col-10">
                                <p>
                                    Medical Record
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/admin/medicine/view" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-pills"></i></div>
                            <div class="col-10">
                                <p>
                                    Medicine
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
