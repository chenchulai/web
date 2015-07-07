<?php
@header('Content-type: text/html;charset=UTF-8');
?>
<nav class="navbar navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">主页</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="./problemList.php">问题</a></li>
                <li><a href="#">状态</a></li>
                <li><a href="#">排名</a></li>
                <li><a href="./contest.php">竞赛</a></li>
                <li><a href="./work.php">作业</a></li>
                <li><a href="#">FAQ</a></li>
                <?php
                if(isset($_SESSION['teacherName'])){
                echo "
                <li class='dropdown'>
                    <a href='#' class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false'>管理<span class='caret'></span></a>
                    <ul class='dropdown-menu' role='menu'>
                        <li><a href='newAccount.php'>创建账号</a></li>
                        <li><a href='newContest.php'>创建比赛</a></li>
                        <li><a href='newProblem.php'>创建题目</a></li>
                        <li><a href='newPractice.php'>发布练习</a></li>
                        <li><a href='newNotice.php'>发布公告</a></li>
                    </ul>
                </li>";}
                ?>
            </ul>
            <?php
            if(isset($_SESSION['userName'])) {
                echo "<ul class='nav navbar-nav navbar-right'>
                <li><a href='#'>{$_SESSION['userName']}</a></li>
                <li><a href='./login_front.php'>注销</a></li>
            </ul>";
            }
            else if(isset($_SESSION['teacherName'])){
                echo "<ul class='nav navbar-nav navbar-right'>
                <li><a href='#'>{$_SESSION['teacherName']}</a></li>
                <li><a href='./login_front.php'>注销</a></li>
            </ul>";
            }
            else if(isset($_SESSION['adminName'])){
                echo  "<ul class='nav navbar-nav navbar-right'>
                <li><a href='#'>{$_SESSION['adminName']}</a></li>
                <li><a href='./login_front.php'>注销</a></li>
            </ul>";
            }
            else {
                echo "<ul class='nav navbar-nav navbar-right'>
                <li><a href='./login_front.php'>登录</a></li>
                <li><a href='./register_front.php'>注册</a></li>
            </ul>";
            }
            ?>

        </div><!-- /.nav-collapse -->
    </div><!-- /.container -->
</nav><!-- /.navbar -->
