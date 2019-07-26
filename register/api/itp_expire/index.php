<?php 
function GUID() {
    if (function_exists('com_create_guid') === true)
    {return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

	$id=GUID();
   require_once('dbconnect.php');
   
   $sql = "SELECT rn, itp,datediff(itp,now()) as itpdiff FROM `autobook_vin` WHERE (itp IS NOT NULL) and (year(itp)>'2000') and datediff(itp,now())<=14";
   $result = $con -> query($sql);
   
    if ($result->num_rows > 0) {
		 while ($rws=$result->fetch_assoc()){
			  
			  $auto    	= $rws['rn'];
			  $itp_date = $rws['itp'];
			  $days		= $rws['itpdiff'];
			  $text = "Pentru autovehicolul ".$auto." ITP ";
			  if ($days=='0') {$text.= " expira azi ".$itp_date;}
			  if ($days <0) {$text.=" a expirat de ".abs($days)." zile";}
			  if ($days >0) {$text .= "va expira in ".$days." zile";}
			  
			$sql_phone = "
			SELECT u.tel,l.id FROM `autobook_vin` v 
			INNER JOIN autobook_link l ON l.idvin=v.id
			INNER JOIN autobook_user u ON u.id = l.iduser
			WHERE rn='$auto' and l.id NOT IN (
			SELECT ckey FROM `autobook_smssend` where year(timestamp) = year(now()) and month(timestamp)=month(now()) and day(timestamp)=day(now())
			)
			";  
			  $result_phone = $con -> query($sql_phone);
			  if ($result_phone->num_rows > 0) {
			    while ($phones=$result_phone->fetch_assoc()){
					 $phone 	= $phones['tel'];
					 $authkey 	= $phones['id'];
					 $timestamp	= date("Y-m-d H:i:s");
					     $sql_insert="
						 INSERT INTO autobook_smssend(id,phone,text,sent,command,ckey,timestamp) VALUES ('$id','$phone','$text','0','itp_expired','$authkey','$timestamp')";
					     $result_insert = $con -> query($sql_insert);
															}
												}	
			  
		                                       }
	
	    
			
		                        }
	 
   
    
	 
?>
