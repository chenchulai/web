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
    <title>竞赛</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="contest.js" type="text/javascript"></script>
    <style type="text/css">
        .main{font-size: 17px;}
        h3{font-weight: 800;}
        .main div{margin-top:10px;}
        #Explain{display: inline;overflow: visible;}
    </style>
</head>
<body onload="startTime()">
<?php
include("./top.php");
require_once("./lib/link_mysqli.php");
$db=new DB();
$contestID=$_REQUEST["contestID"];
$strSQL="select * from contest where contestID='$contestID'";
$result=$db->GetData($strSQL);
$contest=$result->fetch_assoc();
?>
<div class="container main">
    <div><h3><?php echo $contest["contestName"];?></h3></div>
    <div><span>竞赛状态：</span><span id="state"></span></div>
    <div><span>启动时间：</span><span id="startTime"><?php echo $contest["contestStartTime"];?></span></div>
    <div><span>结束时间：</span><span id="endTime"><?php echo $contest["contestEndTime"];?></span></div>
    <div><span>现在时间：</span><span id="getTime"></span></div>
    <div><div>竞赛说明：</div><div id="Explain"><?php echo $contest["contestExplain"]?></div></div>
    <div>
        <table class="table table-bordered">
            <tr>
                <th>题目编号</th>
                <th>标题</th>
                <th>通过</th>
                <th>提交</th>
            </tr>
            <?php
            $result->free_result();
            $strSQL="select * from contestproblem where contestID='$contestID'";
            $re=$db->GetData($strSQL);
            $strSQL="select * from problem where proID in (select proID from contestproblem where contestID='$contestID')";
            $result=$db->GetData($strSQL);
            while($problem=$result->fetch_assoc()){
                $con=$re->fetch_assoc();
                echo "<tr>
                        <td>{$con['contestOrder']}</td>
                        <td><a href='problem.php?proID={$problem['proID']}'>{$problem['proTitle']}</a></td>
                        <td>{$problem['proTotalAC']}</td>
                        <td>{$problem['proTotalSubmit']}</td>
                    </tr>";
            }
            ?>
        </table>
    </div>
</div>
</body>
</html>