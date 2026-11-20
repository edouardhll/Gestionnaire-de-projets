<?php    
    include('header.php');
    include('./include/tasks.php');
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        $result = selectUserTasks($pdo, $_SESSION['id']);

            echo '<table style="border:solid 1px #111"><tr>taches</tr>';
                foreach ($result as $task){
                    echo'
                    <tr style="border:solid 1px #111">'
                    .'<td>'.$task['title'].'</td>'
                    .'<td>'.$task['description'].'</td>'
                    .'<td><a href="./detailsTask.php?id='.$task['id'].'">Détails</a></td>'
                    .'<td><a href="./editTask.php?id='.$task['id'].'">Modifier</a></td>'
                    .'<td><a href="./deleteTask.php?id='.$task['id'].'">Supprimer</a></td>'
                    .'</tr>';
                }
            echo'</table>';

            echo 'Connexion OK';
            } catch (\PDOException $e) {
                error_log($e->getMessage());
                die("Erreur de connexion à la base de données.");
            }
?>