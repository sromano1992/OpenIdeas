<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
   
    <title>OpenIdeas - User Page</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/business-casual.css" rel="stylesheet">

    <!-- Fonts -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Josefin+Slab:100,300,400,600,700,100italic,300italic,400italic,600italic,700italic" rel="stylesheet" type="text/css">
    
    <script type="text/javascript" src="login.js"></script>
        <script type="text/javascript" src="js/insert_idea.js"></script>
        <script async="" src="//www.google-analytics.com/analytics.js"></script>

        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>        
        <!-- JavaScript jQuery code from Bootply.com editor  -->
        
        <script type="text/javascript">
        
        $(document).ready(function() {
            $('.cont').click(function(){
                var nextId = $(this).parents('.tab-pane').next().attr("id");
                 $('[href=#'+nextId+']').tab('show');
                })
        });
        
        </script>
        <script type="text/javascript">
            function readNotice(idNotice, element) {
                var dataString = 'idNotice=' + idNotice;
                $.ajax({
                    type: "POST",
                    url: "./readNotice.php",
                    data: dataString,
                    cache: true,
                    success: function(html){
                        if (html == "success") {
                            $(element).remove();    
                        }
                    }
                });
            }
        </script>
        <script type="text/javascript">
            function readAll() {
                $.ajax({
                    type: "POST",
                    url: "./readAllNotices.php",
                    cache: true,
                    success: function(html){
                        if (html == "success") {
                            $('#ulNotices').html();
                            var ul = "<li class='dropdown-header'>Commenti</li><li role='separator' class='divider'></li>";
                            ul = ul.concat("<li class='dropdown-header'>Followers</li><li role='separator' class='divider'></li>");
                            ul = ul.concat("<li class='dropdown-header'>Finanzia</li>");
                            $('#ulNotices').html(ul);
                        }
                    }
                });
            }
        </script>
    
</head>

<body onload="getCategories()">
 <div class="brand">OpenIdeas</div>
    <div class="address-bar">Insert your idea HERE!</div>
    
    <?php
        error_reporting(0);
        include("navbar.php");
        require "manageDB.php";
        if (!isset($_SESSION['email'])){
            header("location: index.php");
        }   
    ?>

