<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>MARSOSE - Citizen's Report Site</title>

  <!-- LOGO -->
  <link href="assets/img/Favicon Marsose.svg" rel="icon" >

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/styleLP.css" rel="stylesheet">

</head>

<body>
  <!-- ======= Header ======= -->
  @include('landing_page.header')

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">
          <h3 data-aos="fade-up">Selamat datang!</h3>
          <h1 data-aos="fade-up">Warga RW 03</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Marsose merupakan platform yang untuk menampung segala keluhanmu di RW 3 Kelurahan Kesatrian, Kecamatan Blimbing, Kota Malang. Tunggu apa
            lagi?</h2>
          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#about" class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Get Started</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/Click here.gif" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    @include('landing_page.about')

    <!-- ======= Jenis Laporan ======= -->
    <section id="values" class="values">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>Jenis-jenis</h2>
          <p>Laporan Pengaduan</p>
        </header>
        <div class="row">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="assets/img/kategori/bridge construction-amico.svg" class="img-fluid" alt="">
              <h3>Infratruktur</h3>
              <p>Pengaduan terkait dengan kondisi jalan, saluran air, penerangan jalan, fasilitas umum, dan lain-lain.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="assets/img/kategori/Security On-bro.svg" class="img-fluid" alt="">
              <h3>Keamanan</h3>
              <p>Pengaduan terkait dengan keamanan lingkungan, tindak kriminal, dan gangguan ketertiban umum.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/kategori/Medical care-amico.svg" class="img-fluid" alt="">
              <h3>Kesehatan</h3>
              <p>Pengaduan terkait dengan layanan kesehatan, kebersihan lingkungan, dan penanggulangan penyakit.</p>
            </div>
          </div>

        </div>

        <div class="row mt-4 justify-content-center align-items-center">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="800">
            <div class="box">
              <img src="assets/img/kategori/Environmental audit-amico.svg" class="img-fluid" alt="">
              <h3>Lingkungan</h3>
              <p>Pengaduan terkait dengan kerusakan atau pencemaran lingkungan, penghijauan, dan masalah ekologi lainnya.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="1000">
            <div class="box">
              <img src="assets/img/kategori/Customer relationship management.gif" class="img-fluid" alt="">
              <h3>Layanan Masyarakat</h3>
              <p>Pengaduan terkait dengan pelayanan administrasi, fasilitas pendidikan, dan pelayanan sosial lainnya.</p>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Values Section -->

    <!-- ======= Laporan Section ======= -->
    @include('landing_page.laporan')

    <!-- ======= Pricing Section ======= -->
    @include('landing_page.surat')

    <!-- ======= Galery Section ======= -->
    @include('landing_page.galery')

    <!-- ======= Team Section ======= -->
    @include('landing_page.team')
    
    

    <!-- ======= Support Section ======= -->
    <section id="clients" class="clients">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Supported by</h2>
          <p>Thanks for</p>
        </header>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper justify-content-center align-items-center">
            <div class="swiper-slide"><span><H6>RW 03 Kelurahan Kesatrian, Kecamatan Blimbing</H6></span></div>  
            <div class="swiper-slide"><img src="assets/img/support/kota_malang.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/support/polinema.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/support/jti_polinema.png" class="img-fluid" alt=""></div>  
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </section><!-- End Support Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Kontak</h2>
          <p>Hubungi Kita</p>
        </header>

        <div class="row gy-4">
          <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="info-box d-flex flex-column justify-content-center align-items-center shadow-sm p-3 mb-5 bg-body rounded">
              <i class="bi bi-telephone"></i>
              <h3>Kontak Whatsapp</h3>
              <p>+62 877 7046 7527<br>+62 851 0155 2315</p>
            </div>
            <div class="info-box mt-4 d-flex flex-column justify-content-center align-items-center shadow-sm p-3 mb-5 bg-body rounded">
              <i class="bi bi-clock"></i>
              <h3>Jam Kerja RT/RW</h3>
              <p>Setiap Hari</p>
              <p>7:00AM - 05:00PM</p>
            </div>
          </div>
          <div class="col-md-8 shadow-sm p-3 mb-5 bg-body rounded" data-aos="fade-up" data-aos-delay="300">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3951.2218203887423!2d112.64057307937847!3d-7.976011271548345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd628474ea2985f%3A0x1a1513478579a578!2sJl.%20Marsose%2C%20Kesatrian%2C%20Kec.%20Blimbing%2C%20Kota%20Malang%2C%20Jawa%20Timur!5e0!3m2!1sen!2sid!4v1716035912149!5m2!1sen!2sid" frameborder="0" style="border:0; width: 100%; height: 100%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        

      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('landing_page.footer')

</body>
</html>