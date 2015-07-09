<?php
session_start();
$key=$_POST["key"];
$value=$_POST["value"];
$op=$_POST["op"];
$arr=array();
if($op=="get"){
    echo json_encode($_SESSION);
}
if($op=="set"){
    $_SESSION[$key]=$value;
    $arr["set"]="1";
    echo json_encode($arr);
}
if($op=="remove"){
    unset($_SESSION[$key]);
    $arr["remove"]="1";
    echo json_encode($arr);
}

if($op=="isset"){
    if(isset($_SESSION[$key])){
        $arr["isset"]="1";
    }else{
        $arr["isset"]="0";
    }
    echo json_encode($arr);
}
?>