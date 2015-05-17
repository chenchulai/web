<?php
function validatePost($checks){
    foreach((array)$checks as $name){
        if (isset($_POST[$name]) == false)
            return false;
    }
    return true;
}

function validatePostGo($checks, $url){
    if (validatePost($checks) == false){
        header("Location:{$url}");
        die;
    }
}

function validateGet($checks){
    foreach((array)$checks as $name){
        if(isset($_GET[$name]) == false)
            return false;
    }
    return true;
}

function validateGetGo($checks, $url){
    if (validateGet($checks) == false){
        header("Location:{$url}");
        die;
    }
    return true;
}
