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
      <script src="js/jquery-2.1.4.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
      <script src="js/offcanvas.js"></script>
</head>
<body>
<?php
include("./top.html");
?>
<div class="container">
    <h2 class="text-center">重置密码</h2>
    <form action="./forgetMail_back.php" method="POST">
        <div class="row">
        <div class="col-md-2 col-md-offset-5">
        <h5>
        你的帐号为：
        </h5>
        </div>
        </div>
        <div class="col-md-2 col-md-offset-5 ">
<?php
        echo "<input type=\"text\" name=\"{$_GET['userName']}\" onlyread>";
?>
        </div>
        <div class="row">
        <div class="col-md-2 col-md-offset-5">
        <h5>
        请输入你的新密码：
        </h5>
        </div>
        </div>
        <div class="row">
        <div class="col-md-2 col-md-offset-5 ">
        <input type="password" name="password">
        </div>
        </div>
        <div class="row">
        <div class="col-md-2 col-md-offset-5">
        <h5>
        请确认你的新密码：
        </h5>
        </div>
        </div>
        <div class="col-md-2 col-md-offset-5 ">
        <input type="password" name="checkPassword">
        </div>
        <div class="row">
        <br />
        </div>
        <div class="row">
        <div class="col-md-2 col-md-offset-5">
        <input type="submit" class="btn btn-lg btn-success col-md-offset-2 col-md-6"  role="button"value="发送"/>
        </div>
        </div>
    </form>
</div>

<?php
include("./footer.html");
?>
</body>
</html>
