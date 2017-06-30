<?php
require_once 'Controller/User.class.php';
require_once 'Controller/sql.class.php';
require_once 'Controller/page.class.php';
session_start();
$class = "";
$action = "";
if (isset($_GET["class"]) & isset($_GET["action"])){
    $class = $_GET["class"];
    $action = $_GET["action"];
}elseif (isset($_POST["class"]) & isset($_POST["action"])) {
    $class = $_POST["class"];
    $action = $_POST["action"];
    echo "POST";
}else {
    die("方法不匹配");
}

$obj = new $class;
$obj->$action();

if (isset($obj->error)){
    echo "<script>";
    echo "alert('$obj->error')";
    echo "</script>";
    if(isset($obj->url)){
        $url = $obj->url;       
        header("Refresh:0;url=${url}");
    }
}elseif (isset($obj->success)){
    echo "<script>";
    echo "alert('$obj->success')";
    echo "</script>";
    if(isset($obj->url)){
        $url = $obj->url;
        header("location:${url}");
    }
    
//     echo $obj->success;
}

