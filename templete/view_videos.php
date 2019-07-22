<?php

  $fs = hasConID($_GET['id']);
  if ($fs) PVPlus(['id' => $_GET['id']],'videos');
  // dd($id);

 ?>
<style>
  .list-group-item-action {
    border: none;
    background: none;
    border-radius: 20px!important;
  }
  .list-group-item-action.active {
    box-shadow: 0 .5rem 1rem rgba(0,0,0,.15)!important;
  }
</style>
<link rel="stylesheet" href="https://unpkg.com/dplayer@1.25.0/dist/DPlayer.min.css">
<div class="m-4 p-4 row">
  <div class="col-8">
    <h4 class="pb-2"><?php echo json_decode($content['title']) ?> <span class="czs czs-link-l"></span> </h4>
    <div class="text-muted" style="font-size: 80%;">
      <span class="text-primary border border-primary pt-1 pb-1 pl-2 pr-2 rounded">
        <?php echo json_decode($content['tags']) ?>
      </span>
      <span class="ml-3"><?php echo $content['time'] ?></span>
    </div>
    <div class="pt-3 pb-2 text-muted" style="font-size: 75%;">
      <span> <span class="czs czs-star"></span> 点赞数: <?php echo $content['nick'] ?></span>
      <span class="ml-3"> <span class="czs czs-eye"></span> 播放量: <?php echo $content['view'] ?></span>
      <span class="ml-3"> <span class="czs czs-user"></span> 用户: <a href="#"><?php echo $content['user'] ?></a></span>
    </div>
    <div class="iframe-wrap mt-2 mb-2">
      <iframe
        id="Fplayer"
        style="width: 100%; height: 80vh;border:none;"
        src="<?php echo $content['url'][0]->url ?>"
      > </iframe>
      <div id="Dplayer"></div>
    </div>
    <div id="preview" class="markdown-body"></div>
    <div class="mt-2 text-center">
      <button type="button" class="btn btn-primary mr-2" id="LIKE"> <span class="czs czs-star"></span> 点赞</button>
      <button type="button" class="btn btn-primary mr-2" id="SHARE"> <span class="czs czs-share"></span> 分享</button>
      <button type="button" class="btn btn-primary" disabled> <span class="czs czs-download-l"></span> 下载</button>
    </div>
  </div>
  <div class="col-4">
    <div class="bg-light p-2" style="margin-top: 10vh;height: 80vh;">
      <div class="clearfix m-2 mb-3">
        <div class="float-left">视频选集 <span class="czs czs-server"></span></div>
        <div class="float-right text-muted currentNumber">1/<?php echo count($content['url']) ?></div>
      </div>
      <div class="list-group" style="overflow:auto;height: 90%;">
      <?php foreach ($content['url'] as $k => $v) { ?>
        <button
          style="outline: none"
          class="list-btn list-group-item list-group-item-action <?php if ($k == 0) echo 'active' ?>"
          data-number="<?php echo $k ?>"
          data-frame="<?php echo $v->frame ?>"
          data-url="<?php echo $v->url ?>">
          <?php echo $v->title ?>
        </button>
      <?php } ?>
      </div>
    </div>
  </div>
  <?php if ($fs) { ?>
  <script src="https://unpkg.com/dplayer"></script>
  <script>
    if (<?php echo json_decode($content['url'][0]->frame) ?>) {
      document.getElementById('Dplayer').style.display = 'none'
    } else {
      document.getElementById('Fplayer').style.display = 'none'
    }
    const DP = new DPlayer({
      container: document.getElementById('Dplayer'),
      screenshot: true
    });
  </script>
  <?php } ?>
</div>
