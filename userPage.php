
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
        <script type="text/javascript" src="js/insert_idea.js"></script>
        
    </head>

    <body>
       
    <?php
        error_reporting(0);
        include("navbar.php");
        require "manageDB.php";
        if (!isset($_SESSION['email'])){
            header("location: index.php");
        }   
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
                <li class="active"><a href="#step1" data-toggle="tab">Step 1</a></li>
                <li class="disabled" id="step2_li"><a id="step2_a">Step 2</a></li>
                <li class="disabled" id="summary_li"><a id="summary_a">Summary</a></li>
                <!--
        <li class="disabled"><a href="#step2" data-toggle="tab">Step 2</a></li>
                <li class="disabled"><a href="#summary" data-toggle="tab">Summary</a></li>
                -->
              </ul>
                                    
              <div class="tab-content">
                <div class="tab-pane active" id="step1">
                  <div class="table-responsive">
                    <br>
                      <input type="text" id="name_idea" class="form-control" placeholder="Insert your idea's name">
                      <br>
                      <textarea id="description" class="form-control" rows="5" placeholder="Description"></textarea>
                      <br>
                      <nav>
                        <ul class="pager">
                        <li class="next"><a onClick="nextToStep2()">Next<span aria-hidden="true">&rarr;</span></a></li>
                        </ul>
                      </nav>
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
                <div class="tab-pane" id="step2">
                  <br>
                   <div class="form-group">
            <label for="exampleInputFile">Attach image </label>
            <form enctype="multipart/form-data" action="uploadPhoto.php" target="my-iframe" method="post">
            <input type="file" id="p" name="photo">
            <input type="submit" value="post">
            </form>
            <iframe name="my-iframe" src="uploadPhoto.php" id="iframe_text" style="height:50px;width:300px"></iframe>
            </div>
                  <!-- <a class='btn btn-primary' href='javascript:;'>

                    Allega File...
                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                  </a>
                    &nbsp;
                    <span class='label label-info' id="upload-file-info"></span>
                    <br>
                    <br>-->
                    <label for="basic-url">URL Video</label>
                      <div class="input-group">
                       <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
                        <input id="video_upload" type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
                      </div>
                      <br>
                   <nav>
                     <ul class="pager">
                      <!--<li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Prev</a></li>-->
                      <li class="next"><a onClick="nextToSummary()">Next <span aria-hidden="true">&rarr;</span></a></li>
                     </ul>
                    </nav>   
                </div>
                    <div class="tab-pane" id="summary"><br>
                 <form enctype="multipart/form-data" action="insert_idea.php?idUser=<?php echo $_SESSION['email'];?>" target="iframe_insert" method="post">
          <h4>Riepilogo:</h4><br>
                    <dl class="dl-horizontal">
                       <dt >Nome</dt>
                       <dd><input type="text" id="name_summary" name="nome_summary"></dd>
                       <dt>Descrizione</dt>
                       <dd><input type="text" id="description_summary" name="descr_summary"></dd>
                      </dl>
                  <div class="row">
                    <div class="col-md-6">
                      <img id="image_summary" src="gallery/bg.jpg" alt="Allegato" class="img-thumbnail">
                    </div>
                    <div class="col-md-6">
                      <iframe id="video_summary" height="253" width="438" src="http://www.youtube.com/embed/XGSy3_Czz8k" frameborder="0" allowfullscreen></iframe>
                    </div>
                  </div><br>
                  <input type="text" id="path_sum" name="path_summary" style="display:none">
                  <input type="text" id="url_sum" name="url_summary"style="display:none">
                  <input type="submit" value="conferma">
                    <!--<button type="button" class="btn btn-primary pull-right" >Conferma</button>-->
                    <br>
                   <hr>
                 </form>
                 <iframe name="iframe_insert" src="insert_idea.php" style="height:50px;width:300px;" s></iframe>



                 </div><!--/tab-pane-->
                   
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
