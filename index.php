    <!DOCTYPE html>
    <html lang="en">
    
    <head>    
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>OpenIdeas - HomePage</title>
        <!-- Custom CSS -->
        <link href="css/shop-homepage.css" rel="stylesheet">        
        <link href="css/bootstrap.css" rel="stylesheet">       
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-social.css" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <script type="text/javascript" src="login.js"></script>
        <script type="text/javascript">
            function refreshIdeas(id) {
                
                if (id == "noCategory") {
                    var dataString = 'category=null';
                }
                else {
                    var dataString = 'category='+id;
                }
                $.ajax({
		    type: "POST",
		    url: "./refreshIdeas.php",
		    data: dataString,
		    cache: true,
		    success: function(html){
		        $('#divIdeas').html();
		        $('#divIdeas').html(html);
                        $('#categoriesGroup a').each(function() {
                            $(this).removeClass("active");                            
                        });
                        $('#'+id).addClass("active");          
		    }
		});
            }
        </script>
        
    </head>
    
    <body style="background:#eeeeee; ">
        <?php include("navbar.php");?>
        <!-- Page Content -->
        <div class="container">
    
            <div class="row">
    
                <div class="col-md-3">
                    <p class="lead">Categorie</p>
                    <div class="list-group" id="categoriesGroup">
                        <?php
                            error_reporting(0);
                            require "manageDB.php";
                            $categories = getCategories();
                            echo "<a href='#' onclick='refreshIdeas(this.id)' class='list-group-item active' id='noCategory'>Tutte</a>";
                            foreach($categories as $category) {
                                echo "<a href='#' onclick='refreshIdeas(this.id)' class='list-group-item' id='$category[name]'>$category[name]</a>";
                            }?>
                    </div>
                </div>
    
                <div class="col-md-9">
    
                    <div class="row carousel-holder">
    
                        <div class="col-md-12">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators">
                                    <?php $ideas = getThreeMaxFollow();
                                          $j = 0;
                                          foreach($ideas as $idea) {
                                            if($j == 0) {
                                                echo "<li data-target='#carousel-example-generic' data-slide-to='$j' class='active'></li>";
                                            }
                                            else {
                                                echo "<li data-target='#carousel-example-generic' data-slide-to='$j'></li>";
                                            }
                                            $j++;
                                          }
                                    ?>
                                </ol>
                                <div class="carousel-inner">
                                    <?php
                                        $ideas = getThreeMaxFollow();
                                        $j = 0;
                                        foreach($ideas as $path) {
                                            if($j == 0) {
                                                echo "<div class='item active'>";
                                            }
                                            else echo "<div class='item'>";
                                            echo "<img class='slide-image' src='$path' alt='' style='height:300px; width:800px'>";
                                            echo "</div>";
                                            $j++;
                                        }
                                    ?>
                                    <!--<div class="item active">
                                        <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                    </div>
                                    <div class="item">
                                        <img class="slide-image" src="http://placehold.it/800x300" alt="">
                                    </div> -->
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
    
                    </div>
    
                    <div class="row" id="divIdeas">
                        <?php
                        $ideas = getIdeasOrderedByFollowers();
                            $maxFollowers = getMaxFollow();
                            for ($i=0; $i<sizeof($ideas); $i++){
                                $idIdea = $ideas[$i][0];
                                $idea = getIdeaById($idIdea);
                                $followersNum = sizeof($idea['Followers']);
                                $ideaScorePercentage = $followersNum/$maxFollowers;
                                $starNum = ceil($ideaScorePercentage*5);
                                $ideaImPath = $idea['Idea']['imPath'];
                                if (strlen($ideaImPath) == 0){
                                    $ideaImPath = "images/imNotFound.jpg";
                                }
                                ?>
                                     <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail">
                                            <img src="<?php echo"{$ideaImPath}";?>" style="width:320px;height:150px;" >
                                            <div class="caption">
                                                <h4 class="pull-right"></h4>
                                                <h4><a href="<?php echo"idea.php?id={$idIdea}";?>"><?php echo"{$idea['Idea']['nome']}";?></a>
                                                </h4>
                                                <p><?php echo"{$idea['Idea']['description']}";?></p>
                                            </div>
                                            <div class="ratings">
                                                <p class="pull-right">
                                                <?php                                                    
                                                    echo"{$followersNum}";?> followers
                                                </p>
                                                <p>
                                                    <?php
                                                        for ($j=0; $j<$starNum; $j++){
                                                            ?>
                                                                <span class="glyphicon glyphicon-star"></span>
                                                            <?php
                                                        }
                                                        for ($j=5; $j>$starNum; $j--){
                                                            ?>
                                                                <span class="glyphicon glyphicon-star-empty"></span>
                                                            <?php
                                                        }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>            
                                <?php
                            }
                        ?> 

                    </div>
                </div>
            </div>
        </div>
        <!-- /.container -->
    
        <div class="container">
    
            <hr>
    
            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>Copyright &copy; OpenIdeas 2015</p>
                    </div>
                </div>
            </footer>
    
        </div>
        <!-- /.container -->
    
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
    
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    
    </body>
    
    </html>
