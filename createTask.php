<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);?>
<?php include("./include/tasks.php");
include("./header.php");?>
<form action="" method="get" class="form">
    <div class="form">
        <label for="title">Nom de la tâche:</label>
        <input type="text" name="title" required />
    </div>
    <div class="form">
        <label for="description">Description:</label>
        <input type="text" name="description" required />
    </div>
    <div class="form">
        <label for="priority">Prioritée:</label>
        <select name="priority" required>
            <option value="2">Importante</option>
            <option value="1">Moyenne</option>
            <option value="0">Faible</option>
        </select>
    </div>
    <div class="form">
        <label for="deadline">Date limite:</label>
        <input type="date" name="deadline" required />
    </div>
    <div>
        <input type="submit" value="Créer"/>
    </div>
</form>

<?php

?>
<?php
    $pdo = new PDO($dsn, $user, $pass, $options);
    if (isset($_GET['title'])) {
        $title = $_GET['title'] ;
    }
    if (isset($_GET['description'])) {
        $description = $_GET['description'] ;
    }
    if (isset($_GET['priority'])) {
        $priority = $_GET['priority'] ;  
    }
    
    if (isset($_GET['deadline'])) {
        $deadline = $_GET['deadline'] ;
    }

    $userID = $_SESSION['id'];

    if(isset($title, $description, $priority, $deadline)){
        createTask($pdo, $title, $description, $priority, $deadline, $userID);
    }
    // header("Location: ./allTasks.php");
    // exit(); //redirige vers allTasks pour mettre à jour direct la page
?>