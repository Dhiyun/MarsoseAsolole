<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head><base href="{{ asset('') }}"/>
        <title>@yield('title')</title>

        <!-- LOGO -->
        <link href="{{ asset('assets/img/Favicon Marsose(Dark).svg') }}" rel="shortcut icon" >
        {{-- <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" /> --}}
        <!--begin::Fonts(mandatory for all pages)-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Vendor Stylesheets(used for this page only)-->
        <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
        <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true" data-kt-app-aside-push-footer="true" class="app-default">
        <!--begin::Theme mode setup on page load-->
        <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
        <!--end::Theme mode setup on page load-->
        <!--begin::App-->
        <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
            <!--begin::Page-->
            <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
                <!--begin::Wrapper-->
                <div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
                    <!--begin::Sidebar-->
                        @include('super-admin.layouts.sidebar')
                    <!--end::Sidebar-->
                    <!--begin::Main-->
                    <div>
                        @yield('content')
                    </div>
                    <!--end:::Main-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Header-->
                    @include('super-admin.layouts.header')
                <!--end::Header-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::App-->
        <!--begin::Javascript-->
        <script>var hostUrl = "{{ asset('assets/') }}";</script>
        <!--begin::Global Javascript Bundle(mandatory for all pages)-->
        <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Vendors Javascript(used for this page only)-->
        <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
        <!--end::Vendors Javascript-->
        <!--begin::Custom Javascript(used for this page only)-->
        <script src="{{ asset('assets/js/custom/apps/user-management/users/list/table.js') }}"></script>

        //JS Add
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/kk/add.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/surat/add.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/warga/add.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/laporan/add.js') }}"></script>

        //JS Edit
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/kk/edit.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/surat/edit.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/warga/edit.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/warga-lokal/edit.js') }}"></script>
        <script src="{{ asset('assets/js/custom/bymyself/super-admin/surat/edit.js') }}"></script>

        <script src="{{ asset('assets/js/custom/bymyself/super-admin/laporan/accept.js') }}"></script>
        
        <script src="{{ asset('assets/js/custom/bymyself/selectoption.js') }}"></script>
        <script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
        <script src="{{ asset('assets/js/custom/apps/chat/chat.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
        <script src="{{ asset('assets/js/custom/utilities/modals/users-search.js') }}"></script>
        <!--end::Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>
