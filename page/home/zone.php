<?php
  require_once($_SERVER["DOCUMENT_ROOT"].'/inc/utils.php');
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = true;
  $title = '/home';
  if (!$FACE) header('Location: /');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title><?php echo $title ?></title>
  <?php require_once($rt.'header.php') ?>
</head>

<body>
  <?php require_once($rt.'nav.php') ?>
  <?php require_once($rt.'footer.php') ?>
</body>
<?php require_once($rt.'script.php') ?>

</html>
