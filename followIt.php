<?php
    session_start();
    require 'manageDB.php';
    $idButton=$_POST['idButton'];
    $idIdea=$_POST['idIdea'];
    $idUser = $_SESSION['email'];
    
    if($idButton = "followIt") {
        $result = insertFollower($idUser,$idIdea);
        if($result == NULL) {
            return("Non puoi seguire una tua idea");
        }
        else {
            echo "<li><a href='#' id='notFollowIt'>Non seguire pi&ugrave;</a></li>";
        }
    }
?>