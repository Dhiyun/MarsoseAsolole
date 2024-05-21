<style>
    .menu-link.nav-link:hover {
        color: #FF520D !important;
    }
</style>

<!-- Navbar -->
<div class="container-fluid">
    <div class="landing-header rounded-4" style="background-color: #1E293B; position: fixed; width: 98.5%; z-index: 1000;">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center flex-equal">
                    <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                        <i class="ki-outline ki-abstract-14 fs-2hx"></i>
                    </button>
                    <a href="/user">
                        <img alt="Logo" src="assets/media/logos/logo-marsose3.svg" class="logo-default h-25px h-lg-30px" />
                    </a>
                </div>
                <div class="d-lg-block" id="kt_header_nav_wrapper">
                    <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                        <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-semibold" id="kt_landing_menu">
                            <div class="menu-item">
                                <a class="menu-link nav-link {{ request()->is('user/dashboard') ? 'active' : '' }} py-3 px-4 px-xxl-6" href="/user/dashboard" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Dashboard</a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link nav-link {{ request()->is('user/laporan') ? 'active' : '' }} py-3 px-4 px-xxl-6" href="/user/laporan" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Laporan Warga</a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link nav-link {{ request()->is('user/surat_keterangan') ? 'active' : '' }} py-3 px-4 px-xxl-6" href="/user/surat_keterangan" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Surat-surat</a>
                            </div>
                        </div>
                    </div>
                </div>             

                <!-- Avatar Profile -->
                <div class="flex-equal text-end ms-1">
                    <div class="app-navbar-item ms-2 ms-lg-6" id="kt_header_user_menu_toggle">
                        <div class="cursor-pointer symbol symbol-circle symbol-30px symbol-lg-45px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                            <img src="assets/media/avatars/300-2.jpg" alt="user" />
                        </div>
                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                            <div class="menu-item px-3">
                                <div class="menu-content d-flex align-items-center px-3">
                                    <div class="symbol symbol-50px me-5">
                                        <img alt="Logo" src="assets/media/avatars/300-2.jpg" />
                                    </div>
                                    <div class="d-flex flex-column">
                                        <div class="fw-bold d-flex align-items-center fs-5">Max Smith
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">Pro</span></div>
                                        <a href="#" class="fw-semibold text-muted text-hover-primary fs-7">max@kt.com</a>
                                    </div>
                                </div>
                            </div>
                            <div class="separator my-2"></div>
                            <div class="menu-item px-5">
                                <a href="../../demo39/dist/account/overview.html" class="menu-link px-5">My Profile</a>
                            </div>
                            <div class="menu-item px-5 my-1">
                                <a href="../../demo39/dist/account/settings.html" class="menu-link px-5">Account Settings</a>
                            </div>
                            <div class="menu-item px-5">
                                <a href="../../demo39/dist/authentication/layouts/corporate/sign-in.html" class="menu-link px-5">Sign Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer" style="height: 100px;"></div>