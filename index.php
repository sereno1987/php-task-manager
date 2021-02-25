<?php
include "bootstrap/init.php";

# check for logged out users
if (isset($_GET['logout'])){
    #redirect to auth page
    logout();
    }

# check for loggedin users
if (!isLoggedIn()){
    #redirect to auth page
    redirect(site_url('auth.php'));
}

$loggedInUser= getLoggedInUser();

# for delete and update always check it firstly
if (isset($_GET['delete_folder']) && is_numeric($_GET['delete_folder'])){
    $deletedItems=deleteFolder(($_GET['delete_folder']));
//    echo $deletedItems;
}

if (isset($_GET['delete_task']) && is_numeric($_GET['delete_task'])){
    $deletedItems=deleteTask(($_GET['delete_task']));
//    echo $deletedItems;
}

$folders=getFolders();

$tasks=getTasks();

#its important to include the template after function, so we have data to fill in the items
include "tmpl/tmpl-index.php";
