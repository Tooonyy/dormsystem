<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/17
 * Time: 17:43
 */

include './common.php';

$post = $_POST;
$id = $post['id'];
$d_id = $post['d_id'];
$psw = md5($post['psw']);
$name = $post['name'];
$charge = $post['charge'];

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result) {
//        exit(json_encode([
//            'code' => 400,
//            'msg' => '连接数据库失败！'
//        ]));
    echo "<script>alert('连接数据库失败，请稍后重试!')</script>";
    echo "<script>window.location.href = 'admin_paging.php'</script>";
}

$sql = "UPDATE dorm_manager SET `d_id`='$d_id',`psw`='$psw',`name`='$name',`charge`='$charge' WHERE id='$id'";
$res = $mysql->query($sql);
if ($res === false){
    echo "<script>alert('更新失败，请稍后重试!')</script>";
    echo "<script>window.location.href = 'admin_paging.php'</script>";
}else{
    echo "<script>alert('更新成功!')</script>";
    echo "<script>window.location.href = 'admin_paging.php'</script>";
}