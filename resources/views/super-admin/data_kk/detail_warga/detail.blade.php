@extends('super-admin.layouts.template')
@section('title', 'Super Admin | Detail Data Penduduk')

@section('content')

    <style>
        .hidden {
            display: none;
        }

        .visible {
            display: block;
        }
    </style>

    <div class="app-main flex-column flex-row-fluid mt-5 mx-5 mb-5" id="kt_app_main">
        <!--begin::Content wrapper-->
        <div class="d-flex flex-column flex-column-fluid">
            <!--begin::Toolbar-->
            @include('super-admin.layouts.breadcrumb')
            <!--end::Toolbar-->
            <!--begin::Content-->
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <!--begin::Content container-->
                <div id="kt_app_content_container" class="app-container container-fluid">
                    <!--begin::Card-->
                    <div class="card">
                        <!--begin::Nama Kepala Keluarga-->
                        <div class="card-header mt-5"><!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1">
                                <!--begin::Menu- wrapper-->
                                <div class="btn btn-icon btn-custom btn-color-gray-600 btn-active-color-primary w-35px h-35px w-md-40px h-md-40px"
                                    onclick="window.history.back();">
                                    <i class="ki-outline ki-arrow-left fs-3"></i>
                                </div>
                                <!--begin::Menu-->
                                <h1 class="mt-1">Detail Keseluruhan</h1>
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Nama Kepala Keluarga-->
                        <!--begin::Card body-->
                        <div class="card-body py-4">
                            <!--begin::Row-->
                            <div class="row">
                                <!--begin::Col (Detail Warga)-->
                                <div class="col-lg-6">
                                    <!--begin::details View-->
                                    <div class="card mb-5 mb-xl-10">
                                        <!--begin::Card header-->
                                        <div class="card-header border-0 mt-5">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0">Detail Warga</h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--begin::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body p-9">
                                            <!--begin::Row-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">NIK</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $warga->nik }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Nama</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <span class="fw-semibold text-gray-800 fs-6">{{ $warga->nama }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Jenis Kelamin</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8 fv-row">
                                                    <span
                                                        class="fw-semibold text-gray-800 fs-6">{{ ucfirst($warga->jenis_kelamin) }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Tempat, Tanggal Lahir</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-semibold text-gray-800 fs-6">{{ $warga->tempat_lahir }},
                                                        {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->format('d M Y') }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Alamat</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $warga->alamat }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Agama</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800">{{ $warga->agama }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">RT</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $warga->kk->rt->no_rt ?? 'N/A' }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Status Keluarga</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ ucwords(str_replace('_', ' ', $warga->status_keluarga)) }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="row mb-7">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Status Kependudukan</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span class="fw-bold fs-6 text-gray-800"
                                                        data-status="{{ $warga->user->level->level_nama }}">
                                                        {{ $warga->user->level->level_nama }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div id="periode" class="row mb-7 d-none">
                                                <!--begin::Label-->
                                                <label class="col-lg-4 fw-semibold text-muted">Periode Jabatan</label>
                                                <!--end::Label-->
                                                <!--begin::Col-->
                                                <div class="col-lg-8">
                                                    <span
                                                        class="fw-bold fs-6 text-gray-800">{{ $warga->periode_jabatan_awal }}
                                                        - {{ $warga->periode_jabatan_akhir }}</span>
                                                </div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::details View-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col (Edit Pengguna)-->
                                <div class="col-lg-6">
                                    <!--begin::Basic info-->
                                    <div class="card mb-5 mb-xl-10">
                                        <!--begin::Card header-->
                                        <div class="card-header mt-5 border-0">
                                            <!--begin::Card title-->
                                            <div class="card-title m-0">
                                                <h3 class="fw-bold m-0">Edit User</h3>
                                            </div>
                                            <!--end::Card title-->
                                        </div>
                                        <!--begin::Card content-->
                                        <div class="collapse show">
                                            <!--begin::Form-->
                                            <form class="form" method="POST"
                                                action="{{ route('user.update', $warga->user->id_user) }}">
                                                @csrf
                                                @method('PUT')
                                                <!--begin::Card body-->
                                                <div class="card-body border-top p-9">
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <label class="required fw-semibold fs-6 mb-2"
                                                            for="username">Username</label>
                                                        <input type="number" id="username" name="username"
                                                            class="form-control form-control-solid mb-3 mb-lg-0"
                                                            value="{{ old('username', $warga->user->username) }}"
                                                            required />
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <label class="required fw-semibold fs-6 mb-2"
                                                            for="password">Password</label>
                                                        <input type="password" id="password" name="password"
                                                            class="form-control form-control-solid mb-3 mb-lg-0" />
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div class="fv-row mb-7">
                                                        <label class="required fw-semibold fs-6 mb-2"
                                                            for="level">Level</label>
                                                        <select name="id_level" data-control="select2"
                                                            class="form-select form-select-solid form-select-lg" required>
                                                            <option value="" disabled selected>Pilih Level</option>
                                                            @foreach ($level as $lvl)
                                                                <option value="{{ $lvl->id_level }}"
                                                                    data-level-nama="{{ $lvl->level_nama }}"
                                                                    {{ old('id_level', $warga->user->id_level) == $lvl->id_level ? 'selected' : '' }}>
                                                                    {{ $lvl->level_nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Input group-->
                                                    <div id="periode-jabatan" class="fv-row mb-7" style="display: none;">
                                                        <label class="required fw-semibold fs-6 mb-2">Periode
                                                            Jabatan</label>
                                                        <div class="input-group">
                                                            <div class="w-100 mb-3">
                                                                <label class="fw-semibold fs-6 mb-2"
                                                                    for="periode_jabatan_awal">Awal</label>
                                                                <input type="date" id="periode_jabatan_awal"
                                                                    name="periode_jabatan_awal"
                                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                                    value="{{ old('periode_jabatan_awal') }}" />
                                                            </div>
                                                            <div class="w-100 mb-3">
                                                                <label class="fw-semibold fs-6 mb-2"
                                                                    for="periode_jabatan_akhir">Akhir</label>
                                                                <input type="date" id="periode_jabatan_akhir"
                                                                    name="periode_jabatan_akhir"
                                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                                    value="{{ old('periode_jabatan_akhir') }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Input group-->
                                                    <!--begin::Actions-->
                                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                                        <button type="submit" class="btn btn-primary"
                                                            id="kt_account_profile_details_submit">Save Changes</button>
                                                    </div>
                                                    <!--end::Actions-->
                                                </div>
                                                <!--end::Card body-->
                                            </form>
                                            <!--end::Form-->
                                        </div>
                                        <!--End::Card content-->
                                    </div>
                                    <!--end::Basic info-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content container-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Content wrapper-->
        <!--begin::Footer-->
        @include('super-admin.layouts.footer')
        <!--end::Footer-->
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const periodeJabatanAwal = document.getElementById('periode_jabatan_awal');
            const periodeJabatanAkhir = document.getElementById('periode_jabatan_akhir');

            periodeJabatanAwal.setAttribute('min', today);
            periodeJabatanAkhir.setAttribute('min', today);
        });

        document.addEventListener('DOMContentLoaded', function() {
            const selectIdLevel = document.querySelector('[data-control="select2"]');
            const periodejabatan = document.getElementById("periode-jabatan");
            const periodeJabatanAwal = document.getElementById("periode_jabatan_awal");
            const periodeJabatanAkhir = document.getElementById("periode_jabatan_akhir");
            const periode = document.getElementById('periode')
            const valStatus = document.querySelector('[data-status]');
            const status = valStatus.dataset.status;

            $(selectIdLevel).select2();

            function togglePeriodeJabatan() {
                const selectedOption = selectIdLevel.options[selectIdLevel.selectedIndex];
                const selectedLevelNama = selectedOption.getAttribute('data-level-nama');

                if (selectedLevelNama !== "Warga") {
                    periodejabatan.style.display = 'block';
                    periodeJabatanAwal.setAttribute('required', 'required');
                    periodeJabatanAkhir.setAttribute('required', 'required');
                } else {
                    periodejabatan.style.display = 'none';
                    periodeJabatanAwal.removeAttribute('required');
                    periodeJabatanAkhir.removeAttribute('required');
                }
            }

            $(selectIdLevel).on('change', togglePeriodeJabatan);

            togglePeriodeJabatan();

            if (status === 'Warga') {
                periode.classList.add('d-none');
                periode.classList.remove('active');
            } else {
                periode.classList.add('active');
                periode.classList.remove('d-none');
            }

            const submitButton = modalElement.querySelector('[data-kt-user-action="submit"]');
            submitButton.addEventListener("click", function(event) {
                event.preventDefault();
                formValidation.validate().then(function(status) {
                    if (status === "Valid") {
                        submitButton.setAttribute("data-kt-indicator", "on");
                        submitButton.disabled = true;

                        // Simulasikan proses submit selama 2 detik
                        setTimeout(function() {
                            submitButton.removeAttribute("data-kt-indicator");
                            submitButton.disabled = false;

                            Swal.fire({
                                text: "Level form has been successfully submitted!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-primary"
                                }
                            }).then(function(result) {
                                if (result.isConfirmed) {
                                    formElement.submit();
                                    modalInstance.hide();
                                }
                            });
                        }, 2000);
                    } else {
                        Swal.fire({
                            text: "Sorry, looks like there are some errors detected, please try again.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }
                });
            });
        });
    </script>

@endsection
