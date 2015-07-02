<?php
require_once("./lib/link_mysqli.php");
                    $data = array();
                    $db = new DB();
                    $strSQL=sprintf('select * from problem');
                    $result=$db->GetData($strSQL);
                    $count=$result->num_rows;
                    $records=3;
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
                    if($page+1>$countPage)
                        $next=$page;
                    else
                        $next=$page+1;
                    if($page-1<1)
                        $previous = $page;
                    else
                        $previous = $page-1;
                    $nStart=($page-1)*$records;
                    $strSQL=sprintf('select * from problem order by proID ASC limit %d , %d',$nStart,$records);
                    $problem = $db->GetData($strSQL);
                    $data=array();
                    while($line=$problem->fetch_assoc()){
                    echo "<tr>
                            <td><input type='checkbox' name='checkedBox' value='{$line['proID']}' id='checked{$line['proID']}'></td>
                            <td>{$line['proID']}</td>
                            <td><a href='problem.php?id={$line['proID']}'>{$line['proTitle']}</a></td>
                            <td>{$line['proSort']}</td>
                            <td>{$line['proTotalAC']}</td>
                            <td>{$line['proTotalSubmit']}</td>
                            </tr>";
                    }
                    $problem->free_result();
                    $db->__destruct();
?>