<?php
session_start();
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
    <style type="text/css">
        span{display: inline-block; width: 150px;text-align: right;}
        .marginTop{margin-top: 50px;}
        .left div{margin-top: 10px;}
        .left,.right{border: 1px solid red;}
        th,tr,td{text-align: center; }
        .inputNone{display:none;width:2em;}
    </style>
    <script type="text/javascript">
        function showDialog(url)
        {
                feature="dialogWidth:1000px;dialogHeight:400px;status:no;help:no";
                var k =window.showModalDialog(url,window,feature);
        }
    </script>
</head>

<body>
<?php
    include("top.php");
?>
<div class="container marginTop">
    <form action="contest.php" method="post">
        <div class="left col-md-5 col-lg-5">
            <div><span>标题：</span><input type="text"></div>
            <div><span>开始时间：</span><input type="text"  id="start"></div>
            <div><span>结束时间：</span><input type="text"  id="end"></div>
            <div><span>是否私有：</span><input type="radio" name="published" checked="checked">是<input type="radio" name="published">否</div>
            <div><span>&nbsp;</span><input type="submit" value="确认"><input type="reset" value="重置" onclick="resetOrder()"></div>
        </div>
        <div class="right col-md-7 col-lg-7">
            <input type="button" value="选择题目" onclick="showDialog('selectProblem.php')">
            <input type="button" value="一键排序" onclick="inOrder()">
            <input type="button" value="重置顺序" onclick="resetOrder()">
            <table class="table table-striped">
                <tr>
                    <th class="t1">&nbsp;</th>
                    <th class="t2">题目编号</th>
                    <th class="t3">题目名称</th>
                    <th class="t4">作者</th>
                    <th class="t5">使用状态</th>
                    <th class="t6">题目序号</th>
                </tr>
                <?php
                require_once("./lib/link_mysqli.php");
                $db=new DB();
                $sql="select * from problem";
                $result=$db->GetData($sql);
                $i=1;
                while($line=$result->fetch_assoc()) {
                    if ($i % 2 == 0)
                        echo "<tr class='color0'>";
                    else
                        echo "<tr class='color1'>";
                    echo "<td><input type='checkbox' value='{$line['proTitle']}'></td>";
                    echo "<td>{$line['proID']}</td>";
                    echo "<td><a href='#'>{$line['proTitle']}</a></td>";
                    echo "<td>{$line['teacherID']}</td>";
                    if($line['isPublish']==0)
                        echo "<td>否</td>";
                    else
                        echo "<td>是</td>";
                    echo "<td id='order{$i}' onclick='order(this)'></td>";
                    echo "</tr>";
                    echo "<input type='text' id='orderI{$i}' class='inputNone'>";
                    $i++;
                }
                ?>
            </table>
        </div>
    </form>
</div>
<?php
    include("footer-fix.html");
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
<script type="text/javascript">
     var i=0;
     var arr = new Array;
     function order(obj){
        if(obj.innerHTML=="") {
            if(i==26){
                i=32;
            }
            obj.innerHTML =String.fromCharCode(i+65);
            document.getElementById('orderI'+obj.id.substring(5)).value=obj.innerHTML;
            arr[i]=obj;
            i++;
        }
    }
    function inOrder(){
        for(var j=1;j<52;j++){
            var temp='order'+j;
            var obj=document.getElementById(temp);
            if(obj&&obj.innerHTML=="") {
                arr[i]=obj;
                if(i==26){
                    i=32;
                }
                obj.innerHTML = String.fromCharCode(i+65);
                document.getElementById('orderI'+obj.id.substring(5)).value=obj.innerHTML;
                i++;
            }
        }
    }
     function resetOrder(){
         for(var j=0;j<arr.length;j++){
             arr[j].innerHTML="";
             document.getElementById('orderI'+arr[j].id.substring(5)).value="";
         }
         i=0;
     }

</script>
</html>