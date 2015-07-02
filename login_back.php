<?php
session_start();
require("./lib/db.php");
require("./lib/loginOfValidata.php");

$check = array('user','password');
validatePostGo($check,'./login_front.php');

$db = new DB();
$user = $db->check_input($_POST['user']);
$password = $_POST['password'];
$password_type;

if($_POST['userType'] == 'account') {
    $tablename = 'account';
    $name='userName';
    $ID='userID';
    $password_type = "userPassword";
}
if($_POST['userType'] == 'teacher')  {
    $tablename = 'teacher';
    $name='teacherName';
    $ID='teacherID';
    $password_type = "teacherPassword";
}
if($_POST['userType'] == 'admin'){
    $tablename = 'admin';
    $name='adminName';
    $ID='adminID';
    $password_type = "adminPassword";
}


$sql = sprintf("select * from %s where %s = '%s'",$tablename,$name,$user);
$result = $db->query($sql);
if(!mysqli_num_rows($result)){
    $msg = "用户名或密码错误，请重新登录！";
    $path = "./login_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
$line = mysqli_fetch_assoc($result);

if($password != $line[$password_type]){
    $msg = "密码错误，请重新登录";
    $path = "./login_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
$_SESSION[$name] =$_POST['user'];
$_SESSION[$ID] = $line[$ID];
header("location:./index.php");

?>


