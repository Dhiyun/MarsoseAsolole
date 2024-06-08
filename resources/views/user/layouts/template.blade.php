<!DOCTYPE html>
<html lang="en">

<!--begin::Head-->
<head>
    <base href="../../../"/>
    <!-- Title -->
    <title>@yield('title')</title>

    <!-- LOGO -->
    <link id="favicon" href="{{ asset('assets/img/Favicon Marsose(Dark).svg') }}" rel="shortcut icon">

    <!--begin::Fonts(mandatory for all pages)-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!--end::Fonts-->
    <!--begin::Vendor Stylesheets(used for this page only)-->
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/styleUser.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    
</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-header-fixed="true" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" data-kt-app-aside-enabled="true" data-kt-app-aside-fixed="true" data-kt-app-aside-push-toolbar="true" data-kt-app-aside-push-footer="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>
			// Mendefinisikan mode tema default dan mode tema saat ini
			var defaultThemeMode = "light";
			var themeMode;
		
			// Memeriksa apakah elemen root HTML memiliki atribut data-bs-theme-mode
			if (document.documentElement) {
				// Jika ya, gunakan nilai dari atribut tersebut sebagai mode tema
				if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
					themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
				} 
				// Jika tidak, cek apakah terdapat data tema di localStorage
				else {
					if (localStorage.getItem("data-bs-theme") !== null) {
						themeMode = localStorage.getItem("data-bs-theme");
					} 
					// Jika tidak ada, gunakan mode tema default
					else {
						themeMode = defaultThemeMode;
					}
				}
		
				// Jika mode tema adalah "system", gunakan tema sesuai dengan preferensi sistem pengguna
				if (themeMode === "system") {
					themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
				}
		
				// Tetapkan mode tema yang dipilih ke elemen root HTML
				document.documentElement.setAttribute("data-bs-theme", themeMode);
			}
		</script>		
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Navbar-->
					@include('user.layouts.navbar')
				<!--end::Navbar-->
				<!--begin::Wrapper-->
				<div class="container mt-5" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<!--end::Sidebar-->
					<!--begin::Main-->
					<div>
						@yield('content')
					</div>
					<!--end:::Main-->
				</div>
				<!--end::Wrapper-->
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
		<script src="{{ asset('assets/js/widgets.bundle.js') }}"></script>
        <script src="{{ asset('assets/js/custom/widgets.js') }}"></script>
		<!--end::Custom Javascript-->
		<!--end::Javascript-->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

		<script>
		/* menu-list surat */
			var surat_js = document.querySelector('.surat-content');
			if (surat_js) {
				document.querySelector('.'+surat_js.dataset.handbook).classList.add('active')
			}
		</script>
	</body>
	<!--end::Body-->
</html>