<?php
require("./lib/loginOfValidata.php");
require("./lib/db.php");

$check = array('user', 'password', 'checkPassword','email');
validatePostGo($check,'./register_front.php');

$db = new DB();

$user = $db->check_input($_POST['user']);
$password = $db->check_input($_POST['password']);
$checkPassword = $db->check_input($_POST['checkPassword']);
$email = $db->check_input($_POST['email']);
$moto = $db->check_input($_POST['moto']);
$userType = $_POST['userType'];

if ($password != $checkPassword){
    $msg = '密码不一致，请重新登录';
    $path = "./login_front.php";
    header("location:./hint.php?mgs=$msg&psth=$path");
    die;
}
$tableName = "account";

$sql = sprintf("select * from %s where userName=%s",$tableName, $user);
$result = $db->query($sql);

//用户名被占用
if(mysqli_num_rows($result)){
    $msg = "该用户名已经被占有，请重新登录";
    $path ="./register_front.php";
    header("location:./index.html?msg=$msg&path=$path");
    die;
}
$date = date("Y-m-d");
$date = $db->check_input($date);

$sql = sprintf("insert into %s (userName,userMoto,userPassword,userRegisterData,userEmail) values (%s,%s,%s,%s,%s)",$tableName,$user,$moto,$password,$date,$email);

$result = $db->query($sql);
if($result == true){
    $msg = "用户注册成功！";
    $path = "./index.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}else{
    $msg = "用户注册失败,请联系管理员";
    $path = "./register_front.php";
    header("location:./hint.php?msg=$msg&path=$path");
    die;
}
?>
