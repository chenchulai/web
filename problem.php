<?php
session_start();

require_once("./lib/loginOfValidata.php");
require_once("./lib/link_mysqli.php");
$check = array("id");
validateGetGo($check,"./problemList.php");
$db = new DB();
$id = $db->checkValue($_GET['id']);
$sql = sprintf("select * from problem where proID=%d",$id);
$result = $db->GetData($sql);
$line = $result->fetch_assoc();
if ($line == null || $line[$isPublish] == true)
    header("location:./problemList.php");

$proTitle ="proTitle";
$proDescription = "proDescription";
$proInput = "proInput";
$proOutput = "proOutput";
$proSameInput = "proSameInput";
$proSameOutput = "proSameOutput";
$proHint = "proHint";
$proSort = "proSort";
$proTimeLint = "proTimeLimit";
$proMemoryLimit = "proMemoryLimit";
$proTotalSubmit = "proTotalSubmit";
$proTotalAC = "proTotalAC";
$isPublish = "isPublish";
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <META content="EditPlus" name="Generator">
    <META content="" name="Author">
    <META content="" name="Keywords">
    <META content="" name="Description">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <title>题目</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <style type="text/css">
        #kong{display: inline-block;width: 100px;text-align: right;}
        #hid{display: none;}
        .center {text-align:center;}
    </style>
</head>

<body>
<?php
    require_once("./top.php");
    echo "<div class='container'>";
    echo "<h2 class='text-center text-primary'>$line[$proTitle]</h2>";
    echo "<div class='row'><span id='timeLimit' class='col-md-offset-2 col-md-2 text-success'>时间限制:{$line[$proTimeLint]}</span>";
    echo "<span id='memoryLimit' class='col-md-2 text-success'>内存限制：{$line[$proMemoryLimit]}</span>";
    echo "<span id='total_ac' class='col-md-2 text-success'>总解决数：{$line[$proTotalSubmit]}</span>";
    echo "<span id='total_submit' class='col-md-2 text-success'>总提交数：{$line[$proTotalAC]}</span>";
    echo "</div><h4 class='text-primary'>题目描述</h4><div><span id='description'>".str_replace("\n","<br />",$line[$proDescription])."</span></div>";
    echo "<br />";
    echo "<h4 class='text-primary'>输入描述</h4><div><span id='input'>".$line[$proInput]."</span></div>";
    echo "<br />";
    echo "<h4 class='text-primary'>输出描述</h4><div><span id='output'>".str_replace("\n","<br />",$line[$proOutput])."</span></div>";
    echo "<br />";
    echo "<h4 class='text-primary'>样例输入</h4><div><span id='sameInput'>".str_replace("\n","<br />",$line[$proSameInput])."</span></div>";
    echo "<br />";
    echo "<h4 class='text-primary'>样例输出</h4><div><span id='sameOutput'>".str_replace("\n","<br />",$line[$proSameOutput])."</span></div>";
    echo "<br />";
    echo "<h4 class='text-primary'>提示</h4><div><span id='hint'>".str_replace("\n","<br />",$line[$proHint])."</span></div>";
    echo "<br />";
    echo "<h4 class='text-primary'>分类</h4><div><span id='sort'>".str_replace("\n","<br />",$line[$proSort])."</span></div>";
    echo "<br />";
    echo "<br />";
    echo "<div class='row'>";
    echo "<div class='col-md-1 col-md-offset-5'>";
    echo "<a style='' href='./problemStatus.php?id=".$id."'>";
    echo "<input type='button' class='btn btn-success' value='status'/>";
    echo "</a>";
    echo "</div>";
    echo "<div class='col-md-1'>";
    echo "<a style='' href='./submit_front.php?id=".$id."'>";
    echo "<input type='button' class='btn btn-success' value='submit'/>";
    echo "</a>";
    echo "</div>";
    echo "</div>";
    $result->free_result();
    $db->__destruct();
    require_once("./footer.html");
?>
</div>
</div>
</body>
</html>
