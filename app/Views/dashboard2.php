<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?= $title ?></title>
  <meta name="description" content="">
  <meta name="keywords" content="">
  <link href="assets/dash/img/amb-logo.png" rel="icon">

  <link href="assets/dash/img/amb-logo.png" rel="apple-touch-icon">
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <link href="assets/dash/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/dash/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/dash/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/dash/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/dash/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/dash/css/main.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <style>
.swiper {
      width: 100%;
      max-width: 1000px;
      padding-top: 50px;
      padding-bottom: 50px;
    }

    .swiper-slide {
      background: #fff;
      border-radius: 10px;
      width: 300px; 
      height: 300px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 22px;
      font-weight: bold;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
    .swiper-slide img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 10px;
      display: block;
    }
    .slide-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), rgba(0,0,0,0.4));
        z-index: 1;
    }
    .slide-caption {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 2;
    color: white;
    padding: 10px 20px;
    font-size: 25px;
    font-weight: bold;
    text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.10);
    border-radius: 8px;
    }

</style>

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="<?=base_url('/')?>" class="logo d-flex align-items-center me-auto me-lg-0">
        <h1 class="sitename">AMB</h1>
        <span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Beranda<br></a></li>
          <li><a href="#about">Tentang</a></li>
          <li><a href="#services">Layanan</a></li>
          <li><a href="#contact">Kontak</a></li>
          <li><a href="/Katalog">Katalog</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="<?= base_url('/login') ?>">Login</a>

    </div>
  </header>

  <main class="main">













    <!-- Hero Section -->
    <section id="hero" class="hero section">
      <!-- Background di luar container -->
      <div class="hero-bg"></div>

      <div class="container position-relative">
        <!-- Gambar mobil -->
        <div class="hero-image">
          <img src="assets/dash/img/hero-car.png" alt="Hero Car Image" data-aos="slide-left" data-aos-delay="5  00">
        </div>

        <!-- Teks dan konten -->
        <div class="row justify-content-start text-start" data-aos="fade-up" data-aos-delay="100">
          <div class="col-xl-6 col-lg-8">
            <h2>PT ANUGRAH MOBILINDO BATAM<span>.</span></h2>
            <p>Your Trusted Automotive Partner</p>
          </div>
        </div>

        <!-- Icon box -->
        <div class="row gy-4 mt-5 justify-content-start" data-aos="fade-up" data-aos-delay="200">
          <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <i class="bi bi-bank"></i>
              <h3><a href="">Jual Beli Mobil</a></h3>
            </div>
          </div>
          <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <i class="bi bi-credit-card"></i>
              <h3><a href="">Cash / Credit</a></h3>
            </div>
          </div>
          <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <i class="bi bi-building-add"></i>
              <h3><a href="">Tukar dan Tambah</a></h3>
            </div>
          </div>
        </div>


      </div>
      </div>
    </section>


    <!-- About Section -->
    <section id="about" class="about section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4">
      <div class="col-lg-6 order-1 order-lg-2">
        <img src="https://lh3.googleusercontent.com/p/AF1QipN6yEWumoEN14VvEacdpWmIdeaQjyIs6fZRrf0-=s680-w680-h510-rw" class="img-fluid" alt="Showroom Mobil">
      </div>
      <div class="col-lg-6 order-2 order-lg-1 content">
        <h3>Showroom Mobil Berkualitas & Terpercaya</h3>
        <p class="fst-italic">
          Kami adalah showroom mobil terpercaya yang melayani tukar tambah, jual beli mobil baru dan bekas dengan proses yang cepat dan aman.
        </p>
        <ul>
          <li><i class="bi bi-check2-all"></i> <span>Layanan tukar tambah mobil dengan harga terbaik di pasaran.</span></li>
          <li><i class="bi bi-check2-all"></i> <span>Pembelian dan penjualan mobil berbagai merek dan tipe.</span></li>
          <li><i class="bi bi-check2-all"></i> <span>Proses cepat, transparan, dan didampingi oleh tim profesional kami.</span></li>
        </ul>
        <p>
          Kami berkomitmen memberikan layanan terbaik bagi Anda yang ingin membeli atau menjual mobil. Hubungi kami sekarang dan temukan mobil impian Anda dengan mudah!
        </p>
      </div>
    </div>

  </div>

