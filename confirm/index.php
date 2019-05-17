<?php 
if (isset($_GET['id']) && ($_GET['id']!='')) {
	$id = $_GET['id'];
   require_once('dbconnect.php');
 	 $sql="UPDATE autobook_link SET valid='1' WHERE id='$id'";
	 $result = $con -> query($sql);
	  echo "Felicitari! Acum sunteti membru autobook SPACE ; Verifica beneficiile ;)";
}

 
?>