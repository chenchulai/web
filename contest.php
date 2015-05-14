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
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <style type="text/css">
        .contestCenter{ margin:0 auto;}
        p{text-align:center; line-height:50px;}
    </style>
</head>

<body>
<?php
    require_once("link_mysql.php");
    include("top.html");
?>
<div class="contestCenter">
<?php
	for($i=0;$i<100;$i++){
		echo "<p>这是第".$i."条记录</p>";
	}
include("footer.html");
?>
</div><!--/.container-->
<script src="js/jquery-2.1.4.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>