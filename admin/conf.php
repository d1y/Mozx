<?php
  require_once($_SERVER["DOCUMENT_ROOT"]."/inc/utils.php");
  $lang = checkLang();
  $title = '/conf';
  $flag = true;
  $_type = $_REQUEST['type'];
  if (!$_type) header('Location: conf.php?type=dash');
  $conf = json_decode(file_get_contents('../config.json'));
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php require_once($currentTemp.'header.php') ?>
  <title><?php echo $title ?></title>
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
  <link rel="stylesheet" href="/css/dashboard.css">
</head>

<body>
  <div class="container-fluid">
    <div class="wrapper ">
      <div class="sidebar" data-color="purple" data-background-color="white" data-image="../assets/img/sidebar-1.jpg">
        <div class="logo">
          <a href="/" class="simple-text logo-normal">MOZX</a>
        </div>
        <div class="sidebar-wrapper">
          <ul class="nav">
            <li class="nav-item <?php echo $_type == 'dash' ? 'active' : '' ?>">
              <a class="nav-link" href="?type=dash">
                <i class="material-icons">dashboard</i>
                <p><?php echo $lang ? '仪表盘' : 'Dashboard' ?></p>
              </a>
            </li>
            <li class="nav-item <?php echo $_type == 'user' ? 'active' : '' ?>">
              <a class="nav-link" href="?type=user">
                <i class="material-icons">person</i>
                <p><?php echo $lang ? '用户管理' : 'User Profile' ?></p>
              </a>
            </li>
            <li class="nav-item <?php echo $_type == 'post' ? 'active' : '' ?>">
              <a class="nav-link" href="?type=post">
                <i class="material-icons">content_paste</i>
                <p>稿件管理</p>
              </a>
            </li>
            <li class="nav-item <?php echo $_type == 'diy' ? 'active' : '' ?>">
              <a class="nav-link" href="?type=diy">
                <i class="material-icons">wallpaper</i>
                <p>主题设置</p>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="main-panel">
        <div class="content">
          <div class="container-fluid">
            <?php if ($_type == 'dash') { ?>
            <div>
              <p><span class="text-primary">PHP_VERSION: </span> <?php echo PHP_VERSION ?></p>
              <p><span class="text-primary">OS: </span><?php echo PHP_OS ?></p>
              <?php foreach ($conf as $k => $v) { ?>
              <p><?php echo '<span class="text-primary">',$k,':','</span>',$v ?></p>
              <?php } ?>
            </div>
            <?php } else if ($_type == 'user') { ?>
            <div>
              <button class="btn btn-success" data-type="add_user">添加用户</button>
              <button class="btn btn-danger" data-type="del_user">删除用户</button>
              <button class="btn" data-type="del_all">删除全部</button>
            </div>
            <div class="input-group input-group-lg mb-2">
              <input type="text" id="confirm_search" class="form-control" placeholder="搜索用户">
              <button class="btn btn-success">
                <i class="material-icons">search</i>
              </button>
            </div>
            <div>
              <table class="table" id="userTable">
                <thead class="bg-primary text-white">
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">NickName</th>
                    <th scope="col">UserName</th>
                    <th scope="col">CreateTime</th>
                    <th scope="col">Edit</th>
                  </tr>
                </thead>
                <tbody></tbody>
              </table>
              <div class="text-center">
                <div class="pager clearfix w-50 d-inline-block">
                  <button type="button" id="nextBtn" class="btn btn-primary">加载更多</button>
                </div>
              </div>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit user profile</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form>
                        <div class="form-group">
                          <label for="recipient-name" class="col-form-label">id:</label>
                          <input type="text" class="form-control" id="post-id" disabled>
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">nickname:</label>
                          <input type="text" class="form-control" id="post-nickname">
                        </div>
                        <div class="form-group">
                          <label for="message-text" class="col-form-label">password:</label>
                          <input type="password" class="form-control" id="post-pwd">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="button" id="confirm_user" class="btn btn-primary">Confirm</button>
                      <button type="button" id="confirm_del" class="btn btn-primary">删除账号</button>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <button class="btn btn-success" id="confirm_admin">设置管理员</button>
              </div>
              <?php } else if ($_type == 'post') { ?>
              <p>post</p>
              <?php } else if ($_type == 'diy') { ?>
              <p>diy</p>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
<?php require_once($currentTemp.'script.php') ?>
<script src="/js/admin.js"></script>

</html>