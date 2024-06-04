<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_detail_kriteria" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_detail_kriteria_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Kriteria</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                    data-kt-detail_kriteria-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_detail_kriteria_form" class="form"
                    action="{{ route('detail_kriteria.store') }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7"
                        id="kt_modal_add_detail_kriteria_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_detail_kriteria_header"
                        data-kt-scroll-wrappers="#kt_modal_add_detail_kriteria_scroll"
                        data-kt-scroll-offset="300px">
                        <!-- Nama Kriteria -->
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2" for="nama_kriteria">Nama Kriteria</label>
                            <select id="nama_kriteria" name="nama_kriteria" class="form-control form-control-solid mb-3 mb-lg-0" required>
                                <option value="" disabled selected>-- Pilih Nama Kriteria --</option>
                                @foreach($kriterias as $kriteria)
                                    <option value="{{ $kriteria->id_kriteria }}" {{ old('id_kriteria') == $kriteria->nama_kriteria ? 'selected' : '' }}>Kriteria {{ $kriteria->nama_kriteria }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!-- Rentang -->
                        <div class="fv-row mb-7">
                            <label for="rentang" class="form-label">Rentang</label>
                            <input type="text" class="form-control" id="rentang"
                                name="rentang" required>
                            <div id="rentangHelp" class="form-text">Silahkan masukkan Rentang</div>
                        </div>
                        <!-- Nilai -->
                        <div class="fv-row mb-7">
                            <label for="nilai" class="form-label">Nilai</label>
                            <input type="number" class="form-control" id="nilai"
                                name="nilai" required>
                            <div id="nilaiHelp" class="form-text">Silahkan masukkan Nilai</div>
                        </div>
                        <!-- Bobot Normalisasi -->
                        <div class="fv-row mb-7">
                            <label for="bobot_normalisasi" class="form-label">Bobot_Normalisasi</label>
                            <input type="number" class="form-control" id="bobot_normalisasi"
                                name="bobot_normalisasi" step="0.01" required>
                            <div id="bobot_normalisasiHelp" class="form-text">Silahkan masukkan Bobot_Normalisasi, Contoh: 1.00</div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm"
                            data-kt-detail_kriteria-modal-action="submit">
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