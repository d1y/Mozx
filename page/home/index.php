<?php
  require_once($_SERVER["DOCUMENT_ROOT"].'/inc/utils.php');
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = true;
  $title = '/home';
  if (!$FACE) header('Location: /');
  $videos = randGetIndex([
    'cover',
    'title','tags',
    'view','id',
    'nick','time'
  ]);
  $musics = randGetIndex([
    'cover',
    'title','tags',
    'view','id',
    'time'
  ],'music');
  $posts = randGetIndex([
    'cover',
    'title','tags',
    'view','id',
    'show','nick',
    'time'
  ],'write');
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title><?php echo $title ?></title>
  <?php require_once($rt.'header.php') ?>
</head>

<body>
  <?php require_once($rt.'nav.php') ?>
  <div class="p-4">
    <div class="clearfix headline">
      <i class="icon icon-music"></i>
      <div class="float-left">
        <a href="#" class="name">音乐</a>
        <p class="fire">音乐连接所有人</p>
      </div>
    </div>
    <div class="clearfix">
      <?php foreach ($musics as $k) { ?>
      <div class="small-item fakeDanmu-item">
        <a href="../view/index.php?type=music&id=<?php echo $k['id'] ?>" class="cover">
          <img src=<?php echo $k['cover'] ?> alt="">
        </a>
        <a href="../view/index.php?type=music&id=<?php echo $k['id'] ?>" class="title" target="_blank"><?php echo json_decode($k['title']) ?></a>
        <div class="meta">
          <span class="play">
            <i class="czs czs-eye-l"></i>
            <?php echo $k['view'] ?>
          </span>
          <span class="time">
            <i class="czs czs-time-l"></i>
            <?php echo date("m-d", strtotime($k['time'])) ?>
          </span>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <hr>
  <div class="p-4">
    <div class="clearfix headline">
      <i class="icon icon-douga"></i>
      <div class="float-left">
        <a href="#" class="name">视频</a>
        <p class="fire">音乐现场,搬运合集</p>
      </div>
    </div>
    <div class="clearfix headline">
      <?php foreach($videos as $v) { ?>
      <div class="small-item fakeDanmu-item">
        <a href="../view/index.php?type=videos&id=<?php echo $v['id'] ?>" class="cover">
          <img src=<?php echo $v['cover'] ?> alt="">
        </a>
        <a href="../view/index.php?type=videos&id=<?php echo $v['id'] ?>" class="title" target="_blank"><?php echo json_decode($v['title']) ?></a>
        <div class="meta">
          <span class="play">
            <i class="czs czs-eye-l"></i>
            <?php echo $v['view'] ?>
          </span>
          <span class="time">
            <i class="czs czs-time-l"></i>
            <?php echo date("m-d", strtotime($v['time'])) ?>
          </span>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <hr>
  <!-- <div class="p-4">
    <div class="clearfix headline">
      <i class="icon icon-game"></i>
      <div class="float-left">
        <a href="#" class="name">其他</a>
        <p class="fire">好玩,有关音乐的一切</p>
      </div>
    </div>
    <div class="clearfix headline">
    </div>
  </div> -->
  <div class="p-4">
    <div class="clearfix headline mb-4">
      <i class="icon icon-promote"></i>
      <div class="float-left">
        <a href="#" class="name">知识专栏</a>
        <p class="fire">电子音乐知识普及</p>
      </div>
    </div>
    <div class="clearfix">
      <div class="article-wrap">
        <?php foreach($posts as $obj) {?>
        <div class="article-item">
          <div class="clearfix">
            <div class="article-content float-left" style="width: 82%">
              <h2 class="article-title">
                <a href="../view/index.php?type=post&id=<?php echo $obj['id'] ?>">
                  <?php echo json_decode($obj['title']) ?>
                </a>
              </h2>
              <p class="article-con">
                <a href="../view/index.php?type=post&id=<?php echo $obj['id'] ?>">
                  <?php echo json_decode($obj['show']) ?>
                </a>
              </p>
              <div class="meta-col">
                <span>标签: <u class="text-primary"><?php echo json_decode($obj['tags']) ?></u></span>
                <span>访问量: <u class="text-primary"><?php echo json_decode($obj['view']) ?></u></span>
                <span>喜欢数: <u class="text-primary"><?php echo json_decode($obj['nick']) ?></u></span>
                <span>创建时间: <u class="text-primary"><?php echo date('Y-m-d',strtotime($obj['time'])) ?></u></span>
              </div>
            </div>
            <h2 class="article-img float-left">
              <a href="#" target="_blank" class="article-bgimg">
                <div class="article-cover"
                  style="background-image: url(<?php echo json_decode($obj['cover']) ?>)"></div>
              </a>
            </h2>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <?php require_once($rt.'footer.php') ?>
</body>
<?php require_once($rt.'script.php') ?>

</html>
