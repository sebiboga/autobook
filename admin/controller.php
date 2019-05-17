<?php 
$t = date("Y-m-d");

 if (isset($_POST['rca'])) {$rca = $_POST['rca']; 
 if (isset($_POST['car'])) {$car = $_POST['car']; }
 
 
$rca = date("Y-m-d", strtotime($rca) );
 
 require_once('dbconnect.php');
 $sql="UPDATE  vin SET rca = '$rca', rcat='$t' WHERE rn='$car'";
 $result = $con -> query($sql);
 
 }
 
 if (isset($_POST['itp'])) {$itp = $_POST['itp']; 
  if (isset($_POST['vin'])) {$vin = $_POST['vin']; }
 
 $itp = date("Y-m-d", strtotime($itp) );
 
 require_once('dbconnect.php');
 $sql="UPDATE  vin SET itpt='$t' WHERE vin='$vin'";
 $result = $con -> query($sql);
 
 require_once('dbconnect.php');
 $sql="UPDATE  vin SET itp = '$itp', itpt='$t' WHERE vin='$vin'";
 $result = $con -> query($sql);
  }
 
 
 if (isset($_POST['vigneta'])) {$vigneta = $_POST['vigneta']; 
 if (isset($_POST['vin'])) {$vin = $_POST['vin']; }

 $vigneta = date("Y-m-d", strtotime($vigneta) ); 
  
 require_once('dbconnect.php');
 $sql="UPDATE  vin SET rot='$t' WHERE vin='$vin'";
 $result = $con -> query($sql);
	  
  
  
 require_once('dbconnect.php');
 $sql="UPDATE  vin SET rovigneta = '$vigneta',rot='$t' WHERE vin='$vin'";
 $result = $con -> query($sql);
 
 
 }
 
 if (isset($_POST['tel'])&&($_POST['tel']!='')){$tel = $_POST['tel'];
  
 require_once('dbconnect.php');
 $car = $_COOKIE['auto'];
 $sql="UPDATE  vin SET tel = '$tel' WHERE rn='$car'";
  $result = $con -> query($sql);
 
 }
 if (isset($_POST['email'])&&($_POST['email']!='')){$email = $_POST['email'];
  
 require_once('dbconnect.php');
 $car = $_COOKIE['auto'];
 $sql="UPDATE  vin SET email = '$email' WHERE rn='$car'";
  $result = $con -> query($sql);
 }
 
 
header('Location: ../admin');
 
?>