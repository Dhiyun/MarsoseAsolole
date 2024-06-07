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
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-laporan_spk-modal-action="close">
                    <i class="ki-outline ki-cross fs-1"></i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form action="{{ route('laporan_spk.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="id_alternatif" class="form-label">Alternatif</label>
                        <select name="id_alternatif" id="id_alternatif" class="form-select">
                            @foreach($alternatifs as $alternatif)
                                <option value="{{ $alternatif->id_alternatif }}">{{ $alternatif->laporanPengaduan->judul }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    @foreach($kriterias as $kriteria)
                    @if ($kriteria->nama_kriteria == 'Dampak')
                    <div class="mb-3">
                        <label for="{{ $kriteria->nama_kriteria }}" class="form-label">Dampak</label>
                        <select name="{{ $kriteria->nama_kriteria }}" id="{{ $kriteria->nama_kriteria }}" class="form-select">
                            <option value="" disabled selected>-- Pilih Dampak --</option>
                            @foreach ($detail as $d)
                            @if ($d->kriteria->nama_kriteria == 'Dampak')
                                <option value="{{ $d->rentang }}">{{ $d->rentang }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @elseif ($kriteria->nama_kriteria == 'Jenis_Laporan')
                    <div class="mb-3">
                        <label for="{{ $kriteria->nama_kriteria }}" class="form-label">Jenis Laporan</label>
                        <select name="{{ $kriteria->nama_kriteria }}" id="{{ $kriteria->nama_kriteria }}" class="form-select">
                            <option value="" disabled selected>-- Pilih Jenis Laporan --</option>
                            @foreach ($detail as $d)
                            @if ($d->kriteria->nama_kriteria == 'Jenis_Laporan')
                                <option value="{{ $d->rentang }}">{{ $d->rentang }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    @else
                        <div class="mb-3">
                            <label for="{{ $kriteria->nama_kriteria }}" class="form-label">{{ $kriteria->nama_kriteria }}</label>
                            <input type="number" name="{{ $kriteria->nama_kriteria }}" id="{{ $kriteria->nama_kriteria }}" class="form-control" step="0.01" required>
                        </div>
                    @endif
                    @endforeach
                    <button type="submit" class="btn btn-primary">Simpan</button>
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
