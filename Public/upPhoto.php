<?php
header("Content-Type:text/html;charset=utf-8");
require_once '../Model/DbUntil.class.php';
session_start();
$user = $_SESSION["user"];
print_r($_FILES);//获取上传文件的信息
$db = new DbUntil();
if(is_uploaded_file($_FILES["filename"]["tmp_name"])){//判断是否为上传文件
//         echo "是上传文件";
    move_uploaded_file(//将文件从临时文件移动到目标文件
        $_FILES["filename"]["tmp_name"], //临时文件地址
        "up/".$_FILES["filename"]["name"]//目标文件地址
        );
    $address = "up/".$_FILES["filename"]["name"];
//     echo $address;
    $sql = "update `teacher` set `photo` = ? where `teacher`.`t_name`=?";
    $db->addDelUpd($sql, array($address,$user), $con);
    
}

echo $user;
?>