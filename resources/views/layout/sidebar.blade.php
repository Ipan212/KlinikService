<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('AdminLTE-3/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Al-Basmallah</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('AdminLTE-3/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name }}</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
       
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{url('/')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              @if (Auth::user()-> role == 'pendaftaran')
              <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-solid fa-id-card"></i>
                  <p>
                    Daftar Pasien
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">2</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('pasien.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Pasien Baru</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('pendaftaran.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Pemeriksaan</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{ route('pemanggilan.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-solid fa-microphone"></i>
                  <p>
                    Pemanggilan
                  </p>
                </a>
            </li>
              @endif
              @if (Auth::user()-> role == 'rekme')
              <li class="nav-header">Rekam Medis</li>
              <li class="nav-item">
                <a href="{{ route('fisik.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-solid fa-notes-medical"></i>
                  <p>
                    Pemerikaan Fisik
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('rekam_medis.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-solid fa-stethoscope"></i>
                  <p>
                    Pemeriksaan Medis
                  </p>
                </a>
              </li>
              @endif
            @if (Auth::user()-> role == 'transaksi')
          <li class="nav-item">
            <a href="{{ route('transaksi.index')}}" class="nav-link">
              <i class="nav-icon fas fa-solid fa-money-bill"></i>
              <p>
                Transaksi
              </p>
            </a>
        </li>
        @endif
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-solid fa-table"></i>
            <p>
              Kelola Data
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">9</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('pasien.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Rekam Medis Pasien</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('obat.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Obat</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('pemeriksaan.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Jenis Pemeriksaan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pegawai</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Dokter</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{ route('klinik.index')}}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Klinik</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Pemeriksaan Medis</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Rekam Medis</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Data Transaksi</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
            <a href="pages/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-regular fa-file"></i>
              <p>
                Pelaporan
              </p>
            </a>
        </li>
        <li class="nav-header">System</li>
        <li class="nav-item">
            <a href="iframe.html" class="nav-link">
              <i class="nav-icon fas fa-solid fa-user"></i>
              <p>User</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
                <i class="nav-icon fas fa-solid fa-arrow-right"></i>
              <p>Login</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/logout" class="nav-link">
              <i class="nav-icon fas fa-solid fa-outdent"></i>
              <p>Logout</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="iframe.html" class="nav-link">
              <i class="nav-icon fas fa-solid fa-wrench"></i>
              <p>Setting</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>