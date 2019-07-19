<?php
  require_once($_SERVER["DOCUMENT_ROOT"].'/inc/utils.php');
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = true;
  $title = '/zone';
  if (!$FACE || !$_GET['id']) header('Location: /');
  $userInfo = letSQL()->select('user','*',[
    'id' => $_GET['id']
  ])[0];
  $testID = ['author_id' => $_GET['id']];
  function getCount($table = 'videos') {
    return letSQL()->count($table,'*',$testID);
  };
  function genHigh($text) {
    return '<span class="text-primary">' . $text . '</span>';
  }
  function getCAT($table = 'videos') {
    return letSQL()->select($table,'*',$testID);
  };
  $hasID = letSQL()->has('user',[
    'id' => $_GET['id']
  ]);
  $videos = getCAT();
  $musics = getCAT('music');
  $post = getCAT('write');
  function joinArr($arr) {
    if (count($arr) >= 16){
      return array_slice($arr, 0, 16);
    }
    return $arr;
  }
  $goLink = $_GET['go'];
  if (!$goLink) $goLink = 'about';
  $error_text = '该用户不存在,请求失败';
  $log = PVPlus([
    'id'=> $_GET['id']
  ]);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title><?php echo $title ?></title>
  <?php require_once($rt.'header.php') ?>
</head>

<body>
  <?php if (!$hasID) require_once($rt . 'error.php') ?>
  <?php require_once($rt.'nav.php') ?>
  <div class="p-4">
    <nav class="nav nav-pills nav-fill mt-2">
      <a data-go="about" class="nav-item nav-link push <?php echo $goLink == 'about' ? 'active' : '' ?>"
        href="">关于Ta</a>
      <a data-go="videos" class="nav-item nav-link push <?php echo $goLink == 'videos' ? 'active' : '' ?>"
        href="">Ta的视频</a>
      <a data-go="music" class="nav-item nav-link push <?php echo $goLink == 'music' ? 'active' : '' ?>"
        href="">Ta的音乐</a>
      <a data-go="post" class="nav-item nav-link push <?php echo $goLink == 'post' ? 'active' : '' ?>" href="">Ta的文章</a>
    </nav>
    <div class="w-100 overflow-hidden mt-1">
      <div class="push-wrap clearfix mt-2">
        <div class="push-item push_videos collapse <?php echo $goLink == 'about' ? 'show' : '' ?>">
          <div class="text-center card">
            <div class="card-body">
              <p>用户ID: <?php echo genHigh($userInfo['id']) ?></p>
              <p>用户花名: <?php echo genHigh($userInfo['nickname']) ?></p>
              <p>用户名: <?php echo genHigh($userInfo['username']) ?></p>
              <p>创建时间: <?php echo genHigh($userInfo['login']) ?></p>
              <p>用户浏览量: <?php echo genHigh($userInfo['view']) ?></p>
              <p>用户视频个数: <?php echo genHigh(getCount())?> </p>
              <p>用户音乐个数: <?php echo genHigh(getCount('music')) ?></p>
              <p>用户文章个数: <?php echo genHigh(getCount('write')) ?></p>
            </div>
          </div>
        </div>
        <div class="push-item push_music collapse <?php echo $goLink == 'videos' ? 'show' : '' ?>">
          <div class="clearfix">
          <?php foreach(joinArr($videos) as $obj) { ?>
            <div class="small-item fakeDanmu-item">
              <a href="?id=<?php echo $obj['id'] ?>" class="cover">
                <img src=<?php echo $obj['cover'] ?> alt="">
              </a>
              <a href="?id=<?php echo $obj['id'] ?>" class="title" target="_blank">
                <?php echo json_decode($obj['title']) ?>
              </a>
              <div class="meta">
                <span class="play">
                  <i class="czs czs-eye-l"></i>
                  <?php echo json_decode($obj['view']) ?>
                </span>
                <span class="time">
                  <i class="czs czs-time-l"></i>
                  <?php echo date("m-d", strtotime($obj['time'])) ?>
                </span>
              </div>
            </div>
          <?php }?>
          </div>
          <?php if (count($videos) > 16) { ?>
          <div class="text-center">
            <button type="button" class="btn btn-primary">加载更多</button>
          </div>
          <?php } ?>
        </div>
        <div class="push-item push_post collapse <?php echo $goLink == 'music' ? 'show' : '' ?>">
          <div class="clearfix">
          <?php foreach(joinArr($musics) as $obj) { ?>
            <div class="small-item fakeDanmu-item">
              <a href="?id=<?php echo $obj['id'] ?>" class="cover">
                <img src=<?php echo $obj['cover'] ?> alt="">
              </a>
              <a href="?id=<?php echo $obj['id'] ?>" class="title" target="_blank">
                <?php echo json_decode($obj['title']) ?>
              </a>
              <div class="meta">
                <span class="play">
                  <i class="czs czs-eye-l"></i>
                  <?php echo json_decode($obj['view']) ?>
                </span>
                <span class="time">
                  <i class="czs czs-time-l"></i>
                  <?php echo date("m-d", strtotime($obj['time'])) ?>
                </span>
              </div>
            </div>
          <?php }?>
          </div>
          <?php if (count($musics) > 16) { ?>
          <div class="text-center">
            <button type="button" class="btn btn-primary">加载更多</button>
          </div>
          <?php } ?>
        </div>
        <div class="push-item push_post collapse <?php echo $goLink == 'post' ? 'show' : '' ?>">
          <div class="clearfix p-4">
            <div class="article-wrap">
              <?php foreach(joinArr($post) as $obj) {?>
              <div class="article-item">
                <div class="clearfix">
                  <div class="article-content float-left" style="width: 82%">
                    <h2 class="article-title">
                      <a href="#">
                        <?php echo json_decode($obj['title']) ?>
                      </a>
                    </h2>
                    <p class="article-con">
                      <a href="#">
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
              <?php if (count($post) > 5) { ?>
              <div class="text-center">
                <button type="button" class="btn btn-primary">加载更多</button>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once($rt.'footer.php') ?>
</body>
<?php require_once($rt.'script.php') ?>

</html>
