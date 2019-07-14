<?php 
$t = date("Y-m-d");
 if (isset($_POST['car'])) {$car = $_POST['car']; 
 
 if (isset($_POST['rca'])) {$rca = $_POST['rca']; 
							$rca = date("Y-m-d", strtotime($rca) );
							}

 if (isset($_POST['itp'])) {$itp = $_POST['itp'];
							 $itp = date("Y-m-d", strtotime($itp) );
							 }
 if (isset($_POST['vin'])) {$vin = $_POST['vin']; }
 if (isset($_POST['vigneta'])) {$vigneta = $_POST['vigneta']; 
								$vigneta = date("Y-m-d", strtotime($vigneta) );
								 }
 

 
 require_once('dbconnect.php');
 $sql="UPDATE  autobook_vin SET rca = '$rca' WHERE rn='$car'";
 $result = $con -> query($sql);

 $sql="UPDATE  autobook_vin SET itp = '$itp' WHERE rn='$car'";
 $result = $con -> query($sql);
  
 $sql="UPDATE  autobook_vin SET rovigneta = '$vigneta' WHERE rn='$car'";
 $result = $con -> query($sql);
 
 }

 
 
header('Location: ../admin');
 
?>