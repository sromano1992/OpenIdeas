<?php
    
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
    function updateLastLogin($email, $now){        
        $conn = getConn();
        
        $sql = "UPDATE utente set lastLogin='{$now}' where email='{$email}'";
        $result = mysqli_query($conn, $sql);
        
        mysqli_close($conn);
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
    */
    function insertUser(){
        
    }
    
    function getTest($email){
        $conn = getConn();
        
        $sql = "SELECT * from ";
        
        
        mysqli_close($conn);
    }
?>