<?php 

 if (isset($_POST['rca'])) {$rca = $_POST['rca']; 
 if (isset($_POST['car'])) {$car = $_POST['car']; }
 
  $day   = substr($rca,0,2);
  $month = substr($rca,3,2);
  $year  = substr($rca,6,4);
  $rca   = $year.'-'.$month.'-'.$day;
 require_once('dbconnect.php');
 $sql="UPDATE  vin SET rca = '$rca' WHERE rn='$car'";
 $result = $con -> query($sql);
 echo $rca;
 }

 
 
?>