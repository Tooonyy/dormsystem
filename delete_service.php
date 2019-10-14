<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/18
 * Time: 0:08
 */
include './common.php';

session_start();

$id = $_GET['id'];

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit("连接数据库失败！");
}

$sql = "DELETE FROM service WHERE id='$id'";
$res = $mysql->query($sql);
if ($res === false){
    echo "<script>alert('删除失败，请稍后重试!')</script>";
    echo "<script>window.location.href = './paging2.php'</script>";
}else{
    echo "<script>alert('删除成功!')</script>";
    echo "<script>window.location.href = './paging2.php'</script>";
}