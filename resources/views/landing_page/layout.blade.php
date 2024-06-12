<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>@yield('title', 'MARSOSE - Citizen\'s Report Site')</title>

    <!-- LOGO -->
    <link id="favicon" href="assets/img/Favicon Marsose(Dark).svg" rel="icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/styleLP.css" rel="stylesheet">

    @yield('styles')

    {{-- <script>
        function setFavicon() {
            const isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const favicon = document.getElementById('favicon');
            if (isDarkMode) {
                favicon.href = '{{ asset("assets/img/Favicon Marsose(Light).svg") }}';
            } else {
                favicon.href = '{{ asset("assets/img/Favicon Marsose(Dark).svg") }}';
            }
        }

        setFavicon();

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', setFavicon);
    </script> --}}
</head>

<body>
    <!-- ======= Header ======= -->
    @include('landing_page.header')

    <!-- ======= Hero Section ======= -->
    @include('landing_page.hero')

    <main id="main">
        @yield('content')
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    @include('landing_page.footer')

    @yield('scripts')
</body>

</html>
