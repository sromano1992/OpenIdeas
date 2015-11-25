<?php
    session_start();
    error_reporting(0);
    require 'manageDB.php';
    $idIdea=$_POST['idIdea'];
    $idFinancier = $_SESSION['email'];
    
    $idea = getIdeaById($idIdea);
    
    $userFinancier = getUserById($idFinancier);
    $userIdea = getUserOfIdea($idIdea);
    
    $response = insertFinancier($idIdea, $idFinancier);
    
    if($response == "ok") {
        /* finanziatore */
        $mail_destinatario = "{$userFinancier['User']['email']}";
        $mail_oggetto = "Hai finanziato un'idea!";
        $title = "Hai finanziato l'idea {$idea['Idea']['nome']}";
        $body = "Complimenti! Hai finanziato l'idea {$idea['Idea']['nome']}! Mettiti in contatto con l'ideatore tramite l'email: {$userIdea['email']}";
        
        /* togliere i commenti! invia la mail! */ //sendMail($mail_destinatario, $mail_oggetto, $title, $body);
        //$text = "Complimenti! Hai finanziato la idea {$idea['Idea']['nome']}! Mettiti in contatto con l'ideatore tramite l'email: {$userIdea['email']}";
        $text = "Hai finanziato la idea {$idea['Idea']['nome']}";
        //echo $mail_destinatario. " " . $idIdea . " " . $text . "<br>";
        insertNotice($mail_destinatario, $idIdea, $text, "Financier",0);
        
        
        /* ideatore */
        $mail_destinatario = "{$userIdea['email']}";
        $mail_oggetto = "Hai ottenuto un finanziamento per una tua idea!";
        $title = "Hai ottenuto un finanziamento per l'idea {$idea['Idea']['nome']}";
        $body = "Complimenti! Hai ottenuto un finanziamento per l'idea {$idea['Idea']['nome']}! Mettiti in contatto con il finanziatore tramite l'email: {$userFinancier['User']['email']}";
        /* togliere i commenti! invia la mail! */ //sendMail($mail_destinatario, $mail_oggetto, $title, $body);
        
        $text = "Complimenti! Hai ottenuto un finanziamento per la idea {$idea['Idea']['nome']}! Mettiti in contatto con il finanziatore tramite email: {$userFinancier['User']['email']}";
        insertNotice($mail_destinatario, $idIdea, $text, "Financier");
                
        
        /* followers */
        $followers = getFollowersByIdIdea($idIdea);
        foreach($followers as $follower) {
            if($follower['idUser'] != $idFinancier) {
                $mail_destinatario = "{$follower['idUser']}";
                $mail_oggetto = "Un'idea che stai seguendo ha ottenuto un finanziamento!";
                $title = "L'idea {$idea['Idea']['nome']} ha ottenuto un finanziamento!";
                $body = "L'idea {$idea['Idea']['nome']} ha ottenuto un finanziamento!";
                $text = "La idea {$idea['Idea']['nome']} che stai seguendo ha un finanziatore!";
                insertNotice($mail_destinatario, $idIdea, $text, "Financier");
                /* togliere i commenti! invia la mail! */ //sendMail($mail_destinatario, $mail_oggetto, $title, $body);
            }
        }
        
        echo "Hai finanziato l'idea con successo!";
        
    }
    else
        echo "Ci sono problemi nel database. Ci scusiamo per il disagio";
?>