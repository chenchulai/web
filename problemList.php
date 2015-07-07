<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>问题列表</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <style type="text/css">
.borderPadding{padding-top:70px;}
th,tr,td{text-align: center; }
    </style>
</head>
<body>
<?php
require_once("./lib/link_mysqli.php");
include("top.php");
$db=new DB();
$strSQL=sprintf("select * from problem where isPublish=1");
$practice=$db->GetData($strSQL);
?>
<div class="container borderPadding">
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-striped">
            <tr>
                <td>题目编号</td>
                <td>标题</td>
                <td>类型</td>
                <td>正确</td>
                <td>提交</td>
                <td>提交成功率</td>
            </tr>
            <?php
            while($line=$practice->fetch_assoc()){
                if($line['proTotalSubmit']==0){
                    $successRate=0;
                }
                else {
                    $successRate = $line['proTotalAC'] / $line['proTotalSubmit'];
                }
                echo "<div style='line-height: 30px'><tr>
                    <td>{$line['proID']}</td>
                    <td><a href='problem.php?id={$line['proID']}'>{$line['proTitle']}</a></td>
                    <td>{$line['proSort']}</td>
                    <td>{$line['proTotalAC']}</td>
                    <td>{$line['proTotalSubmit']}</td>
                    <td>{$successRate}</td>
                    </tr></div>";
                }
            $practice->free_result();
            $db->__destruct();
            ?>
        </table>
    </div>
</div>
<?php
include("footer.html");
?>
</body>
</html>
