<?php defined('BASE_PATH') OR die("permission is denied");

//function getCurrentUrl(){
//    return 1;
//}
//
//function power($number, $pow    ){
//    return 1;
//}
//

function diePage($msg){
    echo $msg;
    die();
}

function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }
    return false;
}

function dd($var){
    echo "<pre style='adding: 20px; z-index: 999; background-color: black; color: gray; position: relative; margin: 9px; border-radius: 10px;'>";
    var_dump($var);
    echo "</pre>";
}

function site_url($uri=''){
    return BASE_URL. $uri;
}

