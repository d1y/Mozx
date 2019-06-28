<?php
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = true;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title></title>
  <?php require_once($rt.'header.php') ?>
</head>

<body>
  <?php require_once($rt.'nav.php') ?>
  <div class="container-fluid">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <!-- Required swiper-lazy class and image source specified in data-src attribute -->
          <img data-src="http://lorempixel.com/1400/800/nature/1/" class="swiper-lazy">
          <!-- Preloader image -->
          <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        <div class="swiper-slide">
          <img data-src="http://lorempixel.com/1400/800/nature/2/" class="swiper-lazy">
          <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        <div class="swiper-slide">
          <img data-src="http://lorempixel.com/1400/800/nature/3/" class="swiper-lazy">
          <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        <div class="swiper-slide">
          <img data-src="http://lorempixel.com/1400/800/nature/4/" class="swiper-lazy">
          <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>
        <div class="swiper-slide">
          <img data-src="http://lorempixel.com/1400/800/nature/5/" class="swiper-lazy">
          <div class="swiper-lazy-preloader swiper-lazy-preloader-white"></div>
        </div>

      </div>
      <!-- Add Pagination -->
      <div class="swiper-pagination swiper-pagination-white"></div>
      <!-- Navigation -->
      <div class="swiper-button-next swiper-button-white"></div>
      <div class="swiper-button-prev swiper-button-white"></div>
    </div>
  </div>
  <?php require_once($rt.'footer.php') ?>
</body>
<?php require_once($rt.'script.php') ?>
<script>
   let swiper = new Swiper('.swiper-container', {
     // Enable lazy loading
     lazy: true,
     pagination: {
       el: '.swiper-pagination',
       clickable: true,
     },
     navigation: {
       nextEl: '.swiper-button-next',
       prevEl: '.swiper-button-prev',
     },
   });
 </script>
</html>
