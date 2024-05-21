@extends('user.layouts.template')
@section('title', 'Surat-Surat')

<style>
    html {
	    scroll-behavior: smooth;
    }
</style>

@section('content')
<div class="text-center pt-2">
    <img src="assets/media/logos/marsose.svg" width="100" height="100" alt="...">
</div>

<main class="container">
    <div class="row ml-4 mb-3">
        <div class="col-md-3">
            <button type="button" class="btn"><span style="color: #FF520D; font-weight: bold; background-color: #D9D9D9; 
                border: none; 
                border-radius: 24px; 
                width: 179px; 
                height: 44px; 
                align-items: center; 
                padding: 10px; 
                font-size: 16px;
                justify-content: center; 
                margin-top: -150px;
                margin-left: -65px"> Jenis-jenis Surat</span>
            </button>
            @include('user.component.list')
        </div>

        <!-- Content -->
        <div class="col-md-9 pt-5">
            <div class="tab-content" data-handbook="surat_keterangan" id="v-pills-tabContent">
                <div class="tab-pane show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                   <h2 class="mb-2" style="font-weight: bold;">Surat Keterangan</h2>
                   <p class="mt-2" style="line-height: 32px; font-size: 15px;">
                        Surat keterangan adalah dokumen resmi yang diterbitkan oleh pihak berwenang atau instansi terkait untuk memberikan informasi atau konfirmasi tertulis mengenai suatu hal atau keadaan yang dinyatakan di dalamnya. Surat ini sering digunakan untuk keperluan administratif, legal, atau lainnya yang memerlukan bukti tertulis.
                   </p>
                   <h2 class="mt-5" style="font-weight: bold;">Alur Pengurusan Surat</h2>
                      <table style="border-collapse: separate; border-spacing:0 20px; font-size: 15px;">
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Persiapan Dokumen</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Pengajuan Permohonan</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Proses Administrasi</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Penerbitan Surat Keterangan</td>
                          </tr>
                          <tr>
                              <td><img src="assets/media/icons/point-alur.svg" style="height: 20px; width: 20px; margin-right: 20px;"></td>
                              <td>Pengambilan dan verifikasi kembali</td>
                          </tr>
                      </table>
                </div>
                  <h2 class="mt-5" style="font-weight:bold;"> Template </h2>
                  <button type="button" class="btn" style="border: none; 
                  background: #FF520D; 
                  border-radius: 12px; 
                  width: 220px; 
                  height: 50px;
                  color: white;
                  font-size: 15px; 
                  margin-top: 10px;"><img src="assets/media/icons/icon-download.svg">&nbsp;&nbsp; Download Template</button>
            </div>
        </div>
    </div>
</main>
@endsection