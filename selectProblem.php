<?php
session_start();
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>问题列表</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/offcanvas.css" type="text/css">
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.4/docs/assets/js/ie10-viewport-bug-workaround.js"></script>
    <style type="text/css">
        .borderPadding{padding-top:70px;}
        th,tr,td{text-align: center; }
    </style>
</head>
<body>
<div class="container">
    <div>
        <div><input type="button" value="全选"><input type="button" value="取消"><input type="button" value="确定"></div>
        <table class="table table-striped">
            <tr>
                <td>选择</td>
                <td>题目编号</td>
                <td>标题</td>
                <td>作者</td>
                <td>类型</td>
                <td>录入时间</td>
                <td>使用历史</td>
                <td>正确</td>
                <td>提交</td>
            </tr>
            <?php
            require_once("./lib/link_mysqli.php");
            $db=new DB();
            $strSQL=sprintf("select * from problem");
            $practice=$db->GetData($strSQL);
            while($line=$practice->fetch_assoc()){
                $teacherSQL="select teacherName from teacher WHERE teacherID={$line['teacherID']}";
                $teacherResult=$db->GetData($teacherSQL);
                $teacherName=$teacherResult->fetch_assoc();

                echo "<div style='line-height: 30px'><tr>
                    <td><input type='checkbox'></td>
                    <td>{$line['proID']}</td>
                    <td><a href='problem.php?id={$line['proID']}'>{$line['proTitle']}</a></td>
                    <td>{$teacherName['teacherName']}</td>
                    <td>{$line['proSort']}</td>
                    <td>{$line['entryTime']}</td>";
                if($line['isPublish']==0)
                    echo "<td>未使用</td>";
                else
                    echo "<td>已使用</td>";
                echo"<td>{$line['proTotalAC']}</td>
                    <td>{$line['proTotalSubmit']}</td>
                    </tr></div>";
            }
            $practice->free_result();
            $db->__destruct();
            ?>
        </table>
    </div>
</div>
</body>
</html>
