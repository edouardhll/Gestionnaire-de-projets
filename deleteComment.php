<?php
    include("./include/tasks.php");
    $pdo = new PDO($dsn, $user, $pass, $options);
    $id = $_GET['id'];
    
    if (isset($id)) {// commme si j'avais === TRUE
    deleteComment($pdo, $id, $user_id);
    }
    header("Location: ./allTasks.php");
    exit(); //redirige vers allTasks pour mettre à jour direct la page
?>