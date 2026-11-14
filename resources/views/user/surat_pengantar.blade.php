@extends('user.layouts.template')
@section('title', 'Marsose | Surat-Surat')

@section('content')
<div class="row">
    <div class="col-md-3">

    </div>

    <div class="card pt-2 col-md-9 banner-surat shadow"
        style="background-image: url('assets/media/img/banner-sp.png');">

    </div>
</div>

<main class="container">
    <div class="row">
        <div class="col-md-3 list-menu">
            <button type="button" class="btn">
                <span class="c-surat"> Jenis-jenis Surat</span>
            </button>
            @include('user.component.list')
        </div>

        <div class="col-md-9 pt-5">
            <div class="surat-content" data-handbook="surat_pengantar">
                @include('user.component.konten_surat', [
                    'judul' => 'Surat Pengantar',
                    'deskripsi' => 'Surat Pengantar adalah dokumen yang digunakan untuk mengirimkan permohonan atau merekomendasikan seseorang atau sesuatu kepada pihak lain. Tujuannya adalah untuk memberikan pengantar formal dan menjelaskan maksud dari permohonan atau rekomendasi yang disampaikan. Surat ini mencakup identitas pengirim, penerima, serta informasi yang relevan terkait dengan permohonan atau rekomendasi yang diajukan.',
                    'alur' => [
                        'Pemohon datang ke Ketua RT dan RW untuk meminta pengantar RT/RW.',
                        'Pemohon datang ke kelurahan dengan membawa berkas persyaratannya dan mematuhi kebijakan serta norma yang berlaku di lingkungan RT dan RW setempat.',
                        'Surat Pengantar RT dan RW selesai dan dapat digunakan untuk pengurusan administrasi selanjutnya.',
                    ],
                    'templates' => [
                        ['nama' => 'Surat Pengantar', 'ikon' => 'icon-spengantar.svg', 'syarat' => []],
                    ],
                    'ikonDefault' => 'icon-spengantar.svg',
                ])
            </div>
        </div>
    </div>
</main>
@endsection
