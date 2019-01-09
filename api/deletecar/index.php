<?php 
 $rn='';
 if (isset($_GET['vin'])) {$vin = $_GET['vin']; }
  if (isset($_GET['auto'])) {$auto = $_GET['auto']; }
 require_once('dbconnect.php');
 $sql="DELETE FROM vin WHERE rn = '$auto' AND vin='$vin'";
 $result = $con -> query($sql);
 
 

		
 
 echo "DONE";		
?>


