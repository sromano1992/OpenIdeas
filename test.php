<?php
    echo (new \DateTime())->format('d-m-Y H:i:s');
    require 'manageDB.php';
    //insertIdea('name1','descr','s.romano1992@gmail.com','cat');
    //$userIdeas = getUserIdeasOrderedByFollowers("s.romano1992@gmail.com");
    //print_r($userIdeas);
    $n = 0.77*5;
    echo"<br>{$n}<br>";
    
    
 
        
    // definisco mittente e destinatario della mail
    $nome_mittente = "OpenIdeas";
    $mail_destinatario = "pianobarsimone@hotmail.it";
    $mail_mittente = "test";

    // definisco il subject
    $mail_oggetto = "Registrazione";
    
    // definisco il messaggio formattato in HTML
    $mail_corpo = <<<HTML
    <html>
    <head>
      <title>Una semplice mail con PHP formattata in HTML</title>
    </head>
    <body>
    La tua registrazione al portale <a href='http://localhost/WebSemantico/OpenIdeas/index.php'>OpenIdeas</a>
        � quasi completa. Clicca al link seguente per confermare<br>
        here
    </body>
    </html>
HTML;

    // aggiusto un po' le intestazioni della mail
    // E' in questa sezione che deve essere definito il mittente (From)
    // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
    $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
    $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
    $mail_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";

    // Aggiungo alle intestazioni della mail la definizione di MIME-Version,
    // Content-type e charset (necessarie per i contenuti in HTML)
    $mail_headers .= "MIME-Version: 1.0\r\n";
    $mail_headers .= "Content-type: text/html; charset=iso-8859-1";
    
    if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers))
      echo "Messaggio inviato con successo a " . $mail_destinatario;
    else
      echo "Errore. Nessun messaggio inviato.";
?>