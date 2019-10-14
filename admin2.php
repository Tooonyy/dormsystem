<?php
/**
 * Created by PhpStorm.
 * User: 63254
 * Date: 2018/11/18
 * Time: 20:20
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>后台管理系统</title>

    <style type="text/css">
        body{ margin: 0 auto;padding: 0;}
        .top{ width: 100%;height: 75px;background-image: url('2.jpg');}
        .left_bar{ width: 13%;height: 693px; background-image: url('2.jpg'); float: left;}
        .min_body{ width: 100%;background-image: url('2.jpg')}
        .title{ font-size: 20px; margin-top: 27px; margin-left: 50px; font-weight: bolder;float: left;background-image: url("2.jpg")}
        .login{ font-size: 20px; margin-top: 27px; margin-right: 50px;font-weight: bolder; float: right}
        .exit{ font-size: 20px; margin-top: 27px; margin-right: 25px; font-weight: bolder;float: right;}

        .first_p{ margin-top: 0; padding-top: 16px;}
        .main{ width: 87%; height: 693px; float: right;background: url('2.jpg');}
    </style>
<!--    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>-->
    <script type="text/javascript">
        function change_src(src){
            document.getElementById("iframepage").contentWindow.location.reload(true);
            // $("#iframepage").attr("src", src);
            var object = document.getElementById("iframepage");
            object.src=src;
        }
     </script>
</head>


<body>

<!--    顶部-->
    <div class="top">

        <p class="title" onclick="change_src('./welcome.html')" style="background-image:url('2.jpg')">学生宿舍管理系统</p>
        <p class="login" onclick="change_src('./logout.php')">退出</p>
        <p class="exit" onclick="change_src('./login.html')">登录</p>
    </div>
    <div class="min_body">
<!--        左侧导航栏-->
        <div class="left_bar">
<!--            <image src="2.jpg"></image>-->
            <center>
                <p id="to_stu" class="item">学生管理</p>
                <p id="to_service" onclick="change_src('./paging2.php')">报修记录</p>
                <p id="to_discipline">违纪记录</p>
                <p id="dorm_managing">管理员管理</p>
<!--                <button type="button" id="dorm_managing2">管理员管理</button>-->
<!--                <p>评论管理</p>-->
<!--                <p>用户反馈</p>-->
            </center>
        </div>
<!--        右侧的主页面-->
        <div class="main">
            <iframe id="iframepage" src="./welcome2.html" frameborder="0" name="mainFrame" width="100%" height="693px" style="display: flex;box-sizing: border-box;flex-direction: row;justify-content: center;align-content: center"></iframe>
        </div>
    </div>
<script type="text/javascript" src="managing.js"></script>
</body>

</html>
