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
   
   $sql = "
    SELECT v.vin,u.tel,v.rn,v.id FROM `autobook_vin` v 
	INNER JOIN autobook_link l on l.idvin=v.id 
	INNER JOIN autobook_user u on l.iduser=u.id 
	WHERE v.vin IS NULL and l.valid='1' AND v.rn NOT IN (
		SELECT v.rn FROM autobook_smssend s INNER JOIN autobook_vin v on v.id=s.ckey WHERE s.command='vinreq' )
   ";
   $result = $con -> query($sql);
    if ($result->num_rows > 0) {
		 while ($rws=$result->fetch_assoc()){
			  $phone   = $rws['tel'];
			  $auto    = $rws['rn'];
			  $authkey = $rws['id'];
			  $text = "Introduceti Seria Caroserie pentru autovehicolul ".$auto." Click pe: https://autobook.space/register/vin/?id=".$authkey;
		 }
	 echo "found";
	     if (!valid($phone)){
			 $stop = true;
			 $sqld = "DELETE FROM autobook_user WHERE tel='$phone'";
			 $resd = $con -> query($sqld);
		 }
	 } else {echo "none"; $stop=true;}
   
    if (!$stop){
	 $sql="INSERT INTO autobook_smssend(id,phone,text,sent,command) VALUES ('$id','$phone','$text','0','vinreq')";
	 $result = $con -> query($sql);
	}
	 
?>
