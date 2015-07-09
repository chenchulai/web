<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>状态</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
</head>
<body>
<?php
require_once("./top.php");
?>
<div class="container borderPadding">
<table class = "table table-striped table-hover">
<tr>
<th class="col-md-1 text-center">排名</th>
<th class="col-md-2 text-center">用户名</th>
<th class="col-md-6 text-center">个人说明</th>
<th class="col-md-1 text-center">Solved</th>
<th class="col-md-1 text-center">Submited</th>
<th class="col-md-1 text-center">AC Ratio</th>
</tr>
<?php
require_once("./lib/link_mysqli.php");
$db = new DB();
$sql = sprintf("select userID,count(userID) as ac_number from userSubmitProblem where isfinished = true group by userID order by count(userID) desc limit %d,%d", 0, 30);
$result = $db->GetData($sql);
$i = 1;
while($line = $result->fetch_assoc()){
    $sql = sprintf("select userName,userMoto from account where userID=%d",$line['userID']);
    $userInfo = $db->GetData($sql)->fetch_assoc();
    $userName = $userInfo['userName'];
    $userMoto = $userInfo['userMoto'];
    $sql = sprintf("select sum(submit) as totalSubmit from userSubmitProblem where userID=%d",$line['userID']);
    $totalSubmit = $db->GetData($sql)->fetch_assoc()['totalSubmit'];
    echo "<tr>";
    echo "<td class='text-center'>{$i}</td>";
    echo "<td class='text-center'><a href='./userStatus.php?userName={$userName}'>{$userName}</a></td>";
    echo "<td class='text-center'>{$userMoto}</td>";
    echo "<td class='text-center'>{$line['ac_number']}</td>";
    echo "<td class='text-center'>{$totalSubmit}</td>";
    $ac_ratio = $line['ac_number']/$totalSubmit;
    echo "<td class='text-center'>{$ac_ratio}</td>";
    echo "</tr>";
    $i++;
}
?>
</table>
</div>
<?php
require_once("./footer-fix.html");
?>
</body>
</html>
