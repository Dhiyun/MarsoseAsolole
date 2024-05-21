@extends('user.layouts.template')
@section('title', 'Dashboard')

<style>
    /* Make the image fully responsive */
    .carousel-inner img {
      width: 100%;
      height: 100%;
    }
</style>

@section('content')
<body>
    <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-5" style="background-color: #fff;">
        <div class="my-2 me-5">
            <div class="fs-1 fs-lg-2qx fw-bold mb-2">Selamat Datang, 
                <span class="fw-normal">nama user</span>
            </div>
            <div class="fs-6 fs-lg-5 fw-semibold opacity-75">Laporkan keluhan anda dengan platform marsose</div>
        </div>
        <img src="assets/media/logos/gambar-city.svg" alt="Image Description" class="img-fluid"/>
    </div>

    <!-- Fitur 01-->
    <div class="g-8 me-2 mt-10">
      <h1><b>Fitur</b></h1>
      <p>Marsose memiliki fitur yang menarik</p>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
			<img class="w-80 shadow-1-strong rounded" src="assets/media/icons/surat.svg" alt="" title="" style="margin-left: 100px;">
		</div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <br>
            <p style="font-size: 18px;"><b>Laporan Pengaduan <br>Warga</b></p>
            <p style="font-size: 15px;">Fitur Laporan adalah sarana yang memfasilitasi warga untuk dengan mudah memberikan laporan tentang kejadian di sekitar mereka, menyediakan layanan untuk mengumpulkan informasi tentang situasi terkini.</p>
        </div>
    </div>

    <!-- Fitur 02-->
    <div class="row" style="padding-top: 50px;">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <br>
            <p style="font-size: 18px;"><b>Pengurusan Surat</b></p>
            <p style="font-size: 15px;">Fitur surat adalah sarana yang memfasilitasi warga dalam informasi proses pengurusan surat serta menyediakan berbagai contoh template surat yang dapat digunakan.</p>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
			<img class="w-80 shadow-1-strong rounded" src="assets/media/icons/laporan-warga.svg" alt="" title="" style="margin-left: 100px;">
		</div>
    </div>

    <!-- Alur Laporan Pengaduan -->
    <div class="pt-5">
        <h3>Salah satu platform yang dimiliki Marsose adalah mengenai Laporan Pengaduan Warga</h3>
        <p>Yuk simak beberapa alur yang harus diperhatikan!</p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card me-2" style="border: none; border-radius: 10px;">
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="fw-bold mb-2 text-dark">Alur Laporan Pengaduan Warga</span>
                        <span class="text-muted fw-semibold fs-6">Langkah-langkah membuat laporan:</span>
                    </h3>
                </div>
                <div class="card-body">
                    <div class="timeline-label">
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-info fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-6">Buka Fitur Laporan Warga <br>
                                <span class="text-muted fw-semibold">Akses fitur laporan yang tersedia.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 2</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-6">Isi Formulir Pengaduan <br>
                                <span class="text-muted fw-semibold">Lengkapi formulir dengan detail. Pastikan semua informasi diisi dengan jelas.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 3</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-6">Proses Verifikasi <br>
                                <span class="text-muted fw-semibold">Laporan akan diverifikasi oleh RW untuk menentukan diterima atau ditolak.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 4</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-6">Tindak Lanjut dan Musyawarah <br>
                                <span class="text-muted fw-semibold">Jika diterima, laporan akan dibahas dalam musyawarah dengan RT, RW, dan warga terkait.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 5</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-6">Penyelesaian <br>
                                <span class="text-muted fw-semibold">Setelah musyawarah, tindakan selanjutnya dilakukan untuk menyelesaikan laporan.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Galery -->
    <div class="pt-5 text-center">
        <h3>Galery</h3>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                  <li data-target="#demo" data-slide-to="2"></li>
                </ul>
                
                <!-- The slideshow -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets/media/img/download.jpeg" alt="Download" width="1100" height="500">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/media/img/test.jpeg" alt="Test" width="1100" height="500">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/media/img/haha.jpeg" alt="Haha" width="1100" height="500">
                  </div>
                </div>
                
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>

    <!-- Jenis Surat -->
    <div class="pt-5">
        <h3>Jenis Surat yang dapat diurus melalui Marsose</h3>
        <p>Yuk simak beberapa jenis surat yang dapat diurus melalui Marsose!</p>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card pt-2" style="border: none; border-radius: 10px;">
                <img src="assets/media/icons/icon-sk2.svg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color: #334155; color: #fff; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                    <h3 class="text-white">Surat Keterangan</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/user/surat_keterangan?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light" style="color:#747474; width: 100%; border-radius: 10px;">Lihat Detail</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-3 col-md-6">
            <div class="card pt-2" style="border: none; border-radius: 10px;">
                <img src="assets/media/icons/icon-spr2.svg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color: #334155; color: #fff; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                    <h3 class="text-white">Surat Keterangan</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/user/surat_pengantar?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light" style="color:#747474; width: 100%; border-radius: 10px;">Lihat Detail</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-3 col-md-6">
            <div class="card pt-2" style="border: none; border-radius: 10px;">
                <img src="assets/media/icons/icon-spm2.svg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color: #334155; color: #fff; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                    <h3 class="text-white">Surat Keterangan</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/user/surat_undangan?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light" style="color:#747474; width: 100%; border-radius: 10px;">Lihat Detail</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-3 col-md-6">
            <div class="card pt-2" style="border: none; border-radius: 10px;">
                <img src="assets/media/icons/icon-su2.svg" class="card-img-top" alt="...">
                <div class="card-body" style="background-color: #334155; color: #fff; border-bottom-right-radius: 10px; border-bottom-left-radius: 10px;">
                    <h3 class="text-white">Surat Keterangan</h3>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="/user/surat_pemberitahuan?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light" style="color:#747474; width: 100%; border-radius: 10px;">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection