
<!DOCTYPE html>
<html lang="zxx">
   <head>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
      <link rel="stylesheet" href="{{ asset('template/landing') }}/assets/css/animate.css">
      <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
      <link rel="stylesheet" href="{{ asset('template/landing') }}/assets/bootstarp/bootstrap.min.css">
      <link rel="stylesheet" href="{{ asset('template/landing') }}/assets/css/super-classes.css">
      <link rel="stylesheet" href="{{ asset('template/landing') }}/assets/css/style.css">
      <link rel="stylesheet" href="{{ asset('template/landing') }}/assets/css/mobile.css">
      <title>cyber chip | Home</title>
   </head>
   <body>
      <!---header-and-banner-section-->
      <div class="header-and-banner-con w-100">
         <div class="header-and-banner-inner-con overlay-content">
            <header>
               <!--navbar-start-->
               <div class="container">
                  <div class="header-con">
                     <nav class="navbar navbar-expand-lg navbar-light p-0">
                        <a class="navbar-brand p-0" href="/">
                            {{-- logo navbar --}}
                            <img src="{{ asset('template/assets/logo/logo-polseknobk.png') }}" width="80px" alt="logo-img" class="img-fluid">
                            {{-- logo navbar --}}
                        </a>
                        <button class="navbar-toggler p-0 collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                           <ul class="navbar-nav">
                              <li class="nav-item active">
                                 <a class="nav-link text-white p-0" href="/">Home<span class="sr-only">(current)</span></a>
                              </li>
                           </ul>
                           <a href="{{ route('login') }}" class=" my-2 my-sm-0 contact-btn">Login</a>
                        </div>
                     </nav>
                  </div>
               </div>
               <!--navbar-end-->
            </header>
            <section class="banner-main-con">
               <div class="container">
                  <!--banner-start-->
                  <div class="banner-con">
                     <div class="row">
                        <div class="col-lg-7 col-md-7 col-sm-12 d-flex justify-content-center flex-column banner-main-left-con">
                           <div class="banner-left-con wow slideInLeft">
                              <div class="banner-heading">
                                 <h1>"Satu Klik untuk Suara Anda Didengar!"

                                 </h1>
                              </div>
                              <div class="banner-content">
                                 <p class="col-lg-11 pl-0 pr-0">Bukan sekadar laporan. Ini tentang kepedulian kita bersama menjaga Bukit Kapur tetap aman.
                                 </p>
                              </div>
                              <div class="banner-btn">
                                 <a href="{{ route('login') }}" class="contact-btn">Sampaikan Pengaduan Sekarang</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-12">
                           <div class="banner-right-con wow slideInRight">
                              <figure class="mb-0">
                                 {{-- <img src="assets/image/banner-right-img.png" alt="banner-right-img"> --}}
                              </figure>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--banner-end-->
               </div>
            </section>
         </div>
      </div>
      <!---header-and-banner-section-->
      <!---slider-section-->
      <section>
         <div class="slider-con w-100">
            <div class="container">
               <div class="slider-heading text-center">
                  <h5>"Jangan diam Laporkan"
</h5>
                  <h2>Mulai dari sekarang keamanan lingkungan bukan cuma tugas polisi tapi tugas kita semua.
</h2>
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
      <!---slider-section-->
      <!---information-section-->
      <section>
         <div class="informationmain-con dots-left-img w-100">
            <div class="container overlay-content">
               <div class="row">
                  <div class="col-lg-6 col-md-6 col-sm-12 informationmain-left-con">
                     <div class="informationmainleft-sec-img wow slideInLeft">
                        <figure class="mb-0">
                           <img src="{{ asset('template/assets/logo/logo-polseknobk.png') }}" alt="informationmain-left-sec-img">
                        </figure>
                     </div>
                  </div>
                  <div class="col-lg-6 col-md-6 col-sm-12 informationmain-right-con wow slideInRight">
                     <div class="informationmain-right-heading">
                        <h5>Kami adalah</h5>
                        <h2>Polsek Bukit Kapur
                        </h2>
                     </div>
                     <div class="informationmain-right-content">
                        <p>Polsek Bukit Kapur merupakan bagian integral dari Kepolisian Resor (Polres) Dumai yang bertugas menjaga keamanan dan ketertiban di wilayah Kecamatan Bukit Kapur, Kota Dumai, Provinsi Riau. Kecamatan Bukit Kapur sendiri berdiri berdasarkan Peraturan Pemerintah Nomor 8 Tahun 1979 tanggal 11 April 1979, yang memekarkan Desa Bagan Besar menjadi dua desa: Desa Bagan Besar dan Desa Bukit Kapur. Kedua desa ini kemudian digabungkan untuk membentuk Kecamatan Bukit Kapur, dengan pusat pemerintahan berlokasi di Desa Bukit Kapur.
                        </p>
                        <p>
                            Seiring dengan perkembangan wilayah dan peningkatan kebutuhan akan penegakan hukum, Polsek Bukit Kapur didirikan untuk melayani masyarakat setempat. Sebagai institusi penegak hukum di tingkat kecamatan, Polsek Bukit Kapur memiliki peran penting dalam pemeliharaan keamanan dan ketertiban masyarakat, penegakan hukum, serta pemberian perlindungan dan pelayanan kepada warga di wilayah hukumnya.
                        </p>
                        <ul class="mb-0 list">
                           <li></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!---information-section-->
      <!--form-section-->
      <!-- weight-footer-section -->
      <section>
         <div class="weight-footer-main-con bg-overly-img">
            <div class="footer-con">
               <div class="container overlay-content">
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="footer-con text-center">
                           <p>Copyright Polsek Bukit Kapur © 2025. All Rights Reserved.</p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- weight-footer-section -->
      <script src="{{ asset('template/landing') }}/assets/js/wow.js"></script>
      <script>
         new WOW().init();
      </script>
      <script src="{{ asset('template/landing') }}/assets/js/jquery-3.6.0.min.js"> </script>
      <script src="{{ asset('template/landing') }}/assets/js/popper.min.js"> </script>
      <script src="{{ asset('template/landing') }}/assets/js/bootstrap.min.js"> </script>
      <script src="{{ asset('template/landing') }}/assets/js/custom-script.js"> </script>
   </body>
</html>