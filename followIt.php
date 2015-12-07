<?php
    /** 
    * @author Amedeo Leo
    */
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
            $user_follower = getUserById($idUser);
            $nameSurname = $user_follower['User']['name'] . " " . $user_follower['User']['surname'];

            $idea = getIdeaById($idIdea);
            $id_user_idea = $idea['User']['email'];
            $text_idea = $idea['Idea']['nome'];
            $text = "La tua idea ".$text_idea." ha un nuovo follower: $nameSurname.";
            
            $mail_destinatario = $id_user_idea;
            $mail_oggetto = "La tua idea ".$text_idea." ha un nuovo follower: $nameSurname.";
            $title = "Nuovo follower per la idea ".$text_idea;
            $body = $text;
            
            sendMail($mail_destinatario, $mail_oggetto, $title, $body);

            $text = "La tua idea ".$text_idea." ha un nuovo follower!";
            insertNotice($id_user_idea, $idIdea, $text, "Follower");
            echo "<button type='button' onClick='notFollowIt();' id='notFollowIt' class='btn btn-default btn-lg' style='background: red'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span> Unfollow</button>";
        }
    }
?>