<?php
    require "manageDB.php";
    error_reporting(0);
    $result = insertUser($_POST['email'],$_POST['password'],$_POST['name'],$_POST['surname'],$_POST['picture'],$_POST['birthday'],$_POST['webPage']);

    if ($result == -2){  //user already in but not confirmed
        echo"La tua email e' gia' registrata ma non hai confermato. Controlla la tua casella email per confermare la registrazione.";
    }
    if ($result == -1){ //user already in db 
        echo "La tua email e' gia' registrata. Se hai dimenticato la password procedi con il recupero.";
    }
?>