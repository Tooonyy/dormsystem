<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/17
 * Time: 1:23
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
$admin = $post['admin'];
$psw = md5($post['psw']);
$name = $post['name'];

$sql = "INSERT INTO dorm_manager(`d_id`, `psw`, `name`, `charge`) VALUES ('$admin','$psw','$name','$building')";
$res = $mysql->query($sql);
if (!$res){
    $mysql->close();
    echo"<script>alert('出错！请稍后重试!')</script>";
    echo "<script>window.location.href = 'welcome2.html'</script>";
}else{
    $mysql->close();
    echo "<script>alert('插入成功!')</script>";
    echo "<script>window.location.href = 'welcome2.html'</script>";
}