<?php
@header('Content-type: text/html;charset=UTF-8');
?>
<?php
if(isset($_SESSION['teacherName'])){
    echo "
<div class='panel-primary center-block' style='top:30%;left:0;width: 6%;position: fixed;height:30px;font-size: 10px;text-align: center;'>
    <div class='panel-heading'>管理</div>
        <ul class='list-group'>
            <li class='list-group-item bg-info'><a href='newProblem.php'>问题</a></li>
            <li class='list-group-item'><a href='newContest.php'>作业竞赛</a></li>
            <li class='list-group-item'><a href='newAccount.php'>班级学生</a></li>
            <li class='list-group-item'><a href='newNotice.php'>发布公告</a></li>
        </ul>
    </div>";}?>
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
                <li><a href="./status.php">状态</a></li>
                <li><a href="./ranklist.php">排名</a></li>
                <li><a href="./contest.php">竞赛</a></li>
                <li><a href="./work.php">作业</a></li>
                <li><a href="#">FAQ</a></li>
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
