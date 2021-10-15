<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
        {{-- <a href="index.html">Point of Sales</a> --}}
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('assets/assets/img/mosart.png') }}"  width="150" alt="">
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img src="{{ asset('assets/assets/img/mosart-small.png') }}"  width="50" alt="">
            </a>
        </div>
        <ul class="sidebar-menu">
            
            <li class=" mt-4 {{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fas fa-fire"></i> <span>Dashboard</span>
                </a>
            </li>
            
            <li class="{{ Request::is('taxpayer*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('taxpayer.index') }}">
                    <i class="fas fa-users"></i> <span>Wajib Pajak</span>
                </a>
            </li>

            <li class="{{ Request::is('letter*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('letter.index') }}">
                    <i class="fas fa-inbox"></i> <span>Daftar SP2DK</span>
                </a>
            </li>

            @can('index', \App\Models\Position::class)
                <li class="{{ Request::is('position*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('position.index') }}">
                        <i class="fas fa-user-plus"></i> <span>Jabatan</span>
                    </a>
                </li>
            @endcan

            @can('index', \App\Models\Section::class)
                <li class="{{ Request::is('section*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('section.index') }}">
                        <i class="fas fa-align-left"></i> <span>Seksi</span>
                    </a>
                </li>
            @endcan

            @can('index', \App\Models\User::class)
                <li class="{{ Request::is('user*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('user.index') }}">
                        <i class="fas fa-user-friends"></i> <span>Users</span>
                    </a>
                </li>
            @endcan 
            <li class="{{ Request::is('template*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('template.index') }}">
                    <i class="fas fa-clone"></i> <span>Template Import</span>
                </a>
            </li>
    </aside>
</div>