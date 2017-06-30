<?php
// header("Content-Type:text/html;charset=utf-8");
session_start();
$log = $_SESSION["log"];
echo $log;
// if ($log == "a"){
//     header("Location:../index.php?class=User&action=login");
//     die();
// }
// else {
//     echo "你还没有登录，请<a href=\"http://localhost/xiangmuTwo/View/login.html\">登录</a>";
// }