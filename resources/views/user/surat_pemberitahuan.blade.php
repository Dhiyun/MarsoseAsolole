@extends('user.layouts.template')
@section('title', 'Marsose | Surat-Surat')

@section('content')
<div class="row">
    <div class="col-md-3">

    </div>

    <div class="card pt-2 col-md-9 banner-surat shadow"
        style="background-image: url('assets/media/img/banner-spm.png');">

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
            <div class="surat-content" data-handbook="surat_pemberitahuan">
                @include('user.component.konten_surat', [
                    'judul' => 'Surat Pemberitahuan',
                    'deskripsi' => 'Surat Pemberitahuan adalah dokumen yang dibuat oleh RT atau RW untuk menyampaikan informasi penting kepada warga masyarakat tentang suatu hal tertentu. Tujuannya adalah memberikan pengumuman resmi mengenai perubahan kebijakan, informasi keamanan, atau kegiatan komunitas yang relevan.',
                    'alur' => [
                        'RT/RW mengumpulkan informasi yang diperlukan secara lengkap dan akurat.',
                        'RT/RW mengunduh templat surat yang tersedia dan melengkapi isi surat dengan informasi yang telah disiapkan.',
                        'RT/RW menyebarkan surat pemberitahuan kepada seluruh warga di wilayahnya.',
                    ],
                    'templates' => [
                        ['nama' => 'Surat Pemberitahuan', 'ikon' => 'icon-spem.svg', 'syarat' => []],
                    ],
                    'ikonDefault' => 'icon-spem.svg',
                ])
            </div>
        </div>
    </div>
</main>
@endsection
