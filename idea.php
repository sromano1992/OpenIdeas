<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="js/jquery-1.11.0.min.js"></script>
    <title>OpenIdeas - Idea</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    
    <!-- TIMELINE-->
    <link rel="stylesheet" type="text/css" media="all" href="css/stylesTimeline.css">

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){     
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                });
            });
    </script>
<!-- //end-smoth-scrolling -->
<link href="css/jquery.countdown.css" rel="stylesheet" type="text/css" media="all" />
<script src="js/jquery.countdown.js"></script>
<!--<script src="js/script.js"></script>
<!--responsive tab script here-->
<script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $('#horizontalTab').easyResponsiveTabs({
                        type: 'default', //Types: default, vertical, accordion           
                        width: 'auto', //auto or any width like 600px
                        fit: true   // 100% fit in a container
                    });
                });
               </script>
<!--//resposive tab-->
<script>$(document).ready(function(c) {
    $('.cros').on('click', function(c){
        $('.user-profile').fadeOut('slow', function(c){
            $('.user-profile').remove();
        });
    });   
});
</script>
<script type="text/javascript">
function financeIt() {
        var idIdea = <?php echo $_GET['id'] ?>;
            var dataString = 'idIdea=' + idIdea;
            $.ajax({
            type: "POST",
            url: "./financeIdea.php",
            data: dataString,
            cache: true,
            success: function(html){
                    alert(html);
            if (html.indexOf("successo") > -1) {
                $('#divFinance').html();
                var html = "<div class='alert alert-danger' role='alert'>";
                html = html + "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>";
                html = html + "<span class='sr-only'>Attenzione:</span>";
                html = html + "L'idea &egrave; stata già finanziata!</div>";
                $('#divFinance').html(html);
            }
            }
        });
        return false;
}

</script>
<script type="text/javascript">
    function followIt(){
        var idIdea = <?php echo $_GET['id'] ?>;
            var dataString = 'idIdea=' + idIdea + '&idButton=followIt';
            $.ajax({
            type: "POST",
            url: "./followIt.php",
            data: dataString,
            cache: true,
            success: function(html){
            $('#listFollow').html();
            $('#listFollow').html(html);
            }
        });
        return false;
    }
</script>
<script type="text/javascript">
    function notFollowIt(){
        var idIdea = <?php echo $_GET['id'] ?>;
            var dataString = 'idIdea=' + idIdea + '&idButton=notFollowIt';
            $.ajax({
            type: "POST",
            url: "./notFollowIt.php",
            data: dataString,
            cache: true,
            success: function(html){
            $('#listFollow').html();
            $('#listFollow').html(html);
            }
        });
        return false;
    }
</script>


<script type="text/javascript">
function insertComment(){
    console.log("here");
    var textcontent = $('#text-content').val();
    var idIdea = <?php echo $_GET['id'] ?>;
        var dataString = 'content=' + textcontent + '&idIdea=' + idIdea;
        if (textcontent == '') {
    alert("Non hai scritto nulla!");
    $("#text-content").focus();
        }
        else {
    $.ajax({
        type: "POST",
        url: "./insertComment.php",
        data: dataString,
        cache: true,
        success: function(html){
            $('#divComments').html();
            $('#divComments').html(html);
            document.getElementById('text-content').value='';
        loadChart();
        console.log("loaded");
        }
    });
         }
    return false;
}

$(document).ready(function(){
    $('body').on('click', '#insertComment', function()  {
            console.log("insert..");
            var textcontent = $('#text-content').val();
        var idIdea = <?php echo $_GET['id'] ?>;
            var dataString = 'content=' + textcontent + '&idIdea=' + idIdea;
            alert("" + dataString);
            if (textcontent == '') {
        alert("Non hai scritto nulla!");
        $("#text-content").focus();
            }
            else {
        $.ajax({
            type: "POST",
            url: "./insertComment.php",
            data: dataString,
            cache: true,
            success: function(html){
                alert("success");
                $('#divComments').html();
                $('#divComments').html(html);
                document.getElementById('text-content').value='';
            loadChart();
            console.log("loaded");
            }
        });
             }
        return false;
    })
});

