<?php
    session_start();
    require_once("./lib/link_mysql.php");
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
    <title>录入题目信息</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/offcanvas.js"></script>
    <style type="text/css">
        textarea{height:100px; width: 500px; resize: none;}
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
            <a class="navbar-brand" href="./index.php">主页</a>
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
            <?php
                echo "
                <ul class='nav navbar-nav navbar-right'>
                    <li><a href='./userInformation.php'>{$_session['userName']}</a></li>
                </ul>";
            ?>
        </div><!-- /.nav-collapse -->
    </div><!-- /.container-->
    </nav><!-- /.navbar -->
    <div class="container">
        <form action="#" method="post">
        <div>标题<input type="text" name="proTitle"></div>
        <div>题目分类<select name="selectSort"><option>入门题</option><option>数学建模</option><option>可视化程序设计</option><option>暂不分类</option><option>其他</option></select></div>
        <div>题目描述<textarea name="proDescription"></textarea></div>
        <div>题目输入描述<textarea name="proDescription"></textarea></div>
        <div>题目输出描述<textarea name="proDescription"></textarea></div>
        <div>题目输入样例<textarea name="proDescription"></textarea></div>
        <div>题目输出样例<textarea name="proDescription"></textarea></div>
        <div>输入数据测试用例<textarea name="proDescription"></textarea></div>
        <div>输出数据测试用例<textarea name="proDescription"></textarea></div>
        <div>提示<textarea name="proDescription"></textarea></div>
        <div>题目时间限制<input type="text"></div>
        <div>题目内存限制<input type="text"></div>
        <div>是否开放<input type="radio" name="publish">是<input type="radio" name="publish">否</div>
            <div><input type="submit" value="提交"><input type="reset" value="重置"></div>
        </form>
    </div>
        <footer class=" panel-footer text-center" >
            <a href="http://www.zhku.edu.cn/depa/jishuanxi/index.htm">
                <p>Copyright © 2015仲恺农业工程学院计算科学学院</p>
            </a>
        </footer>
    </body>
</html>