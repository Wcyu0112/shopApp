<?php
$str = "1234567898761234";
// echo $str."<br>";
// echo substr($str, 0,4)."<br>";
// $str = substr_replace($str, "",0, 4);
// echo substr($str, 0,4)."<br>";
// $str = substr_replace($str, "",0, 4);
// echo $str."<br>";
$leng = strlen($str);

echo $leng."<br>";
$arr = array();
for ($i=0;$i < $leng;$i+=4){
    $a = substr($str, 0,4)."<br>";//从0开始提取四个长度的字符
    array_push($arr, $a);
    $str = substr_replace($str, "",0, 4);//从0开始替换4个长度的字符为空格
}
print_r($arr);