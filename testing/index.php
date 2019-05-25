<?php 

function rnvalid($number){ 
		$number = $string = str_replace(' ', '', $number);
		$number = $string = str_replace('-', '', $number);
		$number=strtoupper($number);
  $valid=false;
  $c1 = array("AB","AG","AR","BC","BH","BN","BR","BT","BV","BZ","CJ","CL","CS","CT","CV","DB","DJ","GJ","GL","GR","HD","HR","IF","IL","IS","MH","MM","MS","NT","OT","PH","SB","SJ","SM","SV","TL","TM","TR","VL","VN","VS");

  if (in_array(substr($number,0,2),$c1)) { 
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
		if (substr($number,0,1)=="A")	{ 
		     $n=strlen($number)-1;
			 if (is_numeric(substr($number,1,$n))) {$valid=true;}
			 }
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



  

   require_once('dbconnect.php');
    
	 $sql="SELECT rn FROM autobook_vin ";
	 $result = $con -> query($sql);
	 if ($result->num_rows > 0) {
		 while ($rws=$result->fetch_assoc()){
			 
			  $id = $rws['rn'];
			  echo $id;
			  echo " ";
		 if (rnvalid($id)) {echo "OK";} else {
			 $sql1="DELETE FROM autobook_vin WHERE rn='$id'";
			 $result1 = $con -> query($sql1);
			 echo "--- wrong";}; 
		 echo "<br>";
	 }}
 
?>