<?php
    use Stichoza\GoogleTranslate\TranslateClient;
    
    session_start();
    require 'manageDB.php';
    $content=$_POST['content'];
    $idIdea=$_POST['idIdea'];
    $idUser = $_SESSION['email'];
    $scores = getScore($content);
    insertComment($idUser, $idIdea, $content, $scores);
    $comments = getCommentsByIdIdea($idIdea);
    
    foreach ($comments as $comment) {
        echo "<h4>";
        echo $comment['date'];
        echo "</h4><p>";
        echo $comment['text'];
        $user = getUserById($idUser);
        $nameSurname = $user['User']['name'] . " " . $user['User']['surname'];
        echo "&nbsp;[<span class='todt-joe'>$nameSurname</span>]</p><hr>";
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
    
    function getScore($comment){
        require __DIR__ . '/vendor/autoload.php';
        require_once __DIR__ . '/libs/sentimentAnalysis/autoload.php';
        
        //Translate first
	$tr = new TranslateClient(); // Default is from 'auto' to 'en'
	//$tr->setSource('it');
	//$tr->setTarget('en');
	$comment = $tr->translate($comment);
        
        //Calculate sentiment
	$sentiment = new \PHPInsight\Sentiment();
        // calculations:
        $scores = $sentiment->score($comment);
        $class = $sentiment->categorise($comment);

        $toReturn['dom'] = $class;
        $toReturn['pos'] = $scores['pos'];
        $toReturn['neg'] = $scores['neg'];
        $toReturn['neu'] = $scores['neu'];
        return $toReturn;
    }
?>