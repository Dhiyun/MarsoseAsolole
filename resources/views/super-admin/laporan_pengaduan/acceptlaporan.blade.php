<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_laporan-accept-{{ $lp->id_laporan }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_laporan-accept_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Laporan Pengaduan</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-laporan-accept-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_laporan-accept_form" class="form"
                    action="{{ route('laporan.updateStatus') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id_laporan" value="{{ $lp->id_laporan }}">
                    <input type="hidden" name="status" value="diproses">

                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_add_laporan-accept_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_laporan-accept_header"
                        data-kt-scroll-wrappers="#kt_modal_add_laporan-accept_scroll" data-kt-scroll-offset="300px">
                        <!-- Tanggal Proses -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="tanggal_proses">Tanggal Proses</label>
                            <input type="date" id="tanggal_proses" name="tanggal_proses"
                                class="form-control form-control-solid mb-3 mb-lg-0" value="{{ old('tanggal_proses') }}"
                                required />
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="tanggal_selesai">Tanggal Selesai</label>
                            <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                                class="form-control form-control-solid mb-3 mb-lg-0"
                                value="{{ old('tanggal_selesai') }}" required />
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm"
                            data-kt-laporan-accept-modal-action="submit">
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
