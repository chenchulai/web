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
include('./top.php');
?>

<div class="container">
<div class="jumbotron col-md-6 col-md-offset-3">
<?php
    $msg = $_GET['msg'];
    $path = $_GET['path'];
    if(!isset($path))
        $path = './index.html';
    echo '<h1>欢迎使用本系统</h1>';
    echo "<p class=\"lead text-center\">$msg</p>";
    echo "<p><a class=\"btn btn-lg btn-success col-md-offset-4 col-md-4\" href=\"$path\" role=\"button\">返回</a></p>";
?>
      </div>
</div>

<?php
include('./footer.html');
?>
</body>
</html>
