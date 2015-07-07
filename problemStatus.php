<?php
require_once("./lib/loginOfValidata.php");
$check = array("id");
validateGetGo($check,"./problemList.php");
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
<th class="col-md-2 text-center">User Name</th>
<th class="col-md-2 text-center">Language</th>
<th class="col-md-2 text-center">CodeLength</th>
<th class="col-md-2 text-center">Run Time</th>
<th class="col-md-2 text-center">Run Memory</th>
<th class="col-md-2 text-center">Submit Time</th>
</tr>
<?php
require_once("./lib/link_mysqli.php");
$id = $_GET['id'];
$db = new DB();
$runResult = "running";
$sql = sprintf("select userID,programType,programSize,runTime,runMemory,submitTime from runningLog where proID=%d and runResult='%s' order by runTime,runMemory,submitTime limit %d,%d",$id,$runResult,0,20);
$result = $db->GetData($sql);
while($line = $result->fetch_assoc()){
    $sql = sprintf("select userName from account where userID=%d",$line['userID']);
    $userName = $db->GetData($sql)->fetch_assoc()['userName'];
    echo "<tr>";
    echo "<td class='text-center'><a href='./userStatus.php?userName={$userName}'>{$userName}</a></td>";
    echo "<td class='text-center'>{$line['programType']}</td>";
    echo "<td class='text-center'>{$line['programSize']}</td>";
    echo "<td class='text-center'>{$line['runTime']}</td>";
    echo "<td class='text-center'>{$line['runMemory']}</td>";
    echo "<td class='text-center'>{$line['submitTime']}</td>";
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
