<?php

  require_once("./inc/utils.php");

  $title = '/index';
  $flag = false;

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $title ?></title>
  <?php require_once("./templete/header.php"); ?>
</head>
<body>
  <?php include_once('./templete/nav.php') ?>
  <div class="container-fluid">
    <?php if ($FACE): ?>
      <?php header("Location: /page/home") ?>
      <?php include_once('./templete/logged.php'); ?>
    <?php else: ?>
      <?php include_once('./templete/login.php'); ?>
      <div class="text-center">
        <a href="#">→ 游客访问</>
      </div>
    <?php endif; ?>
    <div class="text-center">
      <?php include_once('./templete/footer.php'); ?>
    </div>
  </div>
</body>
<?php require_once("./templete/script.php"); ?>
<?php if (!$FACE): ?>
  <script src="js/login.js"></script>
<?php endif;?>
</html>
