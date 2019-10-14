<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2018/12/25
 * Time: 12:40
 */

include './common.php';

//session_start();
//if (!$_SESSION['token']){
//    echo "<script>alert('请先登录!')</script>";
//    echo "<script>window.location.href = 'welcome2.html'</script>";
//}

@$allNum = allNews();
@$pageSize = 8; //约定每页显示的信息条数
@$pageNum = empty($_GET["pageNum"]) ? 1 : $_GET["pageNum"];
@$endPage = ceil($allNum / $pageSize); //总页数,向上取整
@$array = users($pageNum, $pageSize);

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result) {
    exit("连接数据库失败！");
}
//查所有数据
$result = users($pageNum, $pageSize);
$mysql->close();


//显示总页数的函数
function allNews()
{
    //连接数据库
    $mysql = new mysqli();
    $connect_result = connect($mysql);
    if (!$connect_result) {
        exit('连接数据库失败');
    }
    $sql = "SELECT count(*) num FROM `service`";
    $result = $mysql->query($sql);
    $data = $result->fetch_assoc();
    $mysql->close();
    return $data['num'];
}

//分页的函数
function users($pageNum = 1, $pageSize = 8)
{
    //自定义返回数据数组
    $i = 0;
    $data = [];
    $mysql = new mysqli();
    $connect_result = connect($mysql);
    if (!$connect_result) {
        exit('连接数据库失败');
    }
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
    $sql = "select * from `service` ORDER BY urgent desc ,id asc limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $result = $mysql->query($sql);
    if ($result === false) {
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    while ($row = $result->fetch_assoc()) {
        $data[$i] = $row;
        $i++;
    }
    $mysql->close();
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style type="text/css">
        body {
            margin: 0 auto;
            padding: 0;
        }

        center {
            margin-top: 5%;
        }
    </style>
    <script type="text/javascript">
        function delete_service(id) {
            window.location.href = "delete_service.php?id=" + id;
        }
    </script>
</head>
<body>
<center>
    <h1>报修表</h1>

    <table cellpadding="5" width="87%" border="1" cellspacing="0" id="special">
        <tr>
            <td style="border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;">
                <button style="float: right" id="select">
                    <a href="./add_service.html">新增</a>
                </button>
            </td>
        </tr>
        <tr>
            <td>id</td>
            <td>宿舍大楼</td>
            <td>房间号</td>
            <td>报修原因</td>
            <td>是否紧急</td>
            <td>操作</td>
        </tr>
        <?php foreach ($result as $k => $v): ?>
        <tr>
            <td><?php echo $v['id']; ?></td>
            <td><?php echo $v['building']; ?></td>
            <td><?php echo $v['room_num']; ?></td>
            <td><?php echo $v['reason']; ?></td>
            <td><?php echo $v['urgent']; ?></td>
            <td><button onclick="delete_service(<?php echo $v['id'];?>)">删除</button></td>
        </tr>
            <?php endforeach; ?>
    </table>
    <div>
        <a href="?pageNum=1">首页</a>
        <a href="?pageNum=<?php echo $pageNum == 1 ? 1 : ($pageNum - 1) ?>">上一页</a>
        <a href="?pageNum=<?php echo $pageNum == $endPage ? $endPage : ($pageNum + 1) ?>">下一页</a>
        <a href="?pageNum=<?php echo $endPage ?>">尾页</a>
    </div>
</center>
</body>
</html>