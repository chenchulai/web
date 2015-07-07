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
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/laydate.js"></script>
    <style type="text/css">
        .marginTop{margin-top: 50px;}
        #main div{margin-bottom: 10px;}
        .bg{position: absolute; top:0px; left: 0px;z-index: 3;width: 100%;height: 100%;opacity:0.4;background:#000000;MozOpacity:0.4;display: none;}
        .box{border:1px solid gray; z-index:5;position:absolute; top:20%; left:10%; background: #CCC; width:80%; padding:20px;display: none;}
        .problem{width: 100%; overflow: auto;height: 100%;border: 1px solid gray;}
        #selectPro{display: none;}
    </style>
    <script language="JavaScript" type="text/javascript">
        var page=1;
        var countPage;
        var checkArr=new Array();
        function firstLoad(){
            if(page==0)
                return;
            page=1;
            loadHTML();
        }
        function loadHTML(){
            $("#bg").show();
            $("#problemList").show();
            $.ajax({
                url:"practice_page.php",
                type:"GET",
                data:{page:page},
                success:stateChanged
            });
        }
        function stateChanged(dataObj){
            var Obj=dataObj.split(',');
            countPage=Obj[0];
            $("#page").html(Obj[1]);
            if(checkArr[page]){
                $("#table input:checkbox").each(function(){
                    for(var i=0;i<checkArr[page].length;i++){
                        if($(this).val()== checkArr[page][i]){
                            $(this).attr("checked","true");
                        }
                    }
                });
                checkArr[page]=new Array();
            }
        }
        function NextHTML(){
            if(page+1>countPage)
                return;
            if(!checkArr[page]) checkArr[page]=new Array();
            $("#table input:checkbox:checked").each(function(){checkArr[page].push($(this).val());});
            page=page+1;
            loadHTML();
        }
        function PreHTML(){
            if(page-1<=0)
                return;
            if(!checkArr[page]) checkArr[page]=new Array();
            $("#table input:checkbox:checked").each(function(){checkArr[page].push($(this).val());});
            page=page-1;
            loadHTML();
        }
        function confirmButton(){
            $("#selectPro").html("");
            $("#selectTable").html("");
            if(!checkArr[page]) checkArr[page]=new Array();
            $("#table input:checkbox:checked").each(function(){checkArr[page].push($(this).val());});
            $("#bg").hide();
            $("#problemList").hide();
            var selectPro=new Array();
            for(var i=1;i<=countPage;i++){
                if(checkArr[i]==null)
                    continue;
                for(var j=0;j<checkArr[i].length;j++){
                    selectPro.push(checkArr[i][j]);
                }
            }
            if(selectPro.length==0){
                $("#selectPro").html("");
                return;
            }
            $.ajax({
                url:"practice_page.php",
                type:"GET",
                data:{selectPro:selectPro},
                dataType:"JSON",
                success:showSelect
            });
        }
        function showSelect(Dataobj){
            var sp="";
            for(var i=0;i<Dataobj.proID.length;i++) {
                var table = $("#selectTable");
                var tr = $("<tr></tr>");
                tr.appendTo(table);
                $("<td>&nbsp;</td><td>"+Dataobj.proID[i]+"</td><td>"+Dataobj.proTitle[i]+"</td><td>×</td>").appendTo(tr);
                sp+="<input type='checkbox' name='selectID[]' checked='checked' value="+Dataobj.proID[i]+">";
            }
            $("#selectPro").html(sp);
        }
        function cancelButton(){
            $("#bg").hide();
            $("#problemList").hide();
        }
    </script>
    <script language="JavaScript" type="text/javascript">
        var pageDel=1;
        var countPageDel;
        var delArr=new Array();
        function delLoad(){
            if(pageDel==0)
                return;
            pageDel=1;
            loadHTMLDel();
        }
        function loadHTMLDel(){
            $("#bg").show();
            $("#problemListDel").show();
            $.ajax({
                url:"practice_page2.php",
                type:"GET",
                data:{page:pageDel},
                success:stateChangedDel
            });
        }

        function stateChangedDel(dataObj){
            var Obj=dataObj.split(',');
            countPageDel=Obj[0];
            $("#pageDel").html(Obj[1]);
            if(delArr[pageDel]){
                $("#tableDel input:checkbox").each(function(){
                    for(var i=0;i<delArr[pageDel].length;i++){
                        if($(this).val()== delArr[pageDel][i]){
                            $(this).attr("checked","true");
                        }
                    }
                });
                delArr[pageDel]=new Array();
            }
        }

        function NextHTMLDel(){
            if(pageDel+1>countPageDel)
                return;
            if(!delArr[pageDel]) delArr[pageDel]=new Array();
            $("#tableDel input:checkbox:checked").each(function(){delArr[pageDel].push($(this).val());});
            pageDel=pageDel+1;
            loadHTMLDel();
        }

        function PreHTMLDel(){
            if(pageDel-1<=0)
                return;
            if(!delArr[pageDel]) delArr[pageDel]=new Array();
            $("#tableDel input:checkbox:checked").each(function(){delArr[pageDel].push($(this).val());});
            pageDel=pageDel-1;
            loadHTMLDel();
        }

        function confirmButtonDel(){
            $("#selectProDel").html("");
            $("#selectTableDel").html("");
            if(!delArr[pageDel]) delArr[pageDel]=new Array();
            $("#tableDel input:checkbox:checked").each(function(){delArr[pageDel].push($(this).val());});
            $("#bg").hide();
            $("#problemListDel").hide();
            var selectPro=new Array();
            for(var i=1;i<=countPageDel;i++){
                if(delArr[i]==null)
                    continue;
                for(var j=0;j<delArr[i].length;j++){
                    selectPro.push(delArr[i][j]);
                }
            }
            if(selectPro.length==0){
                $("#selectProDel").html("");
                return;
            }
            $.ajax({
                url:"practice_page.php",
                type:"GET",
                data:{selectPro:selectPro},
                dataType:"JSON",
                success:showSelectDel
            });
        }

        function showSelectDel(Dataobj){
            var sp="";
            for(var i=0;i<Dataobj.proID.length;i++) {
                var table = $("#selectTableDel");
                var tr = $("<tr></tr>");
                tr.appendTo(table);
                $("<td>&nbsp;</td><td>"+Dataobj.proID[i]+"</td><td>"+Dataobj.proTitle[i]+"</td><td>×</td>").appendTo(tr);
                sp+= "<input type='checkbox' name='selectIDDel[]' checked='checked' value="+Dataobj.proID[i]+">";
            }
            $("#selectProDel").html(sp);
        }

        function cancelButtonDel(){
            $("#bg").hide();
            $("#problemListDel").hide();
        }
    </script>
</head>
<body>
<div class="bg" id="bg"></div>
<?php
include("top.php");
?>
<div class="container marginTop" id="main">
    <form action="newPractice_back.php" method="post">
        <div>
            <input type="button" value="添加题目" onclick="firstLoad()">
            <div class="problem">
                <div id="selectPro"></div>
                <table id="selectTable" class="table">
                    <tr>
                        <th>题目ID</th>
                        <th>题目名称</th>
                    </tr>
                </table>
            </div>
        </div>
        <div><input type="button" value="删除题目" onclick="delLoad()">
            <div class="problem">
                <div id="selectProDel"></div>
                <table id="selectTableDel" class="table">
                    <tr>
                        <th>题目ID</th>
                        <th>题目名称</th>
                    </tr>
                </table>
            </div>
        </div>
        <input type="submit" value="提交">
    </form>
</div>

<div class="box container" id="problemList">
    <div class="content1">
        <table class="table table-striped" id="table">
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
        <div><input type="button" value="确定" onclick="confirmButton()"><input type="button" value="取消" onclick="cancelButton()"></div>
    </div>
</div>

<div class="box container" id="problemListDel">
    <div class="content1">
        <table class="table table-striped" id="tableDel">
            <thead>
            <tr>
                <th>&nbsp;</th>
                <th>题目编号</th>
                <th>题目名称</th>
                <th>作者</th>
                <th>题目类型</th>
                <th>录入时间</th>
            </tr>
            </thead>
            <tbody id="pageDel"></tbody>
        </table>
        <div><a onclick="NextHTMLDel()" href="#">下一页</a><a onclick="PreHTMLDel()" href="#">上一页</a></div>
        <div><input type="button" value="确定" onclick="confirmButtonDel()"><input type="button" value="取消" onclick="cancelButtonDel()"></div>
    </div>
</div>
<?php
include("footer.html");
?>
</body>
</html>