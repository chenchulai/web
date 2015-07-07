<?php
session_start();
if(!isset($_SESSION["teacherName"])){
    header("location:index.php");
}
require_once("./lib/link_mysqli.php");
$db=new DB();
if(isset($_POST["selectID"])){
    for($i=0;$i<count($_POST["selectID"]);$i++){
        $proID = $_POST["selectID"][$i];
        $strSQL="update problem set ispublish=1 where proID='$proID'";
        $db->GetData($strSQL);
    }
}
if(isset($_POST["selectIDDel"])){
    for($i=0;$i<count($_POST["selectIDDel"]);$i++){
        $proID = $_POST["selectIDDel"][$i];
        $strSQL="update problem set isPublish=0 where proID='$proID'";
        $db->GetData($strSQL);
    }
}
$db->__destruct();
header("refresh:1;url=http://localhost/web/newPractice.php");
print('正在处理，请稍等...<br>1秒后自动跳转。');
?>