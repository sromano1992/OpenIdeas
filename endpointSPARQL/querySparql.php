<?php
    require "manageEndpointSparql.php";
    $query = $_POST['query'];
    $format = $_POST['format'];
    $result = sparqlQuery($query, $format);
    echo "{$result}";    
    header('Content-Disposition: attachment; filename="result.txt"');
?>