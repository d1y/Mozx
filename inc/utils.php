<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once 'jwt.php';
use Medoo\Medoo;

$TK = new Jwt;
function TokenCode ($code, $flag = false) {
  global $TK;
  $oneDAY = 86400; // 2 day
  $nowTime = time();
  $also = [
    'iss'=>'kozo4',   //该JWT的签发者
    'iat'=>$nowTime,  //签发时间
    'exp'=>$nowTime + $oneDAY,  //过期时间
    'nbf'=>$nowTime,  //该时间之前不接收处理该Token
    'sub'=>'test',   //面向的用户
    'jti'=>md5(uniqid('JWT').time())  //该Token唯一标识
  ];
  if (!$flag) {
    $also['sub'] = $code;
    return $TK::getToken($also);
  }
  return $TK::verifyToken($code);
}

function hasToken() {
  $token = $_COOKIE['token'];
  if (!$token) $token = '';
  return TokenCode($token, true);
}
$FACE = hasToken();

/*
** 首先把秘钥通过 base64 加密,将其反转 => 获取解密秘钥
** 把加密秘钥去除 加密秘钥的 1/4 长度在前面, 3/4 长度在后面 (四舍五入)
** 然后在使用 base64 解密三次即可
*/
function code_XY(string $str, $flag = false,$code = '1008611') {
  $rawCode = strrev(base64_encode($code));
  $result = '';
  $len = strlen($rawCode);
  $x_len = round($len * 1/4);
  $y_len = round($len * 3/4);
  $a = substr($rawCode,0,$x_len);
  $b = substr($rawCode,$x_len);
  if (!$flag) {
    $tmp = base64_encode(
      base64_encode(
        base64_encode($str)
      )
    );
    $result = $a.$tmp.$b;
  } else {
    $l = substr($str,0,strlen($a));
    $r = substr($str,strpos($str,$b));
    if (strpos($str,$b) && $l == $a && $r == $b ) {
      $tmp = substr(
        $str,
        $x_len,
        strlen($str)-$y_len
      );
      $result = base64_decode(
        base64_decode(
          base64_decode($tmp)
        )
      );
    } else {
      $result = false;
    }
  }
  return $result;
};

function checkLang() {
  $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
  if (preg_match("/zh-c/i", $lang) || preg_match("/zh/i", $lang)) {
    return 1;
  } else {
    return 0;
  };
};

function letSQL() {
  $JSON = $_SERVER['DOCUMENT_ROOT'] . '/config.json';
  $data = json_decode(file_get_contents($JSON));
  $database = new medoo([
    'database_type' => 'mysql',
    'database_name' => $data->MOX_DB_NAME,
    'server' => $data->MOX_DB_HOST,
    'username' => $data->MOX_DB_USER,
    'password' => $data->MOX_DB_PWD,
    'charset' => 'utf-8',
    'port' => $data->MOX_DB_PORT
  ]);
  return $database;
};

// has database & tables
function hasTable($database = 'music', $table = 'user') {
  $_str = "select t.table_name from information_schema.TABLES t where t.TABLE_SCHEMA ='$database' and t.TABLE_NAME ='$table'";
  return $_str;
}

function hasDatabase($databaseName = 'music') {
  $_str = "SELECT information_schema.SCHEMATA.SCHEMA_NAME FROM information_schema.SCHEMATA where SCHEMA_NAME='$databaseName'";
  return $_str;
}

function setCURL($id = 20160529, $flag = true) {
  $ua = "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_8_2) AppleWebKit/536.26.17 (KHTML, like Gecko) Version/6.0.2 Safari/536.26.17";
  if (substr($id,0,2) == 'av') $id = substr($id,2);
  $url = $flag ? "https://api.bilibili.com/x/web-interface/view?aid=$id" : $id;
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, 'http://www.google.cn/');
  curl_setopt($ch, CURLOPT_USERAGENT, $ua);
  $output = curl_exec($ch); 
  curl_close($ch);
  return $output;
}

function dd($var) {
    ob_end_clean();
    $backtrace = debug_backtrace();
    echo "\n<pre>\n";
    if (isset($backtrace[0]['file'])) {
        $filename = $backtrace[0]['file'];
        $filename = explode('\\' , $filename);
        echo end($filename) . "\n\n";
    }
    echo "---------------------------------\n\n";
    var_dump($var);
    echo "</pre>\n";
    die;
}

// var
$currentPath = $_SERVER['DOCUMENT_ROOT'];
$currentTemp = $currentPath.'/templete/';
