<?php

require_once 'Model/DbUntil.class.php';
class sql
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
    var $db;
    public function __construct(){
        $this->db = new DbUntil();
    }
    
    private function create($username,$password,$level){
        $this->username = $username;
        $this->password = $password;
        $this->level = $level;
    }  
    
    public function zhichengCx(){
        $sql = "select * from  `zhicheng`";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function chaxunTech(){
//         $t_id = $_GET["t_id"];
//         $c_id = $_GET["c_id"];
        
//         $_SESSION["t_id"] = $t_id;
//         $c_id = $_SESSION["c_id"];
        $sql = "select teacher.t_id,teacher.t_name,teacher.sex,zhicheng.zc_name,college.x_name,major.z_name from teacher left join major on teacher.z_id=major.z_id 
  left join college on teacher.x_id=college.x_id left join zhicheng on zhicheng.zc_id=teacher.zhichen";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function chaxunStu(){
        $sql = "select student.s_id,student.name,student.sex,student.birthday,college.x_name,major.z_name from student left join major on student.z_id=major.z_id 
left join college on student.x_id=college.x_id";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function xueyuanCx() {
        $sql = "select * from `college`";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
//     public function zhuanyeCx(){
//         $sql = "select * from `major`";
//         $arr = $this->db->search($sql, array(), $con);
//         $json = json_encode($arr);
//         echo $json;
//     }
    
        public function zhuanyeCx(){
            $val = $_GET["val"];
            $sql = "select * from `major` where x_id = ?";
            $arr = $this->db->search($sql, array($val), $con);
            $json = json_encode($arr);
            echo $json;
        }
    
    
    public function addTech() {
        $z_id = $_GET["z_id"];
        $t_name = $_GET["t_name"];
        $sex = $_GET["sex"];
        $zhicheng = $_GET["zhicheng"];
        $xueyuan = $_GET["xueyuan"];
        $zhuanye = $_GET["zhuanye"];
        $img = "up/photo.jpg";
        $sql1 = "insert into `user`(`id`,`name`,`dengji`) values(?,?,?)";
        $this->db->addDelUpd($sql1, array($z_id,$t_name,2), $con);
        
        $sql = "insert into `teacher`(`t_id`,`t_name`,`sex`,`z_id`,`x_id`,`zhichen`,`photo`) values(?,?,?,?,?,?,?)";
        $arr = $this->db->addDelUpd($sql, array($z_id,$t_name,$sex,$zhuanye,$xueyuan,$zhicheng,$img), $con);
        $json = json_encode($arr);
        echo $z_id;
    }
    
    public function addStu(){
        $s_id = $_GET["s_id"];
        $s_name = $_GET["s_name"];
        $sex = $_GET["sex"];
        $bir = $_GET["bir"];
        $img = "up/photo.jpg";
        $xueyuan = $_GET["xueyuan"];
        $zhuanye = $_GET["zhuanye"];
        $sql1 = "insert into `user`(`id`,`name`,`dengji`) values(?,?,?)";
        $arr = $this->db->addDelUpd($sql1, array($s_id,$s_name,3), $con);

        $sql = "insert into `student`(`name`,`sex`,`birthday`,`x_id`,`z_id`,`s_id`,`photo`) values(?,?,?,?,?,?,?)";
        $arr = $this->db->addDelUpd($sql, array($s_name,$sex,$bir,$xueyuan,$zhuanye,$s_id,$img), $con);
        $json = json_encode($arr);
        echo $json;
        
    }
    
    public function addCourse() {
        $c_id = $_GET["c_id"];
        $_SESSION["c_id"] = $c_id;
        $t_id = $_GET["t_id"];
        $_SESSION["t_course_id"] = $t_id;
        
        $c_name = $_GET["c_name"];
        $c_add = $_GET["c_add"];
        $c_time = $_GET["c_time"];
        $sql1 = "insert into `course`(`c_id`,`xueshi`,`t_id`) values(?,?,?)";
        $arr1 = $this->db->addDelUpd($sql1, array($c_id,$c_time,$t_id), $con);
        
        $sql = "insert into `coursemessage`(`c_name`,`c_address`,`c_id`) values(?,?,?)";
        $arr = $this->db->addDelUpd($sql, array($c_name,$c_add,$c_id),$con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function chaxunCours(){
     //   $t_id = $_SESSION["t_course_id"];
        $sql = "select course.c_id,coursemessage.c_name,coursemessage.c_address,course.xueshi,teacher.t_name from course left join coursemessage on course.c_id=coursemessage.c_id left join teacher on course.t_id=teacher.t_id";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }

    public function stuCourMages(){
        $sql = "select student.s_id,student.name,student.sex,major.z_name from student left join major on student.z_id = major.z_id";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function updatePwd() {
        $user = $_SESSION["user"];
        $user_id = $_GET["user_id"];
        $old_pwd = $_GET["old_pwd"];
        $new_pwd = $_GET["new_pwd"];
//      echo $user."----".$user_id;
        
        
        if($user == $user_id){
            $sql = "select password from `user` where `name`=? and `password`=?";
            $arr = $this->db->search($sql, array($user_id,$old_pwd), $con);
//             $json = json_encode($arr);
//             print_r ($arr[0][0]);
            if ($con > 0){
                if($old_pwd == $arr[0][0]){
                    $upSql = "update `user` set `password` = ? where `name`= ?";
                    $upArr = $this->db->addDelUpd($upSql, array($new_pwd,$user_id), $con);
                    $josna = json_encode($upArr);
                    echo $josna;
                }else {
                    echo "不想动";
                }
                
            }else{
                echo "用户名或密码错误";
            }
            
        }else {
            echo "你不能修改自己以外的用户密码。";
        }
    }  
    
    public function shan(){
        $table = $_GET["table"];
        $sCol = $_GET["sCol"];
        $sId = $_GET["id"];
        $sql = "DELETE FROM `${table}` WHERE `${sCol}` =?";
        $this->db->addDelUpd($sql, array($sId), $con);
        $sql1 = "delete from `user` where `id`=?";
        $arr1 = $this->db->addDelUpd($sql1, array($sId), $con);
        echo $sCol.$table.$sId;
//         $this->shanOk($table, $sId, $sCol);
    }
    public function shanOk($table,$sId,$sCol) {
        
        $sql = "delete from `${table}` where `${sCol}` = ${sId}";
        $arr = $this->db->addDelUpd($sql, array(), $con);
        $json = json_encode($arr);
//         $sql1 = "delete from `user` where `id`=${sId}";
//         $arr1 = $this->db->addDelUpd($sql1, array(), $con);
        if ($json){
            echo "删除成功。";
        }else echo "删除失败";
    }
    
    public function shanCours() {
        $id = $_GET["id"];
        $sql = "delete from `coursemessage` where `c_id` = ?";
        $arr = $this->db->addDelUpd($sql, array($id), $con);
        if($con > 0){
            $sql1 = "delete from `course` where `c_id` = ?";
            $arr = $this->db->addDelUpd($sql1, array($id), $con);
            echo "删除成功。";
        }
    }
    
    
    
    public function chaxunShaixuan(){
        $selTechLeix = $_GET["selTechLeix"];
        $selInp = $_GET["selInp"];
        $table = "";
        if ($selTechLeix==1){
            $selTechLeix = "t_id";
            $table = "teacher";
        }elseif($selTechLeix==2){
            $selTechLeix = "t_name";
            $table = "teacher";
        }elseif ($selTechLeix==3){
            $selTechLeix = "sex";
            $table = "teacher";
        }elseif ($selTechLeix==4){
            $selTechLeix = "x_name";
            $table = "college";
        }elseif ($selTechLeix==5){
            $selTechLeix = "z_name";
            $table = "major";
        }
//         echo $selTechLeix;
        $sql = "select teacher.t_id,teacher.t_name,teacher.sex,zhicheng.zc_name,college.x_name,major.z_name from teacher left join major on teacher.z_id=major.z_id
  left join college on teacher.x_id=college.x_id left join zhicheng on zhicheng.zc_id=teacher.zhichen where `${table}`.`${selTechLeix}`=?";
        $arr = $this->db->search($sql, array($selInp), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function chaxunStuShaixuan() {
        $selStuLeixing = $_GET["selStuLeixing"];
        $selInp = $_GET["selInp"];
        $table = "";
        if ($selStuLeixing==1){
            $selStuLeixing = "s_id";
            $table = "student";
        }elseif($selStuLeixing==2){
            $selStuLeixing = "name";
            $table = "student";
        }elseif ($selStuLeixing==3){
            $selStuLeixing = "sex";
            $table = "student";
        }elseif ($selStuLeixing==4){
            $selStuLeixing = "x_name";
            $table = "college";
        }elseif ($selStuLeixing==5){
            $selStuLeixing = "z_name";
            $table = "major";
        }
        $sql = "select student.s_id,student.name,student.sex,student.birthday,college.x_name,major.z_name from student left join major on student.z_id=major.z_id
left join college on student.x_id=college.x_id where `${table}`.`${selStuLeixing}` = ?";
        $arr = $this->db->search($sql, array($selInp), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function bianjiTech(){
        $id = $_GET["bianhao"];
        $sql = "select teacher.t_id,teacher.t_name,teacher.sex,zhicheng.zc_name,college.x_name,major.z_name from teacher left join major on teacher.z_id=major.z_id
  left join college on teacher.x_id=college.x_id left join zhicheng on zhicheng.zc_id=teacher.zhichen where `teacher`.`t_id` = ?";
        $arr = $this->db->search($sql, array($id), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    
    
    
    
    
    public function techInfo(){
    	$user = $_SESSION["user"];
    	$sql = "select teacher.t_id,teacher.t_name,teacher.sex,zhicheng.zc_name,college.x_name,major.z_name from teacher left join major on teacher.z_id=major.z_id 
  left join college on teacher.x_id=college.x_id left join zhicheng on zhicheng.zc_id=teacher.zhichen where `teacher`.`t_name`=?";
        $arr = $this->db->search($sql, array($user), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function imgView(){
    	$user = $_SESSION["user"];
    	$sql = "select `photo` from `teacher` where `t_name`=?";
    	$arr = $this->db->search($sql,array($user),$con);
    	$json = json_encode($arr);
    	echo $json;
    }
    public function imgViewStu(){
        $user = $_SESSION["user"];
        $sql = "select `photo` from `student` where `name`=?";
        $arr = $this->db->search($sql,array($user),$con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function techLookCours(){
        $user = $_SESSION["user"];
        $sql = "select course.c_id,coursemessage.c_name,course.xueshi,teacher.t_name,coursemessage.c_address from `course` join `teacher` on `course`.`t_id`=`teacher`.`t_id` join `coursemessage` on `course`.`c_id`=`coursemessage`.`c_id`";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function stuLookInfo() {
        $user = $_SESSION["user"];
        $sql = "select student.s_id,student.name,student.sex,student.birthday,college.x_name,major.z_name from student left join major on student.z_id=major.z_id
left join college on student.x_id=college.x_id where `student`.`name` = ?";
        $arr = $this->db->search($sql, array($user), $con);
        $json = json_encode($arr);
        echo $user;
    }
    
    public function stuLookCours() {
        $user = $_SESSION["user"];
        $sql = "select course.c_id,coursemessage.c_name,coursemessage.c_address,teacher.t_name from course join coursemessage on course.c_id=coursemessage.c_id join teacher on teacher.t_id=course.t_id";
        $arr = $this->db->search($sql, array(), $con);
        $json = json_encode($arr);
        echo $json;
    }
    
    public function stuChekCoursStop(){
       $user = $_SESSION["user"];
       $sql = "select c_id from `student` where `name`=?";
       $arr = $this->db->search($sql, array($user), $con);
       $json = json_encode($arr);
        echo $json;
    }
    
    public function stuCheckedCours() {
        $user = $_SESSION["user"];
        $cId = $_GET["cId"];
        
        /* $arr = array();
        $a = strlen($cId);
        for ($i=0;$i < $a;$i+=4){
            $aa = substr($cId, 0,4);//从0开始提取四个长度的字符
            array_push($arr, $aa);
            $cId = substr_replace($cId, "",0, 4);//从0开始替换4个长度的字符为空格
        } 
        $value = json_encode($arr);
        echo $value; */
        
       $sql = "update `student` set `c_id`=? where `student`.`name`=?";
       $value = $this->db->addDelUpd($sql, array($cId,$user), $con);
       $json = json_encode($value);
       echo $json;
    }
    
    public function stuOkCours(){
        $user = $_SESSION["user"];
        $sql = "select student.c_id,coursemessage.c_name,coursemessage.c_address,teacher.t_name from `course` join `student` on `student`.`c_id`=`course`.`c_id` join `teacher` on `course`.`t_id`=`teacher`.`t_id` join `coursemessage` on `coursemessage`.`c_id`=`course`.`c_id` where `student`.`name`=?";
        $value = $this->db->search($sql, array($user), $con);
        $json = json_encode($value);
        echo $json;
    }
}

?>