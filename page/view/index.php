<?php
  require_once($_SERVER["DOCUMENT_ROOT"].'/inc/utils.php');
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = false;
  $title = '/view';
  $type = $_GET['type'];
  $id = $_GET['id'];
  $error_text = '参数不存在';
  if (!$type || !$id) {
    dd($type);
    $hasID = true;
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title><?php echo $title ?></title>
  <?php require_once($rt.'header.php') ?>
</head>

<body>
  <?php if ($hasID) require_once($rt . 'error.php') ?>
  <?php require_once($rt.'nav.php') ?>
  <div class="">
  <?php
    $view = $rt . '/view_';
    switch ($_GET['type']) {
      case 'videos':
        require_once $view . 'videos.php';
        break;
      case 'music':
        require_once $view . 'music.php';
        break;
      case 'post':
        require_once $view . 'post.php';
        break;
      default:
        require_once $rt . 'error.php';
        break;
    }
   ?>
  </div>
  <?php require_once($rt.'footer.php') ?>
</body>
<?php require_once($rt.'script.php') ?>

</html>
