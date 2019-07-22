<!--
报错信息
by @d1y
 -->
<style media="screen">
  body {
    overflow: hidden;
    width: 100%;
    height: 100%;
  }
</style>
<div style="
  position: fixed;
  z-index: 43999;
  background: rgba(0,0,0,.9);
  width: 100vw;
  height: 100vh;
  left: 0;
  top: 0;
">
    <p class="text-center text-danger m-4" style="font-size: 10rem">
      <?php echo $error_text ?>
    </p>
    <p class="text-center mt-4">
      <a class="text-primary" onclick="window.history.go(-1);return false" href="/">点击返回首页</a>
    </p>
</div>
