<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_edit_alternatif-{{ $alternatif->id_alternatif }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_edit_alternatif_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Alternatif</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-alternatif-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_edit_alternatif_form" class="form" action="{{ route('alternatif.update', ['id' => $alternatif->id_alternatif]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_alternatif_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_alternatif_header" data-kt-scroll-wrappers="#kt_modal_edit_alternatif_scroll" data-kt-scroll-offset="300px">
                        <!-- Kode Alternatif -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="kode_alternatif">Kode Alternatif</label>
                            <input type="text" id="kode_alternatif" name="kode_alternatif" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $alternatif->kode_alternatif }}" required />
                        </div>
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="judul">Judul Laporan</label>
                            <select name="id_laporan" data-control="select2" class="form-select form-select-solid form-select-lg" required>
                                <option value="" disabled selected>Pilih Judul Laporan</option>
                                @foreach($juduls as $jdl)
                                    <option value="{{ $jdl->id_laporan }}" data-alternatif-nama="{{ $jdl->judul }}" {{ $alternatif->id_laporan == $jdl->id_laporan ? 'selected' : '' }}>{{ $jdl->judul }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm" data-kt-alternatif-modal-action="submit">
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
