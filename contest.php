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
    <title>竞赛</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="contest.js" type="text/javascript"></script>
    <script language="JavaScript">
        function ssff(){
            window.showModalDialog("test.html",null,"dialogHeight:300px;dialogWidth:850px;status:no;scroll:yes;resizable:yes;help:no;center:yes;")
        /*父窗体向子窗体传值
       1. window.showModalDialog('ChildPage.htm',document.getElementById('txtInput').value);
         document.getElementById('txtInput').value=window.dialogArguments ;
        2.var args = new Array();
         args[0] = document.getElementById('txtInput').value;
         window.showModalDialog('ChildPage.htm',args);
         document.getElementById('txtInput').value=window.dialogArguments[0] ;
         3.var obj = new Object();
         obj.name = document.getElementById('txtInput').value;
         window.showModalDialog('ChildPage.htm',obj);
         var obj = window.dialogArguments;
         document.getElementById('txtInput').value=obj.name ;
         子窗体向父窗体传值
         var obj = new Object();
         obj.name = document.getElementById('txtInput').value;
         var result = window.showModalDialog('ChildPage.htm',obj);
         document.getElementById('txtInput').value = result.name;
         var obj = window.dialogArguments;
         document.getElementById('txtInput').value=obj.name ;

         var obj = new Object();
         obj.name = document.getElementById('txtInput').value;
         window.returnValue = obj;
         window.close();
         */
        }
    </script>
    <style type="text/css">
        .contestCenter{ margin:0 auto; padding-top: 70px;}
        p{text-align:center; line-height:50px;}
        #clock{border-style: hidden;background-color: #ffffff;}
        .center{text-align: center}
        .newContest{float: right; text-align: right;margin-top: 20px;}
        table{margin-top:10px;line-height:300%;border:1px solid #e2e2e2}
        table,tr,th,td{text-align: center;}
        .title{border-bottom: 1px solid #e2e2e2;}
        .clearfix:after { clear: both;content: ".";display: block;height: 0;visibility: hidden;}
    </style>
</head>

<body onload="startTime()">
<?php
    include("top.php");
    require_once("./lib/link_mysql.php");
?>

<div class="container contestCenter">
    <div>
        <form>
            <div><h3 class="center">现在时间:<input type="text" id="clock" value="startTime()" disabled="disabled"></h3></div>
            <div>
                <table class="table-striped table1">
                   <tr class="row title">
                        <td class="col-md-1 col-xs-1">ID</td>
                        <td class="col-md-4 col-xs-4">标题</td>
                        <td class="col-md-2 col-xs-2">开始时间</td>
                        <td class="col-md-2 col-xs-2">结束时间</td>
                        <td class="col-md-2 col-xs-2">竞赛状态</td>
                        <td class="col-md-1 col-xs-1">是否私有</td>
                    </tr>
                    <?php
                    require_once("./lib/link_mysqli.php");
                    $db = new DB();
                    $strSQL="select * from contest where contestType='竞赛'";
                    $result=$db->GetData($strSQL);
                    $count=$result->num_rows;
                    $records=1;
                    $countPage=ceil($count/$records);
                    if(isset($_REQUEST['page'])==true){
                        $page=$_REQUEST['page'];
                        if(is_numeric($page)) {
                            $page =intval(trim($page));
                            if($page>$countPage){
                                $page=$countPage;
                            }
                            else if($page<1){
                                $page=1;
                            }
                        }
                        else
                            $page=1;
                    }
                    else{
                        $page=1;
                    }
                    if($page+1>$countPage)
                        $next=$page;
                    else
                        $next=$page+1;
                    if($page-1<1)
                        $previous = $page;
                    else
                        $previous = $page-1;
                    $nStart=($page-1)*$records;
                    $strSQL=sprintf("select * from contest where contestType='竞赛' order by contestID ASC limit %d , %d",$nStart,$records);
                    $contest = $db->GetData($strSQL);
                    while($line=$contest->fetch_assoc()){
                        if($line['issafe']==0) $publish="否";
                        else $publish="是";
                        date_default_timezone_set("PRC");
                        if(date("Y-m-d H:i:s")>$line['contestEndTime']) $status="已结束";
                        else $status="正在进行";
                       echo "<tr class='row'>
                        <td class='col-md-1 col-xs-1'>{$line['contestID']}</td>
                        <td class='col-md-4 col-xs-4'><a href='contestDetail.php?contestID={$line['contestID']}'>{$line['contestName']}</a></td>
                        <td class='col-md-2 col-xs-2'>{$line['contestStartTime']}</td>
                        <td class='col-md-2 col-xs-2'>{$line['contestEndTime']}</td>
                        <td class='col-md-2 col-xs-2'>$status</td>
                        <td class='col-md-1 col-xs-1'>$publish</td>
                    </tr>";
                    }
                    ?>
                </table>
            </div>
            <nav class="col-md-4 col-md-offset-4">
                <ul class="pagination">
                    <?php
                    //换页功能的实现
                    $prevPage = $page-1;
                    $nextPage = $page+1;
                    if ($page == 1)
                        echo "<li><a href='#' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                    else
                        echo "<li><a href='./contest.php?page={$prevPage}' aria-label='Previous'><span aria-hidden='true'>&laquo;</span></a></li>";
                    for($i=$page-5;$i<$page;$i++)
                        if($i>=1&&$i-1<$countPage)
                            echo "<li><a href='./contest.php?page={$i}'>{$i}</a></li>";
                    echo "<li class='active'><a href='./contest.php?page={$page}'>{$page}<span class='sr-only'>(current)</span></a></li>";
                    for($i = $page+1; $i<$page+5 && $i-1<$countPage;$i++)
                        echo "<li><a href='./contest.php?page={$i}'>{$i}</a></li>";
                    if($page>= $countPage)
                        echo "<li><a href='#' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                    else
                        echo "<li><a href='./contest.php?page={$nextPage}' aria-label='Next'><span aria-hidden='true'>&raquo;</span></a></li>";
                    ?>
                </ul>
            </nav>
        </form>
    </div>
</div>
<?php
include("footer-fix.html");
?>


</body>
</html>