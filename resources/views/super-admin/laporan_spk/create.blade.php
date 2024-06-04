<!--begin::Modal - Add task-->
<div class="modal fade" id="kt_modal_add_laporan_spk" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_add_laporan_spk_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Laporan SPK</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary"
                    data-kt-laporan_spk-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_add_laporan_spk_form" class="form"
                    action="{{ route('laporan_spk.store') }}">
                    @csrf
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7"
                        id="kt_modal_add_laporan_spk_scroll" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto"
                        data-kt-scroll-dependencies="#kt_modal_add_laporan_spk_header"
                        data-kt-scroll-wrappers="#kt_modal_add_laporan_spk_scroll"
                        data-kt-scroll-offset="300px">
                        <!-- Jenis Laporan -->
                        <div class="fv-row mb-7">
                            <label for="jenis_laporan" class="form-label">Jenis
                                Laporan</label>
                            <select class="form-select" id="jenis_laporan"
                                name="jenis_laporan" required>
                                <option selected>-- Buka menu pilihan ini --</option>
                                <option value="Infrastruktur">Infrastruktur</option>
                                <option value="Keamanan">Keamanan</option>
                                <option value="Kesehatan">Kesehatan</option>
                                <option value="Lingkungan">Lingkungan</option>
                                <option value="Layanan Masyarakat">Layanan Masyarakat
                                </option>
                            </select>
                        </div>
                        <!-- Biaya -->
                        <div class="fv-row mb-7">
                            <label for="biaya" class="form-label">Biaya</label>
                            <input type="number" class="form-control" id="biaya"
                                name="biaya" required>
                            <div id="biayaHelp" class="form-text">Silahkan masukkan nilai
                                tanpa titik atau koma</div>
                        </div>
                        <!-- Dampak -->
                        <div class="fv-row mb-7">
                            <label for="dampak" class="form-label d-block">Dampak</label>
                            <div class="d-flex justify-content-between">
                                <div
                                    class="form-check form-check-inline flex-grow-1 text-center">
                                    <input class="form-check-input" type="radio"
                                        name="dampak" id="dampak1" value="1"
                                        required>
                                    <label class="form-check-label"
                                        for="dampak1">Rendah</label>
                                    <div id="durasiHelp1" class="form-text">1-50 Orang
                                    </div>
                                </div>
                                <div
                                    class="form-check form-check-inline flex-grow-1 text-center">
                                    <input class="form-check-input" type="radio"
                                        name="dampak" id="dampak2" value="2"
                                        required>
                                    <label class="form-check-label"
                                        for="dampak2">Medium</label>
                                    <div id="durasiHelp2" class="form-text">51-100 Orang
                                    </div>
                                </div>
                                <div
                                    class="form-check form-check-inline flex-grow-1 text-center">
                                    <input class="form-check-input" type="radio"
                                        name="dampak" id="dampak3" value="3"
                                        required>
                                    <label class="form-check-label"
                                        for="dampak3">Tinggi</label>
                                    <div id="durasiHelp3" class="form-text">>100 Orang
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Durasi Pekerjaan -->
                        <div class="fv-row mb-7">
                            <label for="durasi_pekerjaan" class="form-label">Durasi
                                Pekerjaan</label>
                            <input type="number" class="form-control"
                                id="durasi_pekerjaan" name="durasi_pekerjaan" required>
                            <div id="durasiHelp" class="form-text">Silahkan masukkan
                                per-hari</div>
                        </div>
                        <!-- SDM -->
                        <div class="fv-row mb-7">
                            <label for="sdm" class="form-label">SDM</label>
                            <input type="number" class="form-control" id="sdm"
                                name="sdm" required>
                            <div id="jumlah_pengaduanHelp" class="form-text">Silahkan
                                Masukkan jumlah orang yang bekerja</div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm"
                            data-kt-laporan_spk-modal-action="submit">
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