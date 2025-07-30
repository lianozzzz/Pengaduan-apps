<!DOCTYPE html>
<html lang="zxx">
<head>
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
   <title>Cyber Chip | Home</title>

   <!-- Styles -->
   <link rel="stylesheet" href="{{ asset('template/assets/css/animate.css') }}">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
   <link rel="stylesheet" href="{{ asset('template/assets/bootstarp/bootstrap.min.css') }}">
   <link rel="stylesheet" href="{{ asset('template/assets/css/super-classes.css') }}">
   <link rel="stylesheet" href="{{ asset('template/assets/css/style.css') }}">
   <link rel="stylesheet" href="{{ asset('template/assets/css/mobile.css') }}">
</head>
<body>

<!-- Header and Banner -->
<div class="header-and-banner-con w-100">
   <div class="header-and-banner-inner-con overlay-content">
      <header>
         <!-- Navbar -->
         <div class="container">
            <div class="header-con">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <a class="navbar-brand p-0" href="/">
                     <img src="{{ asset('template/assets/logo/logo-polseknobk.png') }}" width="80px" alt="logo-img" class="img-fluid">
                  </a>
                  <button class="navbar-toggler p-0 collapsed" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
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
                  <div class="col-lg-7 col-md-7 d-flex justify-content-center flex-column banner-main-left-con">
                     <div class="banner-left-con wow slideInLeft">
                        <div class="banner-heading">
                           <h1>"Satu Klik untuk Suara Anda Didengar!"</h1>
                        </div>
                        <div class="banner-content">
                           <p class="col-lg-11 p-0">Bukan sekadar laporan. Ini tentang kepedulian kita bersama menjaga Bukit Kapur tetap aman.</p>
                        </div>
                        <div class="banner-btn">
                           <a href="{{ route('login') }}" class="contact-btn">Sampaikan Pengaduan Sekarang</a>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-5 col-md-5">
                     <div class="banner-right-con wow slideInRight">
                        <figure class="mb-0">
                           <img src="{{ asset('template/assets/images/slider-item-img1.png') }}" alt="banner image" class="img-fluid">
                        </figure>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
   </div>
</div>

<!-- Slider Section -->
<section>
   <div class="slider-con w-100">
      <div class="container">
         <div class="slider-heading text-center">
            <h5>"Jangan diam Laporkan"</h5>
            <h2>Mulai dari sekarang keamanan lingkungan bukan cuma tugas polisi tapi tugas kita semua.</h2>
         </div>
         <div class="row wow fadeInUp">
            @for ($i = 1; $i <= 6; $i++)
            <div class="col-lg-2 col-md-4 col-6">
               <div class="partner-box text-center mb-lg-0 mb-4">
                  <figure class="mb-0">
                     <img src="{{ asset('template/assets/images/slider-item-img' . $i . '.png') }}" alt="slider-img-{{ $i }}" class="img-fluid">
                  </figure>
               </div>
            </div>
            @endfor
         </div>
      </div>
   </div>
</section>

<!-- Information Section -->
<section>
   <div class="informationmain-con dots-left-img w-100">
      <div class="container overlay-content">
         <div class="row">
            <div class="col-lg-6 col-md-6 informationmain-left-con">
               <div class="informationmainleft-sec-img wow slideInLeft">
                  <figure class="mb-0">
                     <img src="{{ asset('template/assets/logo/logo-polseknobk.png') }}" alt="logo-polseknobk">
                  </figure>
               </div>
            </div>
            <div class="col-lg-6 col-md-6 informationmain-right-con wow slideInRight">
               <div class="informationmain-right-heading">
                  <h5>Kami adalah</h5>
                  <h2>Polsek Bukit Kapur</h2>
               </div>
               <div class="informationmain-right-content">
                  <p>Polsek Bukit Kapur merupakan bagian integral dari Kepolisian Resor (Polres) Dumai...</p>
                  <p>Seiring dengan perkembangan wilayah dan peningkatan kebutuhan...</p>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Footer -->
<section>
   <div class="weight-footer-main-con bg-overly-img">
      <div class="footer-con">
         <div class="container overlay-content">
            <div class="row">
               <div class="col-lg-12">
                  <div class="footer-con text-center">
                     <p>&copy; 2025 Polsek Bukit Kapur. All Rights Reserved.</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>

<!-- Scripts -->
<script src="{{ asset('template/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('template/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('template/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('template/assets/js/wow.js') }}"></script>
<script src="{{ asset('template/assets/js/custom-script.js') }}"></script>
<script>
   new WOW().init();
</script>

</body>
</html>
