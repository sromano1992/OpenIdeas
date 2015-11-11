<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title> Storage ui kit Flat bootstrap Responsive  Website Template | Home :: w3layouts</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.0.min.js"></script>
<!-- Custom Theme files -->
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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


</head>
<body>
<!--header start here-->
<div class="header">
	<h3 class="main-head">Storage Ui Kit</h3>
	    <div class="head-strip">
	    	<div class="head-strip-left">
	    		<span class="joe"><img src="images/1.png" alt=""> </span>
	    		<div class="joe-text">
	    			<h2>Welcome back Joe Black</h2>
	    			<p>Es bueno volver a verte de nuevo por acá!</p>
	    		</div>
	    	</div>
	    	<div class="head-strip-right">
	    		<ul class="strip-date">
	    			<li><span class="cal"> </span><h4>Monday.July 02</h4></li>
	    			<li><span class="clock"> </span><h4>10.30a.m</h4></li>
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
	    				<div class="col-md-5 user-prof-img">
	    				    <img src="images/2.png" alt="">
	    				</div>
	    				<div class="col-md-8 user-prof-text">
	    					<h3>Mr.Joe Black</h3>
	    				    <p>Puerto Cortes,Honduras</p>
	    				</div>
	    			  <div class="clearfix"> </div>
	    			</div>
	    			<div class="user-polio-bot">
	    				<div class="col-md-4 user-prof-numb like-wt">
	    					<span class="like-heart"> </span>
	    					<h6>25,498</h6>
	    				</div>
	    				<div class="col-md-4 user-prof-numb fdback">
	    					<span class="feedback"> </span>
	    					<h6>145,369</h6>
	    				</div>
	    				<div class="col-md-4 user-prof-numb comment">
	    					<span class="comment-mess"> </span>
	    					<h6>2,487,521</h6>
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
	    				<div class="infograpy"><h5>SALES INFOGRAPHIC</h5></div>
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
													// Returning Visits
													data: [ [6, 4500], [7,3500], [8, 6550], [9, 7600], ],
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
													tickSize: 1200
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
															y = item.datapoint[1];
															showTooltip(item.pageX, item.pageY, y+ x );
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
							<li><h3><a href="#">$157,182</a></h3><p>Total Earnings</p></li>
							<li><h3><a href="#">$38,952</a></h3><p>Revenue</p></li>
							<li><h3><a href="#">+800k</a></h3><p>New Customers</p></li>
						</ul>
					</div>
			 </div>
<!--banner start here-->
	    		<div class="banner">
	    			<div class="bann-left">
	    				<span class="bann-part"> </span>
	    				<div class="bann-text">
	    					<h1>Want to search Analitycs History?</h1>
	    					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
	    				</div>
	    			</div>
	    			<div class="bann-rit">
	    				<a href="#">EXPLORE</a>
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
	    					<div class="latest-today">
	    						<h4>Today,3.20AM</h4>
	    						<h3>NEW INVOICE SUBMITED</h3>
	    						<p>Viris phaedrum ad cum, in usu ipsum percipit. Ut ponderum percipitur este -by <span class="todt-joe"> Joe Black </span></p>
	    					</div>
	    					<div class="latest-today">
	    						<h4>Today,2.45AM</h4>
	    						<h3>ORDER PLACED</h3>
	    						<p>Viris phaedrum ad cum, in usu ipsum percipit. Ut ponderum percipitur este -by <span class="todt-joe"> Joe Black </span></p>
	    					</div>
	    					<div class="latest-today">
	    						<h4>Today,5.15AM</h4>
	    						<h3>PRICE CHANGE</h3>
	    						<p>Viris phaedrum ad cum, in usu ipsum percipit. Ut ponderum percipitur este -by <span class="todt-joe"> Joe Black </span></p>
	    					</div>
	    					<div class="latest-today">
	    						<h4>Today,12.06AM</h4>
	    						<h3>SITE UPDATE</h3>
	    						<p>Viris phaedrum ad cum, in usu ipsum percipit. Ut ponderum percipitur este -by <span class="todt-joe"> Joe Black </span></p>
	    					</div>
	    					<div class="latest-today">
	    						<h4>NEW PRODUCTS</h4>
	    						<h3>NEW INVOICE SUBMITED</h3>
	    						<p>Viris phaedrum ad cum, in usu ipsum percipit. Ut ponderum percipitur este -by <span class="todt-joe"> Joe Black </span></p>
	    					</div>
	    				</div>
	    				<div class="late-btn">
	    					<a href="#">LOAD MORE</a>
	    				</div>
                                    </div>
                                </div>
                 
                        


                <!--<div class="bar-kit">
	    		<div class="col-md-4 header-bot-right-part-1">-->
<!--latest activity strta here-->
</div>
</div>
                   



<!--header end here-->
</body>
</html>