<?php
session_start();
if(!isset($_SESSION["teacherName"])){
    header("location:index.php");
}
require_once("./lib/link_mysqli.php");
$db=new DB();
$teacherID=$_SESSION["teacherName"];
$contestName=$_POST["contestTitle"];
$contestType=$_POST["typeOf"];
$contestStartTime=$_POST["startTime"];
$contestEndTime=$_POST["endTime"];
$issafe=$_POST["published"];
$contestExplain=nl2br($_POST["contestExplain"]);
$strSQL="insert into contest VALUE ('','$teacherID','$contestName','$contestType','$contestStartTime','$contestEndTime','$contestExplain','0','$issafe')";
$db->GetData($strSQL);
$strSQL="select * from contest where contestName='$contestName'";
$result=$db->GetData($strSQL);
$line=$result->fetch_assoc();
$contestID=$line["contestID"];
$result->free_result();
for($i=0;$i<count($_POST["selectID"]);$i++) {
    $proID =$_POST["selectID"][$i];
    $contestOrder = $_POST["sortID"][$i];
    if($contestType=="作业")
        $strSQL ="insert into pratice VALUE ('','$proID','$contestID','$contestOrder')";
    else
        $strSQL ="insert into contestproblem VALUE ('','$contestID','$proID','$contestOrder')";
    $db->GetData($strSQL);
}
$db->__destruct();
if($contestType=="作业")
header("refresh:1;url=http://localhost/web/work.php");
else
header("refresh:1;url=http://localhost/web/contest.php");
print('正在处理，请稍等...<br>1秒后自动跳转。');
?>