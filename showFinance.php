<?php
    /** 
    * @author Amedeo Leo
    */
    session_start();
    require 'manageDB.php';
    $user=$_SESSION['email'];
    $notices = getNoticesOfUser($_SESSION['email']);
    $comments = array();

    foreach($notices as $notice) {
        if($notice['type'] == "Financier") {
            $comments[] = $notice;
        }
    }
    
    foreach($comments as $comment) {
        $href = "idea.php?id=".$comment['idIdea'];
        $id = $comment['idNotice'];
        $onclick = "readNotice($id)";
        echo "<li class='list-group-item'><a href=".$href."id=".$id."onclick=".$onclick.">".$comment['text']."</a></li>";
    }
    
?>