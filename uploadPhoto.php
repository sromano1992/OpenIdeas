<!DOCTYPE html>
<html>
<head>
	<link href="css/bootstrap.css" rel="stylesheet">
</head>
<body>



<?php 
error_reporting(0);

$target = 'galleryTmp/'; 
$target = $target . basename( $_FILES['photo']['name']); 

$pic=($_FILES['photo']['name']); 

if(move_uploaded_file($_FILES['photo']['tmp_name'], $target)) 
{ 
echo("<div class='alert alert-success'><p>L'allegato <em>".$_FILES['photo']['name']."</em> è stato caricato!</p></div>");

} 
else { 
//
} 
?>
</body>
</html>
