<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE HTML>
<html>
<head>
<title>Idea</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<meta name="keywords" content="Storage ui kit Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
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
<script src="js/script.js"></script>
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
$(document).ready(function(){
    $('body').on('click', '#financeIt', function()  {
	    var idIdea = <?php echo $_GET['id'] ?>;
            var dataString = 'idIdea=' + idIdea;
            $.ajax({
		    type: "POST",
		    url: "./financeIdea.php",
		    data: dataString,
		    cache: true,
		    success: function(html){
			if (html.indexOf("successo") > -1) {
				$('#divFinance').html();
				$('#divFinance').html("<h1>L'idea &egrave; stata già finanziata!</h1>");
			}
			alert(html);
		    }
		});
        return false;
    })
});

</script>
<script type="text/javascript">
$(document).ready(function(){
    $('body').on('click', '#followIt', function()  {
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
    })
});
</script>
<script type="text/javascript">
$(document).ready(function(){
    $('body').on('click', '#notFollowIt', function()  {
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
    })
});
</script>


<script type="text/javascript">
$(document).ready(function(){
    $('body').on('click', '#insertComment', function()  {
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
    })
});

</script>

<script type="text/javascript" src="js/canvasjs.min.js"></script>
</head>
<body>

	<?php
	    error_reporting(0);
	    include("navbar.php");
	?>
		
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
<!--header start here-->
<div class="header">
	<h3 class="main-head"><?php
						$idea = getIdeaById($_GET['id']);
						$name = $idea['Idea']['nome'];
						echo $name;
				?></h3>
	    <div class="head-strip">
	    	<div class="head-strip-left">
		        <?php $imPath = $idea['Idea']['imPath'];?>
	    		<span class="joe"><img src="<?php echo $imPath ?>" alt=""> </span>
	    		<div class="joe-text">
	    			<h2><?php
						echo $name;
				?></h2>
	    			<p>
				<?php
						$description = $idea['Idea']['description'];
						echo $description;
				?>
				</p>
	    		</div>
	    	</div>
	    	<div class="head-strip-right">
	    		<ul class="strip-date">
	    			<li><span class="cal"> </span><h4>
				<?php
						$date = $idea['Idea']['dateOfInsert'];
						$newDate = date("d-m-Y", strtotime($date));
						echo $newDate;
				?>
						
				</h4></li>
	    			<li><span class="clock"> </span><h4>
				<?php
						echo $time = date("H:i:s",strtotime($date));
				?>
				</h4></li>
				<?php $categories = getCategoriesOfIdea($_GET['id']); ?>
	    			<li><span class="sun"></span><h4><?php echo implode($categories, " ") ?></h4></li>
	    		</ul>
			<?php if(!isIdeaOfUser($_SESSION['email'],$_GET['id'])) { ?>
				<div class="settiing">
						<div class="menu2">
							<span class="menu-at-on"><img src="images/setter.png" alt=""> </span>	
							<ul id="listFollow">
								<?php $hasAlreadyFollower = hasAlreadyFollower($_SESSION['email'],$_GET['id']);
								if(!$hasAlreadyFollower)
								      echo "<li><a href='#' id='followIt'>Segui</a></li>";
								else
								      echo "<li><a href='#' id='notFollowIt'>Non seguire più</a></li>"; ?>		
							</ul>
							<script>
								$("span.menu-at-on").click(function(){
									$(".menu2 ul").slideToggle(500, function(){
									});
								});
							</script>
						</div>
				</div>
				<?php } ?>
	    		</div>
	    		  <div class="clearfix"> </div>
	    	</div>
	    
<!--header bottom start here-->
	    <div class="header-bottom">
	    	<div class="col-md-4 header-bot-left">
<!--user-profile start here-->
	    		<div class="user-profile">
	    			<div class="user-prof-top">
	    				<span class="cros"> </span>
					<?php $userImgPath = getUserOfIdea($idea['Idea']['id'])['imPath'];?>
	    				<div class="col-md-5 user-prof-img">
	    				    <img src="<?php echo $userImgPath;?>" alt="">
	    				</div>
	    				<div class="col-md-8 user-prof-text">
	    					<h3><?php echo ($idea['User']['name'] . " " . $idea['User']['surname']); ?></h3>
	    				    <!--<p>Puerto Cortes,Honduras</p>-->
	    				</div>
	    			  <div class="clearfix"> </div>
	    			</div>
	    			<div class="user-polio-bot">
	    				<div class="col-md-4 user-prof-numb like-wt">
	    					<span class="like-heart"> </span>
						<!-- numero di follower dell'idea -->
	    					<h6><?php echo getNumberOfFollowers($idea['Idea']['id']);?></h6>
	    				</div>
	    				<div class="col-md-4 user-prof-numb fdback">
	    					<span class="feedback"> </span>
						<!-- numero di idee inserite dall'utente -->
	    					<h6><?php echo getNumberOfUserIdeas($idea['Idea']['idUser']);?></h6>
	    				</div>
	    				<div class="col-md-4 user-prof-numb comment">
	    					<span class="comment-mess"> </span>
						<!-- numero di commenti all'idea -->
	    					<h6><?php echo getNumberOfComments($idea['Idea']['id']);?></h6>
	    				</div>
	    			  <div class="clearfix"> </div>
	    			</div>
	    		</div>
