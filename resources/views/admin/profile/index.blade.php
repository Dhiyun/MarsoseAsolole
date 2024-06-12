@extends('admin.layouts.template')
@section('title', 'Admin | Profile')

@section('content')
    <div class="container mt-2">
        <!--begin::Toolbar-->
        @include('super-admin.layouts.breadcrumb')
        <div class="row">
            <div class="col">
                <div class="card mb-5 mb-xl-10">
                    <!-- Card header -->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!-- Card title -->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Profile Details</h3>
                        </div>
                        <!-- End Card title -->
                    </div>
                    <!-- End Card header -->
                    <!-- Content -->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!-- Form -->
                        <form id="kt_account_profile_details_form" class="form"
                            action="{{ route('admin.updateProfile', ['rt' => $rtNumber]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Card body -->
                            <div class="card-body border-top p-9">
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto Profile</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8">
                                        <!-- Image input -->
                                        <div class="image-input image-input-outline" data-kt-image-input="true"
                                            style="background-image: url('{{ asset('assets/media/svg/avatars/blank.svg') }}')">
                                            <!-- Preview existing avatar -->
                                            <div class="image-input-wrapper w-125px h-125px"
                                                style="background-image: url('{{ Auth::user()->warga->foto ? asset('uploads/' . Auth::user()->warga->foto) : asset('path_to_default_image') }}')">
                                            </div>
                                            <!-- End Preview existing avatar -->
                                            <!-- Label -->
                                            <label
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                title="Change avatar">
                                                <i class="ki-outline ki-pencil fs-7"></i>
                                                <!-- Inputs -->
                                                <input type="file" name="foto" accept=".png, .jpg, .jpeg" />
                                                <input type="hidden" name="foto_remove" />
                                                <!-- End Inputs -->
                                            </label>
                                            <!-- End Label -->
                                            <!-- Cancel -->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                title="Cancel avatar">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </span>
                                            <!-- End Cancel -->
                                            <!-- Remove -->
                                            <span
                                                class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                title="Remove avatar">
                                                <i class="ki-outline ki-cross fs-2"></i>
                                            </span>
                                            <!-- End Remove -->
                                        </div>
                                        <!-- End Image input -->
                                        <!-- Hint -->
                                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                        <!-- End Hint -->
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Full Name</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8">
                                        <!-- Row -->
                                        <div class="row">
                                            <!-- Col -->
                                            <div class="col-lg-12 fv-row">
                                                <input type="text" name="nama"
                                                    class="form-control form-control-lg form-control-solid mb-3 mb-lg-0"
                                                    placeholder="Full name" value="{{ Auth::user()->warga->nama }}"
                                                    required />
                                            </div>
                                            <!-- End Col -->
                                        </div>
                                        <!-- End Row -->
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">NIK</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="nik"
                                            class="form-control form-control-lg form-control-solid" placeholder="NIK"
                                            value="{{ Auth::user()->warga->nik }}" required />
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Jenis Kelamin</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <select id="jenis_kelamin" class="form-control form-control-lg form-control-solid"
                                            name="jenis_kelamin" required>
                                            <option value="laki-laki"
                                                {{ Auth::user()->warga->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>
                                                Laki-laki</option>
                                            <option value="perempuan"
                                                {{ Auth::user()->warga->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                Perempuan</option>
                                        </select>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tempat Lahir</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="tempat_lahir"
                                            class="form-control form-control-lg form-control-solid"
                                            placeholder="Tempat Lahir" value="{{ Auth::user()->warga->tempat_lahir }}"
                                            required />
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Tanggal Lahir</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <input type="date" name="tanggal_lahir"
                                            class="form-control form-control-lg form-control-solid"
                                            value="{{ Auth::user()->warga->tanggal_lahir }}" required />
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Alamat</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <textarea name="alamat" class="form-control form-control-lg form-control-solid" required>{{ Auth::user()->warga->alamat }}</textarea>
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">No RT</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="no_rt"
                                            class="form-control form-control-lg form-control-solid" placeholder="No RT"
                                            value="{{ Auth::user()->warga->no_rt }}" required />
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                                <!-- Input group -->
                                <div class="row mb-6">
                                    <!-- Label -->
                                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Agama</label>
                                    <!-- End Label -->
                                    <!-- Col -->
                                    <div class="col-lg-8 fv-row">
                                        <input type="text" name="agama"
                                            class="form-control form-control-lg form-control-solid" placeholder="Agama"
                                            value="{{ Auth::user()->warga->agama }}" required />
                                    </div>
                                    <!-- End Col -->
                                </div>
                                <!-- End Input group -->
                            </div>
                            <!-- End Card body -->
                            <!-- Actions -->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="reset"
                                    class="btn btn-light btn-active-light-primary me-2">Discard</button>
                                <button type="submit" class="btn btn-primary"
                                    id="kt_account_profile_details_submit">Save Changes</button>
                            </div>
                            <!-- End Actions -->
                        </form>
                        <!-- End Form -->
                    </div>
                    <!-- End Content -->
                </div>
            </div>
        </div>
    </div>
@endsection