</section><!-- /About Section -->


    <!-- Clients Section -->
    <!-- <section id="clients" class="clients section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 2,
                  "spaceBetween": 40
                },
                "480": {
                  "slidesPerView": 3,
                  "spaceBetween": 60
                },
                "640": {
                  "slidesPerView": 4,
                  "spaceBetween": 80
                },
                "992": {
                  "slidesPerView": 6,
                  "spaceBetween": 120
                }
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/dash/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section>/Clients Section -->



    <!-- Services Section -->
    <section id="services" class="services section">

  <!-- Section Title -->
  <div class="container section-title" data-aos="fade-up">
    <h2>Layanan Kami</h2>
    <p>Cek Beragam Layanan dari Showroom Kami</p>
  </div><!-- End Section Title -->

  <div class="container">

    <div class="row gy-4">

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="bi bi-car-front-fill"></i>
          </div>
          <a href="" class="stretched-link">
            <h3>Jual Beli Mobil</h3>
          </a>
          <p>Kami melayani penjualan dan pembelian mobil berbagai merek, kondisi baru maupun bekas, dengan harga kompetitif dan proses transparan.</p>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="bi bi-arrow-left-right"></i>
          </div>
          <a href="" class="stretched-link">
            <h3>Tukar Tambah Mobil</h3>
          </a>
          <p>Ingin ganti mobil? Bawa mobil lama Anda dan tukar tambah dengan unit pilihan yang tersedia di showroom kami.</p>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="bi bi-tools"></i>
          </div>
          <a href="" class="stretched-link">
            <h3>Servis & Perawatan</h3>
          </a>
          <p>Layanan servis dan perawatan berkala untuk memastikan mobil Anda tetap dalam kondisi prima dan aman digunakan.</p>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="bi bi-cash-coin"></i>
          </div>
          <a href="" class="stretched-link">
            <h3>Kredit Mobil</h3>
          </a>
          <p>Fasilitas kredit mobil dengan DP ringan dan bunga kompetitif, bekerja sama dengan berbagai leasing terpercaya.</p>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="bi bi-shield-check"></i>
          </div>
          <a href="" class="stretched-link">
            <h3>Garansi & Asuransi</h3>
          </a>
          <p>Kami menyediakan garansi mesin dan paket asuransi kendaraan agar Anda lebih tenang saat berkendara.</p>
        </div>
      </div><!-- End Service Item -->

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
        <div class="service-item position-relative">
          <div class="icon">
            <i class="bi bi-person-lines-fill"></i>
          </div>
          <a href="" class="stretched-link">
            <h3>Konsultasi & Pencarian Mobil</h3>
          </a>
          <p>Belum menemukan mobil impian? Tim kami siap membantu Anda memilih mobil sesuai kebutuhan dan anggaran.</p>
        </div>
      </div><!-- End Service Item -->

    </div>

  </div>

</section><!-- /Services Section -->


    <!-- Call To Action Section -->
    <section id="call-to-action" class="call-to-action section dark-background">

  <img src="assets/dash/img/cta-bg.jpg" alt="Background Showroom">

  <div class="container">
    <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
      <div class="col-xl-10">
        <div class="text-center">
          <h3>Lihat Katalog Mobil Kami</h3>
          <p>Temukan berbagai pilihan mobil berkualitas dari berbagai merek dan tipe, sesuai kebutuhan dan anggaran Anda. Yuk cek sekarang!</p>
         <div class="swiper mySwiper">
          <div class="swiper-wrapper">
            <?php foreach ($mobil as $m): ?>
              <div class="swiper-slide position-relative">
                <img src="<?= base_url('uploads/mobil/' . $m['foto_mobil']) ?>" alt="<?= esc($m['nama_mobil']) ?>" class="slide-image">
                <div class="slide-overlay"></div> 
                <!-- <div class="slide-caption text-center">
                  <?= esc($m['nama_mobil']) ?><br>
                  <small>Rp <?= number_format($m['harga_jual'], 0, ',', '.') ?></small>
                </div> -->
              </div>
            <?php endforeach; ?>
          </div>
        </div>



          <a class="cta-btn" href="<?=base_url('/Katalog')?>">Lihat Katalog</a>
        </div>
      </div>
    </div>
  </div>

