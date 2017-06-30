<?php
// namespace Controller;

require_once 'Model/DbUntil.class.php';
class page
{
    var $db;
    public function __construct(){
        $this->db = new DbUntil();
    }
    
   /*  <?
    *   //设置当前页显示的数量(这个数量可任意设置) 
    *    $limit=20;
    *     //初始化数据库搜索起始记录 
    *      if (!emptyempty($start)) $start=0;  
    *     mysql_connect("localhost","","");
    *       mysql_select_db(database); 
    *      //设置数据库记录总数  
    *      $result=mysql_query("select * from table");  
    *      $num_max=mysql_numrows($result);  
    *      $result=mysql_query("select * from table order by id desc limit $start,$limit);
    *        $num=mysql_numrows($result);
    *          echo "<table><tr><td>翻页功能</td></tr>";  
    *          if (!emptyempty($num)) {  
    *          for ($i=0;$i<$num;$i++) {
    *            $val=mysql_result($result,$i,"val");
    *              $val1=mysql_result($result,$i,"val1");  
    *              echo "<tr><td>$val</td><td>$val1</td></tr>"; 
    *               }  }  
    *               echo "<tr><td>";  
    *               //设置向前翻页的跳转  
    *               $prve=$start-$limit;  
    *               if ($prve>=0) { 
    *                echo "<a href=page.php?start=$prve>prve</a>";  
    *                }
    *                  //设置向后翻页的跳转  
    *                  $next=$start+$limit;  
    *                  if ($next<$num_max) {
    *                    echo "<a href=page.php?start=$next>next</a>";  }
    *                      echo "</td></tr></table>";  ?> */
        
    
    public function pageRow() {
        $sql = "select * from `student`";
        $a = $this->db->countRow($sql);
        echo $a;
        
    }
}

?>