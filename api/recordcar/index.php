<?php 

function GUID() {
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

  $vin=$car='';
  $id=GUID();
  $ok=0;
 if (isset($_POST['vin'])) { $vin=$_POST['vin']; $ok=1;}
 
 if (isset($_POST['car'])) {
		$car=$_POST['car'];
		$ok=1; 
		$car = str_replace("-","",$car); 
		$car = str_replace(" ","",$car); 
		$car =  strtoupper($car);

//set cookie auto		
$cookie_name = "auto";
$cookie_value = $car;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//end set cookie auto
	

		
		
		
		} else {
			
	if(isset($_COOKIE['auto'])) {
		$car=$_COOKIE['auto'];
		$ok=1; 
		$car = str_replace("-","",$car); 
		$car = str_replace(" ","",$car); 
		$car =  strtoupper($car);
		
//set cookie auto		
$cookie_name = "auto";
$cookie_value = $car;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//end set cookie auto	
		
		
	}
			
		}
		
 if ($vin==''&&$car=='') {$ok=0;}
 
 
 // verificare in DB daca exista auto+vin deja
 
 
 require_once('dbconnect.php');
 $sql= "SELECT * FROM vin WHERE vin='$vin' AND rn='$car'";
 $result = $con -> query($sql);
 $t = date("Y-m-d H:i:s");
 if ($result->num_rows > 0) {$ok=0;}
 
  // in cazul in care am deja un VIN+AUTO si acuma introduc doar AUTO atunci nu insera un record nou
  
  if ($vin=='' && isset($_POST['car'])) {
  require_once('dbconnect.php');
 $sql= "SELECT * FROM vin WHERE  rn='$car'";
 $result = $con -> query($sql);
 $t = date("Y-m-d H:i:s");
 if ($result->num_rows > 0) {$ok=0;}
  }
 
 
  // in cazul in care VIN exista deja in DB si auto empty in DB nu mai fac insert
   
   if (isset($_POST['vin'])) {
  require_once('dbconnect.php');
 $sql= "SELECT * FROM vin WHERE  vin='$vin' AND rn=''";
 $result = $con -> query($sql);
 $t = date("Y-m-d H:i:s");
 if ($result->num_rows > 0) {$ok=0;}
 

//set cookie 
$cookie_name = "vin";
$cookie_value = $vin;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day		
//end_set cookie vin		
 
  }
  
 // in cazul in care exista VIN exista deja dar nu am nr AUTO atunci : 1) delete record cu AUTO dar vin empty;  2) sterg record cu VIN daca AUTO e empty; insert vin si auto
 // sau in cazul in care VIN e empty si AUTO exista 
 
 
if (isset($_POST['vin']) && isset($_POST['car'])) {
  require_once('dbconnect.php');
 $sql= "SELECT * FROM vin WHERE  vin='$vin' AND rn='' ";
 $result = $con -> query($sql);
 
 
 $sql3= "SELECT * FROM vin WHERE  vin='' AND rn='$car' ";
 $result3 = $con -> query($sql3);
 
 $t = date("Y-m-d H:i:s");
if (($result->num_rows > 0)||(($result3->num_rows > 0))) {
	  $sql2 = "DELETE FROM vin WHERE vin='' AND rn='$car' ";
	  $result2 = $con -> query($sql2);
	  
	  $sql2 = "DELETE FROM vin WHERE vin='$vin' AND rn='' ";
	  $result2 = $con -> query($sql2);
	  
	 $ok=1;}
	 
	 
 
	 
  } 
  
  
  //caz in care de la tastatura introduc VIN dar deja am VIN+AUTO in DB sau am in DB doar VIN
   if (isset($_POST['vin'])) {
	   echo "HELLO";
  require_once('dbconnect.php');
 $sql= "SELECT * FROM vin WHERE  vin='$vin'";
 $result = $con -> query($sql);
 $t = date("Y-m-d H:i:s");
 if ($result->num_rows > 0) {$ok=0;}
  }
 
 if ($ok==1) {
if(isset($_COOKIE['vin'])) {$vin=$_COOKIE['vin'];}
 
 $sql="INSERT INTO vin(id,vin,rn,timestamp) VALUES ('$id','$vin','$car','$t')";
 $result = $con -> query($sql);
 echo '{"msg":"new car"}';
 }
?>