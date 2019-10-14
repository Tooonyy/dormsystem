<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2018/12/25
 * Time: 12:40
 */

include './common.php';

session_start();
if (!$_SESSION['token']){
    echo "<script>alert('请先登录!')</script>";
    echo "<script>window.location.href = 'welcome2.html'</script>";
}

@$allNum = allNews();
@$pageSize = 8; //约定每页显示的信息条数
@$pageNum = empty($_GET["pageNum"])?1:$_GET["pageNum"];
@$endPage = ceil($allNum/$pageSize); //总页数,向上取整
@$array = users($pageNum,$pageSize);

//连接数据库
$mysql = new mysqli();
$connect_result = connect($mysql);
if (!$connect_result){
    exit("连接数据库失败！");
}
//查所有数据
$result = users($pageNum,$pageSize);
$mysql->close();


//显示总页数的函数
function allNews()
{
    //连接数据库
    $mysql = new mysqli();
    $connect_result = connect($mysql);
    if (!$connect_result){
        exit('连接数据库失败');
    }
    $sql = "SELECT count(*) num FROM `student`";
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
    if (!$connect_result){
        exit('连接数据库失败');
    }
    // limit为约束显示多少条信息，后面有两个参数，第一个为从第几个开始，第二个为长度
    $sql = "select * from `student` limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
    $result = $mysql->query($sql);
    if($result === false){
        //执行失败，抛出错误
        echo $mysql->error;
        echo $mysql->errno;
        return false;
    }
    while ($row = $result->fetch_assoc()) {
        $data[$i] = $row;
        $i ++;
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
        body{ margin: 0 auto; padding: 0;}
        center{ margin-top: 5%;}
    </style>
    <script type="text/javascript">
        function delete_user(id){
            window.location.href = "delete_user.php?id="+id;
        }
        function modify_user(id)
        {
            window.location.href = "modify_user.php?id="+id;
        }
    </script>
</head>
<body>
<center>
    <h1>学生</h1>
    <table>
        <form action="search_stu.php" method="post">
            <tr>
                <td>
                    <input type="text" name="number" placeholder="学号">
                </td>
                <td>
                    <input type="submit" value="搜索">
                </td>
            </tr>
        </form>
    </table>
    <table>
        <form action="search_stu_building.php" method="post">
            <tr>
                <td>
                    <input type="text" name="building" placeholder="宿舍">
                </td>
                <td>
                    <input type="submit" value="搜索">
                </td>
            </tr>
        </form>
    </table>
    <p>

    </p>
    <table cellpadding="5" width="87%" border="1" cellspacing="0" id="special">
        <tr>
            <td style="border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;border-right: 0;"></td>
            <td style="border-left: 0;">
<!--                <button style="float: right" id="select">-->
<!--                    <a href="add_user.html">新增</a>-->
<!--                </button>-->
            </td>
        </tr>
        <tr>
            <td>学号</td>
            <td>姓名</td>
            <td>学院</td>
            <td>性别</td>
            <td>宿舍大楼</td>
            <td>房间号</td>
            <td>床号</td>
        </tr>
        <?php foreach ($result as $k => $v): ?>
            <tr>
                <td><?php echo $v['s_id'];?></td>
                <td><?php echo $v['name'];?></td>
                <td><?php echo $v['dept_name'];?></td>
                <td><?php echo $v['gender'];?></td>
                <td><?php echo $v['building'];?></td>
                <td><?php echo $v['room_num'];?></td>
                <td><?php echo $v['bed_num'];?></td>
<!--                <td><button onclick="modify_user(<?php echo $v['id'];?>)">修改</button>
                    <button onclick="delete_user(<?php echo $v['id'];?>)">删除</button>
                </td>
            </tr>
-->
        <?php endforeach;?>
    </table>
    <div>
        <a href="?pageNum=1">首页</a>
        <a href="?pageNum=<?php echo $pageNum==1?1:($pageNum-1)?>">上一页</a>
        <a href="?pageNum=<?php echo $pageNum==$endPage?$endPage:($pageNum+1)?>">下一页</a>
        <a href="?pageNum=<?php echo $endPage?>">尾页</a>
    </div>
</center>
</body>
</html>
