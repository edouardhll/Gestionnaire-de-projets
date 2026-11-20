<?php include('header.php');  ?>
<?php include('./include/bdd.php');  ?>
<?php
    $pdo = new PDO($dsn, $user, $pass, $options);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $login = $_POST["login"];
        $password = $_POST["password"];
        $login = htmlentities($login);
        $password = htmlentities($password);
        if($login != "" && $password != ""){
            //connexion à la bdd
            $sql = "SELECT * FROM users WHERE username = :l";
            $req = $pdo->prepare($sql);
            $req->execute([
                'l' => $login,
            ]);
            $user = $req->fetch();
            if($user != false && password_verify($password, $user['password'])){
                $_SESSION['id'] = $user['id']; 
                $_SESSION['username'] = $user['username']; 
                header("Location: ./allTasks.php");
                exit(); //redirige vers allTasks pour mettre à jour direct la page
                //connexion réussie 
            } else {
                echo 'Identifiant ou mot de passe incorrect.';
            }
            
        }
    }
?>
<form action="" method="post" class="form">
    <div class="form">
        <label for="login">Login:</label>
        <input type="text" name="login" required />
    </div>
    <div class="form">
        <label for="password">Mot de passe:</label>
        <input type="password" name="password" required />
    </div>
    <div>
        <input type="submit" value="Se connecter" name="connexion"/>
    </div>
</form>

<?php include('footer.php');  ?>
