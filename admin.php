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
    <link rel="stylesheet" href="./all.css" type="text/css" />
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
<!--       <br><br>-->
        <p class="title" onclick="change_src('./welcome.html')" >学生宿舍管理系统</p>
<!--        <br></br>-->
        <p class="exit" onclick="change_src('./logout.php')">退出</p>
        <p class="login" onclick="change_src('./login.html')">登录</p>
<!--        <p class="info" >软件工程1703 邹某20171003xxx 梁楚铧20171003307</p>-->
    </div>
    <div class="min_body">
<!--        左侧导航栏-->
        <div class="left_bar">
            <center>
                <p id="to_stu" class="item">学生管理</p>
                <p id="to_service" onclick="change_src('./paging2.php')" class="item">报修记录</p>
                <p id="to_discipline" class="item">违纪记录</p>
                <p id="dorm_managing" class="item">管理员管理</p>
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
