<?php
    include("./header.php");
    include("./include/tasks.php");
    $pdo = new PDO($dsn, $user, $pass, $options);
    $id_task = $_GET['id'];
    $id_user = $_SESSION['id'];
    if (isset($id_task)){
        $task = selectOneTask($pdo, $id_user, $id_task);
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $status = $_POST['status'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        editTask($pdo, $id_task, $id_user, $title, $description, $priority, $status, $deadline);
        header("Location: ./allTasks.php");
        exit();
    }
    echo '
    <form action="" method="post" class="form">
        <div class="form">
            <label for="title">Nom de la tâche:</label>
            <input type="text" name="title" value="'.$task["title"].'" required />
        </div>
        <div class="form">
            <label for="description">Description:</label>
            <input type="text" name="description" value="'.$task["description"].'" required />
        </div>
        <div class="form">
            <label for="priority">Prioritée:</label>
            <select name="priority" required>
    ';
                if ($task["status"] == "2"){
                    echo'
                    <option value="2" selected>Importante</option>
                    <option value="1">Moyenne</option>
                    <option value="0">Faible</option>
                    ';
                } elseif ($task["status"] == "1") {
                    echo'
                    <option value="2" selected>Importante</option>
                    <option value="1" selected>Moyenne</option>
                    <option value="0">Faible</option>
                    ';
                } else {
                    echo'
                    <option value="2">Importante</option>
                    <option value="1">Moyenne</option>
                    <option value="0" selected>Faible</option>
                    ';
                }
    echo '
            </select>
        </div>
        <div class="form">
            <label for="status">Statut:</label>
            <select name="status" required>
                ';
                if ($task["status"] == "done"){
                    echo'
                    <option value="done" selected>Fait</option>
                    <option value="doing">En cours</option>
                    <option value="todo">À faire</option>
                    ';
                } elseif ($task["status"] == "doing"){
                    echo'
                    <option value="done">Fait</option>
                    <option value="doing" selected>En cours</option>
                    <option value="todo">À faire</option>
                    ';    
                } else {
                    echo'
                    <option value="dodo">Fait</option>
                    <option value="doing">En cours</option>
                    <option value="todo" selected>À faire</option>
                    ';

                }
        echo'
            </select>
        </div>
        <div class="form">
            <label for="deadline">Date limite:</label>
            <input type="date" name="deadline" required value="'.$task["due_date"].'"/>
        </div>
        <div>
            <input type="submit" value="Modifier"/>
        </div>
                </form>
        
    ';

    ?>
<!-- UPDATE `users` SET `password` = '$2y$10$vI8aWBnW3fID.ZQ4/zo1G.q1lRps.9cGLcZEiGDMVr5yUP1KUOYTa' WHERE `users`.`id` = 1; -->