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
include("./top.html");
?>
  <div class="container">
    <h2 class="text-center">用户注册</h2>
    <form action="./register_back.php" method="POST">
    <div class="row">
        <div class="col-md-1 col-md-offset-4">
            <p class="text-right">
           用户名: 
           </p>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="TEXT" name="user" placeholder="请填写用户名字符数少于64" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-4 text-rigth">
            <p class="text-right">
           个人说明: 
           </p>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <TEXTAREA name='moto' rows="2" cols="29px" placeholder="请填入少于100字符的内容"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-4 text-rigth">
            <p class="text-right">
           密码: 
           </p>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="PASSWORD" name="password" placeholder="请填写长度少于20位密码" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-1 col-md-offset-4 text-rigth">
            <p class="text-right">
           确认密码: 
           </p>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="PASSWORD" name="checkPassword" placeholder="请再次确认密码" class="form-control" required>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-1 col-md-offset-4 text-rigth">
            <p class="text-right">
           用户邮箱: 
           </p>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="TEXT" name="email" placeholder="该邮箱用于找回用户密码" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-4 col-sm-4">
           <div class="row">
            <div class="col-sm-offset-2 col-sm-6">
            <input type="submit" class="btn btn-success col-sm-8" value="注册"/>
           </div>
           <div class="col-sm-4">
               <h5>已有帐号?<a class="btn-link" href="./login.html">登录</a></h5>
            </div>
        </div>
        </div>
    </div>
    </form>
</div><!--/.container-->
<?php
include("./footer.html");
?>
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
  <script src="js/offcanvas.js"></script>
  </body>
</html>
