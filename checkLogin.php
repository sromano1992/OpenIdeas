<?php
    require "manageDB.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = checkUserPassword($email,$password);
    echo "{$result}";
?>