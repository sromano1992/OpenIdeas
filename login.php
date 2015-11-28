<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
     <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
     <title>OpenIdeas - Login e Registrazione</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
     <script type="text/javascript" src="login.js"></script> 
    <script type="text/javascript" src="registration.js"></script> 
    <script type="text/javascript" src="loginStandard.js"></script> 
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
    <?php include("navbar.php");?>

    <div class="container">

        <div class="row" >
            <div class="box">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Login -  
                        <strong> Register</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-md-6">
                    <div class="login">
                        <div class="form-group form-group-lg">
                            <label class="col-sm-8 control-label" for="log_email">Email</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="text" id="log_email" placeholder="Email">
                            </div><br><br>
                            <label class="col-sm-8 control-label" for="log_password">Password</label>
                            <div class="col-sm-8">
                                <input class="form-control" type="password" id="log_password" placeholder="Password">
                            </div><br>
                            <div class="p-container">
                                <label id="errorLabel" class="form-control" style="color: red; visibility: hidden">Credenziali errate</label>
                            </div><br><br>
                            <div class="btns">
                                <div class="btn-group btn-group-justified" role="group" >
                                    <div class="btn-group" role="group" >
                                        <input type="button" value="Login with Facebook" class="btn btn-lg btn-primary" scope="public_profile,email" onclick="checkLoginState();">
                                    </div>
                                <div class="btn-group" role="group">
                                    <input type="submit" onclick="login()" value="Login" class="btn btn-lg btn-primary">
                                </div>
                                </div>
                            </div>
                        </div>
                        <p style="text-align:center">Hai dimenticato la password?<a href="#" onclick="restorePassword()"><span> Clicca qui</span></a></p>                
                    </div>
                </div>

                <div class="col-md-6">
                    <input id="reg_name" type="text" class="form-control" placeholder="Nome" ><br>
                    <input id="reg_surname" type="text" class="form-control" placeholder="Cognome" ><br>                
                    <div class="users">
                        <input id="reg_email" type="email" class="form-control" placeholder="Email" ><br>
                        <input id="reg_password" type="password" class="form-control" placeholder="Password" ><br>
                        <input id="reg_imPath" type="file" class="form-control" placeholder="Immagine del profilo" ><br>
                        <input id="reg_webPage" type="text" class="form-control" placeholder="Pagina web"  ><br>
                        <input id="reg_dateOfBirth" type="date" class="form-control" placeholder="Data di nascita"  ><br>
                    </div><br>
                    <div id="acceptedConditionDiv" class="p-container">
                        <input id="acceptedCondition" type="checkbox" name="checkbox" checked><i> </i>Accetto i termini e le condizioni di utilizzo</label>
                    </div><br>
                    <input type="submit" onclick="signUp()" class="btn btn-lg btn-primary" value="Registrati" >
                    <hr>
                    <p>Hai già un account?<a href="#"> Effettua il login</a></p>
                </div>


               
            </div>
        </div>
    </div>
    <!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; OpenIdeas 2015</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
