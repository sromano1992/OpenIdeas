<?php
    session_start();
    require 'manageDB.php';
    $category=$_POST['category'];
    if($category == "null")
        $ideas=getIdeasOrderedByFollowers();
    else
        $ideas=getIdeasOrderedByFollowersByCategory($category);
        
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
        echo "<div class='col-sm-4 col-lg-4 col-md-4'>";
        echo "<div class='thumbnail'>";
        echo "<img src='{$ideaImPath}' style='width:320px;height:150px;'>";
        echo "<div class='caption'>";
        echo "<h4 class='pull-right'></h4>";
        echo "<h4><a href='idea.php?id={$idIdea}'>{$idea['Idea']['nome']}</a></h4>";
        echo "<p>{$idea['Idea']['description']}</p></div>";
        echo "<div class='ratings'>";
        echo "<p class='pull-right'>{$followersNum} followers";
        echo "</p><p>";
        for ($j=0; $j<$starNum; $j++){
            echo "<span class='glyphicon glyphicon-star'></span>";
        }
        for ($j=5; $j>$starNum; $j--){
            echo "<span class='glyphicon glyphicon-star-empty'></span>";
        }
    echo "</p></div></div></div>";            
    }
?>