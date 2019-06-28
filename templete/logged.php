<?php

include_once $_SERVER['DOCUMENT_ROOT'] . "/inc/utils.php";

$flex = 'https://i.loli.net/2019/06/27/5d145f4beb3ce73105.png';

$lang = checkLang();
?>


<div class="text-center" style="
  margin-top: 20vh;
">
  <div class="">
    <img src="<?php echo $flex ?>" alt=""
      style="max-width: 80%"
      class="shadow bg-white rounded"
    >
  </div>
  <p class="mt-3 text-success">
    - <span><?php echo ($lang ? '已登录' : 'Logged in') ?></span>
    · 将自动跳转到用户页面 -
  </p>
  <script>
    // window.location.href = '/home'
  </script>
</div>
