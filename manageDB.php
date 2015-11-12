<?php
    
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
            }
            // output data of each row
            /*while($row = mysqli_fetch_assoc($result)) {
                echo "id: " . $row["name"]. " - Name: " . $row["email"]. " " . $row["surname"]. "<br>";
            }*/
        } else {    //insert user in db
            insertFBUser($email, $name, $sex, $picture, $birthday);
        }
        
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
    //modificare db per date!
    //http://stackoverflow.com/questions/13063980/mysql-default-datetime-through-phpmyadmin
    //ID IDEA????????
    function insertIdea($name, $description,  $idUser, $categories, $financier = NULL) {
        $date = getTimeAndDate();
        //$date = "2014-11-12";
        $conn = getConn();
        
        echo $name . '<br>';
        echo $date . '<br>';
        echo $description . '<br>';
        echo $idUser . '<br>';
        echo $financier . '<br>';
        
        $sql = "INSERT INTO idea (nome, dateOfInsert, description,  idUser, financier) VALUES ('$name','$date','$description','$idUser', '$financier')";
        $result = mysqli_query($conn, $sql) or die("Insert failed");
        
        
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
    
    /* se l'idea � sua, non pu� seguirla!!! */
    function insertFollower ($idUser, $idIdea) {
        
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

    //???
    //modificare db per rendere univoco date
    function insertComment ($idUser, $idIdea, $text) {
        $date = getTimeAndDate();
        $conn = getConn();
        $sql = "INSERT INTO comment (idIdea, idUser, date, text) VALUES ('$idIdea','$idUser','$date','$text')";
        $result = mysqli_query($conn, $sql) or die("Insert failed");
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
            $sql = "SELECT * FROM comment WHERE idIdea = '$idIdea'";
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
    
    
    /* ci interessa anche l'utente? */
    function getIdeaById($idIdea) {
        $returnValues = array();
        $conn = getConn();
        $sql = "SELECT * FROM idea WHERE id = '$idIdea'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $returnValues[] = $row;
            }
            mysqli_close($conn);
            $returnValues[] = getFollowersByIdIdea($idIdea);
            $returnValues[] = getCommentsByIdIdea($idIdea);
            
            return $returnValues;
        } else {
            mysqli_close($conn);
            return NULL;
        }
    }
    
        /** 
    * @author Simone Romano
    */
    function insertFBUser($email, $name, $sex, $picture, $birthday){
        $conn = getConn();
        
        $nameSurname = explode (" " ,$name);    
        //people can have more than 1 name!
        $name = $nameSurname[0];
        $surname = $nameSurname[1];
        
        $now = (new \DateTime())->format('Y-m-d H:i:s');
        $sql = "INSERT INTO utente(name,surname,dateOfBirth,email,sex,imPath,confirmed,lastLogin) values('{$name}','${surname}','{$birthday}','{$email}','{$sex}','{$picture}','1','{$now}')";
        
        $result = mysqli_query($conn, $sql);
        
        echo"{$result}";
        mysqli_close($conn);
    }
    
    /** 
    * @author Simone Romano
    */
    function insertUser(){
        
    }
    
    function getTest($email){
        $conn = getConn();
        
        $sql = "SELECT * from ";
        
        
        mysqli_close($conn);
    }
?>