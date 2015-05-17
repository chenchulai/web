<?php
session_start();
require("./lib/db.php");
require("./lib/loginOfValidata.php");

$check = array('user','password');
validatePostGo($check,'./login_front.php');

$db = new DB();

$user = $db->check_input($_POST['user']);
$password = $_POST['password'];
if($_POST['userType'] == 'account')
    $tablename = 'account';
if($_POST['userType'] == 'teacher')    
    $tablename = 'teacher';
if($_POST['userType'] == 'admin')
    $tablename = 'admin';

$sql = sprintf("select * from %s where userName = %s",$tablename,$user);

$result = $db->query($sql);
if(!mysqli_num_rows($result)){
    $msg = "该用户不存在，请重新登录！";
    $path = "./login_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}

$line = mysqli_fetch_assoc($result);

if($password != $line['userPassword']){
    $msg = "密码错误，请重新登录";
    $path = "./login_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}

$_SESSION['user'] = $user;
$_SESSION['userType'] == $_POST['userType'];

if($_POST['userType'] == 'account'){
    header('location:./index.php');
    die;
}
if($_POST['userType'] == 'teacher'){
    
}
if($_POST['userType'] == 'admin'){
    
}
?>


