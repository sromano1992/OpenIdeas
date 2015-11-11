<?php
    require 'manageDB.php';
    
    session_start();
    if (!isset($_SESSION['email'])){
        $_SESSION['email'] =  $_POST['email'];
    }
    
    $email = $_POST['email'];
    getUserFBLogin($email);
?>