</script>
<script src="js/jquery-1.11.0.min.js"></script>

<script type="text/javascript" src="js/canvasjs.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
 <div class="brand">OpenIdeas</div>
    <div class="address-bar">Insert your idea HERE!</div>
    <?php 
     error_reporting(0);
    include("navbar.php");?>
     <?php
        require 'manageDB.php';
        $score = getIdeaScores($_GET['id']);
    ?>
<script type="text/javascript">
  function loadChart() {
    console.log("refresh chart");
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Punteggi della tua idea"    
      },
      animationEnabled: true,
      axisY: {
        title: "Totali"
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      theme: "theme2",
      data: [
      {        
        type: "column",  
        showInLegend: true, 
        legendMarkerColor: "grey",
        legendText: "Andamento",
        dataPoints: [
        {y: <?php echo "{$score['neg']}";?>, label: "Negativi"},
        {y: <?php echo "{$score['neu']}";?>,  label: "Neutri"},        
        {y: <?php echo "{$score['pos']}";?>,  label: "Positivi"}     
        ]
      }   
      ]
    });

    chart.render();
  }
  window.onload = loadChart;
  </script>
    <div class="container">

        <div class="row">
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center"><strong><?php
                        $idea = getIdeaById($_GET['id']);
                        $name = $idea['Idea']['nome'];
                        echo $name;
                        ?></strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-lg-6 text-center">
                    <?php $imPath = $idea['Idea']['imPath'];?>
                    <img class="img-responsive img-border img-full" src="<?php echo $imPath ?>" alt="">
                </div>
                <div class="col-lg-6 text-center">
                    <h2><?php
                        echo $name;
                        ?>
                    </h2>
                        <br>
                        <strong><span class=" glyphicon glyphicon-calendar"></span>
                            <?php
                        $date = $idea['Idea']['dateOfInsert'];
                        $newDate = date("d-m-Y", strtotime($date));
                        echo $newDate;
                        ?>
                        </strong><nbps>
                        <strong><span class=" glyphicon glyphicon-time"></span>
                        <?php
                        echo $time = date("H:i:s",strtotime($date));
                        ?>
                        <strong>
                        <p>
                         <?php
                        $description = $idea['Idea']['description'];
                        echo $description;
                        ?>
                        </p>

                       <?php if(!isIdeaOfUser($_SESSION['email'],$_GET['id'])) { ?>
                           
                                <div id="listFollow">
                                <?php $hasAlreadyFollower = hasAlreadyFollower($_SESSION['email'],$_GET['id']);
                                if(!$hasAlreadyFollower)
                                      echo "<button type='button' onClick='followIt();' id='followIt' class='btn btn-default btn-lg' style='background: green'><span class='glyphicon glyphicon-ok' aria-hidden='true'></span> Follow</button>";
                                else
                                      echo "<button type='button' onClick='notFollowIt();' id='notFollowIt' class='btn btn-default btn-lg' style='background: red'><span class='glyphicon glyphicon-remove' aria-hidden='true' ></span> Unfollow</button>"; ?>      
                            

                        </div>
                
                <?php } ?>
                    
                </div>
            </div>
        </div><!--row1-->

        <div class="row">
            <div class="box" >
                <div class="col-lg-4 text-center">
                    <hr>
                    <h2 class="intro-text text-center"><strong>User</strong>
                    </h2>
                    <hr>
                    <?php $userImgPath = getUserOfIdea($idea['Idea']['id'])['imPath'];?>
                     <img src="<?php echo $userImgPath;?>" alt="" class="img-circle" style="height:90px; weight:100px;">
                     <h3><?php echo ($idea['User']['name'] . " " . $idea['User']['surname']); ?></h3>

                     <div class="btn-group btn-group-justified" role="group" aria-label="...">
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" style="background-color: #43CBC7; font-weight: 900; color:white"><span class="glyphicon glyphicon-heart"></span><br><?php echo getNumberOfFollowers($idea['Idea']['id']);?></button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" style="background-color:  #FF6600; font-weight: 900; color:white"><span class="glyphicon glyphicon-flag"></span><br><?php echo getNumberOfUserIdeas($idea['Idea']['idUser']);?></button>
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-default" style="background-color: #59238C; font-weight: 900; color:white"><span class="glyphicon glyphicon-comment"></span><br><?php echo getNumberOfComments($idea['Idea']['id']);?></button>
                        </div>
                    </div>
                    
                </div>
                <div class="col-lg-8 text-center">
                    <div id="chartContainer" style="height: 300px; width: 100%;">
                    </div>
                </div>
                </div>

                <div class="bann-text text-center" id="divFinance">
                        <?php
                               $hasFinancier = hasFinancier($idea['Idea']['id']);
                               if($hasFinancier) : ?>
                                <div class='alert alert-danger' role='alert'>
                                <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                <span class='sr-only'>Attenzione:</span>
                                L'idea &egrave; stata già finanziata!
                                </div>
                               <?php elseif(!$hasFinancier) :
                                if(isIdeaOfUser($_SESSION['email'], $_GET['id'])) {?>
                                    <div class='alert alert-danger' role='alert'>
                                        <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                                        <span class='sr-only'>Attenzione:</span>
                                        Non puoi finanziare una tua idea
                                    </div>
                                <?php } else { ?> 
                                <div class='alert alert-success' role='alert'>
                                        <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                                        <span class='sr-only'>Ok:</span>
                                        Vuoi finanziare l'idea?<br>Mettiti in contatto con l'ideatore!
                                        <div class="bann-rit">
                                                <a href="#"  onClick="financeIt();" id="financeIt"><img src="img/finanzia.png" style="height:90px; weight:100px;"></a>
                                        </div>
                                </div>
                                <?php } endif; ?>
                </div>

        </div><!--row -->
         
        <div class="row">
            <div class="col-lg-10 col-md-offset-1" id='divComments'>
                <ul class="timeline">
                <?php
                                $flag=0;
                                $comments = getCommentsByIdIdea($idea['Idea']['id']);

                                if(!empty($comments)) {
                                        foreach ($comments as $comment) {
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
                                        }
                                }
                        ?>
            <li class="timeline">
                <div class='timeline-panel'>
                    <div class='tl-heading'>   
                        <hr>
                            <h2 class="intro-text text-center"><strong>Commenta</strong>
                            </h2>
                        <hr>
                    </div>
                    <div class='tl-body'>
                        <form class="form-horizontal" role="form" id="addCommentForm" method="post" action="">
                            <div class="form-group">
                                <div class="col-lg-9">
                                    <textarea name="body" id="text-content" class="form-control" rows="7"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-9">
                                    <a class=".load_more" onclick="insertComment()">INSERISCI COMMENTO</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </li>
            </ul>
        </div>
        </div>
        

        <div class="box">
           <div class="col-lg-12 text-center">
                <hr><h2 class="intro-text text-center"><strong>Ultima settimana</strong></h2><hr>
                <div class="col-lg-12 text-center" id='divLastWeek'>
                        <?php
                                $totalPoints = getPointsForIdeaComments($idea['Idea']['id'], "score_pos");
                                $avgPoints = $totalPoints / 7;
                                
                                echo "<div class='col-lg-4 text-center'<h4>";
                                echo "Media punteggi positivi ultima settimana";
                                echo "</h4><p>";
                                echo "&nbsp;<span class='badge'>$avgPoints</span></p></div>";
                                
                                
                                echo "<div class='col-lg-4 text-center'<h4>";
                                echo "Totale punteggi positivi ultima settimana";
                                echo "</h4><p>";
                                echo "&nbsp;<span class='badge'>$totalPoints</span></p></div>";
                                
                                $totalComments = getNumberOfCommentsOfLastWeekByIdIdea($idea['Idea']['id']);
                                echo "<div class='col-lg-4 text-center'<h4>";
                                echo "Totale commenti ultima settimana";
                                echo "</h4><p>";
                                echo "&nbsp;<span class='badge'>$totalComments</span></p></div>";
                                
                                
                        ?>
                </div> <!-- chiudo div latest-today -->
            </div>
        </div>

    </div><!--row-->      
</div><!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; OpenIdeas 2015</p>
                </div>
            </div>
        </div>
    </footer>

</body>

</html>
