<!-- Navbar -->
<div class="landing-header" style="background-color: #1E293B; position: fixed; width: 100%; z-index: 1000;">
    <div class="container">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center flex-equal">
                <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                    <i class="ki-outline ki-abstract-14 fs-2hx"></i>
                </button>
                <a href="{{ route('user.index') }}">
                    <img alt="Logo" src="{{ asset('assets/img/Marsose Fix (Light).svg') }}"
                        class="logo-default h-25px h-lg-35px" />
                </a>
            </div>
            <div class="d-lg-block" id="kt_header_nav_wrapper">
                <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu"
                    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                    data-kt-drawer-width="200px" data-kt-drawer-direction="start"
                    data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
                    data-kt-swapper-mode="prepend"
                    data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                    <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
                        id="kt_landing_menu">
                        <div class="menu-item">
                            <a class="menu-link nav-link {{ request()->is('user/dashboard') ? 'active' : '' }} py-3 px-4 px-xxl-6"
                                href="/user/dashboard" data-kt-scroll-toggle="true"
                                data-kt-drawer-dismiss="true">Dashboard</a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link nav-link {{ request()->is('user/laporan') || request()->is('user/laporan/create') || request()->is('user/laporan/history') ? 'active' : '' }} py-3 px-4 px-xxl-6"
                                href="/user/laporan" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">
                                Laporan Warga
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link nav-link {{ request()->is('user/surat_keterangan') || request()->is('user/surat_pengantar') || request()->is('user/surat_undangan') || request()->is('user/surat_pemberitahuan') ? 'active' : '' }} py-3 px-4 px-xxl-6"
                                href="/user/surat_keterangan" data-kt-scroll-toggle="true"
                                data-kt-drawer-dismiss="true">Surat-surat</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Avatar Profile -->
            <div class="flex-equal text-end ms-1">
                <div class="app-header-logo d-flex align-items-center ps-lg-12" id="kt_app_header_logo">
                </div>
                <div class="app-navbar-item ms-2 ms-lg-6" id="kt_header_user_menu_toggle">
                    <div class="cursor-pointer symbol symbol-circle symbol-50px symbol-lg-45px"
                        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
                        data-kt-menu-placement="bottom-end">
                        <img src="{{ Auth::user()->warga->foto ? asset('uploads/' . Auth::user()->warga->foto) : asset('assets/media/svg/avatars/blank.svg') }}"
                            alt="user" />
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                        data-kt-menu="true">
                        <div class="menu-item px-3">
                            <div class="menu-content d-flex align-items-center px-3">
                                <div class="symbol symbol-50px me-5">
                                    <img alt="image-input-wrapper w-125px h-125px"
                                        src="{{ Auth::user()->warga->foto ? asset('uploads/' . Auth::user()->warga->foto) : asset('assets/media/svg/avatars/blank.svg') }}" />
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="fw-bold d-flex align-items-center fs-3">{{ Auth::user()->warga->nama }}
                                        <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">RT
                                            {{ Auth::user()->warga->no_rt }}</span>
                                    </div>
                                    <div class="fw-normal text-muted text-hover-primary fs-6">NIK.
                                        {{ Auth::user()->warga->nik }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="separator my-2"></div>
                        <div class="menu-item px-4">
                            <a href="{{ route('profile-user') }}" class="menu-link">My Profile</a>
                        </div>
                        <div class="menu-item px-4">
                            <a href="{{ route('logout') }}" class="menu-link">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="spacer" style="height: 100px;"></div>

{{-- <!-- Image Input for Changing Avatar -->
<div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}')">
    <!-- Preview existing avatar -->
    <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ Auth::user()->warga->foto ? asset('uploads/' . Auth::user()->warga->foto) : asset('assets/media/svg/avatars/blank.svg') }}')"></div>
    <!-- End Preview existing avatar -->
    <!-- Label -->
    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
        <i class="ki-outline ki-pencil fs-7"></i>
        <!-- Inputs -->
        <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
        <input type="hidden" name="foto_remove" />
        <!-- End Inputs -->
    </label>
    <!-- End Label -->
    <!-- Cancel -->
    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
        <i class="ki-outline ki-cross fs-2"></i>
    </span>
    <!-- End Cancel -->
    <!-- Remove -->
    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
        <i class="ki-outline ki-cross fs-2"></i>
    </span>
    <!-- End Remove -->
</div> --}}
