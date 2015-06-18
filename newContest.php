<?php
session_start();
if(!isset($_SESSION["teacherName"])){
    header("location:index.php");
}

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
    <title>新建比赛</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/laydate.js"></script>
    <link href="css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="css/xlstablefilter.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.xlstablefilter.js"></script>
    <script language="JavaScript" type="text/javascript">
        var request=false;
        try{
            request = new XMLHttpRequest();
        } catch (trymicrosoft) {
            try {
                request = new ActiveXObject("Msxml2.XMLHTTP");//较新的ie
            } catch (othermicrosoft) {
                try {
                    request = new ActiveXObject("Microsoft.XMLHTTP");//较老的ie
                } catch (failed) {
                    request = false;
                }
            }
        }
        if(!request)
            alert("Error initializing XMLHttpRequest!");//创建具有错误处理能力的XMLHttpRequest。

        var page=1;
        function loadHTML(){
            document.getElementById("bg").style.display="block";
            document.getElementById("problemList").style.display="block";
            var url="page.php?page=1";
            request.open("GET",url,true);
            request.onreadystatechange=stateChanged;
            request.send(null);
        }
        function NextHTML(){
            page=page+1;
            var url="page.php?page="+page;
            request.open("GET",url,true);
            request.onreadystatechange=stateChanged1;
            request.send(null);
        }
        function PreHTML(){
            page=page-1;
            var url="page.php?page="+page;
            request.open("GET",url,true);
            request.onreadystatechange=stateChanged;
            request.send(null);
        }

        function stateChanged(){
            if (request.readyState == 4) {
                if (request.status == 200) {
                    //var response = request.responseText.split("||");
                  document.getElementById("page").innerHTML=request.responseText;
                   // document.getElementsByName("s1").innerHTML=response[1];
                } else
                    alert("status is " + request.status);
            }
        }

        function confirmButton(){
            document.getElementById("bg").style.display="none";
            document.getElementById("problemList").style.display="none";
        }

        function cancelButton(){
            document.getElementById("bg").style.display="none";
            document.getElementById("problemList").style.display="none";
        }
    </script>
    <style type="text/css">
        .marginTop{margin-top: 50px;}
        .spanMargin{margin-left: 3%;}
        #isPublished,#notPublished{margin-left:8px; }
        #main div{margin-bottom: 10px;}
        #contestExplain{width: 30%;height: 80px;resize: none;}
        .bg{position: absolute; top:0px; left: 0px;z-index: 3;width: 100%;height: 100%;opacity:0.4;background:#000;MozOpacity:0.4;display: none;}
        .box{border:1px solid gray; z-index:5;position:absolute; top:20%; left:10%; background: #CCC; width:80%; padding:20px;text-align:center;display: none;}
    </style>
</head>
<body>
<div class="bg" id="bg"></div>
<?php
include("top.php");
?>
<div class="container marginTop" id="main">
    <div>
        <span>标题：<input type="text" name="contestTitle"></span>
        <span class="spanMargin">开始时间：</span><input type="text"  id="start">
        <span class="spanMargin">结束时间：</span><input type="text"  id="end">
        <span class="spanMargin">是否私有：</span>
        <input type="radio" name="published" checked="checked" id="isPublished">是
        <input type="radio" name="published" id="notPublished">否
        <span class="spanMargin">应用类型：</span>
        <select name="typeOf"><option value="竞赛">竞赛</option><option value="作业">作业</option></select>
    </div>
    <div>竞赛说明：<textarea id="contestExplain"></textarea><input type="button" value="选择题目" onclick="loadHTML()"></div>
</div>

<div class="box container" id="problemList">
    <div class="col-md-7 content1">
        <table class="table table-striped" id="example2">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>题目编号</th>
                <th>题目名称</th>
                <th>作者</th>
                <th>题目类型</th>
                <th>录入时间</th>
                <th>使用状态</th>
            </tr>
            </thead>
            <tbody id="page"></tbody>
        </table>
        <div><a onclick="NextHTML()" href="#">下一页</a><a onclick="PreHTML()" href="#">上一页</a></div>
        <div><input type="button" value="确定" onclick="confirmButton()"><input type="button" value="取消" onclick="cancelButton(this)"></div>
    </div>
    <div class="col-md-4 col-md-offset-1"></div>
</div>
<?php
include("footer.html");
?>
<script>
    //日期范围限制
    var start = {
        elem: '#start',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: laydate.now(), //设定最小日期为当前日期
        max: '2099-12-31', //最大日期
        istime: true,
        istoday: false,
        choose: function(datas){
            end.min = datas; //开始日选好后，重置结束日的最小日期
            end.start = datas //将结束日的初始值设定为开始日
        }
    };

    var end = {
        elem: '#end',
        format: 'YYYY-MM-DD hh:mm:ss',
        min: laydate.now(),
        max: '2099-12-31',
        istime: true,
        istoday: false,
        choose: function(datas){
            start.max = datas; //结束日选好后，充值开始日的最大日期
        }
    };
    laydate(start);
    laydate(end);
</script>
<script type="text/javascript">
    <!--
    $(function() {
        $("#example2").xlsTableFilter({
            checkStyle: "custom"
        });
    });
    //-->
</script>
</body>
</html>