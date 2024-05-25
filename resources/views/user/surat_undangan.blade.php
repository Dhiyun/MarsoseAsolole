@extends('user.layouts.template')
@section('title', 'Marsose | Surat-Surat')

@section('content')
<div class="text-center pt-2">
    <img src="assets/media/logos/marsose.svg" width="100" height="100" alt="...">
</div>

<main class="container">
    <div class="row ml-4 mb-3">
        <div class="col-md-3">
            <button type="button" class="btn">
                <span class="c-surat"> Jenis-jenis Surat</span>
            </button>
            @include('user.component.list')
        </div>

        <!-- Content -->
        <div class="col-md-9 pt-5">
            <div class="tab-content surat-content" data-handbook="surat_undangan" id="v-pills-tabContent">
                <div class="tab-pane show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <h2 class="mb-2" style="font-weight: bold;">Surat Undangan</h2>
                   <p class="mt-2" style="line-height: 32px; font-size: 16px;">
                        Surat Undangan adalah dokumen yang digunakan untuk mengundang seseorang atau sekelompok orang untuk hadir dalam suatu acara atau kegiatan. Tujuannya adalah memberikan informasi resmi tentang acara, termasuk tanggal, waktu, tempat, dan tujuan acara tersebut.
                   </p>
                   <h2 class="mt-5" style="font-weight: bold;">Alur Pengurusan Surat</h2>
                      <table style="border-collapse: separate; border-spacing:0 20px; font-size: 16px;">
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Pemohon harus menyiapkan informasi dasar yang dibutuhkan untuk surat undangan, termasuk;
                                Tujuan Undangan,
                                Tanggal, Waktu, dan Tempat Acara
                                Agenda Acara.</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Pemohon datang ke Ketua RT dan RW untuk meminta undangan.</td>
                          </tr>
                      </table>
                </div>
                <h2 class="mt-5" style="font-weight: bold">Jenis dan Template</h2>
                <ul class="listings__grid" style="padding-left:5px;">
                    <li class="card jenis-surat">
                        <img src="{{ url('assets/img/vscode.png') }}" alt="" class="card__logo" />
                        <p class="card__heading">SU A</p>
                        <p class="syarat">Syarat*</p>
                            <ul class="mt-3">
                                <li class="snk">-</li>
                            </ul>
                            <a href="path/to/xx" download>
                                <button class="btn dwn-surat">Download Template</button>
                            </a>
                    </li>
                    <li class="card jenis-surat">
                        <img src="{{ url('assets/img/logo postman.png') }}" alt="" class="card__logo" />
                        <p class="card__heading">SU B</p>
                        <p class="syarat">Syarat*</p>
                            <ul class="mt-3">
                                <li class="snk">-</li>
                            </ul>
                            <a href="path/to/xx" download>
                                <button class="btn dwn-surat">Download Template</button>
                            </a>
                    </li>
                    <li class="card jenis-surat">
                        <img src="{{ url('assets/img/logo gitlab.png') }}" alt="" class="card__logo" />
                        <p class="card__heading">SU C</p>
                        <p class="syarat">Syarat*</p>
                            <ul class="mt-3">
                                <li class="snk">-</li>
                            </ul>
                            <a href="path/to/xx" download>
                                <button class="btn dwn-surat">Download Template</button>
                            </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</main>
@endsection