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
    <META content="EditPlus" name="Generator">
    <META content="" name="Keywords">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>录入题目信息</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/offcanvas.js"></script>
    <script type="text/javascript">
        function select(){
            var t = document.getElementById("selectID");
            var i = document.getElementById("proSort");
            eval(i).value=t.options[t.selectedIndex].value;
            //this.parentNode.nextSibling.value=this.value
        }
        function checkNULL(){
            var title=document.getElementById("proTitle");
            var sort=document.getElementById("proSort");
            var description=document.getElementById("proDescription");
            var input=document.getElementById("proInput");
            var output=document.getElementById("proOutput");
            var sameInput=document.getElementById("proSameInput");
            var sameOutput=document.getElementById("proSameOutput");
            var inputDate=document.getElementById("inputTestDate");
            var outDate=document.getElementById("outputTestDate");
            var timeLimit=document.getElementById("proTimeLimit");
            var memoryLimit=document.getElementById("proMemoryLimit");
            var arr=new Array(title,sort,description,input,output,sameInput,sameOutput,inputDate,outDate,timeLimit,memoryLimit);
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
    </script>
    <style type="text/css">
        textarea{height:100px; width: 500px; resize: none;}
        span{display: inline-block; width: 300px; text-align: right;line-height: 30px; vertical-align: top; font-size: 16px;}
        .marginTop{margin-top: 50px;}
        #selectID,#proTitle,#proSort,#proDescription,#proInput,#proOutput,#proSameInput,#proSameOutput,#inputTestDate,#outputTestDate,#proHint,#proTimeLimit,#proMemoryLimit,#isPublish,#notPublish{margin-top:5px;}
        #proTitle{width: 200px;}
        #proTimeLimit,#proMemoryLimit{width: 150px;}
        #MemoryLimit{width: 200px;}
        #sort{width: 100px;}
        #proSort{width: 180px;position:relative;left:-200px;}
        #preview,#isPublish,#notPublish,#isReset{margin-left: 30px;}
        #selectID{width:118px;margin-left:-100px;}
        #select{margin-left:172px;width:20px;overflow:hidden;}
        #hint,#hint1{margin-left:-150px;display: none;font-size:12px;color:red; width: auto;}
       #hint2,#hint3,#hint4,#hint5,#hint6,#hint7,#hint8,#hint9,#hint10{display: none;font-size:12px;color:red; width: auto;}
    </style>
</head>
<body>
<?php
   include("top.php");
?>
<div class="container marginTop">
    <form action="newProblem_back.php" method="post" onsubmit="return checkNULL()">
        <div style="position:relative;"><span>标题:</span><input type="text" name="proTitle" id="proTitle" autofocus="autofocus">
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
            <span id="hint">*请输入一个标题</span>
            <span id="hint1">*请输入分类信息</span>
        </div>
        <div><span>题目描述:</span><textarea name="proDescription" id="proDescription"></textarea><span id="hint2">*题目描述</span></div>
        <div><span>输入描述:</span><textarea name="proInput" id="proInput"></textarea><span id="hint3">*输入描述</span></div>
        <div><span>输出描述:</span><textarea name="proOutput" id="proOutput"></textarea><span id="hint4">*输出描述</span></div>
        <div><span>输入样例:</span><textarea name="proSameInput" id="proSameInput"></textarea><span id="hint5">*输入样例</span></div>
        <div><span>输出样例:</span><textarea name="proSameOutput" id="proSameOutput"></textarea><span id="hint6">*输出样例</span></div>
        <div><span>输入测试:</span><textarea name="inputTestDate" id="inputTestDate">无</textarea><span id="hint7">*输入测试</span></div>
        <div><span>输出测试:</span><textarea name="outputTestDate" id="outputTestDate">无</textarea><span id="hint8">*输出测试</span></div>
        <div><span>提示:</span><textarea name="proHint" id="proHint">无</textarea>
        <div><span>时间限制:</span><input type="text" name="proTimeLimit" id="proTimeLimit"><span id="MemoryLimit">内存限制:</span><input type="text" name="proMemoryLimit" id="proMemoryLimit"><span id="hint9">*时间限制</span><span id="hint10">*内存限制</span></div>
        <div><span>是否开放:</span><input type="radio" name="isPublish" value="是" id="isPublish" checked="checked">是<input type="radio" name="isPublish" value="否" id="notPublish">否</div>
        <div><span>&nbsp;</span><input type="submit" value="提交"><input id="isReset"type="reset" value="重置"><input id="preview" type="button" value="预览" onclick="showDialog('newProblem_show.php')"></div>
    </form>
</div>
<?php
    include("footer.html");
?>
</body>
</html>