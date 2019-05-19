<?php 
function GUID() {
    if (function_exists('com_create_guid') === true)
    {return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function valid($phone){
	$result = true;
	if (substr($phone,0,2)!='07') {$result=false;}
	if (is_numeric($phone)==1) {} else {$result=false;} 
	if (strlen($phone)!=10) {$result=false;}
	return $result;
}


    $stop=false;
	$id=GUID();
   require_once('dbconnect.php');
   
   $sql = "SELECT *  FROM `autobook_smssend`  WHERE sent='0' LIMIT 1";
   $result = $con -> query($sql);
    if ($result->num_rows > 0) {
		 while ($rws=$result->fetch_assoc()){
			  $phone = $rws['phone'];
			  $text  = $rws['text'];
			  $now	 = date("Y-m-d H:i:s");
			  
			    
		 }
		 
		 $sqlu="UPDATE autobook_smssend SET sent='1',timestamp='$now' WHERE phone='$phone'";
		 $resultu = $con -> query($sqlu);
	}
 echo '{"phone":"'.$phone.'","text":"'.$text.'"}';
   
   
	 
	
	 

