<?php    include('header.php'); ?>
<?php include('./include/bdd.php');  ?>
<?php
    $pdo = new PDO($dsn, $user, $pass, $options);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $username = htmlentities($username);
        $email = htmlentities($email);
        $password = htmlentities($password);
        if($username != "" && $password != "" && $email !=""){
            $password = password_hash($password, PASSWORD_DEFAULT);
            //connexion à la bdd
            $sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
            $req = $pdo->prepare($sql);
            $req->execute([
                'username' => $username,
                'email' => $email,
                'password' => $password
                ]);
            header("Location: ./login.php");
            exit();
        } else {
            echo(Erreur);
        }
    }
?>

<form action="" method="post" class="form">
    <div class="form">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" required />
    </div>
    <div class="form">
        <label for="email">Email</label>
        <input type="email" name="email" required />
    </div>
    <div class="form">
        <label for="password">Mot de passe</label>
        <input type="password" name="password" required />
    </div>
    <div>
        <input type="submit" value="Créer mon compte"/>
    </div>
</form>

<?php include('footer.php');?>