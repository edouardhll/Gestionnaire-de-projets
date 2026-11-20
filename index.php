<?php

if($_SESSION == ""){
    header("Location: ./login.php");
    exit();
}

include('allTasks.php');

include('footer.php'); 
?>