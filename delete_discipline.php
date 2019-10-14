<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/23
 * Time: 17:18
 */

//获取id
$id = $_GET['id'];

include "common.php";

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit("连接数据库失败！");
}

$sql = "DELETE FROM discipline WHERE id='$id'";
$res = $mysql->query($sql);
if ($res === false){
    echo "<script>alert('删除失败，请稍后重试!')</script>";
    echo "<script>window.location.href = 'discipline_paging.php'</script>";
}

echo "<script>alert('删除成功!')</script>";
echo "<script>window.location.href = 'discipline_paging.php'</script>";