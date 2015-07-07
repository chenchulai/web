<?php
session_start();
require_once("./lib/loginOfValidata.php");
require_once("./lib/link_mysqli.php");
$check = array('noticeTitle','content');
validatePostGo($check,"./index.php");

$teacherID = $_SESSION['teacherID'];
$noticeTitle = $_POST['noticeTitle'];
$content = $_POST['content'];
$db = new DB();
$sql = sprintf("insert into notice values('',%d,'%s',%s,'%s')",$teacherID,$content,'now()',$noticeTitle);
$result = $db->GetData($sql) ;
header("location:./newNotice.php");
?>
