<?php
    require 'manageDB.php';
    //echo insertCategory("category1");
    //echo insertCategory("category2");
    //print_r(getCategory("test1"));
    
    /*
    $resultArray = getCategories();
    foreach($resultArray as $row => $innerArray){
        foreach($innerArray as $innerRow => $value){
            echo $value . " ";
        }
        echo "<br>";
    }
    */
    
    //echo deleteCategory("test2");
    
    /*
    $categories = ["test3"];
    echo insertIdea("prova10", "è solo la 5 prova", "email@email.it", $categories, NULL);
    */
    //echo insertFollower("email@email.it", "15");
    //echo insertFollower("nomail@nomail.com" , "14");
    
    //print_r(getFollowersByIdIdea($idIdea = "14"));
    //print_r(getIdeasFollowed($idUser = "email@email.it"));
    
    //echo insertComment($idUser = "email@email.it", $idIdea = "14", $text = "terzo commento");

    //print_r(getComments($idUser = "email@email.it"));
    //print_r(getComments($idUser = NULL, $idIdea = "15"));
    
    //print_r(getIdeaById("14"));
    
    //echo isIdeaOfUser("email@email.it","15");
    
    //echo getUserOfIdea("14");
    
    //echo getNumberOfComments("14"); 
    
    //echo getNumberOfFollowers("15");
    
    //echo hasFinancier("14");
    
    //echo insertFinancier("15", "nomail@nomail.com");
    
    //echo hasFinancier("14");
    
    
    /* nuovi test per nuovo db */
    //echo insertCategory("category1");
    //echo insertCategory("category2");
    //$categories = ["category1"];
    //echo insertIdea($name = "social network", $description = "social network per artisti", $idUser = "lionheart.92@hotmail.it", $categories, $financier = NULL, $dateOfFinancing = NULL);
    //echo insertFinancier("62", "s.romano1992@gmail.com");
    //echo insertComment("s.romano1992@gmail.com","62", "Great idea!");
    //echo hasAlreadyFollower("email@email.it", "62");
    //echo insertFollower("email@email.it", "62");

    //echo (new \DateTime())->format('d-m-Y H:i:s');
    //require 'manageDB.php';
    //insertIdea('name1','descr','s.romano1992@gmail.com','cat');
    //$userIdeas = getUserIdeasOrderedByFollowers("s.romano1992@gmail.com");
    //print_r($userIdeas);
    /*
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
        è quasi completa. Clicca al link seguente per confermare<br>
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
    //$n = 0.77*5;
    //echo"<br>{$n}";
    
    //$categories = ["category1"];
    //echo insertIdea($name = "social network", $description = "social network per artisti", $idUser = "lionheart.92@hotmail.it", $categories, NULL, NULL, $imPath = "pathImg");
    
    //$comments = getCommentsByIdIdea("18");
    //echo count($comments);
    
    //print_r(getPointsForIdeaComments("18"));
    //echo getNumberOfCommentsOfLastWeekByIdIdea("18");
    //echo insertComment("lionheart.92@hotmail.it", "18", "bene", "6000");
    //print_r(getCategories());
    
    //print_r(getIdeas());
    //print_r(getThreeMaxFollow());
    print_r(getIdeasOrderedByFollowersByCategory("category1"));*/
    
    //require "function.php";
    //translateTest();
    
     // create curl resource 
    
    
    require "endpointSPARQL/manageEndpointSparql.php";
    
    uploadIdeaInSparqlEndpoint("19","www.idea19.com","art","idea15name");
?>