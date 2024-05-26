@extends('user.layouts.template')
@section('title', 'Marsose | Dashboard')

@section('content')
<body>
    <div class="d-flex flex-stack flex-wrap flex-md-nowrap card-rounded shadow p-8 p-lg-12 mb-5 selamat-datang">
        <div class="my-2 me-5">
            <div class="fs-1 fs-lg-2qx fw-bold mb-2">Selamat Datang, 
                <span class="fw-normal">nama user</span>
            </div>
            <div class="fs-6 fs-lg-5 fw-semibold opacity-75">Marsose: Solusi Cepat untuk Keluhan Anda!</div>
        </div>
        <img src="assets/media/logos/gambar-city.svg" alt="Image Description" class="img-fluid"/>
    </div>

    <!-- Fitur 01-->
    <div class="g-8 me-2 mt-10">
      <h2><b>Fitur</b></h2>
      <p class="p-desk">Dengan fitur-fitur ini, Marsose berkomitmen untuk mempermudah warga dalam mengurus kebutuhan administratif dan melaporkan kejadian di lingkungan RW 03.</p>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
			<img class="w-80 shadow-1-strong rounded" src="assets/media/icons/surat.svg" alt="" title="" style="margin-left: 100px;">
		</div>
        <div class="col-lg-6 col-md-12 col-sm-12">
            <br>
            <p class="p-fitur"><b>Laporan Pengaduan Warga</b></p>
            <p class="p-fiturdesk">Fitur Laporan Pengaduan Warga memungkinkan Anda untuk melaporkan kejadian atau masalah di lingkungan Anda dengan mudah. Dengan antarmuka yang intuitif, Anda dapat mengisi laporan secara cepat dan tepat. Fitur ini juga menyediakan layanan pengumpulan informasi secara real-time, sehingga pihak berwenang dapat segera mengambil tindakan yang diperlukan untuk mengatasi situasi terkini.</p>
        </div>
    </div>

    <!-- Fitur 02-->
    <div class="row" style="padding-top: 50px;">
        <div class="col-lg-6 col-md-12 col-sm-12">
            <br>
            <p class="p-fitur"><b>Pengurusan Surat</b></p>
            <p class="p-fiturdesk">Fitur Pengurusan Surat dirancang untuk memudahkan Anda dalam proses pengurusan surat-menyurat. Melalui fitur ini, Anda dapat mengakses informasi lengkap mengenai prosedur pengurusan berbagai jenis surat, seperti surat pengantar, surat keterangan, dan lainnya. Selain itu, tersedia juga berbagai template surat yang dapat digunakan langsung, sehingga proses pembuatan surat menjadi lebih efisien dan praktis.</p>
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
			<img class="w-80 shadow-1-strong rounded" src="assets/media/icons/laporan-warga.svg" alt="" title="" style="margin-left: 100px;">
		</div>
    </div>

    <!-- Alur Laporan Pengaduan -->
    <div class="pt-5">
        <h2><b>Salah satu fitur unggulan Marsose adalah Laporan Pengaduan Warga</b></h2>
        <p class="p-desk">Yuk, simak alur yang perlu Anda ketahui!</p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card me-2" style="border: none; border-radius: 10px;">
                <div class="card-header align-items-center border-0 mt-4">
                    <h3 class="card-title align-items-start flex-column" style="font-size: 18px;">
                        <span class="fw-bold mb-2 text-dark">Alur Laporan Pengaduan Warga</span>
                        <span class="text-muted fw-semibold fs-5">Langkah-langkah membuat laporan:</span>
                    </h3>
                </div>
                <div class="card-body" style="font-size: 18px;">
                    <div class="timeline-label">
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 1</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-info fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-3">Buka Fitur Laporan Warga <br>
                                <span class="alur">Akses fitur laporan yang tersedia.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 2</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-success fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-3">Isi Formulir Pengaduan <br>
                                <span class="alur">Lengkapi formulir dengan detail. Pastikan semua informasi diisi dengan jelas.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 3</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-danger fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-3">Proses Verifikasi <br>
                                <span class="alur">Laporan akan diverifikasi oleh RW untuk menentukan diterima atau ditolak.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 4</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-primary fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-3">Tindak Lanjut dan Musyawarah <br>
                                <span class="alur">Jika diterima, laporan akan dibahas dalam musyawarah dengan RT, RW, dan warga terkait.</span>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-label fw-bold text-gray-800 fs-5">Step 5</div>
                            <div class="timeline-badge">
                                <i class="fa fa-genderless text-warning fs-1"></i>
                            </div>
                            <div class="fw-bold timeline-content ps-3 fs-3">Penyelesaian <br>
                                <span class="alur">Setelah musyawarah, tindakan selanjutnya dilakukan untuk menyelesaikan laporan.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Galery -->
    <div class="pt-5 text-center">
        <h2><b>Galeri Kegiatan Warga</b></h2>
        <p class="p-desk">Galeri Kegiatan Warga memperlihatkan beragam aktivitas yang sudah dilaksanakan. <br>
            Ayo, telusuri galeri kami dan saksikan bagaimana warga berkontribusi aktif dalam membangun komunitas yang lebih baik!</p>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div id="demo" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ul class="carousel-indicators">
                  <li data-target="#demo" data-slide-to="0" class="active"></li>
                  <li data-target="#demo" data-slide-to="1"></li>
                  <li data-target="#demo" data-slide-to="2"></li>
                  <li data-target="#demo" data-slide-to="3"></li>
                  <li data-target="#demo" data-slide-to="4"></li>
                </ul>
                
                <!-- The slideshow -->
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="assets/media/img/laporanWarga-img1.jpg" alt="Image 1" width="1000" height="400">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/media/img/laporanWarga-img2.jpg" alt="Image 2" width="1000" height="400">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/media/img/laporanWarga-img3.jpg" alt="Image 3" width="1000" height="400">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/media/img/laporanWarga-img4.jpg" alt="Image 4" width="1000" height="400">
                  </div>
                  <div class="carousel-item">
                    <img src="assets/media/img/laporanWarga-img5.jpg" alt="Image 5" width="1000" height="400">
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
        <h2><b>Jenis-Jenis Surat</b></h2>
        <p class="p-desk">Yuk simak beberapa jenis surat yang dapat diurus melalui Marsose!</p>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-6">
            <div class="card surat">
                <img src="assets/media/icons/icon-sk2.svg" class="card-img-top" alt="...">
                <div class="card-body content-surat">
                    <h3 class="text-white fw-bold">Surat <br> Keterangan</h3>
                    <p class="card-text text-white fs-6">Surat untuk menyatakan atau menjelaskan suatu keadaan yang diketahui atau disaksikan oleh RT/RW.</p>
                    <a href="/user/surat_keterangan?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light button-detail-surat">Lihat Detail</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-3 col-md-6">
            <div class="card surat">
                <img src="assets/media/icons/icon-spr2.svg" class="card-img-top" alt="...">
                <div class="card-body content-surat">
                    <h3 class="text-white fw-bold">Surat <br> Pengantar</h3>
                    <p class="card-text text-white fs-6">Surat untuk mengantar permohonan atau merekomendasikan seseorang atau sesuatu kepada pihak lain.</p>
                    <a href="/user/surat_pengantar?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light button-detail-surat">Lihat Detail</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-3 col-md-6">
            <div class="card surat">
                <img src="assets/media/icons/icon-su2.svg" class="card-img-top" alt="...">
                <div class="card-body content-surat">
                    <h3 class="text-white fw-bold">Surat <br> Undangan</h3>
                    <p class="card-text text-white fs-6">Surat untuk mengundang seseorang atau sekelompok orang untuk menghadiri suatu acara/kegiatan.</p>
                    <a href="/user/surat_undangan?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light button-detail-surat">Lihat Detail</a>
                </div>
            </div>
        </div>
    
        <div class="col-lg-3 col-md-6">
            <div class="card surat">
                <img src="assets/media/icons/icon-spm2.svg" class="card-img-top" alt="...">
                <div class="card-body content-surat">
                    <h3 class="text-white fw-bold">Surat Pemberitahuan</h3>
                    <p class="card-text text-white fs-6">Surat yang dibuat oleh RT/RW untuk menyampaikan informasi kepada warga masyarakat tentang suatu hal.</p>
                    <a href="/user/surat_pemberitahuan?#v-pills-tabContent" type="button" class="mt-auto btn btn-block btn-light button-detail-surat">Lihat Detail</a>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection