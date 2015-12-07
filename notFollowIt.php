<?php
    /** 
    * @author Amedeo Leo
    */
    session_start();
    require 'manageDB.php';
    $idButton=$_POST['idButton'];
    $idIdea=$_POST['idIdea'];
    $idUser = $_SESSION['email'];
    
    if($idButton = "notFollowIt") {
        deleteFollower($idUser,$idIdea);
        echo "<button type='button' onClick='followIt();' id='followIt' class='btn btn-default btn-lg' style='background: green'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Follow</button>";
    }
?>