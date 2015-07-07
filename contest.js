function startTime() {
    var today = new Date();
    var y = today.getFullYear();
    var o = today.getMonth()+1;
    var d = today.getDate();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    o=checkTime(o);
    d=checkTime(d);
    m=checkTime(m);
    s=checkTime(s);
    if($("#clock")){
        $("#clock").val(y+"-"+o+"-"+d+" "+h+":"+m+":"+s);
    }
    if($("#getTime")){
        $("#getTime").html(y+"-"+o+"-"+d+" "+h+":"+m+":"+s);
        if($("#getTime").html()>$("#endTime").html())
            $("#state").html("结束");
        else if($("#getTime").html()<$("#startTime").html())
            $("#state").html("未开始");
        else
            $("#state").html("正在进行");
    }
    t=setTimeout('startTime()',1000)
    }
function checkTime(i){
    if(i<10){
        i="0"+i;
    }
    return i;
}