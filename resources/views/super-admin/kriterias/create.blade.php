<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_kriteria" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_kriteria_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Kriteria</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                    data-kt-kriteria-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_kriteria_form" class="form"
                    action="{{ route('detail_kriteria.store') }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7"
                        id="kt_modal_add_kriteria_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_kriteria_header"
                        data-kt-scroll-wrappers="#kt_modal_add_kriteria_scroll"
                        data-kt-scroll-offset="300px">
                        <!-- Nama Kriteria -->
                        <div class="fv-row mb-7">
                            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
                            <input type="text" class="form-control" id="nama_kriteria"
                                name="nama_kriteria" required>
                            <div id="nama_kriteriaHelp" class="form-text">Silahkan masukkan Nama</div>
                        </div>
                        <!-- Jenis Kriteria -->
                        <div class="fv-row mb-7">
                            <label for="jenis_kriteria" class="form-label">Jenis Kriteria</label>
                            <select class="form-select" id="jenis_kriteria"
                                name="jenis_kriteria" required>
                                <option selected>-- Buka menu pilihan ini --</option>
                                <option value="Benefit">Benefit</option>
                                <option value="Cost">Cost</option>
                            </select>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm"
                            data-kt-kriteria-modal-action="submit">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">Please wait...
                                <span
                                    class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
