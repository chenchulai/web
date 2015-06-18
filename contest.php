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
    <style type="text/css">
        .contestCenter{ margin:0 auto;}
        p{text-align:center; line-height:50px;}
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
            <a class="navbar-brand" href="index.html">主页</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./problemList.php">问题</a></li>
                <li><a href="#">状态</a></li>
                <li><a href="#">排名</a></li>
                <li><a href="contest.php">竞赛</a></li>
                <li><a href="#">作业</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="./login.html">登录</a></li>
                <li><a href="./register.html">注册</a></li>
            </ul>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->
<?php
    require_once("link_mysql.php");
?>
<div class="container contestCenter">
<?php
	for($i=0;$i<100;$i++){
		echo "<p>这是第".$i."条记录</p>";
	}
?>

</div><!--/.container-->

<footer class="panel-footer text-center" >
    <a href="http://www.zhku.edu.cn/depa/jishuanxi/index.htm">
        <p>Copyright © 2015仲恺农业工程学院计算科学学院</p>
    </a>
</footer>


</body>
</html>