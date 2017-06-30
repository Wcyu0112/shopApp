<?php
header('Content-Type:image/png');//设置头部
session_start();//设置session,必须处于脚本顶部
$image = imagecreatetruecolor(100,17);//创建画布，第一个参数为宽，第二个参数为高
$bg = rand(1,255);
$bgcolor = imagecolorallocate($image, 255, 255, 255);//设置背景色
imagefill($image, 0, 0, $bgcolor);//区域填充
for($i = 0;$i < 100;$i++){
    $red = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));
    $x = rand(1,imagesx($image));
    $y = rand(1,imagesy($image));
    imagesetpixel($image, $x, $y, $red);
}

for ($i = 0;$i < 4;$i++){
    $c = imagecolorallocate($image, rand(0,255), rand(0,255), rand(0,255));//生成随机颜色
    $x = rand(1,imagesx($image));
    $y = rand(1,imagesy($image));
    $x1 = rand(1,imagesx($image));
    $y1 = rand(1,imagesy($image));
    imageline($image, $x, $y, $x1, $y1, $c);
}

$fontsize = 15;
$arr = range("a", "z");
for($i = 0;$i < 10;$i++){
    array_push($arr, $i);
}
$count = 4;
$codes = "";
for ($i = 0;$i < $count;$i++){
    $width = imagesx($image)/$count;
    $code = $arr[array_rand($arr)];
    $color = imagecolorallocate($image, rand(0,100), rand(0,100), rand(0,100));
    imagettftext($image,$fontsize, rand(-20,20), $i*($width)+($width-$fontsize)/2,
        (imagesy($image)-$fontsize)/2+13, $color, "YGYXSZITI2.0.TTF", $code);
    $codes.=$code;
}
$_SESSION["code"] = $codes;

imagepng($image);//建立png图片
imagedestroy($image);//销毁画布