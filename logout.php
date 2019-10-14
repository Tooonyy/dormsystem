<?php
/**
 * Created by PhpStorm.
 * User: Chau BingHo
 * Date: 2019/5/17
 * Time: 1:48
 */
session_start();
session_destroy();
echo "<script>alert('退出登录成功!')</script>";
echo "<script>window.location.href = 'welcome2.html'</script>";