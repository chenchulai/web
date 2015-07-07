<?php
require_once("./lib/link_mysqli.php");
$db = new DB();
if($_REQUEST["selectPro"]){
    $proID=implode(",", $_REQUEST["selectPro"]);
    $strSQL="select * from problem where proID in ({$proID})";
    $problem=$db->GetData($strSQL);
    $data=array("proID"=>array(),"proTitle"=>array());

    while($line=$problem->fetch_assoc()){
        array_push($data["proID"],$line["proID"]);
        array_push($data["proTitle"],$line["proTitle"]);
    }
    $problem->free_result();
    echo json_encode($data);
    die;
}
$strSQL=sprintf('select * from problem where ispublish=1');
$result=$db->GetData($strSQL);
$count=$result->num_rows;
$records=2;
$countPage=ceil($count/$records);
echo $countPage,',';
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
if($page+1>$countPage) $next=$page;
else    $next=$page+1;
if($page-1<1) $previous = $page;
else    $previous = $page-1;
$nStart=($page-1)*$records;
$strSQL=sprintf('select * from problem where isPublish=1 order by proID ASC limit %d , %d',$nStart,$records);
$problem = $db->GetData($strSQL);
while($line=$problem->fetch_assoc()){
    echo "<tr>
            <td><input type='checkbox' name='checkedBox' value='{$line['proID']}' id='checked{$line['proID']}'></td>
            <td>{$line['proID']}</td>
            <td><a href='problem.php?id={$line['proID']}'>{$line['proTitle']}</a></td>
            <td>{$line['teacherID']}</td>
            <td>{$line['proSort']}</td>
            <td>{$line['entryTime']}</td>
        </tr>";
}
$problem->free_result();
$db->__destruct();
?><?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/4
 * Time: 15:26
 */