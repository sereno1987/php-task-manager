<?php
# app users wont have access to this path. trick!!
//if (!defined('BASE_PATH')){
//    echo "Permission denied";
//    die();
//}

# or you can use this one- more optimized
defined('BASE_PATH') OR die("permission is denied");

#get current user
function getCurrentUserId(){
    #get logged in user
    return 1;
}
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Tasks
# get tasks name from database
function getTasks(){
    global $connection;
    $userId = getCurrentUserId();
    $folderCondition="";
    $folderId= $_GET["folder_id"]??null;
    if(isset($folderId) and is_numeric($folderId)){
        $folderCondition="and folder_id=$folderId";
    }
    $sql="select * from tasks where user_id=$userId $folderCondition";
    $stm= $connection->prepare($sql);
    $stm->execute();
    $result=$stm->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function addTask($task_title, $folderId){
    global $connection;
    $userId=getCurrentUserId();
    $sql="insert into tasks (title,user_id,folder_id,status) values (:taskTitle, :userId, :folderId, :status)";
    $stm= $connection->prepare($sql);
    $stm->execute([":taskTitle"=> $task_title, ":userId"=>$userId, ":folderId"=>$folderId,":status"=> 0]);
    return $stm->rowCount();

}

function deleteTask($task_id){
    global $connection;
    $userId=getCurrentUserId();
    $sql="delete from tasks where id=$task_id and user_id=$userId";
    $stm= $connection->prepare($sql);
    $stm->execute();
    return $stm->rowCount();

}
#>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>Folders

# get folders name from database
function getFolders()
{
    global $connection;
    $userId = getCurrentUserId();
    $sql = "select * from folders where user_id=$userId";
    $stm = $connection->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_OBJ);
    return $result;
}

function addFolder($folder_name){
    global $connection;
    $userId=getCurrentUserId();
    $sql="insert into folders (name,user_id) values (:folderName, :userId)";
    $stm= $connection->prepare($sql);
    $stm->execute([":folderName"=>$folder_name , ":userId"=>$userId]);
    return $stm->rowCount();
}

function deleteFolder($folder_id){
    global $connection;
    $userId=getCurrentUserId();
    $sql="delete from folders where id=$folder_id and user_id=$userId";
    $stm= $connection->prepare($sql);
    $stm->execute();
    return $stm->rowCount();
}

