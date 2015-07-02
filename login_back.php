<?php
session_start();
require("./lib/db.php");
require("./lib/loginOfValidata.php");

$check = array('user','password');
validatePostGo($check,'./login_front.php');

$db = new DB();
$user = $db->check_input($_POST['user']);
$password = $_POST['password'];
<<<<<<< HEAD
if($_POST['userType'] == 'account') {
    $tablename = 'account';
    $name='userName';
    $ID='userID';
}
if($_POST['userType'] == 'teacher')  {
    $tablename = 'teacher';
    $name='teacherName';
    $ID='teacherID';
}
if($_POST['userType'] == 'admin'){
    $tablename = 'admin';
    $name='adminName';
    $ID='adminID';
}

=======
if($_POST['userType'] == 'account'){
    $tablename = 'account';
    $name_col = 'userName';
    $password_col = 'userPassword';
}
if($_POST['userType'] == 'teacher') {
    $tablename = 'teacher';
    $name_col = 'teacherName';
    $password_col ='teacherPassword';
}
if($_POST['userType'] == 'admin'){
    $tablename = 'admin';
    $name_col = 'adminName';
    $password_col = 'adminPassword';
}

$sql = sprintf("select * from %s where %s = %s",$tablename,$name_col,$user);
>>>>>>> d3156323878dc15658aef586a67c5c305e9ceab3

$sql = sprintf("select * from %s where %s = '%s'",$tablename,$name,$user);
$result = $db->query($sql);
if(!mysqli_num_rows($result)){
    $msg = "用户名或密码错误，请重新登录！";
    $path = "./login_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
$line = mysqli_fetch_assoc($result);
<<<<<<< HEAD

if($password != $line['teacherPassword']){
    $msg = "密码错误，请重新登录";
=======
if($password != $line[$password_col]){
    $msg = "用户名或密码错误，请重新登录";
>>>>>>> d3156323878dc15658aef586a67c5c305e9ceab3
    $path = "./login_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
<<<<<<< HEAD
$_SESSION[$name] =$_POST['user'];
$_SESSION[$ID] = $line['teacherID'];
header("location:./index.php");
=======

$_SESSION['user'] = $_POST['user'];
$_SESSION['userType'] == $_POST['userType'];

if($_POST['userType'] == 'account'){
    header('location:./index.php');
    die;
}
if($_POST['userType'] == 'teacher'){
    
}
if($_POST['userType'] == 'admin'){
    
}
>>>>>>> d3156323878dc15658aef586a67c5c305e9ceab3
?>


