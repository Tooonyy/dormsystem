<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/23
 * Time: 9:44
 */

include './common.php';

$request = file_get_contents('php://input','r');
if ($request == NULL){
    exit(json_encode([
        'code' =>400,
        'msg' => '无请求参数!'
    ]));
}
$post = json_decode($request,true);

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result) {
    exit(json_encode([
        'code' => 400,
        'msg' => '连接数据库失败！'
    ]));
}

$sid = $post['token'];
session_id($sid);
session_start();
if (!array_key_exists('token',$_SESSION)){
    exit(json_encode([
        'code' => 400,
        'msg' => '请重新登录!'
    ]));
}
if ($_SESSION['level'] != 2 ){
    exit(json_encode([
        'code' => 400,
        'msg' => '权限不够!'
    ]));
}
exit(json_encode([
    'code' => 200,
    'msg' => 'success!'
]));