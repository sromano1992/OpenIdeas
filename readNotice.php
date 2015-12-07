<?php
    /** 
    * @author Amedeo Leo
    */
    session_start();
    require 'manageDB.php';
    $idNotice=$_POST['idNotice'];
    $notice = getNoticeById($idNotice);
    $idDestinatario = $notice['idDestinatario'];
    $idIdea = $notice['idIdea'];
    $date = $notice['date'];
    $text = $notice['text'];
    $type = $notice['type'];
    if(updateNotice($idDestinatario, $idIdea, $date, $text, $type) == "ok")
        echo "success";    
?>