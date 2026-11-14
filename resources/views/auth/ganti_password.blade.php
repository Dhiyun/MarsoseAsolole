<!DOCTYPE html>
<html lang="en">

<head>
    <title>MARSOSE | Ganti Password</title>
    <link rel="shortcut icon" href="{{ asset('assets/img/Favicon Marsose(Dark).svg') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
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

        <div class="d-flex flex-column flex-center flex-column-fluid p-10">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch w-md-400px">
                    <form method="POST" class="form w-100" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')

                        <div class="text-center mb-10">
                            <img src="{{ asset('assets/img/Marsose Fix (Dark).svg') }}" alt="Marsose" class="mb-8 w-200px">
                            <h1 class="text-dark fw-bolder mb-3">Buat Password Baru</h1>
                            <div class="text-gray-500 fw-semibold fs-6">
                                Password Anda masih sama dengan username. Demi keamanan akun,
                                silakan buat password baru sebelum melanjutkan.
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif

                        <div class="fv-row mb-6">
                            <input type="password" placeholder="Password baru (minimal 8 karakter)" name="password"
                                autocomplete="new-password" class="form-control bg-transparent" required />
                        </div>

                        <div class="fv-row mb-3">
                            <input type="password" placeholder="Ulangi password baru" name="password_confirmation"
                                autocomplete="new-password" class="form-control bg-transparent" required />
                        </div>

                        <div class="d-grid mt-8">
                            <button type="submit" class="btn btn-danger text-white"
                                style="background-color: #EA5403; border-color: #EA5403;">Simpan Password</button>
                        </div>
                    </form>

                    <form method="POST" action="{{ route('logout') }}" class="text-center mt-6">
                        @csrf
                        <button type="submit" class="btn btn-link text-gray-600">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
