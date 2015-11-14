<?php
    require "manageDB.php";
    $email = $_POST['email'];
     // definisco mittente e destinatario della mail
    $nome_mittente = "OpenIdeas";
    $mail_mittente = "";
    $mail_destinatario = "{$email}";

    // definisco il subject
    $mail_oggetto = "Recupero password";
    $newPassword = randomPassword();
    updatePassword($email, $newPassword);
    
    // definisco il messaggio formattato in HTML
    $mail_corpo = <<<HTML
    <html>
    <head>
      <title>Recupero password portale OpenIdeas</title>
    </head>
    <body>
        La tua password è stata reimpostata a: {$newPassword}
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
      echo "E' stata generata una nuova password ed e' stata inviata all'indirizzo " . $mail_destinatario;
    else
      echo "Errore. Nessun messaggio inviato.";
      
    function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }
?>