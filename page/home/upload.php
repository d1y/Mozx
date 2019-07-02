<?php 

require_once $_SERVER["DOCUMENT_ROOT"]."/inc/utils.php";
$_type = 'videos';
if ($_GET['go']) $_type = $_GET['go'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>/upload</title>
  <?php require_once($currentTemp.'header.php') ?>
</head>

<body>
  <?php require_once($currentTemp.'nav.php') ?>
  <div class="mt-3 p-4">
    <nav class="nav nav-pills nav-fill">
      <a data-go="videos" class="nav-item nav-link push <?php echo $_type == 'videos' ? 'active' : '' ?>" href="">视频投稿</a>
      <a data-go="music" class="nav-item nav-link push <?php echo $_type == 'music' ? 'active' : '' ?>" href="">音乐投稿</a>
      <a data-go="post" class="nav-item nav-link push <?php echo $_type == 'post' ? 'active' : '' ?>" href="">文章投稿</a>
      <a data-go="music" class="nav-item nav-link disabled" href="#">投稿前阅读 <span class="text-success">FAQ</span></a>
    </nav>
    <img src="https://i.loli.net/2019/07/01/5d19817c830f165269.png" class="pt-2 shadow rounded" style="max-width:100%">
    <hr>
    <div class="w-100 overflow-hidden mt-2">
      <div class="push-wrap clearfix">
        <div class="push-item push_videos collapse <?php echo $_type == 'videos' ? 'show' : '' ?>">
          <?php require_once($currentTemp.'upload_videos.php') ?>
        </div>
        <div class="push-item push_music collapse <?php echo $_type == 'music' ? 'show' : '' ?>">
          <?php require_once($currentTemp.'upload_music.php') ?>
        </div>
        <div class="push-item push_post collapse <?php echo $_type == 'post' ? 'show' : '' ?>">
          <?php require_once($currentTemp.'upload_post.php') ?>
        </div>
      </div>
    </div>
  </div>
  <?php require_once($currentTemp.'footer.php') ?>
  <?php require_once($currentTemp.'script.php') ?>
</body>

</html>