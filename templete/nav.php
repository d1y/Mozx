<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/inc/utils.php';
$lang = checkLang();
$flag = true;

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
  <a class="navbar-brand" href="#">MOZX</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation"
  style="outline: none;">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php if ($flag): ?>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">主站</a>
      </li>
      <!-- <li class="nav-item">
        <a href="#" class="nav-link">用户管理</a>
      </li> -->
      <!-- <li class="nav-item">
        <a href="#" class="nav-link">后台管理</a>
      </li> -->
      <!-- <li class="nav-item">
        <a href="#" class="nav-link">主题设置</a>
      </li> -->
      <li class="nav-item">
        <a href="#" class="nav-link btn btn-danger text-white pl-4 pr-4 ml-4">投稿</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit" style="margin-right:8px;">登录</button>
      <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">注册</button>
    </div>
  </div>
  <?php endif ?>
</nav>
<div style="position: relative;width: 100vw;overflow: hidden;">
  <div style="
    background: url('https://i.loli.net/2018/12/23/5c1f37317b88a.png');
    position: absolute;
    top:0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 233;
    overflow-x:auto;
  "></div>
  <img src="https://i0.hdslb.com/bfs/archive/3329c9f0abfb925ae30441f24d924ad3c19775df.png" alt="">
</div>
