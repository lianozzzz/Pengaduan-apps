<!DOCTYPE html>
<html lang="id">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>Cyber Chip | Home</title>

   <!-- Styles -->
   <link rel="stylesheet" href="public/template/landing/assets/css/animate.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   <link rel="stylesheet" href="public/template/landing/assets/bootstarp/bootstrap.min.css">
   <link rel="stylesheet" href="public/template/landing/assets/css/super-classes.css">
   <link rel="stylesheet" href="public/template/landing/assets/css/style.css">
   <link rel="stylesheet" href="public/template/landing/assets/css/mobile.css">
</head>
<body>

<!-- Header and Banner -->
<div class="header-and-banner-con w-100">
   <div class="header-and-banner-inner-con overlay-content">
      <header>
         <div class="container">
            <div class="header-con">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <a class="navbar-brand p-0" href="/">
                     <img src="public/template/landing/assets/logo/logo-polseknobk.png" width="80" alt="logo-img" class="img-fluid">
                  </a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                     <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link text-white p-0" href="/">Home</a>
                        </li>
                     </ul>
                     <a href="{{ route('login') }}" class="my-2 my-sm-0 contact-btn">Login</a>
                  </div>
               </nav>
            </div>
         </div>
      </header>

      <!-- Banner -->
      <section class="banner-main-con">
         <div class="container">
            <div class="banner-con">
               <div class="row">
                  <div class="col-lg-7 d-flex justify-content-center flex-column">
                     <div class="banner-left-con wow slideInLeft">
                        <h1>"Satu Klik untuk Suara Anda Didengar!"</h1>
                        <p>Bukan sekadar laporan. Ini tentang kepedulian kita bersama menjaga Bukit Kapur tetap aman.</p>
                        <a href="{{ route('login') }}" class="contact-btn">Sampaikan Pengaduan Sekarang</a>
                     </div>
                  </div>
                  <div class="col-lg-5">
                     <div class="banner-right-con wow slideInRight">
                        <img src="public/template/landing/assets/image/slider-item-img1.png" alt="banner image" class="img-fluid">
                     </div>
                  </div><div class="col-lg-5 col-md-5 col-sm-12">
                           <div class="banner-right-con wow slideInRight">
                              <figure class="mb-0">
                                 {{-- <img src="assets/image/banner-right-img.png" alt="banner-right-img"> --}}
                              </figure>
                           </div>
                        </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>

<!-- Slider -->
<section>
   <div class="slider-con w-100">
      <div class="container">
         <div class="slider-heading text-center">
            <h5>"Jangan diam Laporkan"</h5>
            <h2>Mulai dari sekarang keamanan lingkungan bukan cuma tugas polisi tapi tugas kita semua.</h2>
         </div>
         <div class="row wow fadeInUp">
                  <div class="col-lg-2 col-md-4 col-6">
                     <div class="partner-box text-center mb-lg-0 mb-4">
                        <figure class="mb-0">
                           <img src="assets/image/slider-item-img1.png" alt="" class="img-fluid">
                        </figure>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-6">
                     <div class="partner-box text-center mb-lg-0 mb-4">
                        <figure class="mb-0">
                           <img src="assets/image/slider-item-img2.png" alt="" class="img-fluid">
                        </figure>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-6">
                     <div class="partner-box text-center mb-lg-0 mb-4">
                        <figure class="mb-0">
                           <img src="assets/image/slider-item-img3.png" alt="" class="img-fluid">
                        </figure>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-6">
                     <div class="partner-box text-center">
                        <figure class="mb-0">
                           <img src="assets/image/slider-item-img4.png" alt="" class="img-fluid">
                        </figure>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-6">
                     <div class="partner-box text-center">
                        <figure class="mb-0">
                           <img src="assets/image/slider-item-img5.png" alt="" class="img-fluid">
                        </figure>
                     </div>
                  </div>
                  <div class="col-lg-2 col-md-4 col-6">
                     <div class="partner-box text-center">
                        <figure class="mb-0">
                           <img src="assets/image/slider-item-img6.png" alt="" class="img-fluid">
                        </figure>
                     </div>
                  </div>
               </div>
      </div>
   </div>
</section>

<!-- Info -->
<section>
   <div class="informationmain-con w-100">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <img src="public/template/landing/assets/logo/logo-polseknobk.png" alt="logo-polseknobk" class="img-fluid">
            </div>
            <div class="col-lg-6">
               <h5>Kami adalah</h5>
               <h2>Polsek Bukit Kapur</h2>
               <p>Polsek Bukit Kapur merupakan bagian integral dari Kepolisian Resor (Polres) Dumai yang bertugas menjaga keamanan dan ketertiban di wilayah Kecamatan Bukit Kapur, Kota Dumai, Provinsi Riau. Kecamatan Bukit Kapur sendiri berdiri berdasarkan Peraturan Pemerintah Nomor 8 Tahun 1979 tanggal 11 April 1979, yang memekarkan Desa Bagan Besar menjadi dua desa: Desa Bagan Besar dan Desa Bukit Kapur. Kedua desa ini kemudian digabungkan untuk membentuk Kecamatan Bukit Kapur, dengan pusat pemerintahan berlokasi di Desa Bukit Kapur.
                        </p>
                        <p>
                            Seiring dengan perkembangan wilayah dan peningkatan kebutuhan akan penegakan hukum, Polsek Bukit Kapur didirikan untuk melayani masyarakat setempat. Sebagai institusi penegak hukum di tingkat kecamatan, Polsek Bukit Kapur memiliki peran penting dalam pemeliharaan keamanan dan ketertiban masyarakat, penegakan hukum, serta pemberian perlindungan dan pelayanan kepada warga di wilayah hukumnya.
                        </p>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Footer -->
<footer class="bg-dark text-white text-center py-3">
   <p>&copy; 2025 Polsek Bukit Kapur. All Rights Reserved.</p>
</footer>

<!-- Scripts -->
<script src="public/template/landing/assets/js/jquery-3.6.0.min.js"></script>
<script src="public/template/landing/assets/js/popper.min.js"></script>
<script src="public/template/landing/assets/js/bootstrap.min.js"></script>
<script src="public/template/landing/assets/js/wow.js"></script>
<script src="public/template/landing/assets/js/custom-script.js"></script>
<script>new WOW().init();</script>

</body>
</html>