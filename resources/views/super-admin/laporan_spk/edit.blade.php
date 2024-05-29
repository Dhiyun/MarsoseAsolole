<!--begin::Modal - Edit task-->
<div class="modal fade" id="kt_modal_edit_laporan_spk-{{ $laporan->id_spk }}" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_edit_laporan_spk_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Laporan SPK</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-laporan_spk-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form method="POST" id="kt_modal_edit_laporan_spk_form" class="form" action="{{ route('laporan_spk.update', ['id' => $laporan->id_spk]) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_laporan_spk_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_laporan_spk_header" data-kt-scroll-wrappers="#kt_modal_edit_laporan_spk_scroll" data-kt-scroll-offset="300px">
                        <!-- Jenis Laporan -->
                        <div class="fv-row mb-7">
                            <label for="jenis_laporan" class="form-label">Jenis Laporan</label>
                            <select class="form-select" id="jenis_laporan" name="jenis_laporan" required>
                                <option value="Infrastruktur" {{ $laporan->jenis_laporan == 'Infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                <option value="Keamanan" {{ $laporan->jenis_laporan == 'Keamanan' ? 'selected' : '' }}>Keamanan</option>
                                <option value="Kesehatan" {{ $laporan->jenis_laporan == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                                <option value="Lingkungan" {{ $laporan->jenis_laporan == 'Lingkungan' ? 'selected' : '' }}>Lingkungan</option>
                                <option value="Layanan Masyarakat" {{ $laporan->jenis_laporan == 'Layanan Masyarakat' ? 'selected' : '' }}>Layanan Masyarakat</option>
                            </select>                            
                        </div>
                        <!-- Biaya -->
                        <div class="fv-row mb-7">
                            <label for="biaya" class="form-label">Biaya</label>
                            <input type="number" class="form-control" id="biaya" name="biaya" value="{{ $laporan->biaya }}" required>
                            <div id="biayaHelp" class="form-text">Silahkan masukkan nilai tanpa titik atau koma</div>
                        </div>
                        <!-- Dampak -->
                        <div class="fv-row mb-7">
                            <label for="dampak" class="form-label d-block">Dampak</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dampak" id="dampak1" value="1" {{ $laporan->dampak == 1 ? 'checked' : '' }} required>
                                <label class="form-check-label" for="dampak1">Rendah</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dampak" id="dampak2" value="2" {{ $laporan->dampak == 2 ? 'checked' : '' }} required>
                                <label class="form-check-label" for="dampak2">Medium</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="dampak" id="dampak3" value="3" {{ $laporan->dampak == 3 ? 'checked' : '' }} required>
                                <label class="form-check-label" for="dampak3">Tinggi</label>
                            </div>
                        </div>
                        <!-- Durasi Pekerjaan -->
                        <div class="fv-row mb-7">
                            <label for="durasi_pekerjaan" class="form-label">Durasi Pekerjaan</label>
                            <input type="number" class="form-control" id="durasi_pekerjaan" name="durasi_pekerjaan" value="{{ $laporan->durasi_pekerjaan }}" required>
                            <div id="durasiHelp" class="form-text">Silahkan masukkan per-hari</div>
                        </div>
                        <!-- SDM -->
                        <div class="fv-row mb-7">
                            <label for="sdm" class="form-label">SDM</label>
                            <input type="number" class="form-control" id="sdm" name="sdm" value="{{ $laporan->sdm }}" required>
                            <div id="jumlah_pengaduanHelp" class="form-text">Silahkan masukkan jumlah orang yang bekerja</div>
                        </div>
                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <div class="text-center pt-15">
                        <button type="submit" class="btn btn-primary btn-sm" data-kt-laporan_spk-modal-action="submit">
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