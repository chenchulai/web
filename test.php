<?php
//总记录数
$count = mysql_result(mysql_query("SELECT COUNT(*) FROM db_name"),0);
//每页显示
$size = 10;
//总页数
$pagecount = ceil($count/$size);
//获取浏览器传来的PAGE值 去除两边空格 转成整数 无则赋值1
$page = isset($_GET['page']) ? intval(trim($_GET['page'])) : 1;
//如果小于1或大于总页数则等于1
if($page < 1 || $page > $pagecount) $page = 1;
//从第几条记录开始显示
$begin = ($page - 1) * $size;
$sql = mysql_query("SELECT * FROM db_name ORDER BY id DESC LIMIT $begin,$size");
while($count && $arr = mysql_fetch_array($sql)){
    //这里是你要输出的内容 如：
    $id = $arr['info_id'];
    echo $id;
}
//翻页
$last = $page - 1;//前页
$next = $page + 1;//后页
echo <<<HTML
<form method="get">
    <a href="?page={$last}">&#8249;前页</a>
    第{$page}/{$pagecount}页
    <a href="?page={$next}">后页&#8250;</a>　
    <input type="text" name="page" size="3" title="跳转到第几页？"/>
    <input type="submit" value="GO"/>
</form>
HTML;
?>
