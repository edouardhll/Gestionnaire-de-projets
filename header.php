<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="?action=session_destroy">Déconnexion</a>

<?php
    session_start();
    if (isset($_GET['action'])&& $_GET['action'] == 'session_destroy'){
        session_unset(); //vide $_SESSION
        session_destroy();
        header("Location: ./login.php");
        exit();
    }
?>
