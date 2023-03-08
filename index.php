<?php
require_once('admin/config/koneksi.php');
require_once('admin/modul/database.php');

$koneksi = new Database($host, $user, $pass, $dbase);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS -->
  <link rel="stylesheet" href="asset/css/style.css">
  <!-- Bootstrap -->
  <link rel="stylesheet" href="asset/css/bootstrap.min.css">
  <!-- AOS -->
  <link rel="stylesheet" href="asset/css/aos.css">
  <!-- Swiper -->
  <link rel="stylesheet" href="asset/css/swiper-bundle.min.css">
  <!-- fancy -->

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">

  <!-- Logo -->
  <link rel="icon" href="asset/img/logotop.svg" type="image/x-icon">
  <title>ngodinG</title>
</head>

<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg bg-light fixed-top" id="navbar">
    <div class="container">
      <a class="navbar-brand" href="#"><img src="asset/img/LogoHeader.svg" alt=""></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="#">Home</a>
          <a class="nav-link" href="#kelas">Kelas Kami</a>
          <a class="nav-link" href="#gallery">Galeri Pengguna</a>
          <a class="nav-link" href="#FAQ">FAQ</a>
          <a><button class="btn-primary">Log in</button></a>
        </div>
      </div>
    </div>
  </nav>

  <!-- Section Home -->
  <section class="Home" id="home">
    <div class="container">
      <!-- <div class="col-4">
        <div class="jumbotron p-5 mb-4 bg-light rounded-3">
            <h1 class="display-5 fw-bold">Custom jumbotron</h1>
            <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron, just like the one in previous versions of Bootstrap. Check out the examples below for how you can remix and restyle it to your liking.</p>
            <button class="btn btn-primary btn-lg" type="button">Example button</button>
        </div>    
      </div> -->
      <div class="row">
        <div class="col-4 atas">
          <h1 class="h1-custom">
            Belajar Coding Lebih Mudah dan Seru!
          </h1>
          <p class="low-emp mt-3 p1" style="width: 50%">
            Perdalam passion-mu bersama mentor-mentor muda membuat
            proses belajarmu lebih fun!
          </p>
          <a href="#"><button class="btn-signup">Sign up</button></a>
        </div>
        <div class="col-7">
          <img class="homeillust" src="asset/img/illust.png" alt="" data-aos="fade-right" data-aos-easing="ease-in-sine"
            data-aos-duration="500">

        </div>
      </div>
    </div>
  </section>

  <!-- Section Class -->
  <section class="freeClass" id="kelas">
    <div class="container">
      <div class="row">
        <div class="col-3">
          <img class="freeillust" src="asset/img/illust3.png" alt="" data-aos="fade-right"
            data-aos-easing="ease-in-sine" data-aos-duration="500">
        </div>
        <div class="col-9">
          <div class="judul">
            <h2>
              Kelas Kami
            </h2>
          </div>
          <div class="slide-container swiper">
            <div class="slide-content">
              <div class="card-wrapper swiper-wrapper">
                <?php
                include 'admin/modul/kelas.php';
                $kelas = new Kelas($koneksi);
                $tampil = $kelas->tampilKelas();
                while ($kel = $tampil->fetch_object()):
                ?>
                <div class="card swiper-slide" data-aos="fade-left" data-aos-easing="ease-in-sine"
                  data-aos-duration="500">
                  <div class="image-content">
                    <span class="overlay"></span>

                    <div class="card-image">
                      <img src="admin/img/cover/<?= $kel->foto; ?>" alt="" class="card-img">
                    </div>
                  </div>

                  <div class="card-content">
                    <h2 class="name">
                      <?= $kel->nama; ?>
                    </h2>
                    <p class="description">
                      <?= $kel->deskripsi; ?>
                    </p>

                    <button class="button">Daftar Sekarang</button>
                  </div>
                </div>
                <?php
                endwhile;
                ?>
              </div>
              <div class="swiper-button-next swiper-navBtn"></div>
              <div class="swiper-button-prev swiper-navBtn"></div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>
  </section>

  <!-- Section Gallery -->
  <section class="gallery" id="gallery">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <!-- Swiper -->
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <?php
              include 'admin/modul/gallery.php';
              $galery = new Gallery($koneksi);
              $tampil = $galery->tampilGallery();
              while ($gal = $tampil->fetch_object()):
              ?>
              <div class="swiper-slide">
                <a href="admin/img/testi/<?= $gal->gambar?>" data-fancybox="group">
                  <img src="admin/img/testi/<?= $gal->gambar; ?>" data-aos="fade-left" data-aos-easing="ease-in-sine"
                    data-aos-duration="500" />
                </a>
              </div>
              <?php
              endwhile;
              ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-scrollbar"></div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
      </div>
  </section>

  <!-- Section FAQ -->
  <section class="FAQ" id="FAQ">
    <div class="FAQ-U">
      <div class="container">
        <div class="row">
          <div class="col-6"><img src="asset/img/illust4.png" alt="" class="illustfaq" data-aos="fade-right"
              data-aos-offset="500" data-aos-easing="ease-in-sine" data-aos-duration="500"></div>
          <div class="col-6 faq-content">
            <div class="deskripsi">
              <h2>FAQ</h2>
            </div>
            <div class="faq-container wrapper">
              <div class="faq-one">
                <!-- faq question -->
                <h1 class="faq-page">Apakah Kelasnya berbayar?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                  <p>Ya, Kelas kami berbayar, akan tetapi kami juga menyediakan kelas gratis untuk pemula.</p>
                </div>
              </div>
              <hr class="hr-line">
              <div class="faq-two">
                <!-- faq question -->
                <h1 class="faq-page">Apakah perlu berlangganan?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                  <p>Tidak, kelas kami adalah one-time purchase, jadi anda hanya perlu membeli sekali dan dapat
                    digunakan seumur hidup.</p>
                </div>
              </div>
              <hr class="hr-line">
              <div class="faq-three">
                <!-- faq question -->
                <h1 class="faq-page">Apakah kelasnya bersertifikat?</h1>
                <!-- faq answer -->
                <div class="faq-body">
                  <p>Ya, tapi sertifikat baru dapat diterima setelah kalian menyelesaikan kelas dan submit projek kalian
                    untuk dinilai para mentor ya!</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-6 kaki">
          <a class="navbar-brand" href="#"><img src="asset/img/LogoHeader.svg" alt=""></a>
          <p>Tingkatkan Skill-mu dan jadilah profesional sekarang!</p>
        </div>
        <div class="col-6 seksifoot">
          <div class="seksi">
            <h5>Social Media
              <nav class="nav flex-column">
                <a href="#">Instagram</a>
                <a href="#">Facebook</a>
                <a href="#">Twitter</a>
              </nav>
            </h5>
          </div>
          <div class="seksi2">
            <h5>Developer
              <nav class="nav flex-column">
                <a href="#">Asset's Sources</a>
                <a href="#">Report Bug</a>
                <a href="#">Developer Team</a>
              </nav>
            </h5>
          </div>
          <div class="seksi3">
            <h5>Forum
              <nav class="nav flex-column">
                <a href="#">General Forum</a>
                <a href="#">Member Forum</a>
              </nav>
            </h5>
          </div>
        </div>
      </div>
    </div>
  </div>





  <!-- JS -->

  <!-- Bootstrap -->
  <script src="asset/js/bootstrap.min.js"></script>
  <script src="asset/js/bootstrap.bundle.min.js"></script>
  <!-- AOS -->
  <script src="asset/js/aos.js"></script>
  <!-- Swiper -->
  <script src="asset/js/swiper-bundle.min.js"></script>

  <!-- JS -->
  <script>AOS.init();</script>
  <script>
    var faq = document.getElementsByClassName("faq-page");
    var i;
    for (i = 0; i < faq.length; i++) {
      faq[i].addEventListener("click", function () {
        /* Toggle between adding and removing the "active" class,
        to highlight the button that controls the panel */
        this.classList.toggle("active");
        /* Toggle between hiding and showing the active panel */
        var body = this.nextElementSibling;
        if (body.style.display === "block") {
          body.style.display = "none";
        } else {
          body.style.display = "block";
        }
      });
    }
  </script>
  <script>
    var swiper = new Swiper(".slide-content", {
      slidesPerView: 3,
      spaceBetween: 25,
      loop: true,
      centerSlide: 'true',
      fade: 'true',
      grabCursor: 'true',
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },

      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        520: {
          slidesPerView: 2,
        },
        950: {
          slidesPerView: 3,
        },
      },
    });
  </script>

  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 1,
      centeredSlides: false,
      slidesPerGroupSkip: 1,
      grabCursor: true,
      keyboard: {
        enabled: true,
      },
      breakpoints: {
        769: {
          slidesPerView: 2,
          slidesPerGroup: 2,
        },
      },
      scrollbar: {
        el: ".swiper-scrollbar",
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
    });
  </script>
  <!-- fancy -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.4.0/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

 <script>
 $('[data-fancybox]').fancybox({
  // Options will go here
  buttons : [
    'close'
  ],
  wheel : false,
  transitionEffect: "slide",
   // thumbs          : false,
  // hash            : false,
  loop            : true,
  // keyboard        : true,
  toolbar         : false,
  // animationEffect : false,
  // arrows          : true,
  clickContent    : false
});
</script>
</body>

</html>