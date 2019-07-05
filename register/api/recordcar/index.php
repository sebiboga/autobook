<?php 
function GUID() {
    if (function_exists('com_create_guid') === true)
    {return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function rnvalid($number){ 
		$number = $string = str_replace(' ', '', $number);
		$number = $string = str_replace('-', '', $number);
		
 
 
  $valid=false;
  $c1 = array("AB","AG","AR","BC","BH","BN","BR","BT","BV","BZ","CJ","CL","CS","CT","CV","DB","DJ","GJ","GL","GR","HD","HR","IF","IL","IS","MH","MM","MS","NT","OT","PH","SB","SJ","SM","SV","TL","TM","TR","VL","VN","VS");

  if (in_array(substr(strtoupper($number),0,2),$c1)) { 
  
    if (is_numeric(substr($number,2,3))) {
		if (ctype_alpha(substr($number,5,3))) {$valid=true;}
		
		} else {
		if (is_numeric(substr($number,2,2))) {
			if (ctype_alpha(substr($number,4,3))) {$valid=true;}
		}	
		}
	} else {
	if (substr($number,0,1)=="B") {
		if (is_numeric(substr($number,1,3))) {
		  if (ctype_alpha(substr($number,4,3))) {$valid=true;}
		} else {
			if (is_numeric(substr($number,1,2))) {
			  if (ctype_alpha(substr($number,4,3))) {$valid=true;}
			}
		}
	} else {
		if (substr($number,0,3)=="MAI") { $valid=true;}
		 else {
		if (substr($number,0,1)=="A")	{ $valid=true;}
		 else {
		if (substr($number,0,2)=="CD")	{ $valid=true;}
         else {
		if (substr($number,0,2)=="TC")	{ $valid=true;}	 
		  else {
		if (substr($number,0,2)=="CO")	{ $valid=true;}
		else {
		if (substr($number,0,2)=="FA")	{ $valid=true;} 
		else {
		if (substr($number,0,3)=="ALA")	{ $valid=true;} 	
		 }
		 }
		 }
		 }		
		 }
		 }
		
	   }
  }

  return $valid;  
}

function valid($phone){
	$result = true;
	if (substr($phone,0,2)!='07') {$result=false;}
	if (is_numeric($phone)==1) {} else {$result=false;} 
	return $result;
}


  

if (isset($_POST['tel']) && (trim($_POST['tel'])!='')) {
	$id=GUID();
    $tel=$_POST['tel'];
	if (valid($tel)) {
		
   require_once('dbconnect.php');
     //validez daca exista deja nr tel in baza de date - returnez id-ul
	 $sql="SELECT id FROM autobook_user WHERE tel='$tel'";
	 $result = $con -> query($sql);
	 if ($result->num_rows > 0) {
		 while ($rws=$result->fetch_assoc()){
			  $id = $rws['id'];
		 }
	 } else {
	 //
	
    $sql="INSERT INTO autobook_user(id,tel) VALUES ('$id','$tel')";
	 $result = $con -> query($sql);}
	 $idtel = $id;



if (isset($_POST['car']) && (trim($_POST['car'])!='')) {
	$id=GUID();
    $car=$_POST['car'];
	if (rnvalid($car)) {
	echo "car number is valid"; echo "<br/>";
    require_once('dbconnect.php');
	 //validez daca am vin empty si nr auto deja in DB... atunci nu mai adaug nr auto inca o data.. si returnez id
	  $sql="SELECT id FROM autobook_vin WHERE vin IS NULL AND rn='$car'";
	  $result = $con -> query($sql);
	 	 if ($result->num_rows > 0) {
		  while ($rws=$result->fetch_assoc()){
			  $id = $rws['id'];
		 }
	   } else {
	 //
	 $car=strtoupper($car);
     $sql="INSERT INTO autobook_vin(id,rn) VALUES ('$id','$car')";
	   $result = $con -> query($sql);}
	$idcar = $id;
	}}}

if (isset($idcar) && isset($idtel)) {
	$id=GUID();
	
	 require_once('dbconnect.php');
	 //daca exista o combinatie iduser idvin deja in autobook_link... nu mai creea duplicat
	 $sql="SELECT id FROM autobook_link WHERE iduser='$idtel' AND idvin='$idcar'";
	 $result = $con -> query($sql);
	 	 if ($result->num_rows > 0) {
		  while ($rws=$result->fetch_assoc()){
			  $id = $rws['id'];
		 } }else {
	 //
      $sql="INSERT INTO autobook_link(id,iduser,idvin) VALUES ('$id','$idtel','$idcar')";
		 $result = $con -> query($sql);}
   
	
}
} echo '{"msg":"Multumim. Autovehicolul tau a fost inregistrat!"}';
 
?>