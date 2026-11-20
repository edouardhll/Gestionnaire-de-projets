<?php
    include("./include/bdd.php");

    function selectUserTasks($pdo, $id_user){
        $sql= "SELECT * FROM tasks WHERE user_id = :user_id";
        $req = $pdo->prepare($sql);                     
        $req->execute([
            'user_id' => $id_user
        ]);            
        $tasks = $req->fetchAll();                   
        
        return $tasks;
    }
    function selectOneTask($pdo, $id_user, $id_task){
        $sql= "SELECT * FROM tasks WHERE user_id = :user_id AND id = :id";
        $req = $pdo->prepare($sql);                     
        $req->execute([
            'user_id' => $id_user,
            'id' => $id_task
        ]);            
        $task = $req->fetch();                   
        
        return $task;
    }
    
    function selectAllTasks($pdo){
        $sql = "SELECT * FROM tasks";                   // Ecrit la requête
        $req = $pdo->prepare($sql);                     // Prépare la requête avant envoi
        $req->execute();                                // Execute la requête
        $tasks = $req->fetchAll();                      // Récupération du résultat complet dans un tableau associatif
        
        return $tasks;                                  // retourne le résultat
    }
    function deleteTask($pdo, $id){
        $sql= "DELETE FROM tasks WHERE id = $id";
        $req = $pdo->prepare($sql);
        $req->execute();
    }
    function createTask($pdo, $title, $description, $priority, $deadline, $userID){
        $sql= "INSERT INTO tasks (user_id, title, description, priority, due_date) VALUES (:id, :t, :d, :p, :dd)";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $userID,
            't' => $title,
            'd' => $description,
            'p' => $priority,
            'dd' => $deadline
        ]);
    }
    function editTask($pdo, $id_task, $id_user, $title, $description, $priority, $status, $deadline){
        $sql= "UPDATE tasks SET 
                title = :title,
                description = :description,
                priority = :priority,
                status = :status,
                due_date = :due_date
            WHERE id = :id AND user_id = :user_id";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $id_task,
            'user_id' => $id_user,
            'title' => $title,
            'description' => $description,
            'priority' => $priority,
            'status' => $status,
            'due_date' => $deadline
        ]);
    }
    function createComment($pdo, $user_id, $task_id, $content){
        $sql= "INSERT INTO comments (task_id, user_id, content) VALUES (:task_id, :user_id, :content)";
        $req = $pdo->prepare($sql);
        $req->execute([
            'task_id' => $task_id,
            'user_id' => $user_id,
            'content' => $content
        ]);
    }
    function selectComments($pdo, $id_user, $id_task){
        $sql= "SELECT * FROM comments WHERE task_id = :task_id AND user_id = :user_id";
        $req = $pdo->prepare($sql);                     
        $req->execute([
            'user_id' => $id_user,
            'task_id' => $id_task
        ]);            
        $comments = $req->fetchAll();                   
        
        return $comments;
    }
    function deleteComment($pdo, $id, $user_id){
        $sql= "DELETE FROM comments WHERE id = :id AND user_id = :user_id";
        $req = $pdo->prepare($sql);
        $req->execute([
            'id' => $id,
            'user_id' => $user_id,
        ]);
    }
?>