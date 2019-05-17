<?php 

 require_once('dbconnect.php');
 $sql="SELECT * FROM vin";
 $result = $con -> query($sql);
 
 $output=new StdClass();
$month_now=date("m");
$year_now=date("Y");
$output->values=array();


				if ($result->num_rows==0){
					$output->msg='No cars';
				}
				else{
					$temp=array();
					while ($rws=$result->fetch_assoc()){
							$x=new StdClass();
							
							
							$x->vin=$rws["vin"]; 
							$x->registration_number=$rws["rn"];
							$x->tel=$rws["tel"];
							$x->email=$rws["email"];
							$x->rca=$rws["rca"];
							$x->itp=$rws["itp"];
							$x->rovigneta=$rws["rovigneta"];
							$temp[]=$x;
														}
							$output->values=$temp;
				}
 
 
 echo json_encode($output);		
?>


