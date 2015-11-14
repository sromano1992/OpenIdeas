<?php
    require "manageDB.php";
    $email = $_GET['email'];
    $name = $_GET['name'];
    if (checkValidation($email,$name)){
        confirmUser($email);
        echo"<script>alert('La registrazione è andata a buon fine. Ora puoi effettuare il login')</script>";
        header("location: login.php");
    }
?>