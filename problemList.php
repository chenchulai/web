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
    <script src="js/offcanvas.js"></script>
    <style type="text/css">
.borderPadding{padding-top:70px;}
    </style>
</head>
<body>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./index.html">主页</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./problemList.php">问题</a></li>
                <li><a href="#">状态</a></li>
                <li><a href="#">排名</a></li>
                <li><a href="./contest.php">竞赛</a></li>
                <li><a href="#">作业</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./login.html">登录</a></li>
                <li><a href="./register.html">注册</a></li>
            </ul>
        </div>
    </div>
</nav>
<?php
require_once("link_mysql.php");
require_once("page.php");
$DB=new MyDB();
$strSQL=sprintf("select * from problem where isPublish='%d'",1);
$practice=$DB->GetData($strSQL);
?>
<div class="container borderPadding">
    <div class="">
        <p>当前题目数量<?php $practice->num_rows;?></p>
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
                $successRate=$line['proTotalAC']/$line['proTalSubmit'];
                echo "<div style='line-height: 30px'><tr>
                    <td>{$line['proID']}</td>
                    <td><a href='problem.php'>{$line['proTitle']}</a></td>
                    <td>{$line['proSort']}</td>
                    <td>{$line['proTotalAC']}</td>
                    <td>{$line['proTotalSubmit']}</td>
                    <td>{$successRate}</td>
                    </tr></div>";
                    page($strSQL,'problemList.php');
                }
            $practice->free_result();
            $DB->__destruct();
            ?>
        </table>
    </div>
</div>
</div>
<footer class="panel-footer text-center" >
    <a href="http://www.zhku.edu.cn/depa/jishuanxi/index.htm">
        <p>Copyright © 2015仲恺农业工程学院计算科学学院</p>
    </a>
</footer>
</body>
</html>
