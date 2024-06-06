<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_laporan" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_laporan_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Laporan Pengaduan</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-laporan-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_laporan_form" class="form" action="{{ route('laporan.store') }}" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_laporan_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_laporan_header" data-kt-scroll-wrappers="#kt_modal_add_laporan_scroll" data-kt-scroll-offset="300px">
                        <!-- Judul -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="judul">Judul</label>
                            <input type="text" id="judul" name="judul" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('judul') }}" required />
                        </div>
                        <!-- Jenis Laporan -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="jenis_laporan">Jenis Laporan</label>
                            <select id="jenis_laporan" name="jenis_laporan" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih Jenis Laporan --</option>
                                <option value="Infrastruktur" {{ old('jenis_laporan') == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Keamanan" {{ old('jenis_laporan') == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                                <option value="Kesehatan" {{ old('jenis_laporan') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Lingkungan" {{ old('jenis_laporan') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Layanan Masyarakat" {{ old('jenis_laporan') == 'Layanan Masyarakat' ? 'selected' : '' }}>Layanan Masyarakat</option>
                            </select>
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-10">
                            <!--begin::Label-->
                            <label class="d-block fw-semibold fs-6 mb-5">
                                <span class="required">Gambar</span>
                                <span class="ms-1" data-bs-toggle="tooltip" title="Isi Gambar yang Sesuai.">
                                    <i class="ki-outline ki-information-5 text-gray-500 fs-6"></i>
                                </span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Image input placeholder-->
                            <style>.image-input-placeholder { background-image: url({{ asset('assets/media/svg/files/blank-image.svg') }}); }</style>
                            <!--end::Image input placeholder-->
                            <!--begin::Image input-->
                            <div class="image-input image-input-empty image-input-outline image-input-placeholder" data-kt-image-input="true">
                                <!--begin::Preview existing avatar-->
                                <div class="image-input-wrapper w-120px h-120px"></div>
                                <!--end::Preview existing avatar-->
                                <!--begin::Label-->
                                <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                                    <i class="ki-outline ki-pencil fs-7"></i>
                                    <!--begin::Inputs-->
                                    <input type="file" name="gambar" accept=".png, .jpg, .jpeg" />
                                    <!--end::Inputs-->
                                </label>
                                <!--end::Label-->
                                <!--begin::Cancel-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                                    <i class="ki-outline ki-cross fs-2"></i>
                                </span>
                                <!--end::Cancel-->
                                <!--begin::Remove-->
                                <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="ki-outline ki-cross fs-2"></i>
                                </span>
                                <!--end::Remove-->
                            </div>
                            <!--end::Image input-->
                            <!--begin::Hint-->
                            <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                            <!--end::Hint-->
                        </div>
                        <!--end::Input group-->
                        <!-- Tanggal Lahir -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="keterangan">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" class="form-control form-control-solid mb-3 mb-lg-0" required>{{ old('keterangan') }}</textarea>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm" data-kt-laporan-modal-action="submit">
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
