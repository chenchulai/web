
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
<div class="container">
<h2 class="text-center text-primary">Problem Solved</h2>
<?php
require_once("./lib/link_mysqli.php");
$db = new DB();
$userName = $_GET['userName'];
$sql = sprintf("select userID from account where userName='%s'",$userName);
$userID = $db->GetData($sql)->fetch_assoc()['userID'];
$sql = sprintf("select proID from userSubmitProblem where userID=%d and isfinished = %s",$userID,'true');
$result = $db->GetData($sql);
echo "<div class='row'>";
for($i = 0; $i < mysqli_num_rows($result); $i++){
    $proID = $result->fetch_assoc()['proID'];
    echo "<div class='col-md-1'>";
    echo "<a href='./problem.php?id={$proID}'><button class='col-md-12 btn btn-success'>{$proID}</button></a>";
    echo "</div>";
    if($i % 12 == 11){
        echo "</div>";
        echo "<div class='row'>";
    }
}
echo "</div>";
?>
<h2 class="text-center text-primary">Problem Tried</h2>
<?php
require_once("./footer-fix.html");
$sql = sprintf("select proID from userSubmitProblem where userID=%d and isfinished = %s",$userID,'false');
$result = $db->GetData($sql);
echo "<div class='row'>";
for($i = 0; $i < mysqli_num_rows($result); $i++){
    $proID = $result->fetch_assoc()['proID'];
    echo "<div class='col-md-1'>";
    echo "<a href='./problem.php?id={$proID}'><button class='col-md-12 btn btn-warning'>{$proID}</button></a>";
    echo "</div>";
    if($i % 12 == 11){
        echo "</div>";
        echo "<div class='row'>";
    }
}
echo "</div>";
?>
</div>
</body>
</html>
