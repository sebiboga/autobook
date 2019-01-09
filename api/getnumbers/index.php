<?php 

 require_once('dbconnect.php');
 $sql="SELECT rn FROM vin WHERE rn<>'' ";
 $result = $con -> query($sql);
 
 $output=new StdClass();
$month_now=date("m");
$year_now=date("Y");
$output=array();


				if ($result->num_rows==0){
					$output->msg='No cars';
				}
				else{
					$temp=array();
					while ($rws=$result->fetch_assoc()){
							
							
							
						
							$temp[]=$rws["rn"];
						
							
														}
							$output=$temp;
				}
 
 
 echo json_encode($output);		
?>


