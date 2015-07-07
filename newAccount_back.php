<?php
session_start();
if(!isset($_SESSION["teacherName"])){
    header("location:index.php");
}
require_once("./lib/link_mysqli.php");
$db=new DB();
$clazz=$_POST["clazz"];
$userName=$_POST["userName"];
$userMotto=$_POST["userMotto"];
$userPSW=$_POST["userPSW"];
$userEmail=$_POST["userEmail"];
date_default_timezone_set("PRC");
$userRegisterDate=date("Y-m-d H:i:s");
if($clazz!=null){
    $strSQL="select * from clazz WHERE className='$clazz'";
    $result=$db->GetData($strSQL);
    if($line=$result->fetch_assoc()){
        $classID=$line["classID"];
    }else{
        $result->free_result;
        $strSQL="insert into clazz VALUE ('','$clazz')";
        $db->GetData($strSQL);
        $strSQL="select * from clazz WHERE className='$clazz'";
        $result=$db->GetData($strSQL);
        $line=$result->fetch_assoc();
        $classID=$line["classID"];
    }
    $result->free_result;
    $strSQL = "insert into account VALUE('','$classID',''$userName','$userMotto','$userPSW','$userEmail','$userRegisterDate','0','0')";
}
else {
    $strSQL = "insert into account (userID,userName,userMotto,userPassword,userEmail,userRegisterDate,userSubmit,userSovle)VALUE('','$userName','$userMotto','$userPSW','$userEmail','$userRegisterDate','0','0')";
}$db->GetData($strSQL);
$db->__destruct();
header("refresh:1;url=http://localhost/web/newAccount.php");
print('正在处理，请稍等...<br>1秒后自动跳转。');
?>