@extends('user.layouts.template')
@section('title', 'Marsose | Surat-Surat')

@section('content')
<div class="row">
    <div class="col-md-3">

    </div>

    <div class="card pt-2 col-md-9 banner-surat shadow"
        style="background-image: url('assets/media/img/banner-sk.png');">

    </div>
</div>

<main class="container">
    <div class="row">
        <div class="col-md-3 list-menu">
            <button type="button" class="btn">
                <span class="c-surat">Jenis-jenis Surat</span>
            </button>
            @include('user.component.list')
        </div>

        <div class="col-md-9 pt-5">
            <div class="surat-content" data-handbook="surat_keterangan">
                @include('user.component.konten_surat', [
                    'judul' => 'Surat Keterangan',
                    'deskripsi' => 'Surat Keterangan adalah dokumen resmi yang dikeluarkan oleh RT atau RW untuk menyatakan atau menjelaskan suatu keadaan atau fakta tertentu yang diketahui atau disaksikan oleh mereka. Surat ini berfungsi sebagai bukti tertulis untuk keperluan administratif, seperti pengajuan izin atau verifikasi data. Surat Keterangan mencakup informasi pihak terkait, deskripsi keadaan atau peristiwa, serta tanda tangan dan cap resmi dari RT/RW.',
                    'alur' => [
                        'Pemohon datang ke Ketua RT dan RW untuk meminta pengantar RT/RW.',
                        'Pemohon datang ke kelurahan dengan membawa berkas persyaratannya dan mematuhi kebijakan serta norma yang berlaku di lingkungan RT dan RW setempat.',
                        'Surat Keterangan RT dan RW selesai dan dapat digunakan untuk pengurusan administrasi selanjutnya.',
                    ],
                    'templates' => [
                        ['nama' => 'SK Domisili', 'ikon' => 'icon-skdomisili.svg', 'syarat' => ['Fotokopi KTP dan KK.']],
                        ['nama' => 'SK Usaha', 'ikon' => 'icon-skusaha.svg', 'syarat' => ['Fotokopi KTP dan KK pemohon, masing-masing 2 lembar.']],
                        ['nama' => 'SK Tidak Mampu', 'ikon' => 'icon-sktdakmmpu.svg', 'syarat' => ['Fotokopi KTP dan KK.', 'SP Tidak Mampu.']],
                        ['nama' => 'SK Kelakuan Baik', 'ikon' => 'icon-skbbaik.svg', 'syarat' => []],
                        ['nama' => 'SK Meninggal Dunia', 'ikon' => 'icon-skmeninggal.svg', 'syarat' => []],
                    ],
                    'ikonDefault' => 'icon-skdomisili.svg',
                ])
            </div>
        </div>
    </div>
</main>
@endsection
