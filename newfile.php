<?php
// $string = "123,124";
// $arr = explode(",", $string);
// print_r($arr);
// echo "<br>";
// echo count($arr);
// echo "<br>";
// foreach ($arr as $key=>$val){
//     echo $val."<br>";
// }

$string = "abcdefghijklmnopqrstuvwxyz";
// $arr = mb_substr($string, 0,4);
$arr = mb_substr($string,0,4);
echo $arr."<br>".$string;
