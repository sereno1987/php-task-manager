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

function message($msg, $status){
    if ($status=='failure'){
        echo "<div style='width: 100%; height: 40px; background-color: orange; border: darkred; padding: 5    px;text-align: center'>";
        echo $msg;
        echo  "</div>";
    }elseif ($status=='success'){
        echo "<div style='width: 100%; height: 40px; background-color: forestgreen; border: darkgreen; padding: 5px;text-align: center'>";
        echo $msg;
        echo  "</div>";
    }

}


function isAjaxRequest(){
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ) {
        return true;
    }message("You logged in successfully. welcome!<br>
                    <a href='{$home_url}'>go to tasks</a>", 'success');
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

function redirect($url){
    header("location:".$url);
    die();
}
