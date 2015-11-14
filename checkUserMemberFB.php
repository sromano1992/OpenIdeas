<?php
    require 'manageDB.php';
    $email = $_POST['email'];
    $name = $_POST['name'];
    $sex = $_POST['sex'];
    $picture = $_POST['picture'];
    $birthday = $_POST['birthday'];
    getUserFBLogin($email, $name, $sex, $picture, $birthday);
?>