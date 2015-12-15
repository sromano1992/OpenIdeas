<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"
  prefix="oi: http://www.OpenIdeas.org/openIdeasKB" vocab="http://schema.org/" typeof="SoftwareApplication">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title property="name">OpenIdeas - HomePage</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.css" rel="stylesheet"> 
    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
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
        <script type="text/javascript">
        function equalHeight(group) {
            tallest = 0;    
            group.each(function() {       
                thisHeight = $(this).height();       
                if(thisHeight > tallest) {          
                    tallest = thisHeight;       
                }    
            });   
            group.each(function() { $(this).height(tallest); });
        };
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body onload="equalHeight($('.thumbnail'));">

    <div class="brand" property="operatingSystem">OpenIdeas</div>
    <div class="address-bar">Insert your idea HERE!</div>
    <?php include("navbar.php");?>
    

    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    <hr>
                    <h2 class="intro-text text-center">Select
                        <strong>Category</strong>
                    </h2>
                    <hr>
                    <div class="list-group" id="categoriesGroup">
                        <?php
                            error_reporting(0);
                            require "manageDB.php";
                            $categories = getCategories();
                            echo "<a href='#' onclick='refreshIdeas(this.id)' class='list-group-item active' id='noCategory'>All</a>";
                            foreach($categories as $category) {
                                echo "<a href='#' onclick='refreshIdeas(this.id)' class='list-group-item' id='$category[name]'>$category[name]</a>";
                            }?>
                    </div>
                </div>
            
            <div class="box">
                <div class="col-lg-9 text-center">
                    <div id="carousel-example-generic" class="carousel slide">
                        <!-- Indicators -->
                        <ol class="carousel-indicators hidden-xs">
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

                        <!-- Wrapper for slides -->
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
                        </div>

                        <!-- Controls -->
                        <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                            <span class="icon-prev"></span>
                        </a>
                        <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                            <span class="icon-next"></span>
                        </a>
                    </div>
                    <!--<h2 class="brand-before">
                        <small>Welcome to</small>
                    </h2>
                    <h1 class="brand-name">Business Casual</h1>
                    <hr class="tagline-divider">
                    <h2>
                        <small>By
                            <strong>Start Bootstrap</strong>
                        </small>
                    </h2>-->
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
                                $category = getCategoriesOfIdea($idIdea)[0];
                                $url = "idea.php&id=" . $idIdea;
                                if (strlen($ideaImPath) == 0){
                                    $ideaImPath = "images/imNotFound.jpg";
                                }
                                ?>
                                     <div class="col-sm-4 col-lg-4 col-md-4" >
                                        <div class="thumbnail" style="background-color: #e7e7e7;font-weight: 700;">
                                            <img src="<?php echo"{$ideaImPath}";?>" style="width:320px;height:150px;" >
                                            <div class="caption">
                                                <h4 class="pull-right"></h4>
                                                <h4><a property="oi:hasName" href="<?php echo"idea.php?id={$idIdea}";?>"><?php echo"{$idea['Idea']['nome']}";?></a>
                                                </h4>
                                                <span style="display:none" property="oi:hasCategory"><?php echo "Category: {$category}" ?> </span><br>
                                                <span style="display:none"  property="oi:hasUrl"><?php echo "Url: {$url}" ?> </span>
                                                <p style="height:100px; overflow-y:auto"><?php echo"{$idea['Idea']['description']}";?></p>
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

    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

</body>

</html>
