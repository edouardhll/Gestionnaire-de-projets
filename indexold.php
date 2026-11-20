<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
    <!-- Liaison du fichier CSS externe -->
    <link rel="stylesheet" href="style.css">
</head>
    
    <?php
// db.php
$host = '127.0.0.1';
$db   = 'exercice';
$user = 'root';
$pass = 'root';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    
    $result = selectUserById($pdo, 1);
    
    // echo("<p>Connexion réussie</p>");
    // var_dump($result['email']);
    echo('
    <table>
    <tr>
    <td>Username</td>
    <td>'.$result["username"].'</td>
    </tr>
    <tr>
    <td>Email</td>
    <td>'.$result["email"].'</td>
    </tr>
    <tr>
    <td>Taches</td>
    <td>'.$result["tasks"].'</td>
    </tr>
    </table>
            <a class="footer" href="/connexion.php">
                <div class="white-button">
                    <p>Se connecter</p>
                </div>
            </a>
    ');
    
    
    
    }
    
    catch (\PDOException $e) {
        error_log($e->getMessage());
        die("Erreur de connexion à la base de données.");
        }
        
        function selectUserById($pdo, $id){
            $sql = "SELECT * FROM users WHERE id = :id_user";
            $req = $pdo->prepare($sql);
            $req->execute(['id_user' => $id]);
            $user = $req->fetch();
            
            return $user;
            }
