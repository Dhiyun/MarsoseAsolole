<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_warga" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_warga_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Warga</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-warga-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_warga_form" class="form" action="{{ route('warga.store') }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_warga_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_warga_header" data-kt-scroll-wrappers="#kt_modal_add_warga_scroll" data-kt-scroll-offset="300px">
                        <!-- NIK -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nik">NIK</label>
                            <input type="number" id="nik" name="nik" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('nik') }}" required />
                        </div>
                        <!-- Nama -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nama">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('nama') }}" required />
                        </div>
                        <!-- Jenis Kelamin -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <!-- Tempat Lahir -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('tempat_lahir') }}" required />
                        </div>
                        <!-- Tanggal Lahir -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('tanggal_lahir') }}" required />
                        </div>
                        <!-- Agama -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="agama">Agama</label>
                            <select id="agama" name="agama" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Khonghucu" {{ old('agama') == 'Khonghucu' ? 'selected' : '' }}>Khonghucu</option>
                            </select>
                        </div>													
                        <!-- Alamat -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="alamat">Alamat</label>
                            <input type="text" id="alamat" name="alamat" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('alamat') }}" required />
                        </div>
                        <!-- KK -->
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2" for="no_kk">KK</label>
                            <input type="number" id="no_kk" name="no_kk" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('no_kk') }}" />
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm" data-kt-warga-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Add task-->