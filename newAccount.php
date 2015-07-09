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
    <title>班级学生</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script><script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="js/offcanvas.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("")
        });
        function select(){
            $("#clazz").val($("#selectID").val());
        }

        function checkSubmit(){
            if($("input[name='userName']").val()==""){
                alert("请输入用户名");
                return false;
            }
            if($("input[name='userPSW']").val()==""||$("input[name='userPSW']").val().length<6){
                alert("您的密码为空或者长度不足");
                return false;
            }
            if($("input[name='userPSW']").val()!=$("input[name='userPSW']").val()){
                alert("d");
                return false;
            }
            if($("input[name='userEmail']").val()==""){
                alert("请正确输入邮箱");
                return false;
            }
            return true;
        }
    </script>
    <style type="text/css">
        .marginTop{margin-top: 50px;margin-bottom: 50px;}
        #clazz{width: 185px;position:relative;left:-205px;}
        #new,#js{position:relative;left:-190px;}
        #selectID{width:199px;}
    </style>
</head>
<body>
<?php
include("top.php");
?>

<div class="container marginTop">
    <div class="panel panel-primary">
        <div class="panel-heading">班级学生</div>
        <div class="panel-body">
            <form class="form" method="post" onsubmit="return checkSubmit()">
                <div class="input-group form-group col-md-offset-3"><span class="input-group-addon">班级</span>
                    <select id="selectID" onchange="select()" class="form-control-static">
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
                    <input type="text" class="form-control-static" name="clazz" id="clazz" placeholder="如果不想建班级可以留空">
                    <input type="button" id="js" value="检索" class="btn btn-success">
                    <input type="button" id="new" value="新建" class="btn btn-success">
                </div>
                <div class="input-group form-group">
                    <span class="input-group-addon">用户名</span><input type="text" name="userName" class="form-control-static">
                    <span class="input-group-addon">签名</span><input type="text" name="userMotto" class="form-control-static">
                    <span class="input-group-addon">密码</span><input type="password" name="userPSW" class="form-control-static">
                    <span class="input-group-addon">确认密码</span><input type="password" name="userPSWR" class="form-control-static">
                    <span class="input-group-addon">邮箱</span><input type="text" name="userEmail" class="form-control-static"></span>
                </div>
                <div class="form-group col-md-offset-4">
                    <input type="submit" value="提交" class="btn btn-success">
                    <input type="reset" value="重置" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include("footer-fix.html");
?>
</body>
</html>