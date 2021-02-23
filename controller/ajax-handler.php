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
        $folderName=$_POST["folderName"];
        # check the duplcate folder name and lenght of that
        if(!isset($folderName) || strlen($folderName)<1){
            echo "The lenght of folder name must be at least 1 character!";
            die();
        }
        echo addFolder($_POST["folderName"]);
        break;

    case "doneToggle":
        $taskId=$_POST["taskId"];
        if(!isset($taskId) || !is_numeric($taskId)){
            echo "Invalid task Id";
            die();
        }
        echo doneToggle($taskId);
        break;

    case "addTask":
        $taskTitle=$_POST["taskTitle"];
        $folderId=$_POST["folderId"];
        # check the folder must be selected
        if(!isset($folderId) || $folderId==0 ){
            echo "You should select a folder";
            die();
        }
        # check the duplcate task name and lenght of that
        if(!isset($taskTitle) || strlen($taskTitle)<3){
            echo "The lenght of task  must be at least 1 character!";
            die();
        }
       echo addTask($_POST["taskTitle"], $_POST["folderId"]);
        break;

    default:
        diePage("Invalid Action");
}

