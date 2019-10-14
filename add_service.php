<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/16
 * Time: 0:44
 */

include './common.php';

//接受数据
$post = $_POST;


//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit("连接数据库失败！");
}
$building = $post['building'];
$room_num = $post['room_num'];
$reason = $post['reason'];
$urgent = $post['urgent'];

$sql = "INSERT INTO service(`building`, `room_num`, `reason`, `urgent`) VALUES ('$building','$room_num','$reason','$urgent')";
$res = $mysql->query($sql);
if (!$res){
    exit("上传失败！");
}else{
    echo "<script>alert('插入成功!')</script>";
    echo "<script>window.location.href = './add_service.html'</script>";
}