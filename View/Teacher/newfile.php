<?php
header("Content-Type:text/html;charset=utf-8");
session_start();
$a = $_SESSION["user"];
echo $a;