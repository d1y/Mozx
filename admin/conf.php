<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/inc/utils.php");
  $lang = checkLang();
  $title = '/conf';
  $flag = true;
  $_type = $_REQUEST['type'];
  if (!$_type) header('Location: conf.php?type=dash');
  $conf = json_decode(file_get_contents('../config.json'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once($currentTemp.'header.php') ?>
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
  <link rel="stylesheet" href="/css/dashboard.css">
</head>

<body>
  <div class="container-fluid">
    <div class="wrapper ">
      <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <div class="logo">
          <a href="/" class="simple-text logo-normal">MOZX</a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="nav-item active  ">
              <a class="nav-link" href="./dashboard.html">
                <i class="material-icons">dashboard</i>
                <p><?php echo $lang ? '仪表盘' : 'Dashboard' ?></p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="./user.html">
                <i class="material-icons">person</i>
                <p><?php echo $lang ? '用户管理' : 'User Profile' ?></p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="./tables.html">
                <i class="material-icons">content_paste</i>
                <p>稿件管理</p>
              </a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" href="./tables.html">
                <i class="material-icons">wallpaper</i>
                <p>主题设置</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            <?php if ($_type == 'dash') { ?>
            <div>
              <p><span class="text-primary">PHP_VERSION: </span> <?php echo PHP_VERSION ?></p>
              <p><span class="text-primary">OS: </span><?php echo PHP_OS ?></p>
              <?php foreach ($conf as $k => $v) { ?>
                <p><?php echo '<span class="text-primary">',$k,':','</span>',$v ?></p>
              <?php } ?>
            </div>
            <?php } else if ($_type == 'user') { ?>
            <div>
              
            </div>
            <?php } else if ($_type == 'post') { ?>
              <p>post</p>
            <?php } else if ($_type == 'diy') { ?>
              <p>diy</p>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>