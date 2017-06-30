<?php
require_once 'page.class.php';
require_once '../Model/DbUntil.class.php';
$ll = new page();
$a = $ll->pageRow();
echo $a;




// $sql = "select * from  `student`";
// $ll = new DbUntil();
// $a = $ll->countRow($sql);
// echo $a;