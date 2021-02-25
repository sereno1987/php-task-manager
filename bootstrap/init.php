<?php
session_start();
include "constants.php";
include BASE_PATH."bootstrap/config.php";
include BASE_PATH."bootstrap/constants.php";
include BASE_PATH."libs/lib-tasks.php";
include BASE_PATH."libs/helpers.php";
include BASE_PATH."libs/lib-auth.php";
include BASE_PATH."vendor/autoload.php";


try{
        $connection=new PDO("mysql:host=$dataBaseConfig->host; dbname=$dataBaseConfig->db;charset=utf8mb4",$dataBaseConfig->user
            ,$dataBaseConfig->password);
//        echo "connected";

    }
catch (PDOException $e){
//    diePage("connection error".$e->getMessage()."line#: ".$e->getLine());
}

