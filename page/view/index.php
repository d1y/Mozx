<?php
  require_once($_SERVER["DOCUMENT_ROOT"].'/inc/utils.php');
  $rt = $_SERVER["DOCUMENT_ROOT"].'/templete/';
  $flag = false;
  $title = '/view';
  $type = $_GET['type'];
  $id = $_GET['id'];
  $error_text = '参数不存在';
  if (!$type || !$id) {
    $hasID = true;
  };
  $remake = $type;
  if ($type == 'post') $type = 'write';
  $content = letSQL()->select($type,'*',[
    'id' => $id
  ])[0];
  $content['user'] = letSQL()->select('user','username',[
    'id' => $content['author_id']
  ])[0];
  $content['url'] = json_decode($content['url']);
  // dd($content);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <title><?php echo $title ?></title>
  <?php require_once($rt.'header.php') ?>
  <link href="https://cdn.bootcss.com/github-markdown-css/3.0.1/github-markdown.min.css" rel="stylesheet">
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
  <div id="img" style="display:none;"></div>
  <?php require_once($rt.'footer.php') ?>
</body>
<script src="https://cdn.bootcss.com/markdown.js/0.5.0/markdown.min.js"></script>
<?php require_once($rt.'script.php') ?>
<script src="https://cdn.bootcss.com/jquery.qrcode/1.0/jquery.qrcode.min.js"></script>
<script type="text/javascript">
  mdPreview = function($text = 'text') {
    let wrap = document.getElementById('preview');
    function preview(wrap, text) {
      return wrap.innerHTML = markdown.toHTML(text);
    }
    console.log($text)
    preview(wrap,$text);
  }
  <?php
    if (!$content['intro']) $content['intro'] = $content['show'];
  ?>
  <?php if ($remake == 'post') { ?>
    let b = <?php echo json_decode($content['md']) ?>;
    console.log(b)
    mdPreview(b)
  <?php } else { ?>
    mdPreview(<?php echo $content['intro'] ?>)
  <?php } ?>
  function QRcode(url) {
    $('#img').qrcode(url)
    let canvas = $('#img').find('canvas')[0]
    let img = canvas.toDataURL()
    let result = $('<img>',{
      src: img
    })
    return swal({
      content: result[0]
    })
  }
  $('#SHARE').on('click',()=> QRcode(window.location.href))
</script>
</html>
