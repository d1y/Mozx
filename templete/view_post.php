<?php

$fs = hasConID($_GET['id'],'write');
if ($fs) PVPlus(['id' => $_GET['id']],'write');
 ?>

<div class="m-4 p-4">
  <h4 class="pb-2"><?php echo json_decode($content['title']) ?> <span class="czs czs-link-l"></span> </h4>
  <div class="text-muted" style="font-size: 80%;">
    <span class="text-primary border border-primary pt-1 pb-1 pl-2 pr-2 rounded">
      <?php echo json_decode($content['tags']) ?>
    </span>
    <span class="ml-3"><?php echo $content['time'] ?></span>
  </div>
  <div class="pt-3 pb-2 text-muted" style="font-size: 75%;">
    <span> <span class="czs czs-star"></span> <?php echo $content['nick'] ?></span>
    <span class="ml-3"> <span class="czs czs-eye"></span> <?php echo $content['view'] ?></span>
    <span class="ml-3"> <span class="czs czs-user"></span> 用户: <a href="#"><?php echo $content['user'] ?></a></span>
  </div>
  <hr>
  <div id="preview"></div>
  <hr>
  <div class="mt-2 text-center">
    <button type="button" class="btn btn-primary mr-2" id="LIKE"> <span class="czs czs-star"></span> 点赞</button>
    <button type="button" class="btn btn-primary mr-2" id="SHARE"> <span class="czs czs-share"></span> 分享</button>
  </div>
</div>
