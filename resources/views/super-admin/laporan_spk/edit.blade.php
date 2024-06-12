<!--begin::Modal - Edit task-->
<div class="modal fade" id="kt_modal_edit_laporan_spk-{{ $laporan->id_alternatif }}" tabindex="-1" aria-hidden="true">
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
                <form method="POST" id="kt_modal_edit_laporan_spk_form" class="form"
                    action="{{ route('laporan_spk.update', ['id' => $laporan->id_alternatif]) }}">
                    @csrf
                    @method('PUT')
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_edit_laporan_spk_scroll"
                        data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                        data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_edit_laporan_spk_header"
                        data-kt-scroll-wrappers="#kt_modal_edit_laporan_spk_scroll" data-kt-scroll-offset="300px">
                        @foreach ($kriterias as $kriteria)
                            @php
                                $kriteriaFieldName = "Kriteria{$kriteria->id_kriteria}";
                            @endphp
                            <input type="hidden" name="id_alternatif" value="{{ $laporan->id_alternatif }}">
                            @if ($kriteria->nama_kriteria == 'Dampak')
                                <div class="mb-3">
                                    <label for="{{ $kriteria->nama_kriteria }}" class="form-label">Dampak</label>
                                    <select name="{{ $kriteria->nama_kriteria }}" id="{{ $kriteria->nama_kriteria }}"
                                        class="form-select">
                                        <option value="" disabled selected>-- Pilih Dampak --</option>
                                        @foreach ($detail as $d)
                                            @if ($d->kriteria->nama_kriteria == 'Dampak')
                                                <option value="{{ $d->rentang }}"
                                                    {{ $laporan->$kriteriaFieldName == $d->rentang ? 'selected' : '' }}>
                                                    {{ $d->rentang }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @elseif ($kriteria->nama_kriteria == 'Jenis_Laporan')
                                <div class="mb-3">
                                    <label for="{{ $kriteria->nama_kriteria }}" class="form-label">Jenis Laporan</label>
                                    <select name="{{ $kriteria->nama_kriteria }}" id="{{ $kriteria->nama_kriteria }}"
                                        class="form-select">
                                        <option value="" disabled selected>-- Pilih Jenis Laporan --</option>
                                        @foreach ($detail as $d)
                                            @if ($d->kriteria->nama_kriteria == 'Jenis_Laporan')
                                                <option value="{{ $d->rentang }}"
                                                    {{ $laporan->$kriteriaFieldName == $d->rentang ? 'selected' : '' }}>
                                                    {{ $d->rentang }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <div class="mb-3">
                                    <label for="{{ $kriteria->nama_kriteria }}"
                                        class="form-label">{{ $kriteria->nama_kriteria }}</label>
                                    <input type="number" name="{{ $kriteria->nama_kriteria }}"
                                        id="{{ $kriteria->nama_kriteria }}" class="form-control" step="0.01"
                                        value="{{ $laporan->$kriteriaFieldName }}" required>
                                </div>
                            @endif
                        @endforeach
                        <!--begin::Actions-->
                        <div class="text-center pt-15">
                            <button type="submit" class="btn btn-primary btn-sm"
                                data-kt-laporan_spk-modal-action="submit">
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
