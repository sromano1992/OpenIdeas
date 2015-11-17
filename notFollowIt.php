<?php
    session_start();
    require 'manageDB.php';
    $idButton=$_POST['idButton'];
    $idIdea=$_POST['idIdea'];
    $idUser = $_SESSION['email'];
    
    if($idButton = "notFollowIt") {
        deleteFollower($idUser,$idIdea);
        echo "<li><a href='#' id='followIt'>Segui</a></li>";
    }
?>