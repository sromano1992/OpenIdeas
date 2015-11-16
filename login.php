<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>	
<head>
    <title>OpenIdeas - Login e Registrazione</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <meta name="keywords" content="OpenIdeas - Login e Registrazione" />
    <link href="css/style_login.css" rel='stylesheet' type='text/css' />
    <!--web-fonts-->
    <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!--/web-fonts-->
    <link href="css/shop-homepage.css" rel="stylesheet">        
    <link href="css/bootstrap.css" rel="stylesheet">       
    <link href="css/bootstrap-social.css" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/flag-icon.css" rel="stylesheet">
    <link href="css/flag-icon.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <script type="text/javascript" src="login.js"></script> 
    <script type="text/javascript" src="registration.js"></script> 
    <script type="text/javascript" src="loginStandard.js"></script> 
</head>
<body>
	<?php
	    include("navbar.php");     
	?>
	<h1>OpenIdeas - registrazione e login</h1>
            <div class="wrap">
                <div class="signup">
                    <h3>Registrazione<span></span></h3>
                    <div class="singup-info">
			<input id="reg_name" type="text" class="text" placeholder="Nome" >
			<input id="reg_surname" type="text" class="text" placeholder="Cognome" >			    
			<div class="users">
			    <input id="reg_email" type="email" class="text" placeholder="Email" >
			    <input id="reg_password" type="password" class="text" placeholder="Password" >
			    <input id="reg_imPath" type="file" class="text" placeholder="Immagine del profilo" >
			    <input id="reg_webPage" type="text" class="text" placeholder="Pagina web"  >
			    <input id="reg_dateOfBirth" type="date" class="text" placeholder="Data di nascita"  >
			</div>
                        <div id="acceptedConditionDiv" class="p-container">
			   <input id="acceptedCondition" type="checkbox" name="checkbox" checked><i> </i>Accetto i termini e le condizioni di utilizzo</label>
			</div>
			    <input type="submit" onclick="signUp()" value="signup" >
			<div class="clear"> </div>
			<p>Hai già un account?<a href="#">Effettua il login</a></p>
			<div class="clear"> </div>
                        </div>
                    </div>
                <div class="login">
                        <h3>Login<span></span></h3>
                        <div class="login-info">
			    <form enctype="multipart/form-data">
				<input id="log_email" type="text" class="text" placeholder="Email">
				<input id="log_password" type="password" placeholder="Password">
				<div class="p-container">
				    <label id="errorLabel" style="color: red; visibility: hidden">Credenziali errate</label>
				</div>
				<div class="btns">
				    <div class="btn-group btn-group-justified" role="group" >
					<div class="btn-group" role="group">
					    <fb:login-button data-size="xlarge" scope="public_profile,email" onlogin="checkLoginState();">
					    </fb:login-button>
					</div>
					<div class="btn-group" role="group">
					    <input type="submit" onclick="login()" value="login">
					</div>
				    </div>
				</div>
			    </form>
			    </div>
			    <p><a href="#" onclick="restorePassword()">Hai dimenticato la password?<span>Clicca qui</span></a></p>                
                        </div>
                </div>
                <div class="clear"> </div>
            </div>
	</div>
                    <div class="copy-right">
                                            <!--<p>&#169; 2015 Flate Signup And Login Form. All Rights Reserved | Template by <a href="http://w3layouts.com/"> W3layouts</a></p>-->
                            </div>
    
    </body>
</html>