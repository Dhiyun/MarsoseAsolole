@extends('user.layouts.template')
@section('title', 'Marsose | Buat Laporan Warga')

@section('content')
    <h1 class="mb-5 text-center fw-bold">Buat Laporan Warga</h1>
    <div class="card shadow keluhan">
        <div class="card-body p-lg-17">
            <form method="POST" class="form" action="{{ route('user-laporan.store') }}" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger mb-8">{{ $errors->first() }}</div>
                @endif

                <div class="d-flex flex-column mb-8">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="judul">
                        <span class="required">Judul</span>
                    </label>
                    <input id="judul" class="form-control" name="judul" value="{{ old('judul') }}"
                        placeholder="Contoh: Lampu jalan mati di depan pos ronda" />
                </div>
                <div class="d-flex flex-column mb-8 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2">
                        <span class="required">Jenis Laporan</span>
                        <span class="ms-1" data-bs-toggle="tooltip"
                            title="Pilih kategori yang paling sesuai dengan masalah yang dilaporkan">
                            <i class="ki-outline ki-information fs-7"></i>
                        </span>
                    </label>
                    <select name="jenis_laporan" data-control="select2" data-placeholder="Pilih Jenis Laporan..."
                        class="form-select">
                        <option value="Infrastruktur" {{ old('jenis_laporan') == 'Infrastruktur' ? 'selected' : '' }}>
                            Infrastruktur</option>
                        <option value="Keamanan" {{ old('jenis_laporan') == 'Keamanan' ? 'selected' : '' }}>Keamanan
                        </option>
                        <option value="Kesehatan" {{ old('jenis_laporan') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan
                        </option>
                        <option value="Lingkungan" {{ old('jenis_laporan') == 'Lingkungan' ? 'selected' : '' }}>Lingkungan
                        </option>
                        <option value="Layanan Masyarakat"
                            {{ old('jenis_laporan') == 'Layanan Masyarakat' ? 'selected' : '' }}>Layanan Masyarakat</option>
                    </select>
                </div>
                <div class="d-flex flex-column mb-8">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="keterangan">
                        <span class="required">Deskripsi/Keterangan</span>
                    </label>
                    <textarea id="keterangan" class="form-control" rows="4" name="keterangan"
                        placeholder="Ceritakan masalahnya, lokasi tepatnya, dan sejak kapan terjadi">{{ old('keterangan') }}</textarea>
                </div>
                <div class="d-flex flex-column mb-5 fv-row">
                    <label class="d-flex align-items-center fs-6 fw-semibold mb-2" for="gambar">
                        <span class="required">Gambar</span>
                    </label>
                    <label class="pilih-file">
                        <input id="gambar" type="file" name="gambar" class="visually-hidden" accept=".png, .jpg, .jpeg, .gif"
                            onchange="this.parentElement.querySelector('.pilih-file-nama').textContent = this.files.length ? this.files[0].name : 'Belum ada gambar dipilih'" />
                        <span class="pilih-file-tombol">
                            Pilih Gambar
                        </span>
                        <span class="pilih-file-nama">Belum ada gambar dipilih</span>
                    </label>
                    <div class="form-text">Catatan: Pastikan gambar bukti yang diunggah jelas dan mudah dibaca, tersedia
                        dalam format JPG, PNG, atau GIF.</div>
                </div>
        </div>
        <div class="button-container mt-3">
            <button type="submit" class="btn me-5 save-l">Save</button>
            <a href="{{ route('user-laporan.index') }}" class="btn cancel-l">Cancel</a>
        </div>
        </form>
    </div>
    </div>

@endsection
