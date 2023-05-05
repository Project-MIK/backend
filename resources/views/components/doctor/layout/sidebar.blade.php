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
                    <a href="/doctor/consul" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-stethoscope"></i></div>
                            <div class="col-10">
                                <p>
                                    Konsultasi
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/doctor/schedule/" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-calendar-days"></i></div>
                            <div class="col-10">
                                <p>
                                    Jadwal
                                </p>
                            </div>
                        </div>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/doctor/setting" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-gear"></i></div>
                            <div class="col-10">
                                <p>
                                    Setting
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