</section><!-- /Call To Action Section -->
<!-- /Call To Action Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

  <div class="container" data-aos="fade-up" data-aos-delay="100">

    <div class="row gy-4 align-items-center justify-content-between">

      <div class="col-lg-5">
        <img src="https://lh3.googleusercontent.com/gps-cs-s/AC9h4nrzo-60gGumi0RM762jldm7hcT5CJIzcARRqBcokRjm2DSPVSr0E61YflPsZyDfidVUjrbfzvzscAVvOc6x8k2u2g9HK-FBj8s5javQRcEg1_O4ffJGeiRdjLO4Cr8dTOJ8CI_U9Q=s680-w680-h510-rw" alt="" class="img-fluid">
      </div>

      <div class="col-lg-6">

        <h3 class="fw-bold fs-2 mb-3">Statistik Kepercayaan Showroom Kami</h3>
        <p>
          Dengan pengalaman bertahun-tahun di dunia otomotif, kami terus berkembang dan dipercaya oleh banyak pelanggan. Berikut data statistik kami:
        </p>

        <div class="row gy-4">

          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-people flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="40" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p><strong>Pegawai Profesional</strong> <span>Siap melayani Anda dengan ramah dan ahli</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-car-front flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="120" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p><strong>Mobil Tersedia</strong> <span>Berbagai tipe dan merek siap dipilih</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-person-check flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="850" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p><strong>Pembeli Puas</strong> <span>Telah mempercayakan pembelian mobil kepada kami</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-6">
            <div class="stats-item d-flex">
              <i class="bi bi-star-fill flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="98" data-purecounter-duration="1"
                  class="purecounter"></span>
                <p><strong>Tingkat Kepercayaan (%)</strong> <span>Dari review dan feedback pelanggan</span></p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </div>

  </div>

</section><!-- /Stats Section -->
<!-- /Stats Section -->



    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.028921412961!2d104.0010282!3d1.1397681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d98be2d4b234a5%3A0xd086216d95f76f3a!2sPT%20ANUGRAH%20MOBILINDO%20BATAM!5e0!3m2!1sid!2sid!4v1750819664655!5m2!1sid!2sid"
            frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Alamat</h3>
                <p>Komp. Golden Gate blok B no 1, Batu Selicin, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Hubungi Kami</h3>
                <p><a href="https://wa.me/6282384144951?text=Halo%2C%20saya%20tertarik%20dengan%20mobil%20Anda" target="_blank">Jefri : +62 823 8414 4951</a></p>
                <p><a href="https://wa.me/6285272272229?text=Halo%2C%20saya%20tertarik%20dengan%20mobil%20Anda" target="_blank">Dany Lim : +62 852 7227 2229</a></p>
              </div>
            </div>

          </div>

          <div class="col-lg-8">
            <form action="Home/contact" method="post" class="php-email-form" data-aos="fade-up"
              data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>























  <footer id="footer" class="footer dark-background">

    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6 footer-about">
            <a href="index.html" class="logo d-flex align-items-center">
              <span class="sitename">AMB</span>
            </a>
            <div class="footer-contact pt-3">
              <p>Komp. Golden Gate blok B no 1, Batu Selicin, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444</p>
              
              <p class="mt-3"><strong>Phone:</strong> <span>Jefri : +62 823 8414 4951</span><br><span>Dany Lim : +62 852 7227 2229</span></p>
            </div>
            <div class="social-links d-flex mt-4">
              <a href=""><i class="bi bi-twitter-x"></i></a>
              <a href=""><i class="bi bi-facebook"></i></a>
              <a href=""><i class="bi bi-instagram"></i></a>
              <a href=""><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-md-3 footer-links">
            <h4>Tautan Lompatan</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#hero"> Beranda</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#about"> Tentang</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services"> Layanan</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#contact"> Kontak</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="/Katalog"> Katalog</a></li>
            </ul>
          </div>


          <div class="col-lg-4 col-md-12 footer-newsletter">
            <h4>Berita Terbaru</h4>
            <p>Langganan untuk informasi terbaru dari kami!</p>
            <form action="Home/newsletter" method="post" class="php-email-form">
              <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe">
              </div>
              <div class="loading">Loading</div>
              <div class="error-message"></div>
              <div class="sent-message">Your subscription request has been sent. Thank you!</div>
            </form>
          </div>

        </div>
      </div>
    </div>


  </footer>


  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>
  <div id="preloader"></div>
  <script src="assets/dash/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/dash/vendor/php-email-form/validate.js"></script>
  <script src="assets/dash/vendor/aos/aos.js"></script>
  <script src="assets/dash/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/dash/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/dash/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/dash/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/dash/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/dash/js/main.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

  <script>
    const swiper = new Swiper(".mySwiper", {
      effect: "coverflow",
      grabCursor: true,
      centeredSlides: true,
      slidesPerView: "auto",
      spaceBetween: 30,
      coverflowEffect: {
        rotate: 30,
        stretch: 0,
        depth: 100,
        modifier: 1,
        slideShadows: true,
      },
      autoplay: {
        delay: 3000, 
        disableOnInteraction: false, 
      },
      loop: true,
    });


</script>

</body>

</html>