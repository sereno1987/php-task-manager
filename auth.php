<?php
include "bootstrap/init.php";
$home_url=site_url();


# check the action -get or post
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $input=$_POST;
    $action=$_GET['action'];
    if ($action=='signup'){
        $result=signup($input['username'],$input['email'], $input['password']);
        if (!$result== true){
            message("please check inputs!", 'failure');
        }else{
            message("You have been registered successfully. welcome!<br>
                    <a href='{$home_url}'auth.php'>Please Login</a>", 'success');
        }

    } elseif ($action=='login'){
        $result= login($input['email'], $input['password']);
        if (!$result== true){
            message("email or password is incorrect!",'failure');
        }else{
//            message("You logged in successfully. welcome!<br>
//                    <a href='{$home_url}'>go to tasks</a>", 'success');
            redirect(site_url());


        }
    }

 }


include "tmpl/tmpl-auth.php";

