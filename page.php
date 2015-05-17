<?php
function page($sql,$url='')
{
    global $page, $beginCount, $pageNav, $rows, $result;//当前页码
    $rows = 50;//设置每页信息行数
    $total = $result->num_rows();//总信息数
    if (!page)
        $page = 1;//当前页码，如果第一次调用则设置为1
    $url .= "?page";//url地址后加page查询信息
    $lastPage = ceil($total / $rows);//ceil（）向上舍入为最近整数,即为总页数
    $prePage = $page - 1;//上一页
    $nextPage = ($page == $lastPage ? 0 : $page + 1);//下一页
    $beginCount = ($page - 1) * $rows;
    if ($lastPage < 1)
        return false;
    $pageNav = "<a href='$url=1'>首页</a>";
    if ($prePage)
        $pageNav .= "<a href='$url=$prePage'>上一页</a>";
    else
        $pageNav .= "上一页";
    if ($nextPage)
        $pageNav .= "<a href='$url=$nextPage'>下一页</a>";
    else
        $pageNav .= "下一页";
    $pageNav .= "<a href='$url=$lastPage'>尾页</a>";
    $pageNav .= "第<select name='toPage' size='1' onchange='window.location=\"$url=\"+this.value'>";
    for ($i = 1; $i <= $lastPage; $i++) {
        if ($i == $page)
            $pageNav .= "<option value='$i' selected>$i</option>";
        else
            $pageNav .= "<option value='$i'>$i</option>";
    }
    $pageNav .= "</select>页,共" . $lastPage . "页，共" . $total . "条记录";
    return $pageNav;
}
?>