<?php
require_once("./lib/link_mysqli.php");
$db = new DB();
$state=$_REQUEST["state"];
if($state=="isPublish"){
    $proID=implode(",", $_REQUEST["select"]);
    $strSQL="update problem  set isPublish='1' where proID in ({$proID})";
    $db->GetData($strSQL);
    die;
}
if($state=="notPublish"){
    $proID=implode(",", $_REQUEST["select"]);
    $strSQL="update problem set isPublish='0' where proID in ({$proID})";
    $db->GetData($strSQL);
    die;
}

if($_REQUEST["selectPro"]){
    $proID=implode(",", $_REQUEST["selectPro"]);
    $strSQL="select * from problem where proID in ({$proID})";
    $problem=$db->GetData($strSQL);
    $data=array();
    while($line=$problem->fetch_assoc()){
        array_push($data,$line);
    }
    $problem->free_result();
    echo json_encode($data);
    die;
}
if($_REQUEST["flag"]=="not") $strSQL="select * from problem where isPublish='0'";
elseif($_REQUEST["flag"]=="is") $strSQL="select * from problem where isPublish='1'";
else $strSQL=sprintf('select * from problem');
$result=$db->GetData($strSQL);
$count=$result->num_rows;
$records=50;
$countPage=ceil($count/$records);
echo $countPage,',';
if(isset($_REQUEST['page'])==true){
    $page=$_REQUEST['page'];
    if(is_numeric($page)){
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
if($_REQUEST["select"]){
    $proID=implode(",", $_REQUEST["select"]);
    if($_REQUEST["flag"]=="not")
        $strSQL="select * from problem where proID in ({$proID}) and isPublish='1' UNION (SELECT * from problem where proID not in ({$proID}) and isPublish='0' ) limit {$nStart},{$records}";
    elseif($_REQUEST["flag"]=="is")
        $strSQL="select * from problem where proID in ({$proID}) and isPublish='0'UNION (SELECT * from problem where proID not in ({$proID}) and isPublish='1') limit {$nStart},{$records}";
    else
        $strSQL="select * from problem where proID in ({$proID}) UNION (SELECT * from problem where proID not in ({$proID}) order by isPublish ASC) limit {$nStart},{$records}";
}
else
    if($_REQUEST["flag"]=="not")
        $strSQL=sprintf("select * from problem where isPublish='1' limit %d , %d",$nStart,$records);
    elseif($_REQUEST["flag"]=="is")
        $strSQL=sprintf("select * from problem where isPublish='0' limit %d , %d",$nStart,$records);
    else
        $strSQL=sprintf("select * from problem order by isPublish ASC limit %d , %d",$nStart,$records);
$problem = $db->GetData($strSQL);
while($line=$problem->fetch_assoc()){
    if($line['isPublish'])
        $publish="已发布";
    else
        $publish="未发布";
    echo "<tr>";
    if($_REQUEST["select"]&&in_array($line["proID"],$_REQUEST["select"]))
        echo" <td><input type='checkbox' name='checkedBox' value='{$line['proID']}' id='checked{$line['proID']}' checked='checked'></td>";
    else
        echo" <td><input type='checkbox' name='checkedBox' value='{$line['proID']}' id='checked{$line['proID']}'></td>";
    echo" <td>{$line['proID']}</td>
            <td>{$line['proTitle']}</td>
            <td>{$line['proSort']}</td>
            <td>{$line['entryTime']}</td>
            <td>{$publish}</td>
        </tr>";
}
$problem->free_result();
$db->__destruct();
?>