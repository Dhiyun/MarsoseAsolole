<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <!-- Begin::Wrapper -->
    <div id="kt_app_sidebar_wrapper" class="app-sidebar-wrapper hover-scroll-y my-5 my-lg-2" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_header" data-kt-scroll-wrappers="#kt_app_sidebar_wrapper" data-kt-scroll-offset="5px">
        <!-- Begin::Sidebar menu -->
        <div id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false" class="app-sidebar-menu-primary menu menu-column menu-rounded menu-sub-indention menu-state-bullet-primary px-6 mb-5">
            <div class="d-flex justify-content-between mb-3 pr-3 px-sm-2 mb-10 mt-10">
                <div class="btn btn-icon btn-active-color-primary w-35px h-35px ms-3 mt-2 me-2 d-flex d-lg-none" id="kt_app_sidebar_mobile_toggle">
                    <i class="bi bi-arrow-left fs-1"></i>
                </div>
                <!-- Logo -->
                <a href="/" class="app-sidebar-logo">
                    <img alt="Logo" src="assets/img/Marsose Fix (Light).svg" width="176" height="34" fill="none" />
                </a>
                <!-- End::Logo -->
            </div>
            <!-- Begin: Menu item -->
            <div class="menu-item menu-accordion">
                <!-- Begin: Menu link -->
                <a class="menu-link {{ $activeMenu == 'dashboard' ? 'active' : '' }}" href="{{ route('super-admin.index') }}">
                    {{-- <span class="menu-icon">
                        @if ($activeMenu == 'dashboard')
                            <img alt="Logo" src="assets/media/logos/menu-active/logo-dashboard.svg" class="h-25px theme-light-show" />
                        @else
                            <img alt="Logo" src="assets/media/logos/menu/logo-dashboard.svg" class="h-25px theme-light-show" />
                        @endif
                    </span> --}}
                    <span class="menu-title">Dashboard</span>
                </a>
                <!-- End: Menu link -->
            </div>
            <!-- End: Menu item -->

            <!-- Begin: Menu item -->
            <div class="menu-item menu-accordion">
                <!-- Begin: Menu link -->
                <a class="menu-link {{ $activeMenu == 'datakk' ? 'active' : '' }}" href="{{ route('kk.index') }}">
                    {{-- <span class="menu-icon">
                        @if ($activeMenu == 'datakk')
                            <img alt="Logo" src="assets/media/logos/menu-active/logo-warga.svg" class="h-25px theme-light-show" />
                        @else
                            <img alt="Logo" src="assets/media/logos/menu/logo-warga.svg" class="h-25px theme-light-show" />
                        @endif
                    </span> --}}
                    <span class="menu-title">Data KK</span>
                </a>
                <!-- End: Menu link -->
            </div>
            <!-- End: Menu item -->

            <!-- Begin: Menu item -->
            <div class="menu-item menu-accordion">
                <!-- Begin: Menu link -->
                <a class="menu-link {{ $activeMenu == 'warga' ? 'active' : '' }}" href="{{ route('warga.index') }}">
                    {{-- <span class="menu-icon">
                        @if ($activeMenu == 'warga')
                            <img alt="Logo" src="assets/media/logos/menu-active/logo-warga.svg" class="h-25px theme-light-show" />
                        @else
                            <img alt="Logo" src="assets/media/logos/menu/logo-warga.svg" class="h-25px theme-light-show" />
                        @endif
                    </span> --}}
                    <span class="menu-title">Data Penduduk</span>
                </a>
                <!-- End: Menu link -->
            </div>
            <!-- End: Menu item -->
        </div>
        <!-- End::Sidebar menu -->
    </div>
    <!-- End::Wrapper -->
</div>
