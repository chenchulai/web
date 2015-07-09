<?php
session_start();
if(!isset($_SESSION["teacherName"])){
    header("location:index.php");
}
require_once("./lib/link_mysqli.php");
$db=new DB();
$state=$_REQUEST["state"];
if($state=="search"){
    $search=$_REQUEST["search"];
    $strSQL="select * from contest where contestName LIKE '%{$search}%' or contestType LIKE '%{$search}%' or teacherID like '%{$search}%' or teacherID in (select teacherID from teacher where teacherName LIKE '%{$search}%')";
    $result=$db->GetData($strSQL);
    $data=array();
    while($line=$result->fetch_assoc()){
        $strSQL="select * from teacher where teacherID='{$line['teacherID']}'";
        $teacher=$db->GetData($strSQL);
        $line1=$teacher->fetch_assoc();
        $line["teacherName"]=$line1["teacherName"];
        $teacher->FreeResult;
        array_push($data,$line);
    }
    echo json_encode($data);
    die;
}
if($state=="show"){
    $contestID=$_REQUEST["contestID"];
    $data=array();
    $strSQL="select * from contest where contestID='$contestID'";
    $result=$db->GetData($strSQL);
    $line=$result->fetch_assoc();
    $result->Free_result;
    $data=$line;
    $strSQL=" select proID,contestOrder as pOrder  from contestproblem where contestID='$contestID' UNION select proID,problemOrder as pOrder from pratice where contestID='$contestID'";
    $result=$db->GetData($strSQL);
    $data["proID"]=array();
    $data["contestOrder"]=array();
    while($line=$result->fetch_assoc()){
        array_push($data["proID"],$line["proID"]);
        array_push($data["contestOrder"],$line["pOrder"]);
    }
    echo json_encode($data);
    die;
}
$teacherID=$_SESSION["teacherID"];
$contestName=$_POST["contestTitle"];
$contestType=$_POST["typeOf"];
$contestStartTime=$_POST["startTime"];
$contestEndTime=$_POST["endTime"];
$issafe=$_POST["published"];
$contestExplain=$_POST["contestExplain"];

if($state=="insert") {
    $strSQL = "insert into contest VALUE ('','$teacherID','$contestName','$contestType','$contestStartTime','$contestEndTime','$contestExplain','0','$issafe')";
    $db->GetData($strSQL);
    $strSQL = "select * from contest where contestName='$contestName'";
    $result = $db->GetData($strSQL);
    $line = $result->fetch_assoc();
    $contestID = $line["contestID"];
    $result->free_result();
    for ($i = 0; $i < count($_POST["selectID"]); $i++) {
        $proID = $_POST["selectID"][$i];
        $contestOrder = $_POST["sortID"][$i];
        if ($contestType == "作业")
            $strSQL = "insert into pratice VALUE ('','$proID','$contestID','$contestOrder')";
        else
            $strSQL = "insert into contestproblem VALUE ('','$contestID','$proID','$contestOrder')";
        $db->GetData($strSQL);
    }
    $db->__destruct();
    if($contestType=="作业")
        header("refresh:1;url=http://localhost/web/work.php");
    else
        header("refresh:1;url=http://localhost/web/contest.php");
    print('正在处理，请稍等...<br>1秒后自动跳转。');
    die;
}
if($state=="modify") {
    $contestID=$_REQUEST["contestID"];
    $strSQL="delete from contestProblem WHERE contestID='$contestID'";
    $db->GetData($strSQL);
    $strSQL="delete from pratice where contestID='$contestID'";
    $db->GetData($strSQL);
    $strSQL="delete from contest where contestID='$contestID'";
    $db->GetData($strSQL);
    $strSQL = "insert into contest VALUE ('$contestID','$teacherID','$contestName','$contestType','$contestStartTime','$contestEndTime','$contestExplain','0','$issafe')";
    $db->GetData($strSQL);
    $strSQL = "select * from contest where contestName='$contestName'";
    $result = $db->GetData($strSQL);
    $line = $result->fetch_assoc();
    $contestID = $line["contestID"];
    $result->free_result();
    for ($i = 0; $i < count($_POST["selectID"]); $i++) {
        $proID = $_POST["selectID"][$i];
        $contestOrder = $_POST["sortID"][$i];
        if ($contestType == "作业")
            $strSQL = "insert into pratice VALUE ('','$proID','$contestID','$contestOrder')";
        else
            $strSQL = "insert into contestproblem VALUE ('','$contestID','$proID','$contestOrder')";
        $db->GetData($strSQL);
    }
    $db->__destruct();
    header("refresh:1;url=http://localhost/web/newContest.php");
    print('修改成功，请稍等...<br>1秒后自动跳转。');
    die;
}
if($state=="delete"){
    $contestID=$_REQUEST["contestID"];
    $strSQL="delete from contestProblem WHERE contestID='$contestID'";
    $db->GetData($strSQL);
    $strSQL="delete from pratice where contestID='$contestID'";
    $db->GetData($strSQL);
    $strSQL="delete from contest where contestID='$contestID'";
    $db->GetData($strSQL);
    die;
}
?>