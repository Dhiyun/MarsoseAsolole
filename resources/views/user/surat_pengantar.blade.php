@extends('user.layouts.template')
@section('title', 'Marsose | Surat-Surat')

@section('content')
<div class="row">
    <div class="col-md-3">

    </div>

    <div class="card pt-2 col-md-9 banner-surat shadow" style="background-image: url('assets/media/img/banner-sp.png');">
        
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

        <!-- Content -->
        <div class="col-md-9 pt-5">
            <div class="tab-content surat-content" data-handbook="surat_pengantar" id="v-pills-tabContent">
                <div class="tab-pane show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <h2 class="mb-2" style="font-weight: bold;">Surat Pengantar</h2>
                   <p class="mt-2" style="line-height: 32px; font-size: 16px;">
                        Surat Pengantar adalah dokumen yang digunakan untuk mengirimkan permohonan atau merekomendasikan seseorang atau sesuatu kepada pihak lain. Tujuannya adalah untuk memberikan pengantar formal dan menjelaskan maksud dari permohonan atau rekomendasi yang disampaikan. Surat ini mencakup identitas pengirim, penerima, serta informasi yang relevan terkait dengan permohonan atau rekomendasi yang diajukan.
                   </p>
                   <h2 class="mt-5" style="font-weight: bold;">Alur Pengurusan Surat</h2>
                      <table style="border-collapse: separate; border-spacing:0 20px; font-size: 16px;">
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Pemohon datang ke Ketua RT dan RW untuk meminta pengantar RT/RW.</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Pemohon datang ke kelurahan dengan membawa berkas persyaratannya dan mematuhi kebijakan serta norma yang berlaku di lingkungan RT dan RW setempat.</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Surat Pengantar RT dan RW selesai dan dapat digunakan untuk pengurusan administrasi selanjutnya.</td>
                          </tr>
                      </table>
                </div>
                <h2 class="mt-5" style="font-weight: bold">Jenis dan Template</h2>
                <ul class="listings__grid" style="padding-left:5px;">
                    <li class="card jenis-surat">
                        <img src="assets/media/icons/icon-spengantar.svg" alt="" class="card__logo" style="width: 80px; height: 80px;"/>
                        <p class="card__heading">Surat Pengantar</p>
                        <p class="syarat">Syarat*</p>
                            <ul class="mt-3">
                                <li class="snk">-</li>
                            </ul>
                            <a href="path/to/xx" download>
                                <button class="btn dwn-surat" style="width: 30%;">Download Template</button>
                            </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection