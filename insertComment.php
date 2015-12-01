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
    $idea = getIdeaById($idIdea);
    $user_comment = getUserById($idUser);
    $flag=0;
    
    /*foreach ($comments as $comment) {
                                            if($flag%2==0){
                                                echo "<li><div class='tldate'>";
                                                echo $comment['date'];
                                                echo "</div></li><li><div class='timeline-panel'><div class='tl-heading'><p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>";
                                                echo $comment['date'];
                                                echo "</small></p></div><div class='tl-body'><p>";
                                                echo $comment['text'];
                                                $user = getUserById($comment['idUser']);
                                                $nameSurname = $user['User']['name'] . " " . $user['User']['surname'];
                                                echo "&nbsp;[$nameSurname]</p></div></div></li>";
                                            }
                                            else{
                                                echo "<li><div class='tldate'>";
                                                echo $comment['date'];
                                                echo "</div></li><li class='timeline-inverted'><div class='timeline-panel'><div class='tl-heading'><p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>";
                                                echo $comment['date'];
                                                echo "</small></p></div><div class='tl-body'><p>";
                                                echo $comment['text'];
                                                $user = getUserById($comment['idUser']);
                                                $nameSurname = $user['User']['name'] . " " . $user['User']['surname'];
                                                echo "&nbsp;[$nameSurname]</p></div></div></li>";
                                            }
                                            $flag=$flag+1;
                                        }*/

    $nameSurname = $user_comment['User']['name'] . " " . $user_comment['User']['surname'];
    echo $nameSurname;
    $followers = getFollowersByIdIdea($idIdea);
    $alreadySent = array();
    
    foreach($followers as $follower) {
        if($follower['idUser'] != $idUser) {
            $mail_destinatario = "{$follower['idUser']}";
            $mail_oggetto = "C'è un nuovo commento ad un'idea che stai seguendo!";
            $title = "L'idea {$idea['Idea']['nome']} ha un nuovo commento!";
            $nameSurname = $user_comment['User']['name'] . " " . $user_comment['User']['surname'];
            $body = "L'idea {$idea['Idea']['nome']} ha un nuovo commento: [{$nameSurname}]: {$content}";
            
            $alreadySent[] = $follower['idUser'];
            $text_idea = $idea['Idea']['nome'];
            $text = "La idea".$text_idea." che stai seguendo ha un nuovo commento:[".$nameSurname."]: ".$content;
             /* togliere i commenti! invia la mail! */ //sendMail($mail_destinatario, $mail_oggetto, $title, $body);
            insertNotice($follower['idUser'], $idIdea, $text, "Comment");
        }
    }
    
    $writers = getWritersOfIdea($idIdea);
    foreach($writers as $writer) {
        if($writer != $idUser) {
            if(!in_array($writer, $alreadySent)) {
                $text_idea = $idea['Idea']['nome'];
                $text = "La idea".$text_idea." che hai commentato ha un nuovo commento:[".$nameSurname."]: ".$content;
                insertNotice($writer, $idIdea, $text, "Comment");
            }
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