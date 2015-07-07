<?php
session_start();
@header('Content-type: text/html;charset=UTF-8');
require_once("./lib/link_mysqli.php");
$db=new DB();
$proTitle=$_POST['proTitle'];
$proSort=$_POST['proSort'];
$proDescription=$_POST['proDescription'];
$proInput=$_POST['proInput'];
$proOutput=$_POST['proOutput'];
$proSameInput=$_POST['proSameInput'];
$proSameOutput=$_POST['proSameOutput'];
$inputTestData=$_POST['inputTestData'];
$outputTestData=$_POST['outputTestData'];
$proHint=$_POST['proHint'];
$proTimeLimit=$_POST['proTimeLimit'];
$proMemoryLimit=$_POST['proMemoryLimit'];

$teacherID = $_SESSION['teacherID'];

$sql="insert into problem value('','$teacherID','$proTitle','$proDescription','$proInput','$proOutput','$proSameInput','$proSameOutput','$inputTestData','$outputTestData','$proHint','$proSort','$proTimeLimit','$proMemoryLimit','0','0','$isPublish',now())";
$db->GetData($sql);
$db->__destruct();

header("refresh:0.5;url=http://localhost/web/newProblem.php");
print('正在处理，请稍等...<br>1秒后自动跳转。');
?>
