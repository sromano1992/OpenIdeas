<?php
    require 'manageDB.php';
    $content=$_POST['content'];
    $idIdea=$_POST['idIdea'];
    insertComment("email@email.it", $idIdea, $content);
    $comments = getCommentsByIdIdea($idIdea);
    
    foreach ($comments as $comment) {
        echo "<div class='latest-today' id='divComments'><h4>";
        echo $comment['date'];
        echo "</h4><p>";
        echo $comment['text'];
        $user = getUserById($comment['idUser']);
        $nameSurname = $user['User']['name'] . " " . $user['User']['surname'];
        echo "&nbsp;[<span class='todt-joe'>$nameSurname</span>]</p><hr>";
    }
    echo "<p>Add a Comment</p>";
    echo "<form class='form-horizontal' role='form' id='addCommentForm' method='post' action=''>";
    echo "<div class='form-group'>";
    echo "<div class='col-sm-6'>";
    echo "<textarea name='body' id='text-content' class='form-control'></textarea></div></div>";
    echo "<div class='form-group'>";
    echo "<div class='late-btn col-sm-6'>";
    echo "<a href='#' class='.load_more' id='insertComment'>INSERISCI COMMENTO</a></div></div></form>";
?>