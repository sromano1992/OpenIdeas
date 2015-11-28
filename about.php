<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>OpenIdeas - About</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body vocab="http://schema.org/" typeof="SoftwareApplication" >

    <div class="brand" property="name">OpenIdeas</div>
    <div class="address-bar">Insert your idea HERE!</div>
    <?php include("navbar.php");?>

    <div class="container">

        <div class="row">
            <div class="box">
              
                    <hr>
                    <h2 class="intro-text text-center" property="applicationCategory">About
                        <strong property="operatingSystem">OpenIdeas</strong>
                    </h2>
                    <hr>
               
                <div class="col-md-6">
                    <img class="img-responsive img-border-left" src="img/idea.png" alt="">
                </div>
                <div class="col-md-6">
                    <p property="description">
                        Scopo del portale OpenIdeas è dare la possibilità ad utenti che hanno voglia di realizzare un progetto (di qualsiasi tipologia) di renderlo pubblico, avere un feedback sul giudizio degli utenti e trovare eventuali finanziatori.
                    </p>
                </div>
                <div property="aggregateRating" typeof="AggregateRating" style="display:none;">
                    <span property="ratingValue">4.6</span> (
                    <span property="ratingCount">8864</span> ratings )
                </div>
                <div property="offers" typeof="Offer" style="display:none;">
                Price: $<span property="price">1.00</span>
                <meta property="priceCurrency" content="USD" />
                </div>
                 <div class="clearfix" ></div>
            </div>
        </div>

        <div class="row">
            <div class="box" property="author">
                <div class="col-lg-12">
                    <hr>
                    <h2 class="intro-text text-center">Our
                        <strong>Team</strong>
                    </h2>
                    <hr>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <center><img  src="img/ciro.jpg" alt="" align="middle"class="img-circle" >
                    <h3>Amati Ciro</h3>
                        <strong><a href="www.scmeteora.com/ciroamati">WebSite</a></strong></center>
                    
                </div>
                <div class="col-xs-6 col-sm-3">
                    <center><img  src="img/ste.jpg" alt="" align="middle" class="img-circle">
                    <h3>Cardamone Stefania</h3>
                        <strong><a href="www.scmeteora.com/stefaniacardamone">WebSite</a></strong></center>
                </div>
                <div class="col-xs-6 col-sm-3">
                    <center><img  src="img/amedeo.jpg" alt="" align="middle" class="img-circle">
                    <h3>Leo Amedeo</h3>
                        <strong><a href="http://amedeoleo.altervista.org/">WebSite</a></strong><center>
                    
                </div>
                 <div class="col-xs-6 col-sm-3">
                    <center><img src="img/simone.jpg" alt="" align="middle" class="img-circle">
                    <h3>Romano Simone</h3>
                        <strong><a href="http://www.sromano.altervista.org/">WebSite</a></strong></center>
                    
                </div>
                <div class="clearfix"></div>
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
