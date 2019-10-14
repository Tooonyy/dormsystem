<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/16
 * Time: 18:18
 */

include './common.php';

$request = file_get_contents('php://input','r');
$res = json_decode($request,true);
$ad_id = $res['data']['admin'];
$psw = md5($res['data']['password']);

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit(json_encode([
        'code' => 400,
        'msg' => '连接数据库失败！'
    ]));
}
$sql = "SELECT * FROM administrator WHERE ad_id='$ad_id'";
$r = $mysql->query($sql);
if ($r === false){
    exit(json_encode([
        'code' => 400,
        'msg' => '服务器错误!请稍后重试!'
    ]));
}
if (mysqli_num_rows($r) < 1){
    exit(json_encode([
        'code' => 400,
        'msg' => '没有找到该用户!'
    ]));
}
$sql2 = "SELECT * FROM `administrator` WHERE `ad_id`='$ad_id' AND `psw`='$psw'";
$result = $mysql->query($sql2);
if ($result === false){
    exit(json_encode([
        'code' => 400,
        'msg' => '服务器错误!请稍后重试!'
    ]));
}
if ($row = $result->fetch_assoc()){
    session_start();
    $sid = session_id();
    $_SESSION['token'] = $sid;
    $_SESSION['level'] = $row['level'];
    exit(json_encode([
        'code' => 200,
        'msg' => $sid
    ]));
}else{
    exit(json_encode([
        'code' => 400,
        'msg' => '密码错误!'
    ]));
}