<?php
require_once('./lib/Mail.php');
require('./lib/db.php');
require('./lib/loginOfValidata.php');

$check = array('userName','userEmail');
validatePostGo($check,"./forgetMail_front.php");

$db = new DB();

$userName = trim($_POST['userName']);
$userEmail = trim($_POST['userEmail']);
$userName = $db->check_input($userName);

$sql = sprintf('select userName,userEmail from account where userName=%s',$userName);
$result = $db->query($sql);
if(mysqli_num_rows($result) == 0){
    $path="./forgetMail_front.php";
    $msg = '该用户名不存在，请重新输入';
    header("location:./hint.php?msg=$msg & path=$path");
}
$line = mysqli_fetch_assoc($result);
$user_password = $line['userPassword'];
$user_email = $line['userEmail'];
if($user_email != $userEmail){
    $path="./forgetMail_front.php";
    $msg = "你输入的注册邮箱不正确，请重新输入";
    header("location:./hint.php?msg=$msg&path=$path");
}

$x = md5($userName.'+'.$user_password);
$String - base64_encode($userName.".".$x);

$to = $user_email;
$from = "gbdelajiyouxiang@163.com";
$host = "smtp.163.com";
$hostUser = "gbdelajiyouxiang@163.com";
$hostPassword = "xinji12223";

$subject = "你的密码找回信，请不要回复此邮件！";
$body = "尊敬的".$username."先生/女士：<br />    你使用了本站提供的密码找回功能，如果你确认此密码找回功能是你启用的，请点击下面的链接，按流程进行密码重设。<br><br>欢迎你经常访问本站。站长无喱头谢谢你经常光顾本站！<br><Br><a href='/resetUserPass.php?p=".$String.">确认密码找回</a>";

$headers = array('From'=>$from, 'To'=>$to,'$subject'=>$subject);
$smtp = Mail::factory('smtp'.array('host'=>$host,'auth'=>true,'user'=>$hostUser,'password'=>$hostPassword));
$mail = $smtp->send($to, $headers,$body);

if(PEAR::isError($mail)){
    $path='./index.php';
    $msg='邮件发送错误，请于管理员联系';
    header("location:./hint.php?msg=$msg&path=$path");
}else{
    $path='./index.php';
    $msg = '邮件发送成功，请在15分钟内查收';
    header("location:./hint.php?msg=$msg&path=$path");
}

