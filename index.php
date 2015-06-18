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
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <br /><br />
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>ACM大学生国际程序设计竞赛</h1>
            <p>ACM国际大学生程序设计竞赛（英语：ACM International Collegiate Programming Contest, ICPC）是由美国计算机协会（ACM）主办的，一项旨在展示大学生创新能力、团队精神和在压力下编写程序、分析和解决问题能力的年度竞赛。经过30多年的发展，ACM国际大学生程序设计竞赛已经发展成为最具影响力的大学生计算机竞赛。赛事目前由IBM公司赞助。 </p>
          </div>
        </div><!--/.col-xs-12.col-sm-9-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <br /><br />
          <div class="list-group">
            <a href="#" class="list-group-item active">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
            <a href="#" class="list-group-item">Link</a>
          </div>
        </div><!--/.sidebar-offcanvas-->
      </div><!--/row-->
</div><!--/.container-->
<?php
include("./footer.html");
?>

  </body>
</html>
