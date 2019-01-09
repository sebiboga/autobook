<?php 
 $vin='';
 if (isset($_GET['vin'])) {$vin = $_GET['vin']; }
 require_once('dbconnect.php');
 $sql="SELECT * FROM vin WHERE vin = '$vin' ORDER BY timestamp DESC LIMIT 1";
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
					$x=new StdClass();
							
							
							$x->vin=$vin;
                               if (isset($_COOKIE['auto'])){$x->registration_number=prettycarnumber($_COOKIE['auto']);}							
							
							$x->tel="";
							$x->email="";
							$x->rca="";
							$x->itp="";
							$x->rovigneta="";
							$temp[]=$x;
							$output->values=$temp;
				}
				else{
					$temp=array();
					while ($rws=$result->fetch_assoc()){
							$x=new StdClass();
							
							
							$x->vin=$rws["vin"]; 
							$x->registration_number=prettycarnumber($rws["rn"]);
							
							
							
							$x->tel=$rws["tel"];
							$x->email=$rws["email"];
							  $data=substr($rws["rca"],8,2).'-'.substr($rws["rca"],5,2).'-'.substr($rws["rca"],0,4);
							$x->rca=$data;
							  $data=substr($rws["itp"],8,2).'-'.substr($rws["itp"],5,2).'-'.substr($rws["itp"],0,4);
							$x->itp=$data;
							  $data=substr($rws["rovigneta"],8,2).'-'.substr($rws["rovigneta"],5,2).'-'.substr($rws["rovigneta"],0,4);
							$x->rovigneta=$data;
							$temp[]=$x;
														

//set cookie auto		
$cookie_name = "auto";
$cookie_value = $x->registration_number;
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//end set cookie auto
														
														}
							$output->values=$temp;
				}
 
 
 echo json_encode($output);		
?>


