<?php
    include("./header.php");
    include("./include/tasks.php");
    $pdo = new PDO($dsn, $user, $pass, $options);
    $id_task = $_GET['id'];
    $id_user = $_SESSION['id'];
    $task = selectOneTask($pdo, $id_user, $id_task);
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $newComment = $_POST["newComment"];
        $newComment = htmlentities($newComment);
        if($newComment != ""){
            createComment($pdo, $id_user, $id_task, $newComment);
            
            }
    $comments = selectComments($pdo, $id_user, $id_task);
    }   
    echo '
    <h1>'.$task['title'].'</h1>
    <h2>Détails:</h2>
    <table style="border:solid 1px #111">
        <tr style="border:solid 1px #111">
            <td style="border:solid 1px #111">Description:</td>
            <td style="border:solid 1px #111">Statut:</td>
            <td style="border:solid 1px #111">Priorité:</td>
            <td style="border:solid 1px #111">Échéance:</td>
            <td style="border:solid 1px #111">Créée le:</td>
            <td style="border:solid 1px #111">Mis à jour le:</td>
            <td style="border:solid 1px #111">Par:</td>
        </tr>
        <tr style="border:solid 1px #111">
            <td style="border:solid 1px #111">'.$task['description'].'</td>
            <td style="border:solid 1px #111">'.$task['status'].'</td>
            <td style="border:solid 1px #111">'.$task['priority'].'</td>
            <td style="border:solid 1px #111">'.$task['due_date'].'</td>
            <td style="border:solid 1px #111">'.$task['created_at'].'</td>
            <td style="border:solid 1px #111">'.$task['updated_at'].'</td>
            <td style="border:solid 1px #111">'.$task['user_id'].'</td>
        </tr>
    </table>
    <div>
        <h2>Espace commentaires:</h2>

    ';

    foreach ($comments as $comment){
        echo '<p>De: '.$comment['user_id'].' le: '.$comment['created_at'].'</p>' ;
        echo '<p>'.$comment['content'].'</p>' ;
        if ($_SESSION['id'] == $comment['user_id']){
            echo '<a href="./deleteComment.php?='.$comment['id'].'">Supprimer</a>';
        }
    }

    echo '
    </div>
    <form action="" method="post" class="form">
        <div class="form">
            <input type="text" name="newComment" placeholder="Votre commentaire" required />
        </div>
        <div>
            <input type="submit" value="Envoyer"/>
        </div>
    </form>
    ';

    // print_r($comments);


?>