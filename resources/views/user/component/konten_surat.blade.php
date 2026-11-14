<div class="card surat-card mb-6">
    <div class="card-body">
        <span class="surat-label">Jenis Surat</span>
        <h2 class="surat-judul">{{ $judul }}</h2>
        <p class="surat-deskripsi">{{ $deskripsi }}</p>
    </div>
</div>

<div class="card surat-card mb-6">
    <div class="card-body">
        <h3 class="surat-subjudul">Alur Pengurusan Surat</h3>
        <ol class="alur-surat">
            @foreach ($alur as $langkah)
                <li>
                    <span class="alur-nomor">{{ $loop->iteration }}</span>
                    <span class="alur-teks">{{ $langkah }}</span>
                </li>
            @endforeach
        </ol>
    </div>
</div>

@php
    $suratLain = $surats->reject(fn ($surat) => collect($templates)->pluck('nama')->contains($surat->nama_surat));
@endphp

<div class="card surat-card">
    <div class="card-body">
        <h3 class="surat-subjudul">Template Surat</h3>
        <p class="surat-petunjuk">Unduh template, lengkapi isinya, lalu bawa ke Ketua RT/RW bersama persyaratannya.</p>

        <div class="row">
            @foreach ($templates as $template)
                @php
                    $file = $surats->firstWhere('nama_surat', $template['nama']);
                @endphp
                <div class="col-sm-6 col-xl-4 mb-5 d-flex">
                    <div class="template-card">
                        <img src="{{ asset('assets/media/icons/' . $template['ikon']) }}" alt="" class="template-ikon">
                        <h4 class="template-nama">{{ $template['nama'] }}</h4>
                        <p class="template-syarat-judul">Syarat</p>
                        <ul class="template-syarat">
                            @forelse ($template['syarat'] as $syarat)
                                <li>{{ $syarat }}</li>
                            @empty
                                <li>-</li>
                            @endforelse
                        </ul>
                        @if ($file)
                            <a href="{{ route('file.download', ['id' => $file->id_surat]) }}" class="btn btn-template">Download Template</a>
                        @else
                            <span class="btn btn-template disabled" aria-disabled="true">Template belum tersedia</span>
                        @endif
                    </div>
                </div>
            @endforeach

            @foreach ($suratLain as $surat)
                <div class="col-sm-6 col-xl-4 mb-5 d-flex">
                    <div class="template-card">
                        <img src="{{ asset('assets/media/icons/' . $ikonDefault) }}" alt="" class="template-ikon">
                        <h4 class="template-nama">{{ $surat->nama_surat }}</h4>
                        <p class="template-syarat-judul">Diunggah oleh pengurus RW</p>
                        <ul class="template-syarat">
                            <li>{{ $surat->jenis_surat }}</li>
                        </ul>
                        <a href="{{ route('file.download', ['id' => $surat->id_surat]) }}" class="btn btn-template">Download Template</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
