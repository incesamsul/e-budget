<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">based</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
        </div>
        <ul class="sidebar-menu">

            {{-- MENU PENGGUNA --}}
            {{-- SEMUA PENGGUNA / USER MEMPUNYAI MENU INI --}}
            <li class="menu-header">Pengguna</li>
            <li class="" id="liDashboard"><a class="nav-link" href="{{ URL::to('/dashboard') }}"><i
                        class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
            <li class="" id="liProfile"><a class="nav-link" href="{{ URL::to('/profile') }}"><i class="fas fa-user"></i>
                    <span>Profile</span></a></li>
            <li class="" id="liBantuan"><a class="nav-link" href="{{ URL::to('/bantuan') }}"><i
                        class="fas fa-question-circle"></i> <span>Bantuan</span></a></li>



            @if (auth()->user()->role == 'Administrator')
            {{-- MENU ADMIN --}}
            <li class="menu-header">Admin</li>
            <li class="nav-item dropdown " id="liPengguna">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i>
                    <span>Pengguna</span></a>
                <ul class="dropdown-menu">
                    <li id="liManajemenPengguna"><a class="nav-link" href="/admin/pengguna">Manajemen Pengguna</a></li>
                </ul>
            </li>
            <li class="" id="liJenisAnggaran"><a class="nav-link" href="{{ URL::to('/admin/jenis_anggaran') }}"><i
                class="fas fa-money-check"></i> <span>Jenis anggaran</span></a></li>

            {{-- END OF MENU ADMIN --}}
            @endif

            @if (auth()->user()->role == 'pengaju')
            {{-- MENU PENGAJU --}}
            <li class="menu-header">Pengaju</li>
            <li class="" id="liPengajuan"><a class="nav-link" href="{{ URL::to('/pengaju/pengajuan') }}"><i
                class="fas fa-money-check"></i> <span>Pengajuan</span></a></li>

            {{-- END OF MENU PENGAJU --}}
            @endif

            @if (auth()->user()->role == 'bendahara')
            {{-- MENU BENDAHARA --}}
            <li class="menu-header">Bendahara</li>
            <li class="" id="liPengajuan"><a class="nav-link" href="{{ URL::to('/bendahara/pengajuan') }}"><i
                class="fas fa-money-check"></i> <span>Pengajuan</span></a></li>

            {{-- END OF MENU BENDAHARA --}}
            @endif

            @if (auth()->user()->role == 'ketua')
            {{-- MENU BENDAHARA --}}
            <li class="menu-header">Ketua</li>
            <li class="" id="liPengajuan"><a class="nav-link" href="{{ URL::to('/ketua/pengajuan') }}"><i
                class="fas fa-money-check"></i> <span>Pengajuan</span></a></li>

            {{-- END OF MENU BENDAHARA --}}
            @endif







        </ul>

        <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="{{ URL::to('/logout') }}" class="btn bg-main text-white btn-lg btn-block btn-icon-split">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </aside>
</div>
