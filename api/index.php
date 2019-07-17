<?php

header("Content-Type: application/json;charset=utf-8");

$thePath = $_SERVER['DOCUMENT_ROOT'].'/inc/random-name/randomNameGenerator.php';

require_once('../inc/utils.php');
require_once('../inc/mysql.php');
require_once($thePath);

$cls = new stdClass();
$db = letSQL();

define('METHOD', $_SERVER['REQUEST_METHOD']);
define('DATA', $_REQUEST);

$_type = DATA['type'];
$FUCKID = DATA['id'];
$_is = DATA['is'];

function createTable($table, $query, $database = 'music') {
	global $db,$cls;
	if (!$db->query(
		hasTable($database,$table)
	)->fetchAll()) {
		$db->query($query);
		$cls->dev = "创建数据表成功 $table";
	}
}

function genUUID() {
	return date('Ymd') . str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
}

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
	$_user = DATA['user'];
	$_pwd = DATA['pwd'];

	$cls->msg = '未知错误';

	if ($_type == 'user') {
		$flag = $_user && ($_pwd || $_pwd == '0');
		$table = 'user'; // check username && password
		createTable($table,$createUserTable);
		$test = $db->has($table,[
			"username" => $_user
		]);
		switch ($_is) {
			case 'reg':
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
				break;
			
			case 'login':
				if ($flag) {
					$_check = $db->select($table,'*',[
						"username" => $_user
					]);
					if ($_check) {
						$_up = $_check[0]["password"];
						if ($_up === $_pwd) {
							$cls->code = 200;
							$cls->msg = '登录成功';
							$codes = TokenCode($_user);
							$cls->token = $codes;
							setcookie(
								'token',
								$codes,
								time()+2*12*60*60,
								'/'
							);
						} else {
							$cls->code = 400;
							$cls->msg = '密码错误';
						}
					} else {
						$cls->code = 400;
						$cls->msg = '账号不存在';
					};
				}
				break;

			case 'view':
				$_currPage = (int)DATA['page'];
				$_currCount = (int)DATA['count'];
				$_currTest = 4; // defalut count
				$_offset = 0;
	
				$_page = $_currPage ? $_currPage : 1;
				$_count = $_currCount ? $_currCount : $_currTest;
				$_totalCount = $db->count($table);
				--$_page;
				$calc = $_count * $_page;
				$div = $_totalCount / $_count;
				$sur = $_totalCount % $_count;
				$_offset = $calc;
				if ($_page == 0) $_offset = 0;
				$cls->totalpage = ceil($div);
				$dev = $db->select($table,[
					'id',
					'username',
					'nickname',
					'login'
				],[
					"LIMIT" => [$_offset, $_count]
				]);
				$cls->currentpage = $_page+1;
				$cls->data = $dev;
				$cls->msg = '获取成功';
				break;

			case 'update':
				$nickName = DATA['nickname'];
				$nickPwd = DATA['pwd'];
				$query = [];
				if ($nickName) $query['nickname'] = $nickName;
				if ($nickPwd) $query['password'] = $nickPwd;
				$id = $FUCKID;
				if (!$query || !$id) {
					$cls->code = 250;
					$cls->msg = '未知错误';
				} else {
					$dk = $db->update($table,$query,[
						'id' => $FUCKID
					]);
					foreach ($query as $k => $w) {
						$cls->$k = $w;
					}
					$cls->code = 200;
					$cls->msg = '修改成功';
				}
				break;

			case 'delete':
				$id = DATA['id'];
				$all = (int)DATA['all'];
				if ($all) {
					$cls->msg = '删除所有';
					$cls->code = 200;
					$db->query("DELETE from $table");
				} else {
					if (!id) {
						$cls->code = 250;
						$cls->msg = '请传递id';
					} else {
						$cls->code = 200;
						$cls->msg = '删除成功';
					}
					$db->delete($table,[
						'id' => $id
					]);
				}
				break;

			case 'info':
				if (!$FUCKID) {
					$cls->code = 250;
					$cls->msg = '未传递id';
				} else {
					$result = $db->select($table,'*',[
						'id' => $FUCKID
					]);
					if (!$result) {
						$cls->code = 400;
						$cls->msg = '未查询到';
					} else {
						foreach ($result[0] as $k => $v) {
							if ($k == 'password') continue;
							$cls->$k = $v;
						};
						$cls->code = 200;
						$cls->msg = '获取成功';
					}
				}
				break;
			case 'admin':
				$str = DATA['key'];
				$auth = (int)DATA['auth']; // 1 设置管理员 2 取消管理员
				$key = 10086; // ==QVFZSQmQwOUVXVDA9MxYDOwATM
				$encode = code_XY($key);
				if ($str == $encode && $FUCKID && $auth) {
					if ($auth >= 1 && $auth <= 2) {
						$key = 1;
						if ($auth == 2) $key = 0;
						if ($auth)
						$flag = $db->update($table,[
							'admin' => $key
						],[
							'id' => $FUCKID
						]);
						$cls->msg = '修改成功';
						$cls->code = 200;
					} else {
						$cls->code = 250;
						$cls->msg = '参数错误';
					}
				} else {
					$cls->code = 250;
					$cls->msg = '秘钥错误或参数未传递';
				}
				break;
			case 'search':
				$keyword = DATA['keyword'];
				$arr = ['username[~]' => "%$keyword%"];
				$arr_cp = ['nickname[~]' => "%$keyword%"];
				if ($keyword) {
					// 查询两次的成本很高
					$result1 = $db->select($table,'*',$arr);
					$result2 = $db->select($table,'*',$arr_cp);
					$result = array_merge($result1,$result2);
					$cls->result = $result;
					$cls->msg = '搜索成功';
					$cls->code = 200;
				} else {
					$cls->code = 250;
					$cls->msg = '查询失败';
				}
				break;
			default:
				$cls->code = 400;
				$cls->msg = '未知错误';
				break;
		}
	} else if ($_type == 'post') {
		function decodeStr($str) {
			return urldecode(base64_decode($str));
		}
		$_title = decodeStr(DATA['title']);
		$_cover = decodeStr(DATA['cover']);
		$_desc = decodeStr(DATA['intro']);
		$_nick = 1;
		$_view = 1;
		function hasFn () {
			global $cls,$db;
			$_hasUserName = $_COOKIE['user'];
			$name = 'user';
			if (!$_hasUserName) return;
			$_searchUserName = $db->select($name,'id',[
				'username' => $_hasUserName
			]);
			if (!$_searchUserName) {
				$cls->msg = 'cookie 获取失败';
				$cls->code = 250;
				return;
			}
			$_theID = $_searchUserName[0];
			return $_theID;
		}
		$tableM = 'music';
		$tableV = 'videos';
		$tableW = 'write';
		switch ($_is) {
			case $tableV:
				createTable($tableV,$createVideosTable);
				$_urls = decodeStr(DATA['list']);
				$_theID = hasFn();
				$cls->test = $_theID;
				$_UUID = genUUID();
				if (!$_urls || !$_theID) break;
				$_tags = decodeStr(DATA['tags']);
				$db->insert($tableV,[
					'url' => $_urls,
					'cover' => $_cover,
					'title' => $_title,         
					'tags' => $_tags,
					'intro' => $_desc,
					'view' => $_view,
					'author_id' => $_theID,
					'id' => $_UUID,
					'nick' => $_nick
				]);
				$cls->msg = '上传成功';
				$cls->code = 200;
				break;
			
			case $tableM:
				createTable($tableM,$createMusicsTable);
				$_theID = hasFn();
				$_list = decodeStr(DATA['list']);
				if (!$_list || !$_theID) break;
				$_tags = decodeStr(DATA['style']);
				$_UUID = genUUID();
				$db->insert($tableM,[
					'url'  => $_list,
					'cover'=> $_cover,
					'title'=> $_title,
					'tags' => $_tags,
					'intro'=> $_desc,
					'view'=> $_view,
					'author_id'=> $_theID,
					'id'=> $_UUID,
					'nick'=> $_nick
				]);
				$cls->code = 200;
				$cls->msg = '上传成功';
				break;
			
			case $tableW:
				createTable($tableW,$createWriteTable);
				$_theID = hasFn();
				$_UUID = genUUID();
				$_SHOW = decodeStr(DATA['show']);
				$_TAGS = decodeStr(DATA['tags']);
				$_MD = decodeStr(DATA['md']);
				$db->insert($tableW,[
					'md' => $_MD,
					'cover'=> $_cover,
					'title'=> $_title,
					'tags' => $_TAGS,
					'show'=> $_SHOW,
					'view'=> $_view,
					'author_id'=> $_theID,
					'id'=> $_UUID,
					'nick'=> $_nick	
				]);
				break;

			default:
				$cls->code = 250;
				$cls->msg = '未知错误 :(';
				break;
		}
	};
} else {
	$cls->msg = '不接受其他请求方式';
};

echo json_encode($cls);

?>
