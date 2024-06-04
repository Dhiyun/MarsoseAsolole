<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_kk" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_kk_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add KK</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-kk-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_kk_form" class="form" action="{{ route('kk.store') }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_kk_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_kk_header" data-kt-scroll-wrappers="#kt_modal_add_kk_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">No KK</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" id="no_kk" name="no_kk" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('no_kk') }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Kepala Keluarga</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" id="kepala_keluarga" name="kepala_keluarga" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('kepala_keluarga') }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!-- NIK -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nik">NIK</label>
                            <input type="number" id="nik" name="nik" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('nik') }}" required />
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
                        <!--begin::Row-->
                        <div class="row">
                            <!--begin::Col-->
                            <div class="col-lg-4">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!-- Tempat Lahir -->
                                    <div class="fv-row mb-7">
                                        <label class="required fw-semibold fs-6 mb-2" for="tempat_lahir">Tempat Lahir</label>
                                        <span class="ms-1" data-bs-toggle="tooltip" title="Isi Tempat Kelahiran Seperti Kota">
                                            <i class="ki-outline ki-information fs-7"></i>
                                        </span></a>
                                        <input type="text" id="tempat_lahir" name="tempat_lahir" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('tempat_lahir') }}" required />
                                    </div>
                                </div>
                                <!--end::Input group-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col">
                                <!-- Tanggal Lahir -->
                                <div class="fv-row mb-7">
                                    <label class="required fw-semibold fs-6 mb-2" for="tanggal_lahir">Tanggal Lahir</label>
                                    <input type="date" id="tanggal_lahir" name="tanggal_lahir" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('tanggal_lahir') }}" required />
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
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
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" id="alamat" name="alamat" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('alamat') }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!-- JNco Rt -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="no_rt">No RT</label>
                            <select id="no_rt" name="no_rt" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih No RT --</option>
                                @foreach($rts as $rt)
                                    <option value="{{ $rt->no_rt }}" {{ old('no_rt') == $rt->no_rt ? 'selected' : '' }}>RT {{ $rt->no_rt }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm" data-kt-kk-modal-action="submit">
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
