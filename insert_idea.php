 <!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body style="background:rgb(240, 241, 242)">

<?php
error_reporting(0);
require "manageDB.php";
require "endpointSPARQL/manageEndpointSparql.php";
$nome = $_POST["nome_summary"];
$descrizione = $_POST["descr_summary"];
$idUser = $_GET["idUser"];
$path_foto=$_POST["path_summary"];
$url_video=$_POST["url_summary"];
$selectOption = $_POST['selectSum'];
$dataInserimento= getTimeAndDate();
$Lastresult=" ";

/*echo "sel: ".$selectOption."*<br>";
echo $nome."<br>";
echo $descrizione."<br>";
echo "idUser: ".$idUser;
echo $path_foto."<br>";
echo $url_video."<br>";*/
//if (!empty($idUser)) 
//echo "idUser:".$idUser."aaaaa<br>";
$conn = mysql_connect('localhost', 'root', 'root');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully<br>';
mysql_select_db("ws") or die(mysql_error());

$sql = "INSERT INTO idea (nome, dateOfInsert, description, idUser, imPath, url_video) VALUES ('$nome', '$dataInserimento', '$descrizione', '$idUser', '$path_foto', '$url_video')";
//echo "{$sql}";
$result = mysql_query($sql) ;//or die(mysql_error()); 


$sql = "SELECT id FROM category WHERE name='".$selectOption."'";
$result = mysql_query($sql) ;//or die(mysql_error());  
$row = mysql_fetch_array( $result );
$idCat = $row['id'];
//echo "idcat: ".$idCat;

$sql = "SELECT id FROM idea WHERE nome='".$nome."' AND idUser='".$idUser."'";
//echo $sql;
$result = mysql_query($sql) ;//or die(mysql_error());  
$row = mysql_fetch_array( $result );
$idIdea = $row['id'];
//echo "idIdea: ".$idIdea;

$sql = "INSERT INTO hascategory (idCategory, idIdea) VALUES ('$idCat', '$idIdea')";
$Lastresult = mysql_query($sql) ;//or die(mysql_error()); 

//upload idea into fuseki
$urlIdea = "http://localhost/WebSemantico/OpenIdeas/idea.php?id=" . $idIdea;
uploadIdeaInSparqlEndpoint($idIdea,$urlIdea,$selectOption,$nome);


//echo "idIdea: ".$row['id'];
//echo 'Connected closed';
if (!empty($Lastresult))
echo("<div class='alert alert-success'><p>L'idea è stata aggiunta.</p></div>");

mysql_close($conn);
?>


</body>
</html>