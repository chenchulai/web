<?php
require('./lib/db.php');
$db = new DB();

$array = explode('.',base64_decode($_GET['p']));
$userName = $db->check_input(trim($array[0]));
$sql = sprintf("select userPassword from account where userName = %s",$userName);
$result = $db->query($sql);
if(mysql_num_rows($result) == 0){
    $path='./index.php';
    $msg='密码修改失败，请于管理员联系！';
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
$line = mysqli_fetch_assoc($result);
$userPassword = $line['userPassword'];
$checkCode = md5($array['0'].'+'.$userPassword);
if ($array[1] == $checkCode){
    //header("location:./resetUserPass_front.php?userName=$userName");
    //die;
    echo "<input name=\"userName\" value=\"$userName\" onlyread>";
    echo "<input name=\"password\" type=\"password\">";
    echo "<input name=\"checkPassword\" type=\"password\">";
}else{
    $path='./index.php';
    $msg='密码修改失败，请于管理员联系！';
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
?>
