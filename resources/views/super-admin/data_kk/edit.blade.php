<!--begin::Modal - Edit task-->
<div class="modal fade" id="kt_modal_edit_kk-{{ $kk->id_kk }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_edit_kk_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit KK</h2>
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
                <form method="POST" id="kt_modal_edit_kk_form" class="form" action="{{ route('kk.update', ['id' => $kk->id_kk]) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_kk_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_kk_header" data-kt-scroll-wrappers="#kt_modal_edit_kk_scroll" data-kt-scroll-offset="300px">
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">No KK</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" id="no_kk" name="no_kk" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $kk->no_kk }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Kepala Keluarga</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" id="kepala_keluarga" name="kepala_keluarga" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $kk->kepala_keluarga }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-2">Alamat</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" id="alamat" name="alamat" class="form-control form-control-solid mb-3 mb-lg-0" value="{{ $kk->alamat }}" required />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        <!-- JNo Rt -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="no_rt">No RT</label>
                            <select id="no_rt" name="no_rt" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih No RT --</option>
                                @foreach($rts as $rt)
                                    <option value="{{ $rt->no_rt }}" {{ $kk->rt->no_rt == $rt->no_rt ? 'selected' : '' }}>RT {{ $rt->no_rt }}</option>
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
<!--end::Modal - Edit task-->
