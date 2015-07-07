<?php
require_once("./lib/link_mysqli.php");
$runID = $_GET['runID'];
$db = new DB();
$sql = sprintf("select compileResult from runningLog where runID = %s",$runID);
$result = $db->GetData($sql);
$line = $result->fetch_assoc();
$compileResult = $line['compileResult'];
echo $compileResult;
?>

