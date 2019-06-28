<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/inc/utils.php';
$lang = checkLang();

?>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-lg">
  <a class="navbar-brand" href="#">MOZX</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <?php if ($flag): ?>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="#">主站</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">用户管理</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">后台管理</a>
      </li>
      <li class="nav-item">
        <a href="#" class="nav-link">主题设置</a>
      </li>
      <li class="nav-item dropdown">
       <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         上传
       </a>
       <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="#"># 音乐</a>
         <a class="dropdown-item" href="#"># 视频</a>
         <div class="dropdown-divider"></div>
         <a class="dropdown-item" href="#"># 文章</a>
       </div>
     </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
<!--     <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="搜索">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">搜索</button>
    </form> -->
  </div>
  <?php endif ?>
</nav>
<div>
  <img src="https://i0.hdslb.com/bfs/archive/3329c9f0abfb925ae30441f24d924ad3c19775df.png" alt="">
</div>
