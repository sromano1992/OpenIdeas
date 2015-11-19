
<?php

require 'manageDB.php';

$cats = getCategories();
	echo "<option> Select category </option>";
foreach ($cats as $cat) {
 	echo "<option value ='".$cat['name']."'>".$cat['name']."</option>"; 
 } 


?>

