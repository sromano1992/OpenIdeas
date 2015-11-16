 <!DOCTYPE html>
<html>
<body>

<?php

$nome = $_POST["nome_summary"];
$descrizione = $_POST["descr_summary"];
$idUser = $_GET["idUser"];
$path_foto=$_POST["path_summary"];
$url_video=$_POST["url_summary"];
$dataInserimento="2015-01-01";

echo $nome."<br>";
echo $descrizione."<br>";
if (!empty($idUser)) echo "idUser: ".$idUser;
echo $path_foto."<br>";
echo $url_video."<br>";
//if (!empty($idUser)) 
//echo "idUser:".$idUser."aaaaa<br>";
$conn = mysql_connect('localhost:3306', 'root', 'root');
if (!$conn) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully<br>';
mysql_select_db("ws") or die(mysql_error());

//$sql = "INSERT INTO idea (nome, dateOfInsert, description, idUser, path_foto, url_video) VALUES ('$nome', '$dataInserimento', '$descrizione', '$idUser', '$path_foto', '$url_video')";
$sql="INSERT INTO idea(nome, dateOfInsert, description, idUser, path_foto, url_video) VALUES ('ciro','2014-01-01','ciro', 'ciro@gmail.com','ciro','ciro')";
$result = mysql_query($sql);
or die(mysql_error());  

$row = mysql_fetch_array( $result );
//echo "Name: ".$row['name'];
echo 'Connected closed';
mysql_close($conn);
?>


</body>
</html>