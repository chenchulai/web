<?php
session_start();
if(!isset($_SESSION['teacherName'])){
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
    <title>题目</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="./js/jquerySession.js"></script>
    <script type="text/javascript">

        var page=1;
        var countPage;
        var checkArr=new Array();
        var selectPro=new Array();

        function select(){
            $("#proSort").val($("#selectID").val());
        }
        function checkNULL(){
            $("#hin").hide();
            $("#hint0").hide();
            var title=document.getElementById("proTitle");
            var sort=document.getElementById("proSort");
            var description=document.getElementById("proDescription");
            var input=document.getElementById("proInput");
            var output=document.getElementById("proOutput");
            var sameInput=document.getElementById("proSameInput");
            var sameOutput=document.getElementById("proSameOutput");
            var inputData=document.getElementById("inputTestData");
            var outData=document.getElementById("outputTestData");
            var timeLimit=document.getElementById("proTimeLimit");
            var memoryLimit=document.getElementById("proMemoryLimit");
            var arr=new Array(title,sort,description,input,output,sameInput,sameOutput,inputData,outData,timeLimit,memoryLimit);
            var arr1=new Array("hint","hint1","hint2","hint3","hint4","hint5","hint6","hint7","hint8","hint9","hint10");
            for(var i=0;i<=10;i++){
                if(arr[i].value==''){
                    document.getElementById(arr1[i]).style.display="inline-block";
                    arr[i].focus();
                    return false;
                }
                else{
                    document.getElementById(arr1[i]).style.display="none";
                }
            }
            return true;
        }
        function showDialog(url)
        {
            if( document.all ) //IE
            {
                feature="dialogWidth:1000px;dialogHeight:400px;status:no;help:no";
                var k =window.showModalDialog(url,window,feature);
            }
            else
            {
//modelessDialog可以将modal换成dialog=yes
                feature ="width=1000,height=400,menubar=no,toolbar=no,location=no,";
                feature+="scrollbars=yes,status=no,modal=yes";
                var k =window.open(url,"预览",feature);
            }
        }

        var problem = new Array();
        function search(){
            $("#publish").hide();
            $("#neirong").hide();
            if($("#searchC").val()==""){$("#searchDIV").hide(); return;}
            $.ajax({
                url:"newProblem_back.php?state=search",
                type:"POST",
                data:{search:$("#searchC").val()},
                dataType:"JSON",
                success:function(DataObj){
                    var tbody = $("#searchTbody");
                    tbody.html("");
                    for(var i=0;i<DataObj.length;i++) {
                        problem[DataObj[i].proID]=DataObj[i];
                        var tr = $("<tr></tr>");
                        tr.appendTo(tbody);
                        $("<td>"+DataObj[i].proID+"</td><td>"+DataObj[i].proTitle+"</td><td>"+DataObj[i].proSort+"</td><td>"+DataObj[i].entryTime+"</td><td><button class='btn-success' onclick='checkShow("+DataObj[i].proID+")'>查看</button><button class='btn-warning' onclick='modifyProbelm("+DataObj[i].proID+")'>修改</button><button class='btn-danger' onclick='delProbelm("+DataObj[i].proID+")'>删除</button></td>").appendTo(tr);
                    }
                    $("#searchDIV").show();
                }
            });
        }

        function checkShow(proID){
            $("#publish").hide();
            $("#selectPro").html("");
            $("#selectTbody").html("");
            $("#neirong").show();
            $("#NewPanel").html("问题信息");
            $("#proTitle").val(problem[proID].proTitle);
            $("#proSort").val(problem[proID].proSort);
            $("#proDescription").val(problem[proID].proDescription);
            $("#proInput").val(problem[proID].proInput);
            $("#proOutput").val(problem[proID].proOutput);
            $("#proSameInput").val(problem[proID].proSameInput);
            $("#proSameOutput").val(problem[proID].proSameOutput);
            $("#inputTestData").val(problem[proID].inputTestData);
            $("#outputTestData").val(problem[proID].outputTestData);
            $("proHint").val(problem[proID].proHint);
            $("#proTimeLimit").val(problem[proID].proTimeLimit);
            $("#proMemoryLimit").val(problem[proID].proMemoryLimit);
            if(problem[proID].isPublish==0)
                $("#notPublish").attr("checked",true);
        }
         function modifyProbelm(proID){
             checkShow(proID);
             $("#insert").hide();
             $("#modify").show();
             $("#NewPanel").html("修改问题");
             $("#modify").click(function(){
                 if(!checkNULL()) return;
                 $.ajax({
                     url:"newProblem_back.php?state=modify",
                     type:"POST",
                     data:{proID:proID,proSort:$("#proSort").val(),
                         proTitle:$("#proTitle").val(),
                         proDescription:$("#proDescription").val(),
                         proInput:$("#proInput").val(),
                         proOutput:$("#proOutput").val(),
                         proSameInput:$("#proSameInput").val(),
                         proSameOutput:$("#proSameOutput").val(),
                         inputTestData:$("#inputTestData").val(),
                         outputTestData:$("#outputTestData").val(),
                         proHint:$("proHint").val(),
                         proTimeLimit:$("#proTimeLimit").val(),
                         proMemoryLimit:$("#proMemoryLimit").val(),
                         isPublish:$("isPublish").val()},
                     success:function(){
                         alert("修改成功");
                         search();
                     }
                 });
             });
         }

        function delProbelm(proID){
            if(confirm("删除不能再恢复，是否删除？")){
                $.ajax({
                    url:"newProblem_back.php?state=delete",
                    type:"POST",
                    data:{proID:proID},
                    success:function(){
                        search();
                    }
                });
            }else{
                return;
            }
        }
        var flag="";
        $(document).ready(function(){
            $("#searchB").click(search);
            $("#new").click(function(){
                $("#neirong").show();
                $("#searchDIV").hide();
                $("#insert").show();
                $("#modify").hide();
                $("#publish").hide();
                $("form").each(function(){
                    this.reset();
                });
                $("#insert").click(function(){
                    if(!checkNULL()) return;
                    $.ajax({
                        url:"newProblem_back.php?state=modify",
                        type:"POST",
                        data:{proSort:$("#proTitle").val(),
                            proDescription:$("#proDescription").val(),
                            proInput:$("#proInput").val(),
                            proOutput:$("#proOutput").val(),
                            proSameInput:$("#proSameInput").val(),
                            proSameOutput:$("#proSameOutput").val(),
                            inputTestData:$("#inputTestData").val(),
                            outputTestData:$("#outputTestData").val(),
                            proHint:$("proHint").val(),
                            proTimeLimit:$("#proTimeLimit").val(),
                            proMemoryLimit:$("#proMemoryLimit").val(),
                            isPublish:$("isPublish").val()},
                        success:function(){
                            alert("题目录入成功");
                            search();
                        }
                    });
                });
            });

            var flagM=0;
            var flagD=0;
            $("#goM").click(function(){
                $("#is").show();
                $("#not").hide();
                $("#neirong").hide();
                $("#searchDIV").hide();
                $("").hide();
                if(!flagM){
                    checkArr=new Array();
                    selectPro=new Array();
                    flagD=0;
                }
                flagM++;
                flag="is";
                firstLoad();
                $("#is").click(function(){
                    $.ajax({
                        url:"page.php?state=isPublish",
                        data:{select:selectPro},
                        type:"POST",
                        success:function(){
                            alert("发布成功！");
                            checkArr=new Array();
                            selectPro=new Array();
                            $("#publish").hide();
                        }
                    });
                });
            });
            $("#goD").click(function(){
                $("#is").hide();
                $("#not").show();
                $("#neirong").hide();
                $("#searchDIV").hide();
                if(!flagD){
                    checkArr=new Array();
                    selectPro=new Array();
                    flagM=0
                }
                flagD++;
                flag="not";
                firstLoad();
                $("#not").click(function(){
                    $.ajax({
                        url:"page.php?state=notPublish",
                        data:{select:selectPro},
                        type:"POST",
                        success:function(){
                            alert("取消发布成功！");
                            checkArr=new Array();
                            selectPro=new Array();
                            $("#publish").hide();
                        }
                    });
                });
            });
        });


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
                data:{page:page,select:selectPro,flag:flag},
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
            $("#publish").show();
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
    </script>
    <style type="text/css">
        textarea{height:100px; width: 500px; resize: none;}
        span{display: inline-block;width: 20%; text-align: right;line-height: 30px; vertical-align: top; font-size: 16px;}*/
        #selectID,#proTitle,#proSort,#proDescription,#proInput,#proOutput,#proSameInput,#proSameOutput,#inputTestData,#outputTestData,#proHint,#proTimeLimit,#proMemoryLimit,#isPublish,#notPublish{margin-top:5px;}
        #proTitle{width: 200px;}
        #proTimeLimit,#proMemoryLimit{width: 150px;}
        #MemoryLimit{width: 170px;}
        #sort{width: 100px;}
        #proSort{width: 180px;position:relative;left:-200px;}
       #preview,#isPublish,#notPublish{margin-left: 30px;}
        #selectID{width:118px;margin-left:-100px;}
        #select{margin-left:172px;width:20px;overflow:hidden;}
        #hin,#hint0,#hint,#hint1{margin-left:-150px;display: none;font-size:12px;color:red; width: auto;}
        #hint2,#hint3,#hint4,#hint5,#hint6,#hint7,#hint8,#hint9,#hint10{display: none;font-size:12px;color:red; width: auto;}
        #f1{display: none;}
        #neirong{margin-top:50px;display: none;}
        #searchDIV,#modify,#insert{display: none;}
        .bg{position: absolute; top:0px; left: 0px;z-index: 3;width: 100%;height: 100%;opacity:0.4;background:#000000;MozOpacity:0.4;display: none;}
        .box{border:1px solid gray; z-index:5;position:absolute; top:20%; left:10%; background:#ffffff; width:80%;hight:100px; padding:20px;display: none;overflow: auto;}
        #selectPro,#is,#not,#publish{display: none;}
    </style>
</head>
<body>
<div class="bg" id="bg"></div>
<?php
   include("top.php");
?>
<div class="container" style="margin-top: 50px;margin-bottom: 100px;">
    <div class="panel panel-primary">
        <div class="panel-heading">题目</div>
        <div class="panel-body">
            <div class="input-group col-md-8 col-md-offset-2"></span>
                <input type="text" id="searchC" class="form-control" placeholder="输入要搜索的内容"><span class="input-group-btn">
                    <button class="btn btn-success" type="button" id="searchB">搜索</button>
                    <button class="btn btn-success" type="button" id="new">新建</button>
                    <button class="btn btn-success" type="button" id="goM">发布</button>
                    <button class="btn btn-success" type="button" id="goD">取消</button>
                </span></div>
            <div class="col-md-10 col-md-offset-1" id="searchDIV">
                <table class="table table-bordered" id="searchTable">
                    <caption>已搜到的内容:</caption>
                    <thead>
                    <tr>
                        <th>题目编号</th>
                        <th>题目名称</th>
                        <th>题目类型</th>
                        <th>录入时间</th>
                        <th>使用状态</th>
                    </tr>
                    </thead>
                    <tbody id="searchTbody"></tbody>
                </table>
            </div>

            <div class="form-group col-md-10 col-md-offset-1" style="margin-top: 30px;" id="publish">
                <span class="input-group-addon" id="">题目列表</span>
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
                <div><input type="button" value="确定" class="btn btn-success center-block" id="is">
                <input type="button" value="确定" class="btn btn-success center-block" id="not"></div>
            </div>

            <div class="col-md-10 col-md-offset-1" id="neirong">
                <div class="panel panel-default">
                    <div class="panel-heading" id="NewPanel">新建</div>
                    <div class="panel-body">
                        <form id="myForm" method="post">
                            <div style="position:relative;"><span>标题:</span><input type="text" name="proTitle" id="proTitle">
                                <span id="sort">题目分类:</span>
                                <span id="select">
                                    <select id="selectID" onchange="select()">
                                        <option value="" checked="checked"></option>
                                                <?php
                                                require_once("./lib/link_mysqli.php");
                                                $db=new DB();
                                                $sql="select proSort from problem GROUP by proSort";
                                                $result=$db->GetData($sql);
                                                while($line=$result->fetch_assoc()){
                                                    echo"<option value='{$line['proSort']}'>{$line['proSort']}</option>";
                                                }
                                                $db->FreeResult($result);
                                                $db->__destruct();
                                                ?>
                                    </select>
                                </span>
                                        <input id="proSort" name="proSort" type="text">
                                        <span id="hint0">*此标题可用</span>
                                        <span id="hin">*此标题已存在，您可以查看具体信息</span>
                                        <span id="hint">*请输入一个标题</span>
                                        <span id="hint1">*请输入分类信息</span>
                                    </div>
                                    <div><span>题目描述:</span><textarea name="proDescription" id="proDescription"></textarea><span id="hint2">*题目描述</span></div>
                            <div><span>输入描述:</span><textarea name="proInput" id="proInput"></textarea><span id="hint3">*输入描述</span></div>
                            <div><span>输出描述:</span><textarea name="proOutput" id="proOutput"></textarea><span id="hint4">*输出描述</span></div>
                            <div><span>输入样例:</span><textarea name="proSameInput" id="proSameInput"></textarea><span id="hint5">*输入样例</span></div>
                            <div><span>输出样例:</span><textarea name="proSameOutput" id="proSameOutput"></textarea><span id="hint6">*输出样例</span></div>
                            <div><span>输入测试:</span><textarea name="inputTestData" id="inputTestData">无</textarea><span id="hint7">*输入测试</span></div>
                            <div><span>输出测试:</span><textarea name="outputTestData" id="outputTestData">无</textarea><span id="hint8">*输出测试</span></div>
                            <div><span>提示:</span><textarea name="proHint" id="proHint">无</textarea></div>
                            <div><span>时间限制:</span><input type="text" name="proTimeLimit" id="proTimeLimit">MS<span id="MemoryLimit">内存限制:</span><input type="text" name="proMemoryLimit" id="proMemoryLimit">B<span id="hint9">*时间限制</span><span id="hint10">*内存限制</span></div>
                            <div><span>是否开放:</span><input type="radio" name="isPublish" value="是" id="isPublish" checked="checked">是<input type="radio" name="isPublish" value="否" id="notPublish">否</div>
                            <div><span>&nbsp;</span>
                                <input type="button" value="提交" id="insert" class="btn btn-success">
                                <input type="button" value="修改" id="modify" class="btn btn-success">
                                <input id="preview" class="btn btn-success" type="button" value="预览" onclick="showDialog('newProblem_show.php')"></div>
                        </form>
                    </div>
                </div>
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
<div id="f1">
    <?php
        include("footer.html");
    ?>
</div>
<div id="f2">
    <?php
        include("footer-fix.html");
    ?>
</div>

</body>
</html>
