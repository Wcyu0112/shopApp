<?php

class loginYanzheng
{
    function loginYZM() {
        header("Access-Control-Allow-Origin:*");
        header("Cache-Control:no-cache");
//         session_start();
        $user = $_GET["user"];
        $pwd = $_GET["pwd"];
        $js = $_GET["js"];
        $yzm = $_GET["yzm"];
        $log = $_GET["log"];
        $_SESSION["button"] = $log;
        $_SESSION["user"] = $user;
        $_SESSION["pwd"] = $pwd;
        $_SESSION["dengji"] = $js;
        $codes = $_SESSION["code"];
        // echo json_encode(array($user,$pwd,$js,$yzm,$codes,$log));
        return json_encode(array($user,$pwd,$js,$yzm,$codes,$log));
        if($yzm != $codes){
            return false;
        }else{
           return true; 
        }
    }
}

?>