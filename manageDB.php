<?php
    
    require 'function.php';
    require 'functions.php';
    
    function getConn(){
        global $conn;
        
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "ws";
        
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $conn;
    }
    
    function getUserFBLogin($email, $name, $sex, $picture, $birthday){
        $conn = getConn();
        
        $sql = "SELECT * from utente where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) { //user in db
            session_start();
            if (!isset($_SESSION['email'])){
                $_SESSION['email'] =  $_POST['email'];
                while($row = mysqli_fetch_assoc($result)) {
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['surname'] = $row["surname"];
                    $_SESSION['sex'] = $row["sex"];
                    $_SESSION['picture'] = $row["imPath"];
                    $_SESSION['birthday'] = $row["birthday"];
                    $_SESSION['registrationDate'] = $row["registrationDate"];
                    $_SESSION['lastLogin'] = $row["lastLogin"];
                    $_SESSION['webPage'] = $row["webPage"];
                }
                $now = (new \DateTime())->format('Y-m-d H:i:s');
                updateLastLogin($email, $now);
                
            }
            // output data of each row
            /*while($row = mysqli_fetch_assoc($result)) {
                echo "id: " . $row["name"]. " - Name: " . $row["email"]. " " . $row["surname"]. "<br>";
            }*/
        } else {    //insert user in db
            $now = (new \DateTime())->format('Y-m-d H:i:s');
            $picture = urldecode($picture);
            insertFBUser($email, $name, $sex, $picture, $birthday, $now);
            session_start();
            $_SESSION['email'] =  $_POST['email'];
            $nameSurname = explode (" " ,$name);    
            //people can have more than 1 name!
            $_SESSION['name'] = $nameSurname[0];
            $_SESSION['surname'] = $nameSurname[1];
            $_SESSION['sex'] = $sex;
            $_SESSION['picture'] = $picture;
            $_SESSION['birthday'] = $birthday;
            $_SESSION['registrationDate'] = $now;
            $_SESSION['lastLogin'] = $now;
            $_SESSION['webPage'] = "";
        }
        
        mysqli_close($conn);
    }
     /** 
    * @author Simone Romano
    */
    function checkUserPassword($email, $password) {
        $conn = getConn();
        
        $sql = "SELECT * from utente where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) { //user in db
            session_start();
            if (!isset($_SESSION['email'])){
                while($row = mysqli_fetch_assoc($result)) {
                    $confirmed = $row['confirmed'];
                    if ($confirmed == 0){
                        return -3;
                    }
                    $passwordInDb = $row['password'];
                    $test = md5($password);
                    if (md5($password)==$passwordInDb){
                        $_SESSION['email'] =  $email;
                        $_SESSION['name'] = $row["name"];
                        $_SESSION['surname'] = $row["surname"];
                        $_SESSION['sex'] = $row["sex"];
                        $_SESSION['picture'] = $row["imPath"];
                        $_SESSION['birthday'] = $row["birthday"];
                        $_SESSION['registrationDate'] = $row["registrationDate"];
                        $_SESSION['lastLogin'] = $row["lastLogin"];
                        $_SESSION['webPage'] = $row["webPage"];
                        $now = (new \DateTime())->format('Y-m-d H:i:s');
                        updateLastLogin($email, $now);
                    }
                    else{
                        mysqli_close($conn);
                        return -1;
                    }
                }
                
            }
        } else {    //insert user in db
            mysqli_close($conn);
            return -2;
        }
        
        mysqli_close($conn);
        return 1;
    }
    
    /** 
    * @author Simone Romano
    */
    function updateLastLogin($email, $now){        
        $conn = getConn();
        
        $sql = "UPDATE utente set lastLogin='{$now}' where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
    }
    
    /** 
    * @author Simone Romano
    */
    function updatePassword($email, $password){        
        $conn = getConn();
        
        $password = md5($password);
        
        $sql = "UPDATE utente set password='{$password}' where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
    }
    
    
    /** 
    * @author Simone Romano
    * Confirm user.
    */
    function confirmUser($email){        
        $conn = getConn();
        
        $sql = "UPDATE utente set confirmed='1' where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
    }
    
    function getCategory($category = NULL) {
        
        $returnValues = array();
        $conn = getConn();
        
        if($category != NULL) {
            $sql = "SELECT * FROM category WHERE name = '$category'";
        }
        else
            $sql = "SELECT * from category";
            
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $returnValues[] = $row;
            }
            mysqli_close($conn);
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }    
    
    function getCategories() {
        return getCategory();
    }
    
    function insertCategory($name) {
        $conn = getConn();
        $sql = "INSERT INTO category (name) VALUES ('$name')";
        $result = mysqli_query($conn, $sql) or die("Insert failed");
        return $result;
        /* restituisce sempre true */
    }
    
    function deleteCategory($name) {
        $conn = getConn();
        $sql = "DELETE FROM category WHERE name='$name'";
        $result = mysqli_query($conn, $sql) or die("Delete failed");
        return $result;
        /* restituisce sempre true */
    }
    
    //mancano gli allegati
    //utente fb ok, utente normale?
    function insertIdea($name, $description,  $idUser, $categories, $financier = NULL, $dateOfFinancing = NULL, $imPath) {
        $date = getTimeAndDate();
        $conn = getConn();
        /* if financier == NULL && $dateOfFinancing == NULL */
        $sql = "INSERT INTO idea (nome, dateOfInsert, description,  idUser, imPath) VALUES ('$name','$date','$description','$idUser', '$imPath')";
        $result = mysqli_query($conn, $sql) or die ("Insert failed");
        
        $idIdea = mysqli_insert_id($conn);
         
        $arrayOfIdCategories = array();
        foreach($categories as $category){
            $element = getCategory($category);
            $id = $element[0]['id'];
            $arrayOfIdCategories[] = $id;
        }
        
        $query = "INSERT INTO hasCategory (idCategory, idIdea) VALUES (?, '$idIdea')";
        $stmt = mysqli_prepare($conn,$query);
        $stmt->bind_param("s", $one);
        mysqli_query($conn,"START TRANSACTION");
        foreach ($arrayOfIdCategories as $one) {
            $stmt->execute();
        }
        $stmt->close();
        mysqli_query($conn,"COMMIT");
        mysqli_close($conn);
        return $result;
    }
    
    function isIdeaOfUser ($idUser, $idIdea) {
        $conn = getConn();
        $sql = "SELECT * FROM idea WHERE id = '$idIdea'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row['idUser'] == $idUser) {
                    return true;
                }
            }
            return false;
        }
        else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function hasAlreadyFollower($idUser,$idIdea) {
        $conn = getConn();
        $sql = "SELECT * FROM follow WHERE idIdea = '$idIdea'";
        $result = mysqli_query($conn, $sql) or die("Query failed");
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                if($row['idUser'] == $idUser) {
                    mysqli_close($conn);
                    return true;
                }
            }
            return false;
        }
        else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function insertFollower ($idUser, $idIdea) {
        if(isIdeaOfUser($idUser, $idIdea))
            return NULL;
        if(hasAlreadyFollower($idUser, $idIdea))
            return NULL;
        $date = getTimeAndDate();
        $conn = getConn();
        $sql = "INSERT INTO follow (idUser, idIdea, date) VALUES ('$idUser','$idIdea','$date')";
        $result = mysqli_query($conn, $sql) or die("Insert failed");
        return $result;
    }
    
    function getFollowersByIdIdea($idIdea) {
        return getFollowers(NULL, $idIdea);
    }
    
    function getIdeasFollowed($idUser) {
        return getFollowers($idUser);
    }
    
    function getFollowers($idUser = NULL, $idIdea = NULL) {
        $returnValues = array();
        $conn = getConn();
        
        if($idUser == NULL && $idIdea == NULL) {
            $sql = "SELECT * FROM follow";
        }
        else if($idUser != NULL && $idIdea == NULL)
            $sql = "SELECT * FROM follow WHERE idUser = '$idUser'";
        else if($idUser == NULL && $idIdea != NULL)
            $sql = "SELECT * FROM follow WHERE idIdea = '$idIdea'";
        else
            $sql = "SELECT * FROM follow WHERE (idIdea = '$idIdea' AND idUser = '$idUser')";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues[] = $row;
            }
            mysqli_close($conn);
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function getThreeMaxFollow(){
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT * FROM (SELECT idIdea, COUNT( idIdea ) AS countIdea FROM follow GROUP BY idIdea ) AS maxFollows ORDER BY countIdea DESC LIMIT 3";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $imPath = getIdeaById($row['idIdea'])['Idea']['imPath'];
                $returnValues[] = $imPath;
            }
        }
    
        mysqli_close($conn);
        return $returnValues;
    }

    
    /**
     * @author Simone Romano
     **/
    function getUserFollowers($email){        
        $returnValues = array();
        $conn = getConn();
        
        $sql = "Select count(*) from follow where idIdea in( SELECT id FROM idea WHERE idUser='{$email}')";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['count(*)'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
    /**
     * @author Simone Romano
     **/
    function getIdeaDescription($id){        
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select description from idea where id={$id}";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['description'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
    /**
     * @author Simone Romano
     **/
    function getIdeaImPath($id){        
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select imPath from idea where id={$id}";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['imPath'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
     /**
     * @author Simone Romano
     **/
    function getIdeaName($idIdea){        
        $returnValues = array();
        $conn = getConn();
        $toReturn = "";
        
        $sql = "select nome from idea where id='{$idIdea}'";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['nome'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }

    /**
     * @author Simone Romano
     * Return the count of comments for idas of $email user.
     **/
    function getCommentForUser($email){
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select count(*) from comment where idIdea in (select id from idea where idUser='{$email}')";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['count(*)'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
    /**
     * @author Simone Romano
     * Return the list of user ideas ordered by number of followers.
     **/
    function getUserIdeasOrderedByFollowers($email){
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select id from idea where idUser='{$email}'";
        $result = mysqli_query($conn, $sql) or die("select failed");
        $toReturn = array();
        $i = 0;
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $sql_followers = "select count(*) from follow where idIdea='{$row['id']}'";
                $result_followers_num = mysqli_query($conn, $sql_followers) or die("select failed");
                $followers_numb = 0;
                if (mysqli_num_rows($result_followers_num) > 0) {
                    // output data of each row
                    while($row_followers = mysqli_fetch_assoc($result_followers_num)) {
                        $followers_numb = $row_followers['count(*)'];                        
                    }
                }
                $record = array();
                $record[0] = $row['id'];
                $record[1] = $followers_numb;
                $index = 0;
                //inserting in crescent order
                //get index of new element
                for($j = 0; $j < sizeOf($toReturn); $j++) {
                    if ($toReturn[$j][1] > $record[1]){
                        $index = $j;
                        break;
                    }
                }
                //shifit of right part of array
                for($j = sizeOf($toReturn)-1; $j >= $index; $j--) {
                    $toReturn[$j+1] = $toReturn[$j];             
                }
                //insert new element
                $toReturn[$index] = $record;
                $i++;
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
    /**
     * @author Simone Romano
     * Return the max number of follower of an idea.
     **/
    function getMaxFollow(){
         $conn = getConn();
        
        $sql = "select max(countIdea) from
                (
                    select idIdea,count(idIdea) as countIdea from follow
                    group by idIdea
                ) as maxFollow";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['max(countIdea)'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
     /**
     * @author Simone Romano
     * Return the count user's ideas.
     **/
    function getUserIdeasCount($email){
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select count(*) from idea where idUser='{$email}'";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['count(*)'];
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
     /**
     * @author Simone Romano
     * Return last user activities. 
     **/
    function getLastUserActivities($email){
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select date,text,idIdea,'comment' as type from comment where idUser='{$email}'
                union all
                select date,idIdea,idUser,'follow' as type from follow where idUser='{$email}' 
                union all
                select dateOfFinancing,id,idUser,'financier' as type from idea where financier='{$email}'
                union all
                select dateOfInsert,nome,id,'insert' as type from idea where idUser='{$email}' 
                order by date;";
        $result = mysqli_query($conn, $sql) or die("select failed");
    
        mysqli_close($conn);
        return $result;
    }
    
    /**
     * @author Simone Romano
     * Return the count of financiers for idas of $email user.
     **/
    function getUserFinancier($email){        
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select count(*) from idea where idUser='{$email}' and financier is not null";
        $result = mysqli_query($conn, $sql) or die("select failed");
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                //echo "id: " . $row["id"]. " - Name: " . $row["name"] . "<br>";
                $toReturn = $row['count(*)'];
            }
        }
        mysqli_close($conn);
        return $toReturn;   
    }
    
    function insertComment ($idUser, $idIdea, $text, $score = NULL) {
        $date = getTimeAndDate();
        $conn = getConn();
        $sql = "INSERT INTO comment (idIdea, idUser, date, text, Score) VALUES ('$idIdea','$idUser','$date','$text', '$score')";
        $result = mysqli_query($conn, $sql) or die("Insert failed");
        mysqli_close($conn);
        return $result;
    }
    
    function getCommentsByIdIdea($idIdea) {
        return getComments(NULL, $idIdea);
    }
    
    function getUserComments($idUser) {
        return getComments($idUser, NULL);
    }
    
    function getComments($idUser = NULL, $idIdea = NULL) {
        $returnValues = array();
        $conn = getConn();
        
        if($idUser == NULL && $idIdea == NULL) {
            $sql = "SELECT * FROM comment";
        }
        else if($idUser != NULL && $idIdea == NULL) {
            $sql = "SELECT * FROM comment WHERE idUser = '$idUser'";
        }
        else if($idUser == NULL && $idIdea != NULL) {
            $sql = "SELECT * FROM comment WHERE idIdea = '$idIdea' ORDER BY date DESC";
        }
        else {
            $sql = "SELECT * FROM comment WHERE (idIdea = '$idIdea' AND idUser = '$idUser')";
        }
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues[] = $row;
            }
            mysqli_close($conn);
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function getIdeaById($idIdea) {
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT * FROM idea WHERE id = '$idIdea'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues['Idea'] = $row;
            }
            mysqli_close($conn);
            $returnValues['User'] = getUserOfIdea($idIdea);
            $returnValues['Followers'] = getFollowersByIdIdea($idIdea);
            $returnValues['Comments'] = getCommentsByIdIdea($idIdea);
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function getUserOfIdea($idIdea) {
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT idUser FROM idea WHERE id = '$idIdea'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $idUser = $row['idUser'];              
            }
        }
        else {
            mysqli_close($conn);
            return NULL;
        }
        $sql_user = "SELECT * FROM utente WHERE email = '$idUser'";
        $result_user = mysqli_query($conn, $sql_user);
        if (mysqli_num_rows($result_user) > 0) {
            while($row_user = mysqli_fetch_assoc($result_user)) {
                $returnValues = $row_user;
            }
            return $returnValues;
        }
        else {
            mysqli_close($conn);
            return NULL;
        }
        mysqli_close($conn);
    }
    
    function getNumberOfComments($idIdea) {
        $comments = getCommentsByIdIdea($idIdea);
        return count($comments);
    }
    
    function getNumberOfFollowers($idIdea) {
        $followers = getFollowersByIdIdea($idIdea);
        return count($followers);
    }
    
    function hasFinancier($idIdea) {
        $idea = getIdeaById($idIdea);
        if($idea['Idea']['financier'] == NULL)
            return false;
        return true;
    }
    
    function updateIdea($idIdea, $name, $description) {
        
    }
    
    function insertFinancier($idIdea, $idFinancier) {
        $date = getTimeAndDate();
        $idea = getIdeaById($idIdea);
        /* if $idea != null */
        /* if(exists($idFinancier) */
        if($idea['Idea']['idUser'] == $idFinancier)
            return "Non puoi finanziare una tua idea";
        else if($idea['Idea']['financier'] != NULL)
            return "Quest'idea ha gi� un finanziatore";
        else {
            $conn = getConn();
            $sql = "UPDATE idea SET financier = '$idFinancier', dateOfFinancing = '$date' WHERE id = '$idIdea'";
            $result = mysqli_query($conn, $sql);
            mysqli_close($conn);
        }    
    }
    
    function getNumberOfUserIdeas($idUser) {
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT * FROM idea WHERE idUser = '$idUser'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return count($result);
    }
    
    function getUserById($idUser) {
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT * FROM utente WHERE email = '$idUser'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues['User'] = $row;              
            }
            mysqli_close($conn);
            return $returnValues;
        }
        else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function getPointsForIdeaComments($idIdea) {
        $conn = getConn();
        $today = strtotime(getTimeAndDate());
        $ts = $today;
        
        // calculate the number of days since Monday
        $dow = date('w', $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        // calculate timestamp for the Monday
        $ts = $ts - $offset*86400;
        // loop from Monday till Sunday
        $comments = array();
        for ($i = 1; $i <= 7; $i++, $ts += 86400){
            $current_date = date("d-m-Y", $ts);
            $sql = "SELECT * FROM comment where idIdea = '$idIdea'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    if(!isCommentOfOwner($row['idUser'],$idIdea)) {
                        $comment_date = fromTimestampToDate(strtotime($row['date']));
                        if($comment_date == $current_date) {
                            $comments[$i][]= $row;
                        }
                    }
                }
            }
        }
        $values = array();
        $comment = array();
        for($i = 1; $i <= 7; $i++) {
            if(!empty($comments[$i])) {
                $j = 0;
                $sum_score = 0;
                foreach((array)$comments[$i] as $comment) {
                    $sum_score = $sum_score +  $comment['Score'];
                    $j++;
                }
                $values[$i] = $sum_score/$j;
            }
            else
                $values[$i] = 0;
        }
        
        return $values;
    }
    
    /* comprende anche i commenti dell'utente */
    function getNumberOfCommentsOfLastWeekByIdIdea($idIdea) {
        $conn = getConn();
        $today = strtotime(getTimeAndDate());
        $ts = $today;
        
        // calculate the number of days since Monday
        $dow = date('w', $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        // calculate timestamp for the Monday
        $ts = $ts - $offset*86400;
        // loop from Monday till Sunday
        $comments = array();
        for ($i = 1; $i <= 7; $i++, $ts += 86400){
            $current_date = date("d-m-Y", $ts);
            $sql = "SELECT * FROM comment where idIdea = '$idIdea'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $comment_date = fromTimestampToDate(strtotime($row['date']));
                    if($comment_date == $current_date) {
                        $comments[$i][]= $row;
                    }  
                }
            }
        }
        $return = 0;
        for($i = 1; $i <= 7; $i++) {
            if(!empty($comments[$i])) {
                foreach((array)$comments[$i] as $comment) {
                    $return++;
                }
            }
        }
        return $return;
    }
    
    function getTotalScoreOfLastWeekByIdIdea($idIdea) {
        $conn = getConn();
        $today = strtotime(getTimeAndDate());
        $ts = $today;
        
        // calculate the number of days since Monday
        $dow = date('w', $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        // calculate timestamp for the Monday
        $ts = $ts - $offset*86400;
        // loop from Monday till Sunday
        $comments = array();
        for ($i = 1; $i <= 7; $i++, $ts += 86400){
            $current_date = date("d-m-Y", $ts);
            $sql = "SELECT * FROM comment where idIdea = '$idIdea'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    if(!isCommentOfOwner($row['idUser'],$idIdea)) {
                        $comment_date = fromTimestampToDate(strtotime($row['date']));
                        if($comment_date == $current_date) {
                            $comments[$i][]= $row;
                        }
                    }
                }
            }
        }
        
        $return = 0;
        for($i = 1; $i <= 7; $i++) {
            if(!empty($comments[$i])) {
                foreach((array)$comments[$i] as $comment) {
                    $return = $return + $comment['Score'];
                }
            }
        }
        return $return;
    }
    
    function isCommentOfOwner($idUser, $idIdea) {
        $user = getUserOfIdea($idIdea);
        if($idUser == $user['email'])
            return true;
        return false;
    }
    
    function getIdeas() {
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT * FROM idea";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues['Idea'] = $row;
            }
            mysqli_close($conn);
            $returnValues['User'] = getUserOfIdea($returnValues['Idea']['id']);
            $returnValues['Followers'] = getFollowersByIdIdea($returnValues['Idea']['id']);
            $returnValues['Comments'] = getCommentsByIdIdea($returnValues['Idea']['id']);
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    
    function getIdeasByCategory($category) {
        $returnValues = array();
        $conn = getConn();
        $idCategory = getCategory($category)[0]['id'];
        print_r($idCategory);
        
        $sql = "SELECT * FROM hasCategory WHERE idCategory = '$idCategory'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues[] = $row;
            }
            mysqli_close($conn);
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
    function getIdeasOrderedByFollowers(){
        $returnValues = array();
        $conn = getConn();
        
        $sql = "select id from idea";
        $result = mysqli_query($conn, $sql) or die("select failed");
        $toReturn = array();
        $i = 0;
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $sql_followers = "select count(*) from follow where idIdea='{$row['id']}'";
                $result_followers_num = mysqli_query($conn, $sql_followers) or die("select failed");
                $followers_numb = 0;
                if (mysqli_num_rows($result_followers_num) > 0) {
                    // output data of each row
                    while($row_followers = mysqli_fetch_assoc($result_followers_num)) {
                        $followers_numb = $row_followers['count(*)'];                        
                    }
                }
                $record = array();
                $record[0] = $row['id'];
                $record[1] = $followers_numb;
                $index = 0;
                //inserting in crescent order
                //get index of new element
                for($j = 0; $j < sizeOf($toReturn); $j++) {
                    if ($toReturn[$j][1] > $record[1]){
                        $index = $j;
                        break;
                    }
                }
                //shifit of right part of array
                for($j = sizeOf($toReturn)-1; $j >= $index; $j--) {
                    $toReturn[$j+1] = $toReturn[$j];             
                }
                //insert new element
                $toReturn[$index] = $record;
                $i++;
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    
    function getIdeasOrderedByFollowersByCategory($category){
        $returnValues = array();
        $conn = getConn();
        $category = getCategory($category)[0]['id'];
        $sql = "SELECT id FROM idea WHERE id IN ( SELECT idIdea FROM hasCategory WHERE idCategory =  '$category')";
        $result = mysqli_query($conn, $sql) or die("select failed");
        $toReturn = array();
        $i = 0;
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $sql_followers = "select count(*) from follow where idIdea='{$row['id']}'";
                $result_followers_num = mysqli_query($conn, $sql_followers) or die("select failed");
                $followers_numb = 0;
                if (mysqli_num_rows($result_followers_num) > 0) {
                    while($row_followers = mysqli_fetch_assoc($result_followers_num)) {
                        $followers_numb = $row_followers['count(*)'];                        
                    }
                }
                $record = array();
                $record[0] = $row['id'];
                $record[1] = $followers_numb;
                $index = 0;
                //inserting in crescent order
                //get index of new element
                for($j = 0; $j < sizeOf($toReturn); $j++) {
                    if ($toReturn[$j][1] > $record[1]){
                        $index = $j;
                        break;
                    }
                }
                //shifit of right part of array
                for($j = sizeOf($toReturn)-1; $j >= $index; $j--) {
                    $toReturn[$j+1] = $toReturn[$j];             
                }
                //insert new element
                $toReturn[$index] = $record;
                $i++;
            }
        }
    
        mysqli_close($conn);
        return $toReturn;
    }
    /** 
    * @author Simone Romano
    */
    function insertFBUser($email, $name, $sex, $picture, $birthday, $now){
        $conn = getConn();
        
        $nameSurname = explode (" " ,$name);    
        //people can have more than 1 name!
        $name = $nameSurname[0];
        $surname = $nameSurname[1];
        
        $sql = "INSERT INTO utente(name,surname,dateOfBirth,email,sex,imPath,confirmed,lastLogin,registrationDate) values('{$name}','${surname}','{$birthday}','{$email}','{$sex}','{$picture}','1','{$now}','{$now}')";
        
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
    }
    
    /**
     * @author Simone Romano
     * Register new User into system
     **/
    function insertUser($email,$password, $name, $surname, $picture, $birthday, $webPage){
        $conn = getConn();
        
        $validationCode = md5($email . $name);        
        $nameSurname = explode (" " ,$name); 
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        
        //check user already in db
        $sql = "select confirmed from utente where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $confirmed = $row['confirmed'];
                if ($confirmed == 1){
                    mysqli_close($conn);
                    return -1;
                }
                else{
                    mysqli_close($conn);
                    return -2;
                }
            }            
        }       
        $password = md5($password);
        $sql = "INSERT INTO utente(name,surname,dateOfBirth,webPage,email,password,imPath,confirmed,registrationDate,validationCode) values('{$name}','${surname}','{$birthday}','{$webPage}','{$email}','{$password}','{$picture}','0','{$now}', '{$validationCode}')";
        
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
        
        
        //send confirmation email
        $validationLink = "<a href='http://localhost/WebSemantico/OpenIdeas/validation.php?email={$email}&name={$name}'>Conferma</a></body></html>";
        
        // definisco mittente e destinatario della mail
        $nome_mittente = "OpenIdeas";
        $mail_mittente = "";
        $mail_destinatario = "{$email}";

        // definisco il subject
        $mail_oggetto = "Registrazione";
        
        // definisco il messaggio formattato in HTML
        $mail_corpo = <<<HTML
        <html>
        <head>
          <title>Registrazione al portale OpenIdeas</title>
        </head>
        <body>
        La tua registrazione al portale <a href='http://localhost/WebSemantico/OpenIdeas/index.php'>OpenIdeas</a>
            � quasi completa. Clicca al link seguente per confermare<br>
            {$validationLink}
        </body>
        </html>
