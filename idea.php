<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
session_start();
?>


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
<!--Google Fonts-->

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
		    }
		});
             }
        return false;
    })
});

</script>
</head>
<body>
<!--header start here-->
<div class="header">
	<h3 class="main-head"><?php
						require 'manageDB.php';
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
	    			<li><span class="sun"> </span><h4>86F-Tampa,FL</h4></li>
	    		</ul>
	    		<div class="settiing">
	    			<div class="menu2">
					<span class="menu-at-on"><img src="images/setter.png" alt=""> </span>	
					<ul>
						<li><a href="#">Profile</a></li>
						<li><a href="#" >Login</a></li>	
						<li><a href="#" >Log Out</a></li>							
					</ul>
					<script>
						$("span.menu-at-on").click(function(){
							$(".menu2 ul").slideToggle(500, function(){
							});
						});
					</script>
				</div>
						</div>
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
						<?php $points = getPointsForIdeaComments($idea['Idea']['id']); ?>
	    				</div>
	    			  <div class="clearfix"> </div>
	    			</div>
	    		</div>
<!--user-profile end here-->

	    	</div>
<!--header-bot-right start here-->
	    	<div class="col-md-8 header-bot-right">
<!--analytic start here-->
	    		<div class="analytic">
	    			<div class="analytic-top">
	    				<div class="infograpy"><h5>ULTIMA SETTIMANA</h5></div>
	    				<span class="share"> </span>
	    			  <div class="clearfix"> </div>
	    			</div>
	    				<div class="analttic-right">
	    					 <div class="graph-grid">
	    			<!--graph-->
								<link rel="stylesheet" href="css/graph.css">
								<script src="js/jquery.flot.min.js"></script>
					<!--//graph-->
					<script>
										$(document).ready(function () {
											
											// Graph Data ##############################################
											var graphData = [{
													data: [ [1, <?php echo $points[1] ?>], [2, <?php echo $points[2] ?>], [3, <?php echo $points[3] ?>], [4, <?php echo $points[4] ?>], [5, <?php echo $points[5] ?>], [6,<?php echo $points[6] ?>], [7, <?php echo $points[7] ?>]],
													color: '#59676B',
													points: { radius: 4, fillColor: '#59676B' }
												}
											];
										
											// Lines Graph #############################################
											$.plot($('#graph-lines'), graphData, {
												series: {
													points: {
														show: true,
														radius: 1
													},
													lines: {
														show: true
													},
													shadowSize: 0
												},
												grid: {
													color: '#59676B',
													borderColor: 'transparent',
													borderWidth: 10,
													hoverable: true
												},
												xaxis: {
													tickColor: 'transparent',
													tickDecimals: false
													
												},
												yaxis: {
													tickSize: 1000
												}
											});
										
											// Bars Graph ##############################################
											$.plot($('#graph-bars'), graphData, {
												series: {
													bars: {
														show: true,
														barWidth: .9,
														align: 'center'
													},
													shadowSize: 0
												},
												grid: {
													color: '#fff',
													borderColor: 'transparent',
													borderWidth: 20,
													hoverable: true
												},
												xaxis: {
													tickColor: 'transparent',
													tickDecimals: 2
												},
												yaxis: {
													tickSize: 1000
												}
											});
										
											// Graph Toggle ############################################
											$('#graph-bars').hide();
										
											$('#lines').on('click', function (e) {
												$('#bars').removeClass('active');
												$('#graph-bars').fadeOut();
												$(this).addClass('active');
												$('#graph-lines').fadeIn();
												e.preventDefault();
											});
										
											$('#bars').on('click', function (e) {
												$('#lines').removeClass('active');
												$('#graph-lines').fadeOut();
												$(this).addClass('active');
												$('#graph-bars').fadeIn().removeClass('hidden');
												e.preventDefault();
											});
										
											// Tooltip #################################################
											function showTooltip(x, y, contents) {
												$('<div id="tooltip">' + contents + '</div>').css({
													top: y - 16,
													left: x + 20
												}).appendTo('body').fadeIn();
											}
										
											var previousPoint = null;
										
											$('#graph-lines, #graph-bars').bind('plothover', function (event, pos, item) {
												if (item) {
													if (previousPoint != item.dataIndex) {
														previousPoint = item.dataIndex;
														$('#tooltip').remove();
														var x = item.datapoint[0],
															y = item.datapoint[1],
															z = item.datapoint[2];
															//contents = y + " " + z;
															/* modificato showTooltip(item.pageX, item.pageY, y+ x ); */ showTooltip(item.pageX, item.pageY, y);
													}
												} else {
													$('#tooltip').remove();
													previousPoint = null;
												}
											});
										
										});
										</script>
					<!-- Graph HTML -->
								<div id="graph-wrapper">
									<div class="graph-container">
										<div id="graph-lines"> </div>
										<div id="graph-bars"> </div>
									</div>
								</div>
							<!-- end Graph HTML -->
                     </div>
                    </div>
					<div class="analytic-bottom">
						<ul>
							<li><h3><?php echo getNumberOfCommentsOfLastWeekByIdIdea($idea['Idea']['id']) ?></h3><p># Nuovi commenti</p></li>
							<li><h3><?php echo getTotalScoreOfLastWeekByIdIdea($idea['Idea']['id']) ?></h3><p>+ Nuovo punteggio</p></li>
							<!--<li><h3>+800k</h3><p>New Customers</p></li> -->
						</ul>
					</div>
			 </div>
<!--banner start here-->
	    		<div class="banner">
	    			<div class="bann-left">
	    				<span class="bann-part"> </span>
	    				<div class="bann-text">
						<?php
						       $condition = hasFinancier($idea['Idea']['id']);
						       if($condition) : ?>
								<h1>L'idea &egrave; stata già finanziata!</h1>
						       <?php elseif(!$condition) : ?>
								<h1>Vuoi finanziare l'idea?</h1>
	    					                <p>Mettiti in contatto con l'ideatore!</p>
								<div class="bann-rit">
										<a href="#">FINANZIA!</a>
								</div>
								<?php endif; ?>
	    				</div>
	    			</div>
	    		  <div class="clearfix"> </div>
                          
                          
                          
                          
	    		
                </div>
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
						<p>Scrivi un tuo commento</p>
						<form class="form-horizontal" role="form" id="addCommentForm" method="post" action="">
								<div class="form-group">
										<div class="col-sm-6">
												<textarea name="body" id="text-content" class="form-control"></textarea>
										</div>
								</div>
								<div class="form-group">
										<div class="late-btn col-sm-6">
												<a href="#" class=".load_more" id="insertComment">INSERISCI COMMENTO</a>
										</div>
								</div>
						</form>
					</div> <!-- div latest-act-bot -->
				</div> <!-- div latest-activity -->
			</div> <!-- div col-md-12 header-bot-right-part-1 -->
</body>
</html>