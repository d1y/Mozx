<?php
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = true;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title></title>
  <?php require_once($rt.'header.php') ?>
  <style>
    .swiper-container {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #000;
      width: 80%;
      /* Center slide text vertically */
      display: -webkit-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      -webkit-justify-content: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      -webkit-align-items: center;
      align-items: center;
    }

    .swiper-slide:nth-child(2n) {
      width: 60%;
    }

    .swiper-slide:nth-child(3n) {
      width: 40%;
    }
  </style>
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
      <?php for ($i=0;$i<10;$i++) { ?>
      <div class="small-item fakeDanmu-item">
        <a href="#" class="cover">
          <img src="//i2.hdslb.com/bfs/archive/2f5eecaeed1c413e981bdc521ab5627aa981a116.jpg@160w_100h.jpg" alt="">
          <span class="length">03:15</span>
        </a>
        <a href="#" class="title" target="_blank">Adrenalize & MC DL - Endless Affection</a>
        <div class="meta">
          <span class="play">
            <i class="czs czs-eye-l"></i>
            4
          </span>
          <span class="time">
            <i class="czs czs-time-l"></i>
            06-26
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
      <?php for ($i=0;$i<10;$i++) { ?>
      <div class="small-item fakeDanmu-item">
        <a href="#" class="cover">
          <img src="//i2.hdslb.com/bfs/archive/2f5eecaeed1c413e981bdc521ab5627aa981a116.jpg@160w_100h.jpg" alt="">
          <span class="length">03:15</span>
        </a>
        <a href="#" class="title" target="_blank">Adrenalize & MC DL - Endless Affection</a>
        <div class="meta">
          <span class="play">
            <i class="czs czs-eye-l"></i>
            4
          </span>
          <span class="time">
            <i class="czs czs-time-l"></i>
            06-26
          </span>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <hr>
  <div class="p-4">
    <div class="clearfix headline">
      <i class="icon icon-game"></i>
      <div class="float-left">
        <a href="#" class="name">其他</a>
        <p class="fire">好玩,有关音乐的一切</p>
      </div>
    </div>
    <div class="clearfix headline">
      <?php for ($i=0;$i<10;$i++) { ?>
      <div class="small-item fakeDanmu-item">
        <a href="#" class="cover">
          <img src="//i2.hdslb.com/bfs/archive/2f5eecaeed1c413e981bdc521ab5627aa981a116.jpg@160w_100h.jpg" alt="">
          <span class="length">03:15</span>
        </a>
        <a href="#" class="title" target="_blank">Adrenalize & MC DL - Endless Affection</a>
        <div class="meta">
          <span class="play">
            <i class="czs czs-eye-l"></i>
            4
          </span>
          <span class="time">
            <i class="czs czs-time-l"></i>
            06-26
          </span>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>
  <hr>
  <div class="p-4">
    <div class="clearfix headline">
      <i class="icon icon-promote"></i>
      <div class="float-left">
        <a href="#" class="name">知识专栏</a>
        <p class="fire">电子音乐知识普及</p>
      </div>
    </div>
    <div class="clearfix">
      <div class="article-wrap">
        <div class="article-item">
          <div class="clearfix">
            <div class="article-content float-left">
              <h2 class="article-title">
                <a href="#">
                  『电音贫道』拿好！这是你必备的Progressive House分类秘籍
                </a>
              </h2>
              <p class="article-con">
                <a href="#">
                  侵权必删 - 来自: https://zhuanlan.zhihu.com/p/36778777过往的各种道听途说或许令你不禁发问：“听说这是Progressive House，那种听起来截然不同的曲
                </a>
              </p>
              <div class="meta-col">
                <span>音乐舞蹈</span>
                <span title="访问量" class="view"><i class="icon"></i>158</span>
                <span title="喜欢数" class="like"><i class="icon"></i>7</span>
                <span title="评论" class="comment"><i class="icon"></i>2</span>
                <span title="创建时间" class="time"><i class="icon"></i>2018-6-11</span>
              </div>
            </div>
            <h2 class="article-img float-left">
              <a href="#" target="_blank" class="article-bgimg">
                <div class="article-cover" style="background-image: url(&quot;//i0.hdslb.com/bfs/article/8054d706e3cffd38b8cab221a9f7266ed43f872c.jpg&quot;);"></div>
              </a>
            </h2>
          </div>
        </div>
        <div class="article-item">
          <div class="clearfix">
            <div class="article-content float-left">
              <h2 class="article-title"><a href="//www.bilibili.com/read/cv576243" target="_blank" title="探索贫道——旋律派Hardstyle制作人代表之一Atmozfears">
                  探索贫道——旋律派Hardstyle制作人代表之一Atmozfears</a></h2>
              <p class="article-con"><a href="//www.bilibili.com/read/cv576243" target="_blank" title="Power by ATMOZFEARS!!!Atmozfears真名为Tim van de Stadt，出生于1992年11月5日，是一位来自荷兰的著名旋律派Hardstyle DJ制作人之一！run">
                  Power by ATMOZFEARS!!!Atmozfears真名为Tim van de Stadt，出生于1992年11月5日，是一位来自荷兰的著名旋律派Hardstyle DJ制作人之一！run</a></p>
              <div class="meta-col"><span>日常</span><span title="访问量" class="view"><i class="icon"></i>71</span><span title="喜欢数" class="like"><i class="icon"></i>4</span><span title="评论" class="comment"><i class="icon"></i>2</span><span title="创建时间"
                  class="time"><i class="icon"></i>2018-6-11</span></div>
            </div>
            <h2 class="article-img float-left"><a href="//www.bilibili.com/read/cv576243" target="_blank" class="article-bgimg">
                <div title="探索贫道——旋律派Hardstyle制作人代表之一Atmozfears" class="article-cover" style="background-image: url(&quot;//i0.hdslb.com/bfs/article/b2e478db2c17ab24e8a6426e7d1058ebbb914bee.jpg&quot;);"></div>
              </a></h2>
          </div>
        </div>
        <div class="article-item">
          <div class="clearfix">
            <div class="article-content float-left">
              <h2 class="article-title"><a href="//www.bilibili.com/read/cv560387" target="_blank" title="探索贫道 - 如何下载Youtube视频">
                  探索贫道 - 如何下载Youtube视频</a></h2>
              <p class="article-con"><a href="//www.bilibili.com/read/cv560387" target="_blank" title="日常搬运都是在油管上，觉得不错的都会搬到b站来下载之网址篇在网址中添加ss在网址中添加1s在网址中删除ubehttp://www.youtudownloader.com/http://convert2">
                  日常搬运都是在油管上，觉得不错的都会搬到b站来下载之网址篇在网址中添加ss在网址中添加1s在网址中删除ubehttp://www.youtudownloader.com/http://convert2</a></p>
              <div class="meta-col"><span>学习</span><span title="访问量" class="view"><i class="icon"></i>267</span><span title="喜欢数" class="like"><i class="icon"></i>7</span><span title="评论" class="comment"><i class="icon"></i>0</span><span title="创建时间"
                  class="time"><i class="icon"></i>2018-6-7</span></div>
            </div>
            <h2 class="article-img float-left"><a href="//www.bilibili.com/read/cv560387" target="_blank" class="article-bgimg">
                <div title="探索贫道 - 如何下载Youtube视频" class="article-cover" style="background-image: url(&quot;//i0.hdslb.com/bfs/article/d4d2ea1db74e421b613fb2c339fa9db1bfcd812d.jpg&quot;);"></div>
              </a></h2>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php require_once($rt.'footer.php') ?>
</body>
<?php require_once($rt.'script.php') ?>
<script>
  var swiper = new Swiper('.swiper-container', {
    lazy: true,
    loop: true,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
</script>

</html>
