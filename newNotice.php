<?php
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
  <script src="js/jquery-2.1.4.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
 <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
  <script src="js/offcanvas.js"></script>
</head>
<body>
<?php
include("./top.php");
?>
<div class="container">
<h3 class="text-center">发布公告</h3>
<br />
<form class="form-horizontal submit" action="./newNotice_back.php" method="POST">
<div class="row">
<div class="col-md-offset-2 col-md-2 text-right">
<label>公告标题:</label>
</div>
<div class="col-md-4">
<input type='text' class='form-control' name='noticeTitle'/>
</div>
</div>
<br />
<br />
<div class="row">
<div class="col-md-offset-2 col-md-8">
<textarea class="form-control" name="content" cols="30" rows="18" spellcheck="false">
</textarea>
</div>
</div>
<br/>
<div class="form-group">
<input type="Submit" class="btn btn-success col-md-2 col-md-offset-5" value="发布"/> 
</div>
<br/>
<br/>
<br/>
</form>
</div>
<?php
include("./footer.html");
?>
</body>
</html>