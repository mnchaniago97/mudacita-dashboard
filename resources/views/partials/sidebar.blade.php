 <nav class="nxl-navigation">        
    <div class="navbar-wrapper">
            <div class="m-header">
                <a href="/dashboard" class="b-brand">
                    @php
                        $logoPath = optional($appSettings)->org_logo_path;
                        $orgName = optional($appSettings)->org_name ?? 'Mudacita';
                        $logoUrl = $logoPath
                            ? (str_starts_with($logoPath, 'assets/') ? asset($logoPath) : asset('storage/' . $logoPath))
                            : asset('assets/images/logomci2.png');
                    @endphp
                    <img
                        src="{{ $logoUrl }}"
                        alt="{{ $orgName }}"
                        class="img-fluid logo-lg"
                    />
                    <img
                        src="{{ $logoUrl }}"
                        alt="{{ $orgName }}"
                        class="img-fluid logo-sm"
                    />
                </a>
            </div>
            <div class="navbar-content">
                <ul class="nxl-navbar">
                        <li class="nxl-item nxl-caption">
                            <label>MAIN MENU</label>
                        </li>

                        <li class="nxl-item">
                            <a href="/dashboard" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-home"></i></span>
                                <span class="nxl-mtext">Dashboard</span>
                            </a>
                        </li>

                        <li class="nxl-item nxl-hasmenu">
                            <a href="javascript:void(0);" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-grid"></i></span>
                                <span class="nxl-mtext">Pilar Programs</span>
                                <span class="nxl-arrow"><i class="feather-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                               <li class="nxl-item">
                                    <a href="{{ route('pilar.index', 'pendidikan') }}" class="nxl-link">
                                        <span class="nxl-micon"><i class="feather-book-open"></i></span>
                                        <span class="nxl-mtext">Pendidikan</span>
                                    </a>
                                <li class="nxl-item">
                                    <a href="{{ route('pilar.index', 'sosial') }}" class="nxl-link">
                                        <span class="nxl-micon"><i class="feather-heart"></i></span>
                                        <span class="nxl-mtext">Sosial</span>
                                    </a>
                                </li>
                                <li class="nxl-item">
                                    <a href="{{ route('pilar.index', 'lingkungan') }}" class="nxl-link">
                                        <span class="nxl-micon"><i class="feather-sun"></i></span>
                                        <span class="nxl-mtext">Lingkungan</span>
                                    </a>
                                </li>
                                </li>
                            </ul>
                        </li>

                        <li class="nxl-item">
                            <a href="/activity" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-activity"></i></span>
                                <span class="nxl-mtext">Aktivitas</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/collaborations" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-share-2"></i></span>
                                <span class="nxl-mtext">Kolaborasi</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/sdm/management" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-user-check"></i></span>
                                <span class="nxl-mtext">Pengurus</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/sdm/volunteers" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-users"></i></span>
                                <span class="nxl-mtext">Volunteer</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/sdm/recruitment" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-user-plus"></i></span>
                                <span class="nxl-mtext">Rekrutmen Pengurus</span>
                            </a>
                        </li>
                        <li class="nxl-item">
                            <a href="/sdm/volunteer-recruitment" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-user-plus"></i></span>
                                <span class="nxl-mtext">Rekrutmen Volunteer</span>
                            </a>
                        </li>


                        <li class="nxl-item">
                            <a href="/impacts" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-trending-up"></i></span>
                                <span class="nxl-mtext">Dampak</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/agenda" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-calendar"></i></span>
                                <span class="nxl-mtext">Agenda</span>
                            </a>
                        </li>
                        <li class="nxl-item">
                            <a href="{{ route('wilayah.locations.index') }}" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-map-pin"></i></span>
                                <span class="nxl-mtext">Wilayah</span>
                            </a>
                        </li>

                        <li class="nxl-item nxl-caption">
                            <label>SYSTEM</label>
                        </li>

                        <li class="nxl-item">
                            <a href="/reports" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-bar-chart-2"></i></span>
                                <span class="nxl-mtext">Laporan</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/users" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-user"></i></span>
                                <span class="nxl-mtext">User</span>
                            </a>
                        </li>

                        <li class="nxl-item">
                            <a href="/settings" class="nxl-link">
                                <span class="nxl-micon"><i class="feather-settings"></i></span>
                                <span class="nxl-mtext">Settings</span>
                            </a>
                        </li>
                    </ul>

                
            </div>
        </div>
    </nav>

    <header class="nxl-header">
        <div class="header-wrapper flex-wrap">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-3 flex-wrap">
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                    
                </div>
                
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <a href="{{ route('home') }}" class="btn btn-sm btn-light d-flex align-items-center gap-2">
                    <i class="feather-home"></i>
                    <span>Home</span>
                </a>
                
                
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                   
                    
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0" onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button" style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="me-3">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-danger">
                            Logout
                        </button>
                    </form>
                    
            
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>
