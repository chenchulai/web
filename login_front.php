<?php
session_start();
session_destroy();
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
    <title>仲恺ACM首页</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
</head>

  <body>
<?php
include("./top.php");
?>
  <div class="container">
    <h3 class="text-center">用户登录</h3>
    <form action="./login_back.php
        " method="POST">
    <div class="row">
        <div class="col-md-1 col-md-offset-4 text-right">
           用户类型: 
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <select name="userType" class="dropdown">
                    <option value="account">普通用户</option>
                    <option value="teacher">教师</option>
                    <OPTION value="admin">管理员</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-4 text-right">
           用户名: 
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="TEXT" name="user" placeholder="请输入用户名" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-4 text-right">
           密码: 
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="PASSWORD" name="password" placeholder="请输入密码" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 col-sm-offset-4">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-4">
                    <button class="btn btn-success col-sm-10" type="submit"> 登录</button> 
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <a href="#"><button type="button" class="btn btn-link ">忘记密码</button>
            </div>
        </div>
    </div>
    </form>
  </div>
<?php
include("./footer.html");
?>
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
  <script src="js/offcanvas.js"></script>
  </body>
</html>
