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
                <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-money-bill-transfer"></i></div>
                            <div class="col-10">
                                <p>Trans</p>
                                <i class="fas fa-angle-left right ml-auto justify-content-end"></i>
                            </div>
                        </div>
                    </a>

                    <ul class="nav nav-treeview" style="padding-left: 5%">
                        <li class="nav-item">
                            <a href="/admin/complain/" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-bandage"></i></div>
                                    <div class="col-10">
                                        <p>
                                            Komplain
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/consul/" class="nav-link">
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
                            <a href="/admin/receiptProof" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-receipt"></i></div>
                                    <div class="col-10">
                                        <p>
                                            Pemabayaran Resep
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/delivery" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-truck-ramp-box"></i></div>
                                    <div class="col-10">
                                        <p>
                                            Pengiriman Obat
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-database"></i></div>
                            <div class="col-10">
                                <p>
                                    Master
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </div>
                        </div>
                    </a>
                    <ul class="nav nav-treeview" style="padding-left: 5%">
                        <li class="nav-item">
                            <a href="/admin/pasien/" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-bed-pulse"></i></div>
                                    <div class="col-10">
                                        <p>Pasien</p>
                                    </div>
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
                            <a href="/admin/doctor/" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-user-doctor"></i></div>
                                    <div class="col-10">
                                        <p>
                                            Dokter
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/poly/" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-regular fa-hospital"></i></i></div>
                                    <div class="col-10">
                                        <p>
                                            Poliklinik
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/category/" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-tags"></i></div>
                                    <div class="col-10">
                                        <p>
                                            Kategori
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/medicine/" class="nav-link">
                                <div class="row">
                                    <div class="col-2"><i class="fa-solid fa-pills"></i></div>
                                    <div class="col-10">
                                        <p>
                                            Obat
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>

                </li>

                {{-- <li class="nav-item">
                    <a href="/admin/medrec/view" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-file-medical"></i></div>
                            <div class="col-10">
                                <p>
                                    Rekamedik
                                </p>
                            </div>
                        </div>
                    </a>
                </li> --}}


                <li class="nav-item">
                    <a href="/admin/schedule/" class="nav-link">
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
                    <a href="/admin/setting" class="nav-link">
                        <div class="row">
                            <div class="col-2"><i class="fa-solid fa-gear"></i></div>
                            <div class="col-10">
                                <p>
                                    Pengaturan
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
