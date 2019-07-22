<?php

$fs = hasConID($_GET['id'],'music');
if ($fs) PVPlus(['id' => $_GET['id']],'music');

 ?>

<link rel="stylesheet" href="https://unpkg.com/aplayer@1.10.1/dist/APlayer.min.css">
<div class="p-4 m-4">
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
  <div id="preview"></div>
  <div id="APlayer" class="mb-4 mt-4"></div>
  <div class="mt-2 text-center">
    <button type="button" class="btn btn-primary mr-2" id="LIKE"> <span class="czs czs-star"></span> 点赞</button>
    <button type="button" class="btn btn-primary mr-2" id="SHARE"> <span class="czs czs-share"></span> 分享</button>
    <button type="button" class="btn btn-primary" disabled> <span class="czs czs-download-l"></span> 下载</button>
  </div>
</div>
<script src="https://unpkg.com/aplayer"></script>
<script type="text/javascript">
  let musicArray = <?php echo json_encode($content['url']) ?>,
      decodeArr = [],
      cover = <?php echo $content['cover'] ?>;
  musicArray.forEach(item=> {
    decodeArr.push({
      name: item.title,
      url: item.url,
      cover: item.cover ? item.cover : cover
    })
  })
  console.log(decodeArr)
  const ap = new APlayer({
    container: document.getElementById('APlayer'),
    audio: decodeArr
  });
</script>