HTML;

        // aggiusto un po' le intestazioni della mail
        // E' in questa sezione che deve essere definito il mittente (From)
        // ed altri eventuali valori come Cc, Bcc, ReplyTo e X-Mailer
        $mail_headers = "From: " .  $nome_mittente . " <" .  $mail_mittente . ">\r\n";
        $mail_headers .= "Reply-To: " .  $mail_mittente . "\r\n";
        $mail_headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
    
        // Aggiungo alle intestazioni della mail la definizione di MIME-Version,
        // Content-type e charset (necessarie per i contenuti in HTML)
        $mail_headers .= "MIME-Version: 1.0\r\n";
        $mail_headers .= "Content-type: text/html; charset=iso-8859-1";
        
        if (mail($mail_destinatario, $mail_oggetto, $mail_corpo, $mail_headers))
          echo "Messaggio inviato con successo a " . $mail_destinatario;
        else
          echo "Errore. Nessun messaggio inviato.";
    }
    
    /**
     * @author Simone Romano
     * Validate user registration
     **/
    function checkValidation($email, $name){
        $conn = getConn();
        
        $validationCode = md5($email . $name);       
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        
        $sql = "select validationCode from utente where email='{$email}'";
        
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $validationCodeInDb = $row['validationCode'];
                echo"{$validationCode} {$validationCodeInDb}";
                if ($validationCode == $validationCodeInDb){
                    return true;
                }
                else
                    return false;
            }
        }
        return false;
        
        mysqli_close($conn);
    }
    
    function getTest($email){
        $conn = getConn();
        
        $sql = "SELECT * from ";
        
        
        mysqli_close($conn);
    }
?>