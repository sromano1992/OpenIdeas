<?php
    /** 
    * @author Amedeo Leo
    */
    session_start();
    require 'manageDB.php';
    $idDestinatario = $_SESSION['email'];
    
    if(updateAllNoticesOfUSer($idDestinatario) == "ok")
        echo "success";
?>