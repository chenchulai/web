<?php
session_start();
@header('Content-type: text/html;charset=UTF-8');
require_once("./lib/link_mysqli.php");
$db=new DB();
$proTitle=$_POST['proTitle'];
$proSort=$_POST['proSort'];
$proDescription=nl2br($_POST['proDescription']);
$proInput=nl2br($_POST['proInput']);
$proOutput=nl2br($_POST['proOutput']);
$proSameInput=nl2br($_POST['proSameInput']);
$proSameOutput=nl2br($_POST['proSameOutput']);
$inputTestDate=nl2br($_POST['inputTestDate']);
$outputTestDate=nl2br($_POST['outputTestDate']);
$proHint=nl2br($_POST['proHint']);
$proTimeLimit=$_POST['proTimeLimit'];
$proMemoryLimit=$_POST['proMemoryLimit'];
$isPublish=$_POST['isPublish'];
$teacherID=$_SESSION['teacherID'];
/*
$sql=sprintf("insert into problem value('','$teacherID','$proTitle','$proDescription','$proInput','$proOutput','$proSameInput','$proSameOutput','$inputTestDate','$outputTestDate','$proHint','$proSort','$proTimeLimit','$proMemoryLimit','0','0','$isPublish',now())");
$db->GetData($sql);
$db->__destruct();
*/
header("refresh:0.5;url=http://localhost/web/newProblem.php");
print('正在处理，请稍等...<br>1秒后自动跳转。');
?>