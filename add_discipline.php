<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/26
 * Time: 16:17
 */

include './common.php';

$post = $_POST;
if ($post['number'] == NULL){
    echo "<script>alert('请输入学号!')</script>";
    echo "<script>window.location.href = 'add_discipline.html'</script>";
}
$number = $post['number'];
if ($post['name'] == NULL)
{
    echo "<script>alert('请输入姓名!')</script>";
    echo "<script>window.location.href = 'add_discipline.html'</script>";
}
$name = $post['name'];
if ($post['reason'] == NULL){
    echo "<script>alert('请输入原因!')</script>";
    echo "<script>window.location.href = 'add_discipline.html'</script>";
}
$reason = $post['reason'];

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit("连接数据库失败！");
}

$sql = "INSERT INTO discipline(`s_id`,`name`,`detail`) VALUES ('$number','$name','$reason')";
$res = $mysql->query($sql);
if ($res === false){
    $mysql->close();
    echo "<script>alert('服务器错误!请稍后重试')</script>";
    echo "<script>window.location.href = 'discipline_paging.php'</script>";
}else{
    $mysql->close();
    echo "<script>alert('插入成功!')</script>";
    echo "<script>window.location.href = 'discipline_paging.php'</script>";
}
