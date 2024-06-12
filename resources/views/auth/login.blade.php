<!DOCTYPE html>
<html lang="en">

<head>
    <base href="../../../" />
    <title>MARSOSE | Login</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/Favicon Marsose(Dark).svg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body id="kt_body" class="app-blank bgi-size-cover bgi-attachment-fixed bgi-position-center">
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <style>
            body {
                background-image: url('{{ asset('assets/media/auth/bg10.jpeg') }}');
            }

            [data-bs-theme="dark"] body {
                background-image: url('{{ asset('assets/media/auth/bg10-dark.jpeg') }}');
            }
        </style>

        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-lg-row-fluid">
                <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100">
                    <img src="{{ asset('assets/img/Marsose Fix (Dark).svg') }}" class="mb-5 ">
                    <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
                        style="border-radius: 32px" src="{{ asset('assets/img/Attached files (1).gif') }}"
                        alt="" />
                    <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Fast, Efficient and Flexible</h1>
                    <div class="text-gray-600 fs-base text-center fw-semibold">Marsose merupakan platform yang untuk
                        menampung segala keluhanmu. <br> Sistem ini didesain untuk memfasilitasi pelaporan permasalahan
                        <br> oleh warga kepada pihak RT/RW. Tunggu apalagi?
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
                <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                    <div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
                        <div class="d-flex flex-center flex-column flex-column-fluid pb-15 pb-lg-20">
                            <form method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
                                action="{{ route('login_proses') }}">
                                @csrf
                                <div class="text-center mb-11">
                                    <h1 class="text-dark fw-bolder mb-3">Log In</h1>
                                    <div class="text-gray-500 fw-semibold fs-6">Marsose Nih Bos</div>
                                </div>

                                <div class="my-14"></div>

                                <div class="fv-row mb-6">
                                    <input type="text" placeholder="Username" id="username" name="username"
                                        autocomplete="off" class="form-control bg-transparent" />
                                </div>

                                <div class="fv-row mb-3">
                                    <input type="password" placeholder="Password" id="password" name="password"
                                        autocomplete="off" class="form-control bg-transparent" />
                                </div>

                                <div class="d-grid mb-10">
                                    <button type="submit" id="kt_sign_in_submit" class="btn btn-danger mt-5"
                                        style="background-color: #EA5403; border-color: #EA5403;">
                                        <span class="indicator-label">Log In</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
</body>

</html>
