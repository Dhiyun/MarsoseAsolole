<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_surat" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_surat_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Surat</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-surat-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_surat_form" class="form" action="{{ route('surat.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_surat_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_surat_header" data-kt-scroll-wrappers="#kt_modal_add_surat_scroll" data-kt-scroll-offset="300px">
                        <!-- Jenis Surat -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="jenis_surat">Jenis Surat</label>
                            <select id="jenis_surat" name="jenis_surat" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih Jenis Surat --</option>
                                <option value="Surat Pengantar" {{ old('jenis_surat') == 'Surat Pengantar' ? 'selected' : '' }}>Surat Pengantar</option>
                                <option value="Surat Keterangan" {{ old('jenis_surat') == 'Surat Keterangan' ? 'selected' : '' }}>Surat Keterangan</option>
                                <option value="Surat Undangan" {{ old('jenis_surat') == 'Surat Undangan' ? 'selected' : '' }}>Surat Undangan</option>
                                <option value="Surat Pemberitahuan" {{ old('jenis_surat') == 'Surat Pemberitahuan' ? 'selected' : '' }}>Surat Pemberitahuan</option>
                            </select>
                        </div>
                        <!-- Nama Surat -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nama_surat">Nama Surat</label>
                            <input type="text" id="nama_surat" name="nama_surat" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('nama_surat') }}" required />
                        </div>
                        <!-- Upload File -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="file_surat">Upload File</label>
                            <input type="file" accept=".pdf,.doc,.docx" id="file_surat" name="file_surat" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('file_surat') }}" required />
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm" data-kt-surat-modal-action="submit">
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
