<?php
// namespace Controller;

class yanzhengma
{
    private $image;//设置画布
    private $bg;//随机色
    private $bgcolor;//背景色
    private $color;//随机色
    public function __construct($width,$height){
        $this->image = "imagecreatetruecolor(${width},${height})";
        $this->bg -> $this-> randColor();        
    }
    public function randColor(){
        return rand(1,255);
    }
    public function bgColor(){
        $this->color -> $bg;
        //设置背景色
        $this->bgcolor = "imagecolorallocate($this->${image}, $this->${bg},$this->${bg}, $this->${bg})";
    }
        
    public function yzm(){        
        imagefill($this->$image, 0, 0, $this->$bgcolor);//区域填充
        for($i = 0;$i < 100;$i++){
            $red = imagecolorallocate($this->$image, rand(0,255), rand(0,255), rand(0,255));
            $x = rand(1,imagesx($this->$image));
            $y = rand(1,imagesy($this->$image));
            imagesetpixel($this->$image, $x, $y, $red);
        }
        
        for ($i = 0;$i < 4;$i++){
            $c = imagecolorallocate($this->$image, rand(0,255), rand(0,255), rand(0,255));//生成随机颜色
            $x = rand(1,imagesx($this->$image));
            $y = rand(1,imagesy($this->$image));
            $x1 = rand(1,imagesx($this->$image));
            $y1 = rand(1,imagesy($this->$image));
            imageline($this->$image, $x, $y, $x1, $y1, $c);
        }
        
        $fontsize = 15;
        $arr = range("a", "z");
        for($i = 0;$i < 10;$i++){
            array_push($arr, $i);
        }
        $count = 4;
        $codes = "";
        for ($i = 0;$i < $count;$i++){
            $width = imagesx($this->$image)/$count;
            $code = $arr[array_rand($arr)];
            $color = imagecolorallocate($this->$image, rand(0,255), rand(0,255), rand(0,255));
            imagettftext($this->$image,$fontsize, rand(-20,20), $i*($width)+($width-$fontsize)/2,
                (imagesy($this->$image)-$fontsize)/2+13, $color, "YGYXSZITI2.0.TTF", $code);
            $codes.=$code;
        }
        $_SESSION["code"] = $codes;
        
        imagepng($this->$image);//建立png图片
        imagedestroy($this->$image);//销毁画布
    }
}

?>