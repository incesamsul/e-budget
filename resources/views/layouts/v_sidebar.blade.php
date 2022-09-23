<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="{{ asset('AdminLTE-3.2.0/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">e-budget</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img style="width: 40px; height:40px;"
          src="{{ auth()->user()->foto == "" ? asset('img/default.jpg') : asset('data/foto_profile/'.auth()->user()->foto . '/'. auth()->user()->foto) }}"
          class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ auth()->user()->name }}</a>
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
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->


        <li class="nav-header">PENGGUNA</li>
        <li class="nav-item">
          <a id="liDashboard" href="{{ URL::to('/dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <li class="nav-item">
          <a id="liProfile" href="{{ URL::to('/profile') }}" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Profile</p>
          </a>
        </li>
        <li class="nav-item">
          <a id="liBantuan" href="{{ URL::to('/bantuan') }}" class="nav-link">
            <i class="nav-icon fas fa-question-circle"></i>
            <p>Bantuan</p>
          </a>
        </li>


               @if (auth()->user()->role == 'Administrator')
               {{-- MENU ADMIN --}}
               <li class="nav-header">ADMIN</li>
              <li class="nav-item">
                <a id="liPengguna" href="{{ URL::to('/admin/pengguna') }}" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Pengguna</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liJenisAnggaran" href="{{ URL::to('/admin/jenis_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Anggaran masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liAnggaranTerpakai" href="{{ URL::to('/admin/anggaran_terpakai') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Anggaran terpakai</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liTahunAkademik" href="{{ URL::to('/admin/tahun_akademik') }}" class="nav-link">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>Tahun akademik</p>
                </a>
              </li>

              <li class="nav-item">
                <a id="liSisaAnggaran" href="{{ URL::to('/sisa_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Sisa anggaran</p>
                </a>
              </li>


               {{-- END OF MENU ADMIN --}}
               @endif

               @if (auth()->user()->role == 'pengaju')
               {{-- MENU PENGAJU --}}
               <li class="nav-header">PENGAJU</li>
               <li class="nav-item">
                <a id="liPengajuan" href="{{ URL::to('/pengaju/pengajuan') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Pengajuan</p>
                </a>
              </li>

               {{-- END OF MENU PENGAJU --}}
               @endif

               @if (auth()->user()->role == 'bendahara')
               {{-- MENU BENDAHARA --}}
               <li class="nav-header">Bendahara</li>
               <li class="nav-item">
                <a id="liPengajuan" href="{{ URL::to('/bendahara/pengajuan') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Pengajuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liJenisAnggaran" href="{{ URL::to('/admin/jenis_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Anggaran masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liAnggaranTerpakai" href="{{ URL::to('/admin/anggaran_terpakai') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Anggaran terpakai</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liTahunAkademik" href="{{ URL::to('/admin/tahun_akademik') }}" class="nav-link">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>Tahun akademik</p>
                </a>
              </li>

              <li class="nav-item">
                <a id="liSisaAnggaran" href="{{ URL::to('/sisa_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Sisa anggaran</p>
                </a>
              </li>
               {{-- END OF MENU BENDAHARA --}}
               @endif

               @if (auth()->user()->role == 'ketua')
               {{-- MENU BENDAHARA --}}
               <li class="nav-header">Ketua</li>
               <li class="nav-item">
                <a id="liPengajuan" href="{{ URL::to('/ketua/pengajuan') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Pengajuan</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liJenisAnggaran" href="{{ URL::to('/admin/jenis_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Anggaran masuk</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liAnggaranTerpakai" href="{{ URL::to('/admin/anggaran_terpakai') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Anggaran terpakai</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liTahunAkademik" href="{{ URL::to('/admin/tahun_akademik') }}" class="nav-link">
                  <i class="nav-icon fas fa-calendar"></i>
                  <p>Tahun akademik</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liSisaAnggaran" href="{{ URL::to('/sisa_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Sisa anggaran</p>
                </a>
              </li>

               {{-- END OF MENU BENDAHARA --}}
               @endif
               @if (auth()->user()->role == 'yayasan')
               {{-- MENU BENDAHARA --}}
               <li class="nav-header">Yayasan</li>
               <li class="nav-item">
                <a id="liLogAktivitas" href="{{ URL::to('/yayasan/log_aktivitas') }}" class="nav-link">
                  <i class="nav-icon fas fa-sync"></i>
                  <p>Log Activitas</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="liJenisAnggaran" href="{{ URL::to('/admin/jenis_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-money-check"></i>
                  <p>Laporan Anggaran masuk</p>
                </a>
              </li>
               <li class="nav-item">
                <a id="liLaporanAnggaranTerpakai" href="{{ URL::to('/yayasan/laporan') }}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Laporan Anggaran terpakai</p>
                </a>
              </li>

              <li class="nav-item">
                <a id="liSisaAnggaran" href="{{ URL::to('/sisa_anggaran') }}" class="nav-link">
                  <i class="nav-icon fas fa-list"></i>
                  <p>Sisa anggaran</p>
                </a>
              </li>
               {{-- END OF MENU BENDAHARA --}}
               @endif



        <li class="nav-header">OTHER</li>
        <li class="nav-item">
          <a id="liPengguna" href="{{ URL::to('/logout') }}" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
