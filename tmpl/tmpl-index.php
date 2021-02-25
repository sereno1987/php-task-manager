<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title><?= SITE_TITLE ?></title>
  <link rel="stylesheet" href="<?= site_url('assets/css/style.css')?>">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="page">
  <div class="pageHeader">
    <div class="title">Dashboard</div>
    <div class="userPanel">
        <a href="<?= site_url('?logout=1') ?>"><i class="fa fa-sign-out"></i></a>
        <span class="username"><?= $loggedInUser->username ?? 'User'?> </span><img src="<?= $loggedInUser->profileImage?>"/></div>
  </div>
  <div class="main">
    <div class="nav">
      <div class="searchbox">
        <div><i class="fa fa-search"></i>
          <input type="search" placeholder="Search"/>
        </div>
      </div>
      <div class="menu">
        <div class="title">Folders</div>
        <ul class="folders-list">
            <li class="active"><a href="<?= site_url();?>"><i class="fa fa-folder"></i>All</a></li>
            <?php  foreach ($folders as $folder):?>
                <li>
                    <a href="?folder_id=<?=$folder->id ?>"><i class="fa fa-folder"></i><?= $folder->name ?> </a>
                    <a class="remove" onclick="return confirm('Are you sure to delete this folder?')" href="?delete_folder=<?=$folder->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                </li>
            <?php endforeach; ?>

        </ul>
          <div id="newFolderInput">
              <input type="text" id="newFolderInput" style="margin-outside: 5px; width: 80%; height: 25px" placeholder="add new folder"/>
<!--              <button id="newFolderBtn" class="btn clickable">+</button>-->
          </div>
          <div class="functions">
              <div  id="newFolderBtn" class="button active" >Add Folder</div>
          </div>
      </div>

    </div>
    <div class="view">
      <div class="viewHeader">
          <div id="newFolderInput">
              <input type="text" id="newTaskInput"  placeholder="type new task name and enter"/>
          </div>
       <!-- <div class="functions">
            <div class="button active" >Add Task</div>
        </div> -->
      </div>
      <div class="content">
        <div class="list">
          <div class="title">Today</div>
          <ul class="tasks-list">
              <?php if(sizeof($tasks)): ?>
                  <?php  foreach ($tasks as $task):?>
                      <li class="<?= $task->status ?'checked': ''; ?>"><i data-taskId="<?= $task->id?>" class=" isDone clickable <?= $task->status?'fa fa-check-square-o': 'fa fa-square-o'; ?>"></i><span><?= $task->title ?></span>
                          <div class="info">
                              <div class="button gray"><?= $task->created_at ?></div><span class="delete-task">
                                  <a class="remove" onclick="return confirm('Are you sure to delete this folder?')" href="?delete_task=<?=$task->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                              </span><span>created at:</span>
                          </div>

                      </li>

                  <?php endforeach; ?>
              <?php else: ?>
                <li> Oh! you haven't created any tasks in this folder.</li>
              <?php endif; ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script  src="<?= site_url('assets/js/script.js')?>"></script>
<script>
    $(document).ready(function (){
        $('#newFolderBtn').click(function (e){
            var input=$('input#newFolderInput');
            // alert(input.val());
            $.ajax({
                url:"controller/ajax-handler.php",
                method: "post",
                data:{action:"addFolder", folderName:input.val()},
                success:function (responce){

                    if(responce == 1){
                        $('<li><a href="#"><i class="fa fa-folder"></i>'+input.val()+'</a><a class="remove" href="#"><i class="fa fa-trash-o" aria-hidden="true"></i></a></li>').appendTo('ul.folders-list');
                    }
                     else {
                         alert(responce);
                     }
                },
            })
        });
        $('#newTaskInput').keypress(function(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            var taskTitle=$('input#newTaskInput');
            if(keycode == '13'){
                // event.stopPropagation();
                $.ajax({
                    url:"controller/ajax-handler.php",
                    method: "post",
                    data:{action:"addTask", taskTitle:taskTitle.val(), folderId:<?= isset($_GET['folder_id'])? $_GET['folder_id']:0 ?>},
                    success:function (responce){
                        if(responce == 1){
                            location.reload();
                        }
                        else {
                            alert(responce);
                        }
                    },
                })
            }
        });
        $('.isDone').click(function (e){
            var taskId= $(this).attr('data-TaskId');
            $.ajax({
                url:"controller/ajax-handler.php",
                method: "post",
                data:{action:"doneToggle", taskId:taskId},
                success:function (responce){

                    if(responce == 1){
                        location.reload();
                    }
                    else {
                        alert(responce);
                    }
                },
            })
        });

        $('#newTaskInput').focus();
    })

</script>

</body>
</html>
