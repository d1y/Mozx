<?php

header("Content-Type: application/json;charset:utf-8");

$thePath = $_SERVER['DOCUMENT_ROOT'].'/inc/random-name/randomNameGenerator.php';

require_once('../inc/utils.php');
require_once($thePath);

$cls = new stdClass();

$db = letSQL();

define('METHOD', $_SERVER['REQUEST_METHOD']);
define('DATA', $_REQUEST);

$_type = DATA['type'] || '';

if (METHOD  == 'GET') {
	if ($_type == 'user') {
		$cls->msg = 'suppot POST method';
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
		$test = $db->has($table,[
			"username" => $_user
		]);
		$cls->flag = $test;
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
					$cls->nick = $nick;
					$cls->usernmae = $_user;
					$cls->password = $_pwd;
					$cls->msg = '注册成功';
					$cls->id = $id;
					$cls->time = time();
					$db->insert($table,[
						'id' => $id,
						'nick' => $nick,
						'username' => $_user,
						'password' => $_pwd
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
		}
	};
} else {
	$cls->msg = '不接受其他请求方式';
};

echo json_encode($cls);

?>
