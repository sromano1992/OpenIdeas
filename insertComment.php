<?php
    session_start();
    require 'manageDB.php';
    $content=$_POST['content'];
    $idIdea=$_POST['idIdea'];
    $idUser = $_SESSION['email'];
    insertComment($idUser, $idIdea, $content);
    $comments = getCommentsByIdIdea($idIdea);
    $idea = getIdeaById($idIdea);
    $user_comment = getUserById($idUser);
    
    foreach ($comments as $comment) {
        echo "<h4>";
        echo $comment['date'];
        echo "</h4><p>";
        echo $comment['text'];
        $user = getUserById($idUser);
        $nameSurname = $user['User']['name'] . " " . $user['User']['surname'];
        echo "&nbsp;[<span class='todt-joe'>$nameSurname</span>]</p><hr>";
    }
    
    
    $followers = getFollowersByIdIdea($idIdea);
    foreach($followers as $follower) {
        if($follower['idUtente'] != $idUser) {
            $mail_destinatario = "{$follower['idUser']}";
            $mail_oggetto = "C'è un nuovo commento ad un'idea che stai seguendo!";
            $title = "L'idea {$idea['Idea']['nome']} ha un nuovo commento!";
            $nameSurname = $user_comment['User']['name'] . " " . $user_comment['User']['surname'];
            $body = "L'idea {$idea['Idea']['nome']} ha un nuovo commento: [{$nameSurname}]: {$content}";
            sendMail($mail_destinatario, $mail_oggetto, $title, $body);
        }
    }

    /* <p>Scrivi un tuo commento</p>";
    echo "<form class='form-horizontal' role='form' id='addCommentForm' method='post' action=''>";
    echo "<div class='form-group'>";
    echo "<div class='col-sm-6'>";
    echo "<textarea name='body' id='text-content' class='form-control'></textarea></div></div>";
    echo "<div class='form-group'>";
    echo "<div class='late-btn col-sm-6'>";
    echo "<a href='#' class='.load_more' id='insertComment'>INSERISCI COMMENTO</a>";
    echo "</div></div></form>"; */
?>