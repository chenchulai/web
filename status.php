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
    <table class="table table-striped table-hover">
<tr>
<th class='text-center'>RunID</th>
<th class='text-center'>problem</th>
<th class='text-center'>User</th>
<th class='text-center'>Result</th>
<th class='text-center'>Time</th>
<th class='text-center'>Memory</th>
<th class='text-center'>Language</th>
<th class='text-center'>CodeLength</th>
<th class='text-center'>SubmitTime</th>
</tr>
<?php
require_once("./lib/link_mysqli.php");
$db = new DB();
$records = 10;
if (isset($_GET['page']) == null)
    $page = 1;
else
    $page = $_GET['page'];
$sql = sprintf("select * from runningLog order by runID desc limit %d,%d",($page-1)*$records,$records);
$result = $db->GetData($sql);
$runID = 'runID';
$proID = 'proID';
$contestTreamID = 'contestTeamID';
$userID = 'userID';
$compileResult = 'compileResult';
$runResult = 'runResult';
$runTime = 'runTime';
$runMemory = 'runMemory';
$programSize = 'programSize';
$submitTime = 'submitTime';
$programType = 'programType';
$logType = 'logType';

while($line=$result->fetch_assoc()){
    $sql = sprintf("SELECT userName FROM account WHERE userID = %d",$line[$userID]);
    $user_result = $db->GetData($sql);
    $user = $user_result->fetch_assoc()['userName'];
    echo "<tr>\n";
    echo "<td class='text-center'>".$line[$runID]."</td>\n";
    echo "<td class='text-center'><a href='./problem.php?id=".$line[$proID]."'>".$line[$proID]."</a></td>\n";
    echo "<td class='text-center'><a href='./userStatus.php?userName={$user}'>{$user}</a></td>\n";
    if ($line[$compileResult] == NULL)
        echo "<td class='text-center'>".$line[$runResult]."</td>\n";
    else
        echo "<td class='text-center'><a href='./compile_error.php?runID=".$line[$runID]."'>compileError</a></td>\n";
    echo "<td class='text-center'>".$line[$runTime]."</td>\n";
    echo "<td class='text-center'>".$line[$runMemory]."</td>\n";
    echo "<td class='text-center'>".$line[$programType]."</td>\n";
    echo "<td class='text-center'>".$line[$programSize]."</td>\n";
    echo "<td class='text-center'>".$line[$submitTime]."</td>\n";
    echo "</tr>";
}
?>
    </table>
<nav>
<ul class="pager">
<?php
$prevPage = $page-1;
$nextPage = $page+1;
if($page == 1)
    echo "<li><a href='#'>Prev Page</a></li>";
else
    echo "<li><a href='./status.php?page={$prevPage}'>Prev Page</a></li>";
if (mysqli_num_rows($result) != $records)
    echo "<li><a href='#'>Next Page</a></li>";
else
    echo "<li><a href='./status.php?page={$nextPage}'>Next Page</a></li>";
?>
</nav>
</div>
<?php
require_once("./footer.html");
?>
</body>
</html>
