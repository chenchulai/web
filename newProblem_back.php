<?php
session_start();
@header('Content-type: text/html;charset=UTF-8');
require_once("./lib/link_mysqli.php");
$db=new DB();
$proTitle=$_REQUEST['proTitle'];
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
$isPublish=$_POST['isPublish'];
$teacherID=$_SESSION['teacherID'];
$state=$_REQUEST["state"];
if($state=="show"){
    $data=array();
    $sql="select * from problem where proTitle='$proTitle'";
    $result=$db->GetData($sql);
    $line=$result->fetch_assoc();
    $data=$line;
    echo json_encode($data);
    die;
}
elseif($state=="insert"){
    $sql=sprintf("insert into problem value('','$teacherID','$proTitle','$proDescription','$proInput','$proOutput','$proSameInput','$proSameOutput','$inputTestData','$outputTestData','$proHint','$proSort','$proTimeLimit','$proMemoryLimit','0','0','$isPublish',now())");
    $db->GetData($sql);
    $db->__destruct();
    die;
}
elseif($state=="modify"){
    $sql="update problem set VALUE ('','$teacherID','$proTitle','$proDescription','$proInput','$proOutput','$proSameInput','$proSameOutput','$inputTestData','$outputTestData','$proHint','$proSort','$proTimeLimit','$proMemoryLimit','0','0','$isPublish',now());";
}
elseif($state=="del"){
    $sql="delete problem where proTitle='$proTitle' and teacherID=$teacherID";
}
else{header("location:newProblem.php");}


header("refresh:1;url=http://localhost/web/newProblem.php");
print('正在处理，请稍等...<br>1秒后自动跳转。');
?>