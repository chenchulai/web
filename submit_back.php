<!doctype html>
<html language="en:">
<head>
<meta charset="utf-8"/>
</head>
<body>
<?php
//session_start();

require("./lib/db.php");
$db = new DB();
//$loginUser = $_SESSION['user'];
//if($loginUser == NULL || unset($loginUser))
//    header("location:./submit_front.php");
//
$loginUser = 'haha';
$source = $_POST['source'];
$problemID = $_POST['problemID'];
$filename = $loginUser."_".$problemID;
$dir = "./compile_tmp/";
$file_type;
if ($_POST['language'] == 'c'){
    $file_type = ".c";
}else if ($_POST['language'] == 'c++'){
    $file_type = ".cpp";
}else{
    $file_type = ".java";
}

//将$source保存到文件中
$path = $dir.$filename.$file_type;
$fp = fopen($path,"w");
if (!$fp){
    echo "can not open file";
    echo $path;
    die;
}
fwrite($fp,$source);
fclose($fp);
//提交类型  0代表练习 1代表比赛
$logType=0;

/*$sql = sprintf("insert into runningLog (proID,contestTeamID,userID,compileResult,runResult,runTime,runMemory,programSize,submitTime,programType,logType) values (%d,%d,%d,'%s','%s','%s',%d,%d,%s,'%s',%d)",$problemID,-1,$loginUser,NULL,"running",time(),0,filesize($path),"now()",$_POST['language'],$logType); 
$result = $db->query($sql);
 */
//构造编译命令
if ($_POST['language'] == 'c'){
    $compile_str = "gcc ".$path." -o ".$dir.$filename." 2>&1";
}else if($_POST['language'] == 'c++'){
    $compile_str = "g++ ".$path." -o ".$dir.$filename." 2>&1";
}else{
    $compile_str = "javac ".$path." 2>&1";
}
//执行编译命令
exec($compile_str,$compile_result);
unlink($path);

//编译程序成功
if (count($compile_result) == 0){
//从数据库中读入测试数据
$input;


}
//编译程序错误
else{
    //将编译的错误结果保存到数据库中，方便用户查找。
    $result="";
    foreach($compile_result as $a){
        $result .= str_replace($path,"",$a)."<br />";
    }
}
?>
</body>
</html>

