<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('assets/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text">Presensi</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/adminlte/dist/img/man-1.png') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <!-- just only admin can access -->
                @can('manage everything')
                <li class="nav-item {{ request()->routeIs('admin.grade.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.grade.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-layer-group"></i>
                        <p>
                            Master Kelas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.grade.index') }}"
                                class="nav-link {{ request()->routeIs('admin.grade.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.grade.create') }}"
                                class="nav-link {{ request()->routeIs('admin.grade.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Kelas Baru</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.student.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.student.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Master Siswa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.student.index') }}"
                                class="nav-link {{ request()->routeIs('admin.student.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.student.create') }}"
                                class="nav-link {{ request()->routeIs('admin.student.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Siswa Baru</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.parent.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ request()->routeIs('admin.parent.*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-tag"></i>
                        <p>
                            Master Wali Siswa
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.parent.index') }}"
                                class="nav-link {{ request()->routeIs('admin.parent.index') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Wali Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.student.create') }}"
                                class="nav-link {{ request()->routeIs('admin.student.create') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Wali Siswa Baru</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.attendance.student.index') }}"
                        class="nav-link {{ request()->routeIs('admin.attendance.student.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-clock"></i>
                        <p>
                            Absensi Siswa
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('main') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" class="nav-icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                        <p>
                            Scan QR Card
                        </p>
                    </a>
                </li>
                @endcan

                <!-- parents can access -->
                @can('show attendance')
                <li class="nav-item">
                    <a href="{{ route('parent.attendance.index') }}"
                        class="nav-link {{ request()->routeIs('parent.attendance.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-clipboard-list"></i>
                        <p>
                            Lihat Kehadiran
                        </p>
                    </a>
                </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>