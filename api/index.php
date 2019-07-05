<?php

header("Content-Type: application/json;charset=utf-8");

$thePath = $_SERVER['DOCUMENT_ROOT'].'/inc/random-name/randomNameGenerator.php';

require_once('../inc/utils.php');
require_once($thePath);

$cls = new stdClass();
$db = letSQL();

define('METHOD', $_SERVER['REQUEST_METHOD']);
define('DATA', $_REQUEST);

$_type = DATA['type'];

if (METHOD  == 'GET') {
	if ($_type == 'user') {
		$cls->msg = 'suppot POST method';
	} else if ($_type == 'bili') {
		$aid = $_GET['aid'];
		$get = $_GET['get'];
		if (!$aid) {
			$cls->code = 400;
			$cls->msg = '请传递cid';
		} else {
			if (substr($aid,0,2) == 'av') $aid = substr($aid,2);
			switch ($get) {
				case 'cover':
					$data = json_decode(setCURL($aid))->data;
					$cls->code = 200;
					$cls->aid = $aid;
					$cls->title = $data->title;
					$cls->pic = $data->pic;
					$cls->desc = $data->desc;
					break;
				case 'download':
					$now = time();
					$url_query = array(
						'callback'=> 'callbackfunction',
						'aid'=> $aid,
						'page'=> 1,
						'platform'=> 'html5',
						'quality'=> 1,
						'vtype'=> 'mp4',
						'type'=> 'jsonp',
						'_'=> $now
					);
					$data = http_build_query($url_query);
					$cls->test = $data;
					$genURL = "https://api.bilibili.com/playurl?$data";
					$cls->URL = $genURL;
					$data = json_decode(setCURL($genURL,false));
					$cls->fuck = $data;
				case 'info':
					$data = setCURL("https://api.bilibili.com/x/web-interface/view?aid=$aid",false);
					$cls = json_decode($data);
				default:
					break;
			}
		}
	} else {
		$cls->code = 250;
		$cls->msg = '未传递参数';
	}
} else if (METHOD == 'POST') {
	/*
	** @type::
	**  -> user :: 用户相关
	**   --> is :: 登录注册 => 1 注册 0 登录
	**     => user : 用户名
	**		 => pwd : 密码
	*/
	$_is = DATA['is'];
	$_user = DATA['user'];
	$_pwd = DATA['pwd'];

	$cls->msg = '未知错误';

	if ($_type == 'user') {
		$flag = $_user && ($_pwd || $_pwd == '0');
		$table = 'user'; // check username && password
		if (!$db->query(
			hasTable() // `user` table has
		)->fetchAll()) {
			$cls->dev = '数据表创建成功';
			$eyes = $db->query("CREATE TABLE `music`.`user` ( `id` TEXT NOT NULL , `nickname` TEXT NOT NULL , `username` TEXT NOT NULL , `password` TEXT NOT NULL , `login` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP , `view` INT NOT NULL , `admin` TINYINT(1) NOT NULL DEFAULT '0' ) ENGINE = InnoDB");
			$cls->fetch = $eyes->fetchAll();
		}
		$test = $db->has($table,[
			"username" => $_user
		]);
		if ($_is == '1') { // 注册
			if ($flag) {
				if ($test) {
					$cls->msg = '已存在用户名';
					$cls->code = 400;
					$cls->time = time();
				} else {
					$r = new randomNameGenerator('array');
					$nick = $r->generateNames(1)[0];
					$id = uniqid();
					$cls->code = 200;
					$cls->id = $id;
					$cls->nickname = $nick;
					$cls->usernmae = $_user;
					$cls->password = $_pwd;
					$cls->login = time();
					$cls->msg = '注册成功';
					$cls->view = 1;
					$d = $db->insert($table,[
						'id' => $id,
						'nickname' => $nick,
						'username' => $_user,
						'password' => $_pwd,
						'view' => 1
					]);
				}
			}
		} else if ($_is == '0') { // 登录
			if ($flag) {
				$_check = $db->select($table,'*',[
					"username" => $_user
				]);
				if ($_check) {
					$_up = $_check[0]["password"];
					if ($_up === $_pwd) {
						$cls->code = 200;
						$cls->msg = '登录成功';
						setcookie(
							'user',
							$_user,time()+8*60*60,
							'/'
						);
						$cls->cookie = 'cookie 设置成功';
					} else {
						$cls->code = 400;
						$cls->msg = '密码错误';
					}
				} else {
					$cls->code = 400;
					$cls->msg = '账号不存在';
				};
			}
		} else {
			$cls->msg = '未知错误';
		}
	};
} else {
	$cls->msg = '不接受其他请求方式';
};

echo json_encode($cls);

?>
