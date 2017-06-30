<?php
require_once 'Model/DbUntil.class.php';
require_once 'loginYanzheng.class.php';
class User
{
    var $id;
    var $username;
    var $password;
    //保存等级
    var $level;
    //保存失败信息
    var $error;
    //保存成功信息
    var $success;
    //跳转的页面
    var $url;
    var $db;
    var $yanzhengma;
    public function __construct(){
        $this->db = new DbUntil();
        $this->yanzhengma = new loginYanzheng();
    }
    
    private function create($username,$password,$level){
        $this->username = $username;
        $this->password = $password;
        $this->level = $level;
    }
    /**
     * 注册方法，传两个参数
     * username代表用户名
     * password代表密码
     * 也可以使用不传的方式
     */
    public function register(){
        if(isset($_POST["user"])&isset($_POST["pwd"])){
            $username = $_POST["user"];
            $password = $_POST["pwd"];
            $sql = "select * from `user` where name=?";
            $this->db->search($sql,array($username),$con);
            if($con>0){
                $this->error = "用户名已存在";
            }else{
                $dengji=0;
                if($username=="admin"){
                    $dengji=1;
                };
                $sql1 = "insert into `user`(`name`,`password`) values(?,?)";
                $res = $this->db->addDelUpd($sql1,array($username,$password), $con);
                if($res){
                    $this->success = "注册成功";
                    $this->url="htmls/login.html.php";
                }
            }
        }
    }
    
    /**
     * 登陆方法
     */
    public function login(){
        $codes = $_SESSION["code"];
        $yzm = $_POST["yzm"];
        $log = $_POST["logg"];
        
        if($yzm == $codes){
            $user = $_POST["user"];
            $_SESSION["user"] = $user;
            $_COOKIE["user"] = $user;
            
            $pwd = $_POST["pwd"];
            $dengji = $_POST["sel"];
            $sql = "select * from `user` where `name`=? and `password`=? and `dengji`=?";
            $arr = $this->db->search($sql,array($user,$pwd,$dengji),$con);
            if($con>0){
                $this->create($user, $pwd, $dengji);
                $this->success = "登陆成功";
                $_SESSION["log"] = $log;
                if($this->level==1){
                    $this->url="http://localhost/xiangmuTwo/View/Admin/indexAdmin.html";
                }elseif($this->level==2){
                    $this->url="http://localhost/xiangmuTwo/View/Teacher/indexTech.html";
                }elseif ($this->level == 3){
                    $this->url="http://localhost/xiangmuTwo/View/Student/indexStu.html";
                }
            }else {
                $this->url="http://localhost/xiangmuTwo/View/login.html";
                $this->error="用户名或者密码错误";
            }
        }else {
            $this->error = "验证码错误哦";
            $this->url="http://localhost/xiangmuTwo/View/login.html";
        }        
    }
    
    public function logout(){
        unset($_SESSION["user"]);
        unset($_SESSION["log"]);
        $this->success = "退出成功";
//         $log = $_POST["log"];
//         $this->url = "http://localhost/xiangmuTwo/View/login.html";
        header("location:http://localhost/xiangmuTwo/View/login.html");
        echo $log;
       
    }
    public function __call($fun,$args){
        echo "不能调用不存在的方法${fun},"."参数是:";
        print_r($args);
    }
    
    
    
    
}

?>