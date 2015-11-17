<?php
    session_start();
    require 'manageDB.php';
    $idIdea=$_POST['idIdea'];
    $idFinancier = $_SESSION['email'];
    
    $idea = getIdeaById($idIdea);
    
    $userFinancier = getUserById($idFinancier);
    $userIdea = getUserOfIdea($idIdea);
    
    $response = insertFinancier($idIdea, $idFinancier);
    
    if($response == "ok") {
        $mail_destinatario = "{$userFinancier['User']['email']}";
        $mail_oggetto = "Hai finanziato un'idea!";
        $title = "Hai finanziato l'idea {$idea['Idea']['nome']}";
        $body = "Complimenti! Hai finanziato l'idea {$idea['Idea']['nome']}! Mettiti in contatto con l'ideatore tramite l'email: {$userIdea['email']}";
        
        sendMail($mail_destinatario, $mail_oggetto, $title, $body);
        
        $mail_destinatario = "{$userIdea['email']}";
        $mail_oggetto = "Hai ottenuto un finanziamento per una tua idea!";
        $title = "Hai ottenuto un finanziamento per l'idea {$idea['Idea']['nome']}";
        $body = "Complimenti! Hai ottenuto un finanziamento per l'idea {$idea['Idea']['nome']}! Mettiti in contatto con il finanziatore tramite l'email: {$userFinancier['User']['email']}";
        sendMail($mail_destinatario, $mail_oggetto, $title, $body);
        
        $followers = getFollowersByIdIdea($idIdea);
        foreach($followers as $follower) {
            if($follower['idUser'] != $idFinancier) {
                $mail_destinatario = "{$follower['idUser']}";
                $mail_oggetto = "Un'idea che stai seguendo ha ottenuto un finanziamento!";
                $title = "L'idea {$idea['Idea']['nome']} ha ottenuto un finanziamento!";
                $body = "L'idea {$idea['Idea']['nome']} ha ottenuto un finanziamento!";
                sendMail($mail_destinatario, $mail_oggetto, $title, $body);
            }
        }
    }
    else
        echo "Ci sono problemi nel database. Ci scusiamo per il disagio";
?>