<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/17
 * Time: 0:02
 */

include './common.php';

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit(json_encode([
        'code' => 400,
        'msg' => '连接数据库失败！'
    ]));
}

$sql = "SELECT * FROM dorm_manager WHERE d_id='20171003312'";
$r = $mysql->query($sql);
$res = $r->fetch_assoc();
//if (!$res){
//    echo 'nothing';
//}else
//    echo 'something';
exit(json_encode([
    'code' => 200,
    'msg' => $res['level']
]));