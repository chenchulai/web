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
    <script type="text/javascript" src="js/laydate.js"></script>
    <script language="JavaScript" type="text/javascript">
        var page=1;
        var countPage;
        var checkArr=new Array();
        var selectPro=new Array();
        function firstLoad(){
            $("#bg").height($(document).height());
            if(page==0)
                return;
            page=1;
            loadHTML();
        }
        function loadHTML(){
            $("#bg").show();
            $("#problemList").show();
            $.ajax({
                url:"page.php",
                type:"GET",
                data:{page:page,select:selectPro},
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
            $("#selectTbody").html("");
            if(!checkArr[page]) checkArr[page]=new Array();
            $("#table input:checkbox:checked").each(function(){checkArr[page].push($(this).val());});
            $("#bg").hide();
            $("#problemList").hide();
            selectPro=new Array();
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
                url:"page.php",
                type:"GET",
                data:{selectPro:selectPro},
                dataType:"JSON",
                success:showSelect
            });
        }

        function showSelect(Dataobj){
            var sp="";
            var current=65;
            for(var i=0;i<Dataobj.length;i++) {
               var tbody = $("#selectTbody");
               var tr = $("<tr></tr>");
                if(Dataobj[i].isPublish=="0") Dataobj[i].isPublish="未使用";
                else Dataobj[i].isPublish="已使用";
               tr.appendTo(tbody);
               $("<td>"+Dataobj[i].proID+"</td>" +
               "<td>"+Dataobj[i].proTitle+"</td>" +
               "<td>"+Dataobj[i].proSort+"</td>"+
               "<td>"+Dataobj[i].entryTime+"</td>"+
               "<td>"+Dataobj[i].isPublish+"</td>").appendTo(tr);
                sp+="<input type='checkbox' name='sortID[]' checked='checked' value="+String.fromCharCode(current++)+">" +
                "<input type='checkbox' name='selectID[]' checked='checked' value="+Dataobj[i].proID+">";
            }
            $("#selectPro").html(sp);
        }
        function cancelButton(){
            $("#bg").hide();
            $("#problemList").hide();
        }

        function checkSubmit(){
            if($("input[name='contestTitle']").val()=="") {
                alert("请输入标题");
                return false;
            }if($("#start").val()==""||$("#end").val()==""){
                alert("请正确输入时间");
                return false;
            }
            if($("input[name='published']").val()==""){
                alert("请选择是否私有");
                return false;
            }
            if($("#selectPro").html()==""){
                alert("请添加题目");
                return false;
            }
            return true;
        }
        function select(){
            $("#clazz").val($("#selectID").val());
        }
        function checkShow(contestID){
            $("#selectPro").html("");
            $("#selectTbody").html("");
            $("#neirong").show();
            $("#sub").hide();
            $("#mod").hide();
            $("#selectButton").hide();
            selectPro=new Array();
            var selectOrder=new Array();
            $.ajax({
                url:"newContest_back.php?state=show",
                type:"POST",
                data:{contestID:contestID},
                dataType:"JSON",
                success:function(data){
                    $("input[name='contestTitle']").val(data.contestName);
                    $("#start").val(data.contestStartTime);
                    $("#end").val(data.contestEndTime);
                    if(data.issafe=='0') $("#notPublished").attr("checked",true);
                    else $("isPublished").attr("checked",true);
                    $("select[name='typeOf']").val(data.contestType);
                    $("#contestExplain").val(data.contestExplain);
                    selectPro=data.proID;
                    selectOrder=data.contestOrder;
                    $.ajax({
                        url:"page.php",
                        type:"GET",
                        data:{selectPro:selectPro},
                        dataType:"JSON",
                        success:function(Dataobj){
                            var sp="";
                            for(var i=0;i<Dataobj.length;i++) {
                                var tbody = $("#selectTbody");
                                var tr = $("<tr></tr>");
                                if(Dataobj[i].isPublish=="0") Dataobj[i].isPublish="未使用";
                                else Dataobj[i].isPublish="已使用";
                                tr.appendTo(tbody);
                                $("<td>"+Dataobj[i].proID+"</td>" +
                                "<td>"+Dataobj[i].proTitle+"</td>" +
                                "<td>"+Dataobj[i].proSort+"</td>"+
                                "<td>"+Dataobj[i].entryTime+"</td>"+
                                "<td>"+Dataobj[i].isPublish+"</td>").appendTo(tr);
                                sp+="<input type='checkbox' name='sortID[]' checked='checked' value="+selectOrder[i]+">" +
                                "<input type='checkbox' name='selectID[]' checked='checked' value="+Dataobj[i].proID+">";
                            }
                            $("#selectPro").html(sp);
                        }
                    });
                }
            });
        }

        function modifyContest(contestID){
            $("#turnB").val("修改");
            $("#selectPro").html("");
            $("#selectTbody").html("");
            $("form").each(function(){
                this.reset();
            });
            checkShow(contestID);
            $("#selectButton").show();
            $("#sub").show();
            $("form").attr("action","newContest_back.php?state=modify&contestID="+contestID);
        }

        function delContest(contestID){
            $("#selectPro").html("");
            $("#selectTbody").html("");
            if(confirm("删除不能再恢复，是否删除？")){
                $.ajax({
                    url:"newContest_back.php?state=delete",
                    type:"POST",
                    data:{contestID:contestID},
                    success:function(){
                        alert("删除成功");
                        search();
                    }
                });
            }else{
                return;
            }
        }
        function search(){
            $("#neirong").hide();
            if($("#searchC").val()==""){$("#searchDIV").hide(); return;}
            $.ajax({
                url:"newContest_back.php?state=search",
                type:"POST",
                data:{search:$("#searchC").val()},
                dataType:"JSON",
                success:function(DataObj){
                    var tbody = $("#searchTbody");
                    tbody.html("");
                    for(var i=0;i<DataObj.length;i++) {
                        var tr = $("<tr></tr>");
                        tr.appendTo(tbody);
                        $("<td>"+DataObj[i].contestID+"</td><td>"+DataObj[i].contestName+"</td><td>"+DataObj[i].teacherName+"</td><td>"+DataObj[i].contestType+"</td><td><button class='btn-success' onclick='checkShow("+DataObj[i].contestID+")'>查看</button><button class='btn-warning' onclick='modifyContest("+DataObj[i].contestID+")'>修改</button><button class='btn-danger' onclick='delContest("+DataObj[i].contestID+")'>删除</button></td>").appendTo(tr);
                    }
                    $("#searchDIV").show();
                }
            });
        }
    </script>
    <style type="text/css">
        .marginTop{margin-top: 50px;margin-bottom: 50px;}
        #isPublished,#notPublished{margin-left:8px; }
        #main div{margin-bottom: 10px;display:none;}
        #contestExplain{width: 100%;height: 80px;resize: none;}
        .bg{position: absolute; top:0px; left: 0px;z-index: 3;width: 100%;height: 100%;opacity:0.4;background:#000000;MozOpacity:0.4;display: none;}
        .box{border:1px solid gray; z-index:5;position:absolute; top:20%; left:10%; background:#ffffff; width:80%;hight:100px; padding:20px;display: none;overflow: auto;}
        #selectPro{display: none;}
        #selectID{width:199px;}
        #searchDIV,#neirong{display: none;}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#searchB").click(search);
            $("#new").click(function(){
                $("#neirong").show();
                $("#searchDIV").hide();
                $("#turnB").val("提交");
                $("form").each(function(){
                    this.reset();
                });
                $("#sub").show();
                $("form").attr("action","newContest_back.php?state=insert");
            });
        });
    </script>
