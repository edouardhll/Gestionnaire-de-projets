<?php
try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    
        $result = selectAllUsers($pdo);
    //    $result = selecUserById($pdo, 1);
    
    echo '<a href="addUser.php">Ajouter un utilisateur</a>';
    
    echo '<table style="border:solid 1px #111">';
            foreach ($result as $user){
                    echo '
                        <tr style="border:solid 1px #111">
                            <td>'.$user['id'].'</td>'
                            .'<td>'.$user['username'].'</td>'
            .'<td>'.$user['email'].'</td>'
            .'<td>'.$user['password'].'</td>'
            .'<td>'.$user['created_at'].'</td>'
            .'<td>'.$user['role_id'].'</td>'
            .'<td> 
                       <a href="./editUser.php?id='.$user['id'].'">Modifier</a> 
                       <a href="./deleteUser.php?id='.$user['id'].'">Supprimer</a>
                  </td>'.
                '</tr>';
        } 
    echo '</table>';
    
    function selectAllUsers($pdo){
        $sql = "SELECT * FROM users";                   // Ecrit la requête
        $req = $pdo->prepare($sql);                     // Prépare la requête avant envoi
        $req->execute();                                // Execute la requête
        $users = $req->fetchAll();                      // Récupération du résultat complet dans un tableau associatif
        
        return $users;                                  // retourne le résultat
    }
?>