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