<!--user-profile end here-->
	    	</div>
<!--header-bot-right start here-->
	    	<div class="col-md-8 header-bot-right">
<!--analytic start here-->
		<div id="chartContainer" style="height: 300px; width: 100%;">
		</div>
<!--banner start here-->
	    		
					<?php if(!isIdeaOfUser($_SESSION['email'], $_GET['id'])) {
						echo "<div class='banner'><div class='bann-left'><span class='bann-part'></span>";
						echo "<div class='bann-text' id='divFinance'>";
						$hasFinancier = hasFinancier($idea['Idea']['id']);
						if($hasFinancier) {
								echo "<h1>L'idea &egrave; stata gi&agrave; finanziata!</h1></div>";
						}
						else {
								if(!isIdeaOfUser($_SESSION['email'], $_GET['id'])) {
										echo "<h1>Vuoi finanziare l'idea?</h1>";
										echo "<p>Mettiti in contatto con l'ideatore!</p>";
										echo "<div class='bann-rit'>";
										echo "<a href='#' id='financeIt'>FINANZIA!</a>'</div></div>";
								}
						}
						echo "</div><div class='clearfix'></div></div>";
				          }?>
				
                        <div class="col-md-12 header-bot-right-part-1">
	    			<div class="latest-activity">
	    				<div class="latest-act-top">
	    					<h4>COMMENTI</h4>
	    					<span class="rocket"> </span>
	    				  <div class="clearfix"> </div>
	    				</div>
	    				<div class="latest-act-bot">
	    					<ul>
	    						<li><span class="box"> </span></li>
	    						<li><span class="line"> </span></li>
	    						<li><span class="box"> </span></li>
	    						<li><span class="line"> </span></li>
	    						<li><span class="box"> </span></li>
	    						<li><span class="line"> </span></li>
	    						<li><span class="box"> </span></li>
	    						<li><span class="line"> </span></li>
	    						<li><span class="box"> </span></li>
	    						<li><span class="line"> </span></li>
	    					</ul>
						<div class='latest-today' id='divComments'>
						<?php
								$comments = getCommentsByIdIdea($idea['Idea']['id']);
								if(!empty($comments)) {
										foreach ($comments as $comment) {
												echo "<h4>";
												echo $comment['date'];
												echo "</h4><p>";
												echo $comment['text'];
												$user = getUserById($comment['idUser']);
												$nameSurname = $user['User']['name'] . " " . $user['User']['surname'];
												echo "&nbsp;[<span class='todt-joe'>$nameSurname</span>]</p><hr>";
										}
								}
						?>
						</div> <!-- chiudo div latest-today -->
						<?php if(!isIdeaOfUser($_SESSION['email'], $_GET['id'])) {
								echo "<p>Scrivi un tuo commento</p>";
								echo "<form class='form-horizontal' role='form' id='addCommentForm' method='post' action=''>";
								echo "<div class='form-group'>";
								echo "<div class='col-sm-6'>";
								echo "<textarea name='body' id='text-content' class='form-control'></textarea>";
								echo "</div></div>";
								echo "<div class='form-group'>";
								echo "<div class='late-btn col-sm-6'>";
								echo "<a href='#' class='.load_more' id='insertComment'>INSERISCI COMMENTO</a>";
								echo "</div></div></form>";
						} ?>
					</div> <!-- div latest-act-bot -->
				</div> <!-- div latest-activity -->
			</div> <!-- div col-md-12 header-bot-right-part-1 -->
			<div class="col-md-12 header-bot-right-part-1">
	    			<div class="latest-activity">
	    				<div class="latest-act-top">
	    					<h4>Ultima settimana</h4>
	    					<span class="rocket"> </span>
	    				  <div class="clearfix"> </div>
	    				</div>
	    				<div class="latest-act-bot">
						<div class='latest-today' id='divLastWeek'>
						<?php
								$totalPoints = getPointsForIdeaComments($idea['Idea']['id'], "score_pos");
								$avgPoints = $totalPoints / 7;
								
								echo "<h4>";
								echo "Media punteggi positivi ultima settimana";
								echo "</h4><p>";
								echo "&nbsp;<span class='todt-joe'>$avgPoints</span></p><hr>";
								
								
								echo "<h4>";
								echo "Totale punteggi positivi ultima settimana";
								echo "</h4><p>";
								echo "&nbsp;<span class='todt-joe'>$totalPoints</span></p><hr>";
								
								$totalComments = getNumberOfCommentsOfLastWeekByIdIdea($idea['Idea']['id']);
								echo "<h4>";
								echo "Totale commenti ultima settimana";
								echo "</h4><p>";
								echo "&nbsp;<span class='todt-joe'>$totalComments</span></p><hr>";
								
								
						?>
						</div> <!-- chiudo div latest-today -->
					</div> <!-- div latest-act-bot -->
				</div> <!-- div latest-activity -->
			</div> <!-- div col-md-12 header-bot-right-part-1 -->
</body>
</html>