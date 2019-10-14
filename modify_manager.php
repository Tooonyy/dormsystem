<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/17
 * Time: 17:18
 */

include './common.php';

$number = $_GET['ad_id'];
if (!$number) {
    echo "<script>alert('请填写宿舍管理人员工号!')</script>";
    echo "<script>window.location.href = 'paging.php'</script>";
}
$result = users($number);

function users($number)
{
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
    $data = [];
    $i = 0;
    $sql = "SELECT * FROM administrator WHERE ad_id='$number'";
    $res = $mysql->query($sql);
    if ($res === false) {
        echo "<script>alert('没有找到该宿舍管理人员!')</script>";
        echo "<script>window.location.href = 'admin_paging.php'</script>";
    } else {
        while ($row = $res->fetch_assoc()) {
            $data[$i] = $row;
            $i++;
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
        body {
            margin: 0 auto;
            padding: 0;
        }

        center {
            margin-top: 5%;
        }
    </style>
</head>
<body>
<center>
    <h1>宿舍管理人员</h1>

    <table cellpadding="5" width="50%" border="0" cellspacing="0" id="special">
        <?php foreach ($result as $k => $v): ?>
        <form action="modify_manager_save.php?id=<?php echo $v['id']; ?>" method="post">
            <tr>
                <td style="text-align: right">
                    宿舍管理员工号
                </td>
                <td>
                    <input type="text" name="d_id" placeholder="<?php echo $v['ad_id']; ?>" style="width:250px;">
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    密码
                </td>
                <td>
                    <input type="text" name="psw" placeholder="<?php echo $v['psw']; ?>" style="width:250px;">
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    姓名
                </td>
                <td>
                    <input type="text" name="name" placeholder="<?php echo $v['name']; ?>" style="width:250px;">
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    负责大楼
                </td>
                <td>
                    <input type="text" name="charge" placeholder="<?php echo $v['charge']; ?>" style="width:250px;">
                </td>
            </tr>
            <?php endforeach; ?>
        </form>
    </table>
</center>
</body>
</html>