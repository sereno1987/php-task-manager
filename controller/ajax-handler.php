<?php
include "../bootstrap/constants.php";

include  BASE_PATH."bootstrap/init.php";

#make sure its an ajax request
if(!isAjaxRequest()){
    diePage("Invalid Ajax Request");
}

# make sure action is set
if(!isset($_POST["action"]) || empty($_POST["action"])){
    diePage("Invalid Action");
}

# check different action- handle ajax requests
switch ($_POST["action"]){
    case "addFolder":
        # check the duplcate folder name and lenght of that
        if(!isset($_POST["folderName"]) || strlen($_POST["folderName"])<1){
            echo "The lenght of folder name must be at least 1 character!";
            die();
        }
        echo addFolder($_POST["folderName"]);
        break;
    default:
        diePage("Invalid Action");
}

