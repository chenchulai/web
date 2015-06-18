<?php
session_start();
if(!isset($_SESSION['teacherName'])){
    header("location:index.php");
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <META content="EditPlus" name="Generator">
    <META content="" name="Author">
    <META content="" name="Keywords">
    <META content="" name="Description">
    <meta http-equiv="Expires" content="0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <title>预览</title>
    <style type="text/css">
        #kong{display: inline-block;width: 100px;text-align: right;}
        span{font-size: 14px;}
        #hid{display: none;}
    </style>
</head>

<body>
<div class="main" onload="closeWindow()">
    <h2 id="title"></h2>
    <h2 id="hid">标题</h2>
    <div><span>时间限制：</span><span id="timeLimit"></span>
        <span id="kong">内存限制：</span><span id="memoryLimit"></span>
        <span id="kong">是否开放：</span><span id="publish"></span>
        <span id="kong">总解决数：</span><span id="publish">0</span>
        <span id="kong">总提交数：</span><span id="publish">0</span>
    </div>
    <h4>题目描述</h4>
    <div><span id="description"></span></div>
    <h4>输入描述</h4>
    <div><span id="input"></span></div>
    <h4>输出描述</h4>
    <div><span id="output"></span></div>
    <h4>样例输入</h4>
    <div><span id="sameInput"></span></div>
    <h4>样例输出</h4>
    <div><span id="sameOutput"></span></div>
    <h4>提示</h4>
    <div><span id="hint"></span></div>
    <h4>分类</h4>
    <div><span id="sort"></span></div>
    <h4>输入测试</h4>
    <div><span id="inputDate"></span></div>
    <h4>输出测试</h4>
    <div><span id="outDate"></span></div>
    <!--div><input type="button" onclick="closeWindow()" value="关闭窗口"></div-->
</div>
<script type="text/javascript">
    if( document.all ) //IE
    {
        var k = window.dialogArguments;
        var reg=new RegExp("\r\n","g");
    }
    else {
        var k = window.opener;
        var reg=new RegExp("\n","g");
    }
    if(k!=null)
    {
        var m=document.getElementById("title").innerHTML=k.document.getElementById("proTitle").value.replace(reg,"<br>");
        document.getElementById("sort").innerHTML=k.document.getElementById("proSort").value.replace(reg,"<br>");
        document.getElementById("description").innerHTML= k.document.getElementById("proDescription").value.replace(reg,"<br>");
        document.getElementById("input").innerHTML=k.document.getElementById("proInput").value.replace(reg,"<br>");
        document.getElementById("output").innerHTML=k.document.getElementById("proOutput").value.replace(reg,"<br>");
        document.getElementById("sameInput").innerHTML=k.document.getElementById("proSameInput").value.replace(reg,"<br>");
        document.getElementById("sameOutput").innerHTML=k.document.getElementById("proSameOutput").value.replace(reg,"<br>");
        document.getElementById("inputDate").innerHTML=k.document.getElementById("inputTestDate").value.replace(reg,"<br>");
        document.getElementById("outDate").innerHTML=k.document.getElementById("outputTestDate").value.replace(reg,"<br>");
        document.getElementById("timeLimit").innerHTML=k.document.getElementById("proTimeLimit").value.replace(reg,"<br>");
        document.getElementById("memoryLimit").innerHTML=k.document.getElementById("proMemoryLimit").value.replace(reg,"<br>");
        document.getElementById("hint").innerHTML=k.document.getElementById("proHint").value.replace(reg,"<br>");
        if(k.document.getElementById("isPublish").value=='是')
            document.getElementById("publish").innerHTML="是";
        else
            document.getElementById("publish").innerHTML="否";
       if(m==""){
           document.getElementById("hid").style.display="inline-block";
       }
    }
    else
        window.close();
    setTimeout("closeWindow()",60000);
    function closeWindow(){
        window.close();
    }
</script>
</body>
</html>