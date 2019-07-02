<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
use Medoo\Medoo;

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
  $data = json_decode(file_get_contents('../config.json'));
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

function setCURL($id = 20160529, $flag = true) {
  if (substr($id,0,2) == 'av') $id = substr($id,2);
  $url = $flag ? "https://api.bilibili.com/x/web-interface/view?aid=$id" : $id;
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);
  return $output;
}

// var
$currentPath = $_SERVER['DOCUMENT_ROOT'];
$currentTemp = $currentPath.'/templete/';
