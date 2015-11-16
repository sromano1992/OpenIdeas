<?php
    $fileName = $_POST['file_name'];
    print_r($_POST);
    if (isset($_FILES['upload_file'])) {
        if(move_uploaded_file($_FILES['upload_file']['tmp_name'], "userImg/" . $fileName)){
            echo "uploaded file " + $fileName;
        } else {
            echo "uploaded file " + $fileName + " :KO";
        }
        exit;
    } else {
        echo "No files uploaded ...";
    }
?>