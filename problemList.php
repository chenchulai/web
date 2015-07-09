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
include("top.php");
require_once("./lib/link_mysqli.php");
$db=new DB();
$sql = sprintf("select count(1) from problem where isPublish='1'");
$result = $db->GetData($sql);
$total_result = mysqli_fetch_array($result)[0];
$records = 1;
if (isset($_GET['page']) == null)
    $page = 1;
else
    $page = $_GET['page'];
$strSQL=sprintf("select * from problem where isPublish=%d limit %d,%d",1,($page-1)*$records,$records);
$practice=$db->GetData($strSQL);
?>
<div class="container borderPadding">
        <table class="table table-striped table-hover">
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
<nav class="col-md-4 col-md-offset-4">
  <ul class="pagination">
<?php
//换页功能的实现
$prevPage = $page-1;
$nextPage = $page+1;
if ($page == 1)
    echo "<li><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
else
    echo "<li><a href='./problemList.php?page={$prevPage}' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
for($i=$page-5;$i<$page;$i++)
    if($i>=1&&($i-1)*$records<$total_result)
        echo "<li><a href='./problemList.php?page={$i}'>{$i}</a></li>";
echo "<li class='active'><a href='./problemList.php?page={$page}'>{$page}<span class='sr-only'>(current)</span></a></li>";
    for($i = $page+1; $i<$page+5 && ($i)*$records<$total_result;$i++)
        echo "<li><a href='./problemList.php?page={$i}'>{$i}</a></li>";
if($page*$records >= $total_result)
    echo "<li><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
else
    echo "<li><a href='./problemList.php?page={$nextPage}' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
?>
  </ul>
</nav>
</div>
<?php
include("footer-fix.html");
?>
</body>
</html>
