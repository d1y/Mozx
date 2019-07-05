<?php

  $rt = $_SERVER["DOCUMENT_ROOT"];
  include_once $rt.'/inc/utils.php';
  $lang = checkLang();
  $title = '/reg';
  $flag = false;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title><?php echo $title ?></title>
    <?php require_once($rt."/templete/header.php") ?>
  </head>
  <body>
    <?php require_once($currentTemp.'nav.php') ?>
    <div class="text-center">
      <div class="" style="background:url('https://i.loli.net/2019/06/27/5d14707ebc36220981.png')"></div>
      <div class="form-signin">
        <img style="user-select: none;" class="mb-4" src="../resources/logo.svg" alt="" width="120" height="120">
        <h3 class="h3 mb-3 font-weight-normal"><?php echo $lang ? '⬇️ 请注册账号' : 'Please sign in' ?></h3>
        <label for="inputUserName" class="sr-only"><?php echo $lang ? '♐️ 账号' : 'username' ?></label>
        <input type="text" id="inputUserName" class="form-control mt-sm-2" placeholder="<?php echo $lang ? '账号' : 'username' ?>" required autofocus>
        <label for="inputPassword" class="sr-only"><?php echo $lang ? '✨ 密码' : 'Password' ?></label>
        <input type="password" id="inputPassword" class="form-control mt-sm-2" placeholder="<?php echo $lang ? '密码' : 'Password' ?>" required>
        <div class="checkbox mb-3">
          <p class="text-muted">将自动生成一个花名,Yo.可修改一次</p>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn" data-type="up"><?php echo $lang ? '👾 注册' : 'Sign up' ?></button>
      </div>
      <?php require_once($rt."/templete/footer.php") ?>
    </div>
  </body>
  <?php require_once($rt."/templete/script.php") ?>
  <script type="text/javascript" src="/js/login.js"></script>
</html>
