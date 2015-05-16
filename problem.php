<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>问题</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/offcanvas.js"></script>
    <style type="text/css">
        .border{
            border:1px solid red;
        }
        .borderpadding{ padding-top: 70px;}
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
            <a class="navbar-brand" href="#">主页</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="#">问题</a></li>
                <li><a href="#">状态</a></li>
                <li><a href="#">排名</a></li>
                <li><a href="contest.php">竞赛</a></li>
                <li><a href="#">作业</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">登录</a></li>
                <li><a href="#">注册</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container borderpadding">
    <div class="">
        <table class="table table-striped">
            <div style="line-height: 30px"><tr>
                <td>题目编号</td>
                <td>标题</td>
                <td>正确</td>
                <td>提交</td>
                <td>提交成功率</td>
            </tr></div>
            <?php
                require_once("link_mysql.php");
            $sql="";
            $DB=new MyDB();
                for($i=10;$i<60;$i++){
                echo "<div style='line-height: 30px'><tr>
                    <td>&nbsp;10{$i}</span>
                    <td>A+B练习{$i}</span>
                    <td>33{$i}</span>
                    <td>88{$i}</span>
                    <td>50%</td>
                    </tr></div>";
                }
            ?>
        </table>
        </div>
    </div>
</div>
</body>
</html>