<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <div class="box">
                <hr><h2 class="intro-text text-center"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;<strong><?php echo"{$_SESSION['name']}"?></strong></h2><hr>
                <a href="<?php echo"{$_SESSION['picture']}" ?>"><img title="profile image" style="max-width:30%; margin: 0 auto;" class="img-circle img-responsive" src="<?php echo"{$_SESSION['picture']}" ?>"/></a>
                <br>
                <ul class="list-group">
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Registrato</strong></span><?php echo"{$_SESSION['registrationDate']}"?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Ultimo accesso</strong></span><?php echo"{$_SESSION['lastLogin']}"?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Nome completo</strong></span><?php echo"{$_SESSION['name']} {$_SESSION['surname']}"?></li>
                    <li class="list-group-item text-right"><span class="pull-left"><strong>Pagina web</strong></span><?php echo"{$_SESSION['webPage']}"?></li>
                </ul>   
            </div>
        </div> 
        <div class="col-sm-6 col-md-4">
            <div class="box">
                <hr><h2 class="intro-text text-center"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span>&nbsp;<strong>Activity</strong></h2><hr>
                <ul class="list-group">
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
            </div>
        </div>

        <div class="col-sm-6 col-md-4">
            <div class="box">
                <hr><h2 class="intro-text text-center"><span class="glyphicon glyphicon-tags" aria-hidden="true"></span>&nbsp;<strong>Notifiche</strong></h2><hr>         
                <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" onclick="readAll();">Lette</button>
                        <div class="btn-group" role="group">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          Visualizza notifiche
                          <span class="caret"></span>
                        </button>
                        <?php
                            $notices = getNoticesOfUser($_SESSION['email']);
                            $comments = array();
                            $financiers = array();
                            $followers = array();
                            
                            foreach($notices as $notice) {
                                if($notice['type'] == "Comment") {
                                    $comments[] = $notice;
                                }
                                else if($notice['type'] == "Financier") {
                                    $financiers[] = $notice;
                                }
                                else if($notice['type'] == "Follower") {
                                    $followers[] = $notice;
                                }
                            }
                        ?>
                       <ul class="dropdown-menu" aria-labelledby="dropdownMenu1" id="ulNotices">
                            <li class="dropdown-header">Commenti</li>
                            <?php foreach($comments as $comment) {
                                $href = "idea.php?id=".$comment['idIdea'];
                                $id = $comment['idNotice'];
                                $onclick = "readNotice($id)";
                                echo "<li><a href=$href id=$id onclick=$onclick>".$comment['text']."</a></li>";
                            }
                            ?>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Followers</li>
                            <?php foreach($followers as $follower) {
                                $href = "idea.php?id=".$follower['idIdea'];
                                $id = $follower['idNotice'];
                                $onclick = "readNotice($id)";
                                echo "<li><a href=$href id=$id onclick=$onclick>".$follower['text']."</a></li>";
                            }
                            ?>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Finanzia</li>
                            <?php foreach($financiers as $financier) {
                                $href = "idea.php?id=".$financier['idIdea'];
                                $id = $financier['idNotice'];
                                $onclick = "readNotice($id)";
                                echo "<li><a href=$href id=$id onclick=$onclick>".$financier['text']."</a></li>";
                            }
                            ?>
                        </ul>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="box">
            <div class="col-lg-12">
                <hr><h2 class="intro-text text-center"><strong>Inserisci un'idea</strong></h2><hr>
                <ul class="nav nav-pills nav-justified" id="myTab">
                    <li class="active" id="step1_li"><a href="#step1" class="" id="step1_a" data-toggle="tab">Step 1</a></li>
                    <li class="disabled" id="step2_li"><a id="step2_a" class="" >Step 2</a></li>
                    <li class="disabled" id="summary_li"><a id="summary_a">Summary</a></li>
                </ul>
                 <div class="tab-content">
                <div class="tab-pane active" id="step1">
                  <div class="table-responsive">
                    <br>
                      <input type="text" id="name_idea" class="form-control" placeholder="Insert your idea's name" onchange="checkParameterStep1()">
                      <br>
                      <textarea id="description" class="form-control" rows="5" placeholder="Description" onchange="checkParameterStep1()"></textarea>
                      <br>
                      <select id="select_cat" class="form-control" onchange="checkParameterStep1()">
                    </select>
                      <nav>
                        <ul class="pager">
                        <li class="next"><div class="disabled" id="step1_div"> <a class="btn cont" href="#">Next<span aria-hidden="true">&rarr;</span></a></div></li>
                        </ul>
                      </nav>
                    
                    <div class="row" style="display:none;">
                      <div class="col-md-4 col-md-offset-4 text-center">
                            <ul class="pagination" id="myPager"></ul>
                      </div>
                    </div>
                  </div><!--/table-resp-->
                  
                  
                  
                    
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
                                                <p style="height:300px; overflow-y:auto;text-align:justified"><?php echo"{$ideaDescription}";?></p>
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
                  
                  <hr><h2 class="intro-text text-center"><strong>Recent Activity</strong></h2><hr>
                  
                  
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
                        <label for="exampleInputFile"><span class="glyphicon glyphicon-file"></span>Attach image </label><br>
                        <form enctype="multipart/form-data" action="uploadPhoto.php" target="my-iframe" method="post">
                            <input type="file" id="p" name="photo"><br>
                            <input type="submit" value="Carica" class="btn btn-primary" onclick="checkParameterStep2()">
                        </form><br>
                        
                        <iframe name="my-iframe" src="uploadPhoto.php" id="iframe_text" style="height:51px; width:600px; background: transparent; border: 0;" scrolling="no" ></iframe>
                          
                    </div>
                  



                  <!-- <a class='btn btn-primary' href='javascript:;'>

                    Allega File...
                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
                  </a>
                    &nbsp;
                    <span class='label label-info' idhttp://localhost:8888/OpenIdeas/userPage.php#step1="upload-file-info"></span>
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
                      <li class="next"><div class="disabled" id="step2_div"> <a  class="btn cont" href="#" onclick="nextToSummary()">Next<span aria-hidden="true">&rarr;</span></a></div></li>
                     </ul>
                    </nav>   
                </div>
                    <div class="tab-pane" id="summary"><br>
                 <form enctype="multipart/form-data" action="insert_idea.php?idUser=<?php echo $_SESSION['email'];?>" target="iframe_insert" method="post">
          <h4>Summary:</h4><br>
                    <dl class="dl-horizontal">
                        <dt><label for="nome_summary">Name</label></dt>
                            <dd><input type="text" id="name_summary" class="form-control" name="nome_summary" placeholder="" readonly onchange="setReadonly(this)"></dd>
                        <dt><label for="descr_summary">Description</label></dt>
                            <dd><textarea type="text" rows="20" id="description_summary" class="form-control" name="descr_summary" placeholder="descrizione" readonly onchange="setReadonly(this)"></textarea></dd>
                        <dt><label for="descr_summary">Category</label></dt>
                           <dd><select id="select_cat1" readonly name="selectSum" class="form-control" onchange="checkSummary()" ></select></dd>
                     </dl>
                  <div class="row">
                    <div class="col-md-6">
                      <img id="image_summary" style="height: 300px"src="gallery/bg.jpg" alt="Allegato" class="img-thumbnail">

                    </div>
                    <div class="col-md-6">
                    <iframe id="url_sum"  src="" width="409" height="300px" src=""></iframe>
                     <div class="input-group" >
                        <input id="video_uploadM" style="display: none; width:409px" type="text" class="form-control" id="basic-url" onchange="setNewVideo(this)" placeholder="Insert new url video" aria-describedby="basic-addon3">
                      </div>              
                     </div>
                  </div><br>

                  <input type="text" id="path_sum" name="path_summary" style="display:none">
                  <input type="text" id="urlvideo_sum" name="url_summary" style="display:none">
                 <br><br><br><br>
                  <button type="button" class="btn btn-warning pull-right" onclick="modify()"><span class="glyphicon glyphicon-pencil"></span>Modifica</button>
                  <input type="submit" id="submit_conferma" value="Conferma"  class="btn btn-primary pull-right">

                    <!--<button type="button" class="btn btn-primary pull-right" >Conferma</button>-->
                    <br>
                
                 </form>
                 <div class="col-md-3">
                 <form id="formModifyImage" style="visibility:hidden;" enctype="multipart/form-data" action="uploadPhoto.php" target="my-iframe2" method="post">
                            <input type="file" id="p" name="photo"><br>
                            <button disabled id="button_view" type="button" class="btn btn-warning pull-right" onclick="viewNewImage()"><span class='glyphicon glyphicon-pencil'></span>View Image</button>
                            <input type="submit" value="Carica" class="btn btn-primary" onclick="viewButtonView()">
                 </form>
                </div>
                    <br>  <br> <br> <br> <br> <br> 
                 <iframe name="my-iframe2" src="uploadPhoto.php" id="iframe_text2" style="height:51px; width:600px; border: 2; display:none" scrolling="no" ></iframe>
                          
                <!--<iframe name="iframe_insert" src="insert_idea.php" style="height:1px;width:1px; background: transparent; border: 0;" scrolling="no"></iframe>-->
               
                <iframe name="iframe_insert" src="insert_idea.php" style="height:51px;width:400px; margin-left: 24em;" scrolling="no"></iframe>
    


                 </div><!--/tab-pane-->

                   
                  </div><!--/tab-pane-->
              </div><!--/tab-content-->




            </div><!--col-lg-12 -->
        </div><!--box -->
    </div> <!--row idea -->                              
</div><!-- /.container -->

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; OpenIdeas 2015</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
