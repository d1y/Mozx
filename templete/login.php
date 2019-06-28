<?php

  include_once $_SERVER['DOCUMENT_ROOT'].'/inc/utils.php';
  $lang = checkLang();

?>

<div class="text-center">
  <div class="" style="background:url('https://i.loli.net/2019/06/27/5d14707ebc36220981.png')"></div>
  <div class="form-signin">
    <img style="user-select: none;" class="mb-4" src="../resources/logo.svg" alt="" width="120" height="120">
    <h3 class="h3 mb-3 font-weight-normal"><?php echo $lang ? '⬇️ 请登录账号' : 'Please sign in' ?></h3>
    <label for="inputUserName" class="sr-only"><?php echo $lang ? '♐️ 账号' : 'username' ?></label>
    <input type="text" id="inputUserName" class="form-control mt-sm-2" placeholder="<?php echo $lang ? '账号' : 'username' ?>" required autofocus>
    <label for="inputPassword" class="sr-only"><?php echo $lang ? '✨ 密码' : 'Password' ?></label>
    <input type="password" id="inputPassword" class="form-control mt-sm-2" placeholder="<?php echo $lang ? '密码' : 'Password' ?>" required>
    <div class="checkbox mb-3">
      <a href="/page/reg.php">👋 未注册?</a> <strong>&nbsp;&nbsp;&nbsp;</strong>
      <a href="" id="forget">🌝 忘记密码?</a>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="btn" data-type="in"><?php echo $lang ? '👾 登录' : 'Sign in' ?></button>
  </div>
</div>
