<?php
require_once("./lib/loginOfValidata.php");
$check = array("id");
validateGetGo($check,"./index.php");
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
require_once("./top.php");
?>
<div class="container">
<div class="row text-center">
<?php
require_once("./lib/link_mysqli.php");
$id = $_GET['id'];
$db = new DB();
$sql = sprintf("select noticeTitle,content from notice where noticeID = %d",$id);
$result = $db->GetData($sql)->fetch_assoc();
echo "<h2>{$result['noticeTitle']}</h2>";
echo "<br />";
echo "<br />";
echo "<div class='row'>".str_replace("\n","<br />",$result['content'])."</div>";
?>
</div>
</div>
<?php
require_once("./footer-fix.html");
?>
</body>
</html>
