<?php
session_start();
require_once("./lib/db.php");
require_once("./lib/loginOfValidata.php");
$userID = $_SESSION['userID'];
if($userID== NULL || isset($userID) == false)
    header("location:./login_front.php");
$check = array("problemID","language","source");
validatePostGo($check,"./submit_front.php?id=".$_POST['problemID']);

$db = new DB();
$source = $_POST['source'];
$problemID = $_POST['problemID'];
$filename ="Main_".$userID."_".$problemID;
$dir = "./compile_tmp/";
$file_ype;
if ($_POST['language'] == 'c'){
    $file_type = ".c";
}else if ($_POST['language'] == 'c++'){
    $file_type = ".cpp";
}else{
    $file_type = ".java";
}

//将$source保存到文件中
$path = $dir.$filename.$file_type;
if($file_type == ".java")
    $source = str_replace("Main",$filename,$source);
$fp = fopen($path,"w");
if (!$fp){
    echo "can not open file";
    echo $path;
    die;
}
fwrite($fp,$source);
fclose($fp);

//提交类型  0代表作业 1代表比赛
$logType=0;
$time = date('Y-m-d H:i:s');

$sql = sprintf("insert into runningLog (proID,userID,compileResult,runResult,runTime,runMemory,programSize,submitTime,programType,logType) values (%d,%d,'%s','%s','%s',%d,%d,'%s','%s',%d)",$problemID,$userID,NULL,"running",0,0,filesize($path),$time,$_POST['language'],$logType); 
$result = $db->query($sql);

//构造编译命令
if ($_POST['language'] == 'c'){
    $compile_str = "gcc ".$path." -o ".$dir.$filename." 2>&1";
}else if($_POST['language'] == 'c++'){
    $compile_str = "g++ ".$path." -o ".$dir.$filename." 2>&1";
}else{
    $compile_str = "/usr/java/jdk1.7.0_79/bin/javac ".$path." 2>&1";
}

//执行编译命令
exec($compile_str,$compile_result);
unlink($path);

//编译程序成功
if (count($compile_result) == 0){
//从数据库中读入测试数据
$sql = sprintf("select inputTestData,outputTestData from problem where proID=%d",$problemID);
$result = $db->query($sql);
$line = $result->fetch_assoc();
$inputTestData = $line['inputTestData'];
$outputTestData = $line['outputTestData'];
$path = $dir.$filename."_input";
$fp = fopen($path,"w");
if ($fp < 0){
    echo "can't create ".$path;
    die;
}

fwrite($fp,$inputTestData);
fclose($fp);
$cmd = "./compile_tmp/run_program ".$dir.$filename." ".$path;
exec($cmd,$run_result);
for($i=0;$i<count($run_result);$i++)
    echo $run_result[$i]."<br />";
var_dump($run_result);
die;

}
//编译程序错误
else{
    //将编译的错误结果保存到数据库中，方便用户查找。
    $result="";
    foreach($compile_result as $a){
        $result .= str_replace($path,"Main",$a)."<br />";
    }
    $result = $db->check_input($result);
    $sql = sprintf("update runningLog set compileResult = '%s' where proID=%d and userID=%d and submitTime='%s'",$result,$problemID,$userID,$time);
    if(!$db->query($sql)){
        echo "更新数据失败";
    }else{
        header("location:./status.php");
    }
}
?>

