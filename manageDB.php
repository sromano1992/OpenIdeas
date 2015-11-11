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
    
    function getUserFBLogin($email){
        $conn = getConn();
        
        $sql = "SELECT * from utente";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                echo "id: " . $row["name"]. " - Name: " . $row["email"]. " " . $row["surname"]. "<br>";
            }
        } else {
            echo "0 results";
        }
        
        mysqli_close($conn);
    }
    
    function getTest($email){
        $conn = getConn();
        
        $sql = "SELECT * from utente";
        
        
        mysqli_close($conn);
    }
?>