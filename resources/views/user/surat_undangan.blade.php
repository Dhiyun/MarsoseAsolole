@extends('user.layouts.template')
@section('title', 'Marsose | Surat-Surat')

@section('content')
<div class="row">
    <div class="col-md-3">

    </div>

    <div class="card pt-2 col-md-9 banner-surat shadow"
        style="background-image: url('assets/media/img/banner-su.png');">

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
            <div class="surat-content" data-handbook="surat_undangan">
                @include('user.component.konten_surat', [
                    'judul' => 'Surat Undangan',
                    'deskripsi' => 'Surat Undangan adalah dokumen yang digunakan untuk mengundang seseorang atau sekelompok orang untuk hadir dalam suatu acara atau kegiatan. Tujuannya adalah memberikan informasi resmi tentang acara, termasuk tanggal, waktu, tempat, dan tujuan acara tersebut.',
                    'alur' => [
                        'Pemohon menyiapkan informasi dasar untuk surat undangan, yaitu tujuan undangan, tanggal, waktu, dan tempat acara, serta agenda acara.',
                        'Pemohon datang ke Ketua RT dan RW untuk meminta undangan.',
                    ],
                    'templates' => [
                        ['nama' => 'Surat Undangan', 'ikon' => 'icon-sundangan.svg', 'syarat' => []],
                    ],
                    'ikonDefault' => 'icon-sundangan.svg',
                ])
            </div>
        </div>
    </div>
</main>
@endsection
