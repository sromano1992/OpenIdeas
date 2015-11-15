<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
    
        <title>OpenIdeas - pagina utente</title>
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
        
        
    </head>

    <body>
       
    <?php
        error_reporting(0);
        include("navbar.php");
        require "manageDB.php";
        if (!isset($_SESSION['email'])){
            header("location: index.php");
        }
        include("navbar.php");     
    ?>
      <hr>
        <div class="container">
            <div class="row">
                <?php
                   echo "<div class='col-sm-10'><h1>{$_SESSION['name']}</h1></div>"; 
                ?>                  
            <div class="col-sm-2"><a href="<?php echo"{$_SESSION['picture']}" ?>" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="<?php echo"{$_SESSION['picture']}" ?>"/></a></div>
        </div>
        <div class="row">
                    <div class="col-sm-3"><!--left col-->
                  
              <ul class="list-group">
                <li class="list-group-item text-muted">Profilo</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Registrato</strong></span><?php echo"{$_SESSION['registrationDate']}"?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Ultimo accesso</strong></span><?php echo"{$_SESSION['lastLogin']}"?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Nome completo</strong></span><?php echo"{$_SESSION['name']} {$_SESSION['surname']}"?></li>
                
              </ul> 
                   
              <div class="panel panel-default">
                <div class="panel-heading">Pagina web <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body"><a href="<?php echo"{$_SESSION['webPage']}"?>"><?php echo"{$_SESSION['webPage']}"?></a></div>
              </div>
              
              
              <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Received comments</strong></span>
                    <?php
                        $comments = getCommentForUser($_SESSION['email']);
                        echo "{$comments}";
                    ?>
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span>
                    <?php
                        $followers = getUserFollowers($_SESSION['email']);
                        echo "{$followers}";
                    ?>
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Financier</strong></span>
                    <?php
                        $financier = getUserFinancier($_SESSION['email']);
                        echo "{$financier}";
                    ?>
                </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>My ideas</strong></span>
                     <?php
                        $numIdeas = getUserIdeasCount($_SESSION['email']);
                        echo "{$numIdeas}";
                    ?>
                </li>
              </ul> 
                   
              <div class="panel panel-default">
                <div class="panel-heading">Social Media</div>
                <div class="panel-body">
                    <i class="fa fa-facebook fa-2x"></i> <i class="fa fa-github fa-2x"></i> <i class="fa fa-twitter fa-2x"></i> <i class="fa fa-pinterest fa-2x"></i> <i class="fa fa-google-plus fa-2x"></i>
                </div>
              </div>
              
            </div><!--/col-3-->
            <div class="col-sm-9">
              
              <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
                <li><a href="#messages" data-toggle="tab">Messages</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
              </ul>
                  
              <div class="tab-content">
                <div class="tab-pane active" id="home">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Label 1</th>
                          <th>Label 2</th>
                          <th>Label 3</th>
                          <th>Label </th>
                          <th>Label </th>
                          <th>Label </th>
                        </tr>
                      </thead>
                      <tbody id="items">
                        <tr>
                          <td>1</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                         <tr>
                          <td>8</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                          <td>Table cell</td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4 text-center">
                            <ul class="pagination" id="myPager"></ul>
                      </div>
                    </div>
                  </div><!--/table-resp-->
                  
                  
                  <hr>
                    
                <div class="row">
                        <?php
                            //each position of $uerIdeas contains an array:
                            //$userIdeas[k][0] = ideaId; $userIdeas[k][1] = followers number;   
                            $userIdeas = getUserIdeasOrderedByFollowers($_SESSION['email']);
                            $maxFollowers = getMaxFollow();
                            for ($i=0; $i<sizeof($userIdeas); $i++){
                                $idIdea = $userIdeas[$i][0];
                                $idea = getIdeaById($idIdea);
                                $ideaName = getIdeaName($idIdea);
                                $ideaDescription = getIdeaDescription($idIdea);
                                $followersNum = sizeof($idea['Followers']);
                                $ideaScorePercentage = $followersNum/$maxFollowers;
                                $starNum = ceil($ideaScorePercentage*5);
                                $ideaImPath = getIdeaImPath($idIdea);
                                if (strlen($ideaImPath) == 0){
                                    $ideaImPath = "images/imNotFound.jpg";
                                }
                                ?>
                                     <div class="col-sm-4 col-lg-4 col-md-4">
                                        <div class="thumbnail">
                                            <img src="<?php echo"{$ideaImPath}";?>" style="width:320px;height:150px;" >
                                            <div class="caption">
                                                <h4 class="pull-right"></h4>
                                                <h4><a href="<?php echo"idea.php?id={$idIdea}";?>"><?php echo"{$ideaName}";?></a>
                                                </h4>
                                                <p><?php echo"{$ideaDescription}";?></p>
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
                  
                  <hr>
                  
                  <h4>Recent Activity</h4>
                  
                  <div class="table-responsive">
                    <table class="table table-hover">
                      
                      <tbody>
                        <?php
                            $result = getLastUserActivities($_SESSION['email']);
                            if (mysqli_num_rows($result) > 0) {
                                // output data of each row
                                while($row = mysqli_fetch_assoc($result)) {
                                    //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                                    if($row['type'] == 'follow'){
                                        $date = $row['date'];
                                        $ideaName = getIdeaName($row['text']);
                                        $ideaId = $row['text'];
                                        $author = $row['idIdea'];  //query result column have different name (try query to understand value of each column)
                                        ?>
                                        <tr>
                                            <td><i class="pull-right fa fa-edit"></i> <?php echo"{$date} - Hai iniziato a seguire l'idea <a href='idea.php?id={$ideaId}'>{$ideaName}</a> dell'utente <b>{$author}</b>";?></td>
                                        </tr><?php
                                    }
                                    else if ($row['type'] == 'insert'){
                                        $date = $row['date'];
                                        $ideaName = $row['text'];
                                        $ideaId = $row['idIdea'];
                                        ?>
                                        <tr>
                                            <td><i class="pull-right fa fa-edit"></i> <?php echo"{$date} - Hai aggiunto l'idea <a href='idea.php?id={$ideaId}'>{$ideaName}</a>";?><td>
                                        </tr><?php
                                    }
                                    else if ($row['type'] == 'financier'){
                                        $date = $row['date'];
                                        $ideaId = $row['text'];
                                        $ideaName = getIdeaName($ideaId);
                                        $author = $row['idIdea'];   //query result column have different name (try query to understand value of each column)
                                        ?>
                                        <tr>
                                            <td><i class="pull-right fa fa-edit"></i> <?php echo"{$date} - Hai deciso di finanziare l'idea <a href='idea.php?id={$ideaId}'>{$ideaName}</a> dell'utente <b>{$author}</b>";?><td>
                                        </tr><?php
                                    }
                                    else if ($row['type'] == 'comment'){
                                        $date = $row['date'];
                                        $comment = $row['text'];
                                        $ideaName = getIdeaName($row['idIdea']);
                                        $author = getUserOfIdea($row['idIdea'])['email'];
                                        $ideaId = $row['idIdea'];
                                        ?>
                                        <tr>
                                            <td><i class="pull-right fa fa-edit"></i> <?php echo"{$date} - Hai lasciato il messaggio <b>{$comment}</b> sull'idea <a href='idea.php?id={$ideaId}'>{$ideaName}</a> dell'utente <b>{$author}</b>";?><td>
                                        </tr><?php
                                    
                                    }
                                }
                            }
                        ?>
                       
                      </tbody>
                    </table>
                  </div>
                  
                 </div><!--/tab-pane-->
                 <div class="tab-pane" id="messages">
                   
                   <h2></h2>
                   
                   <ul class="list-group">
                      <li class="list-group-item text-muted">Inbox</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Here is your a link to the latest summary report from the..</a> 2.13.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Hi Joe, There has been a request on your account since that was..</a> 2.11.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Nullam sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Thllam sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Wesm sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">For therepien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Also we, havesapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                      <li class="list-group-item text-right"><a href="#" class="pull-left">Swedish chef is assaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                      
                    </ul> 
                   
                 </div><!--/tab-pane-->
                 <div class="tab-pane" id="settings">
                            
                    
                      <hr>
                      <form class="form" action="##" method="post" id="registrationForm">
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="first_name"><h4>First name</h4></label>
                                  <input type="text" class="form-control" name="first_name" id="first_name" placeholder="first name" title="enter your first name if any.">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                <label for="last_name"><h4>Last name</h4></label>
                                  <input type="text" class="form-control" name="last_name" id="last_name" placeholder="last name" title="enter your last name if any.">
                              </div>
                          </div>
              
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="phone"><h4>Phone</h4></label>
                                  <input type="text" class="form-control" name="phone" id="phone" placeholder="enter phone" title="enter your phone number if any.">
                              </div>
                          </div>
              
                          <div class="form-group">
                              <div class="col-xs-6">
                                 <label for="mobile"><h4>Mobile</h4></label>
                                  <input type="text" class="form-control" name="mobile" id="mobile" placeholder="enter mobile number" title="enter your mobile number if any.">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="email"><h4>Email</h4></label>
                                  <input type="email" class="form-control" name="email" id="email" placeholder="you@email.com" title="enter your email.">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="email"><h4>Location</h4></label>
                                  <input type="email" class="form-control" id="location" placeholder="somewhere" title="enter a location">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                  <label for="password"><h4>Password</h4></label>
                                  <input type="password" class="form-control" name="password" id="password" placeholder="password" title="enter your password.">
                              </div>
                          </div>
                          <div class="form-group">
                              
                              <div class="col-xs-6">
                                <label for="password2"><h4>Verify</h4></label>
                                  <input type="password" class="form-control" name="password2" id="password2" placeholder="password2" title="enter your password2.">
                              </div>
                          </div>
                          <div class="form-group">
                               <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                    <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                                </div>
                          </div>
                    </form>
                  </div>
                   
                  </div><!--/tab-pane-->
              </div><!--/tab-content-->
    
            </div><!--/col-9-->
        </div><!--/row-->
    
        <!-- jQuery -->
        <script src="js/jquery.js"></script>
    
        <!-- Bootstrap Core JavaScript -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
