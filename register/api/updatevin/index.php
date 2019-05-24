<?php 

	if (isset($_POST['id'])) {$id=$_POST['id'];} else {$id='';}
	if (isset($_POST['vin'])&&(trim($_POST['vin'])!='')&&(strlen($_POST['vin'])==17)&&(ctype_alnum($_POST['vin']))) {$vin = strtoupper($_POST['vin']);
   require_once('dbconnect.php');
   
   $sql = "UPDATE autobook_vin SET vin='".$vin."' WHERE id='".$id."'";
   $result = $con -> query($sql);
    echo '{"msg":"Multumim. Datele sunt complete acum."}';
	} 
?>
