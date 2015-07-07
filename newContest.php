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
        .spanMargin{margin-left: 3%;}
        #isPublished,#notPublished{margin-left:8px; }
        #main div{margin-bottom: 10px;}
        #contestExplain{width: 100%;height: 80px;resize: none;}
        .bg{position: absolute; top:0px; left: 0px;z-index: 3;width: 100%;height: 100%;opacity:0.4;background:#000000;MozOpacity:0.4;display: none;}
        .box{border:1px solid gray; z-index:5;position:absolute; top:20%; left:10%; background: #CCC; width:80%; padding:20px;display: none;}
        .floatLeft{float: left;}
        .problem{width: 100%; overflow: auto;height: 100%;border: 1px solid gray;}
        #selectPro{display: none;}
        #clazz{width: 185px;position:relative;left:-205px;}
        #selectID{width:199px;}
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
                url:"page.php",
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
            for(var i=0;i<Dataobj.proID.length;i++) {
               var table = $("#selectTable");
               var tr = $("<tr></tr>");
               tr.appendTo(table);
               $("<td>&nbsp;</td><td>"+Dataobj.proID[i]+"</td><td>"+Dataobj.proTitle[i]+"</td><td>×</td>").appendTo(tr);
                sp+="<input type='checkbox' name='sortID[]' checked='checked' value="+String.fromCharCode(current++)+">" +
                "<input type='checkbox' name='selectID[]' checked='checked' value="+Dataobj.proID[i]+">";
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

    </script>
</head>
<body>
<div class="bg" id="bg"></div>
<?php
include("top.php");
?>
<div class="container marginTop" id="main">
    <form action="newContest_back.php" method="post" onsubmit="return checkSubmit()">
    <div>
        <span>标题：<input type="text" name="contestTitle" value=""></span>
        <span class="spanMargin">开始时间：</span><input type="text"  name="startTime" id="start" value="">
        <span class="spanMargin">结束时间：</span><input type="text"  name="endTime" id="end" value="">
        <span class="spanMargin">是否私有：</span>
        <input type="radio" name="published" id="isPublished" value="1">是
        <input type="radio" name="published" id="notPublished" value="0">否
        <span class="spanMargin">应用类型：</span>
        <select name="typeOf"><option value="竞赛">竞赛</option><option value="作业">作业</option></select>
    </div>
    <div class="col-md-6">
        <div>竞赛说明：</div>
        <div><textarea id="contestExplain" name="contestExplain">无</textarea></div>
        <div><span>面向班级：</span><select id="selectID" onchange="select()">
                <option value="" checked="checked"></option>
                <?php
                require_once("./lib/link_mysqli.php");
                $db=new DB();
                $sql="select className from clazz GROUP by className";
                $result=$db->GetData($sql);
                while($line=$result->fetch_assoc()){
                    echo"<option value='{$line['className']}'>{$line['className']}</option>";
                }
                $db->FreeResult($result);
                $db->__destruct();
                ?>
            </select>
            <input type="text" name="clazz" id="clazz">
        </div>
        <div><span>团队模式：</span><input type="radio" name="published" id="isPublished" value="1">是
            <input type="radio" name="published" id="notPublished" value="0">否</div>
    </div>
    <div class="floatLeft col-md-6">
        <div>
            <input type="button" value="选择题目" onclick="firstLoad()">
            <input type="button" value="一键排序" onclick="">
            <input type="button" value="重置序号" onclick="">
        </div>
        <div class="problem">
            <div id="selectPro"></div>
            <table id="selectTable" class="table">
                <tr>
                    <th>题目排序</th>
                    <th>题目ID</th>
                    <th>题目名称</th>
                    <th></th>
                </tr>
            </table>
        </div>
        <input type="submit" value="提交">
    </div>
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
        <div><input type="button" value="确定" onclick="confirmButton()"><input type="button" value="取消" onclick="cancelButton(this)"></div>
    </div>
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
</body>
</html>