</head>
<body>
<div class="bg" id="bg"></div>
<?php
include("top.php");
?>
<div class="container marginTop">
    <div class="panel panel-primary">
        <div class="panel-heading">比赛作业</div>
        <div class="panel-body">
            <div class="input-group col-md-6 col-md-offset-3"></span>
                <input type="text" id="searchC" class="form-control" placeholder="输入要搜索的内容"><span class="input-group-btn">
                    <button class="btn btn-success" type="button" id="searchB">搜索</button>
                    <button class="btn btn-success" type="button" id="new">新建</button>
                </span></div>
            <div class="col-md-10 col-md-offset-1" id="searchDIV">
                <table class="table table-bordered" id="searchTable">
                    <caption>已搜到的内容:</caption>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>负责人</th>
                            <th>类型</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody id="searchTbody"></tbody>
                </table>
            </div>
            <div class="col-md-10 col-md-offset-1" id="neirong">
                <h4>详细信息</h4>
                <form method="post" onsubmit="return checkSubmit()" class="form-horizontal" id="myform">
                    <div class="input-group form-group">
                        <span class="input-group-addon">标题</span>
                        <input type="text" name="contestTitle" value="" class="form-control"></span>
                        <span class="input-group-btn"><button type="button" class="btn btn-success" onclick="firstLoad()" id="selectButton">选择题目</button></span>
                    </div>
                    <div class="input-group form-group">
                        <span class="input-group-addon">开始</span>
                        <input type="text" class="laydate-icon form-control-static"  name="startTime" id="start" value="">
                        <span class="input-group-addon">结束</span>
                        <input type="text" class="laydate-icon form-control-static" name="endTime" id="end" value="">
                        <span class="input-group-addon">私有</span>
                        <input type="radio" name="published" id="isPublished" value="1">是
                        <input type="radio" name="published" id="notPublished" value="0">否
                        <span class="input-group-addon">类型</span>
                        <select name="typeOf" class="form-control-static"><option value="竞赛">竞赛</option><option value="作业">作业</option></select>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon">竞赛说明</span>
                        <textarea class="form-control" id="contestExplain" name="contestExplain">无</textarea>
                    </div>
                    <div class="form-group">
                        <span class="input-group-addon">题目列表</span>
                        <div class="problem">
                            <div id="selectPro"></div>
                            <table id="selectTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>题目编号</th>
                                        <th>题目名称</th>
                                        <th>题目类型</th>
                                        <th>录入时间</th>
                                        <th>使用状态</th>
                                    </tr>
                                </thead>
                                <tbody id="selectTbody"></tbody>
                            </table>
                        </div>
                    </div>
                    <div id="sub">
                        <input type="submit" value="提交" class="center-block btn-success" id="turnB">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="box" id="problemList">
    <div class="content">
        <table class="table table-bordered" id="table">
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>题目编号</th>
                    <th>题目名称</th>
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
</div>
<?php
include("footer-fix.html");
?>
<script>
    !function(){
        laydate.skin('molv');//切换皮肤，请查看skins下面皮肤库
        laydate({elem: '#demo'});//绑定元素
    }();
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
            end.start = datas ;//将结束日的初始值设定为开始日
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
</body>
</html>