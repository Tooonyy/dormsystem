<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/17
 * Time: 16:47
 */

include './common.php';

$post = $_POST;
$number = $post['number'];
if (!$number){
    echo "<script>alert('请填写学号!')</script>";
    echo "<script>window.location.href = 'paging.php'</script>";
}
$result = users($number);

function users($number)
{
    //连接数据库
    $mysql = new mysqli();
    $connect_result = connect($mysql);
    if (!$connect_result){
        echo "<script>alert('连接数据库失败，请稍后重试!')</script>";
        echo "<script>window.location.href = 'paging.php'</script>";
    }
    $data = [];
    $i = 0;
    $sql = "SELECT * FROM student WHERE s_id='$number'";
    $res = $mysql->query($sql);
    if ($res === false){
        echo "<script>alert('没有找到该学生!')</script>";
        echo "<script>window.location.href = 'paging.php'</script>";
    }else{
        while($row = $res->fetch_assoc()){
            $data[$i] = $row;
            $i ++;
        }
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
</head>
<body>
<center>
    <h1>学生</h1>
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