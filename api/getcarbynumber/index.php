<?php 
 $rn='';
 if (isset($_GET['number'])) {$rn = $_GET['number']; $rn = str_replace("-","",$rn); $rn = str_replace(" ","",$rn); $rn =  strtoupper($rn);}
 require_once('dbconnect.php');
 $sql="SELECT * FROM autobook_vin WHERE rn = '$rn' ORDER BY timestamp DESC LIMIT 1";
 $result = $con -> query($sql);
 
  function prettycarnumber($auto) {
	  $str=$auto;
	  $str = substr($auto, 0, 2) . '-' . substr($auto, 2);
	  $auto = $str;
	  $str = substr($auto, 0, 5) . '-' . substr($auto, 5);
	   
	  return $str;
 }
 
 
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
							$x->registration_number=prettycarnumber($rws["rn"]);
							
							
							  $data=substr($rws["rca"],8,2).'-'.substr($rws["rca"],5,2).'-'.substr($rws["rca"],0,4);
							$x->rca=$data;
							  $data=substr($rws["itp"],8,2).'-'.substr($rws["itp"],5,2).'-'.substr($rws["itp"],0,4);
							
							
							
							$x->itp=$data;
							  $data=substr($rws["rovigneta"],8,2).'-'.substr($rws["rovigneta"],5,2).'-'.substr($rws["rovigneta"],0,4);
							
							
							
							$x->rovigneta=$data;
							
							
							$temp[]=$x;
														
	

														
														
														}
							$output->values=$temp;
				}
 
 

 echo json_encode($output);		
?>


