<?php 

	if (isset($_GET['id'])) {$id=$_GET['id'];} else {$id='';}
	if (isset($_GET['vin'])) {$vin=$_GET['vin'];} else {$vin='';}
   require_once('dbconnect.php');
   
   $sql = "UPDATE autobook_vin SET vin='$vin' WHERE id='$id'";
   $result = $con -> query($sql);
    echo '{"msg":"Multumim. Datele sunt complete acum."}';
	 
?>
