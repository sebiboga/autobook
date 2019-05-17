
<?php 
if (isset($_COOKIE['auto'])) {$auto=$_COOKIE['auto'];}
if (isset($_COOKIE['vin'])) {$vin=$_COOKIE['vin'];}
?>
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="css/main.css">
<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet"> 
  
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  
  <script>
function here() {
	
	var currentdate = new Date(); 
    var xnow = currentdate.getFullYear()   + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate();

     xnow = new Date(xnow);
	 
	 
   var result; 
   var rcat;
   
   var numar='';
       numar = $('#auto').text();
	   
   var sasiu =  $('#vin').text();
  console.log(numar);
  console.log(vin);

 if(typeof numar != 'undefined')
  if (numar.length){
	  $.getJSON("../api/getcarbynumber/?number="+numar).then(function (result){
	  
		   console.log(result.values[0]);
		  if(typeof result.values[0] != 'undefined') {
		  $('#rcadata').text(': '+result.values[0].rca); 
		  $('#itpdata').text(': '+result.values[0].itp);
		  $('#rovignetadata').text(': '+result.values[0].rovigneta);
		  
		  
		  
		  rcat = result.values[0].rcat;
		  rcat = new Date(rcat);
		  
		  if (result.values[0].tel.length >0) {{ $('#tel').text(': '+result.values[0].tel); $('#itel').attr("class","hidden");}}
		  if (result.values[0].email.length >0) {{$('#mail').text(': '+result.values[0].email);;$('#email').attr("class","hidden");}}
		  if ((result.values[0].tel.length >0)&&(result.values[0].email.length >0)) {$('#sbut').attr("class","hidden");}
		  
		  if ((rcat.getFullYear() === xnow.getFullYear() )&& (rcat.getMonth() === xnow.getMonth() ) && (rcat.getDate() === xnow.getDate() ) ) {$('#rcai').attr("class","hidden");} 
		  		  
		  itpt = result.values[0].itpt;
		  itpt = new Date(itpt);
		  
		  if ((itpt.getFullYear() === xnow.getFullYear() )&& (itpt.getMonth() === xnow.getMonth() ) && (itpt.getDate() === xnow.getDate() ) ) {$('#itpi').attr("class","hidden");} 
		  
		  rot = result.values[0].rot;
		  rot = new Date(rot);

		  if ((rot.getFullYear() === xnow.getFullYear() )&& (rot.getMonth() === xnow.getMonth() ) && (rot.getDate() === xnow.getDate() ) ) {$('#roi').attr("class","hidden");} 

		  
		  var textauto;
		  textauto = result.values[0].vin;
		  textauto='<a href="https://vindecoder.eu/check-vin/'+textauto+'" target=_blank>'+textauto+'</a>';
		  $('#textauto').html(textauto);} 
		     
	  
	  });
  }
}
</script>
  
  
  
 </head>
 <body>
 <span class='back'><a href='../'>< back</a></span>
<?php 
$t = date("Y-m-d");

if (isset($auto)&&(isset($vin))) {
	
	$sql="SELECT * FROM vin  WHERE (rn='$auto' AND vin='$vin')  ORDER BY timestamp  DESC LIMIT 1";
	
} else {

if (isset($_GET['pag'])) {$pag = $_GET['pag'];} else {$pag = 0;}

 $vin='';
 
 $sql="SELECT * FROM vin  WHERE rcat !='$t' OR rcat IS NULL OR itpt!='$t' OR itpt IS NULL OR rot!='$t' OR rot IS NULL ORDER BY timestamp  DESC LIMIT ".$pag.",1";
 
 
}
 $done=0;
 require_once('dbconnect.php');
 $result = $con -> query($sql);
 
 



				
					$temp=array();
					while ($rws=$result->fetch_assoc()){
							
							//set cookie auto		
$cookie_name = "auto";
$cookie_value = $rws["rn"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
//end set cookie auto
   //set cookie 
$cookie_name = "vin";
$cookie_value =$rws["vin"];
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day		
//end_set cookie vin

							
							echo "<h3><span id='vin'>".$vin = $rws["vin"];
							echo "</span></h3>";
							
							
							echo "<h2><span id=auto>".$auto = $rws["rn"];
							echo "</span></h2>";
							
							
							echo "<br/>";
														}
							
				
 
 
	
	
	
?>

<?php if ($done==0) { ?>
<h4>
<p>
<a href="https://www.rcam.ro/ro/polite-rca" target=_blank>RCA</a>  <span id='rcadata'> </span><br/>
</p>


<form id='rcai' action='controller.php' method=POST style=main.css>
  <input type=date name=rca>
  <input type=hidden name=car value='<?php echo $auto;?>'>
  <input type=submit value='schimba'>
</form>
<hr>

<p><a href="http://prog.rarom.ro/rarpol/rarpol.asp" target="_blank">ITP</a> <span id='itpdata'> </span></p>

<form  id='itpi' action='controller.php' method=POST>
  <input type=date name=itp>
  <input type=hidden name=vin value='<?php echo $vin;?>'>
  <input type=submit value='schimba'>
</form>
<hr>
<p> <a href="http://www.cnadnr.ro/ro/verificare-rovinieta" target="_blank">ROvigneta</a> <span id='rovignetadata'> </span></p></p>

<form id='roi' action='controller.php' method=POST>
  <input type=date name=vigneta>
  <input type=hidden name=vin value='<?php echo $vin;?>'>
  <input type=submit value='schimba'>
</form>

<hr>
<form id='contact' action='controller.php' method=POST>
tel 	<span id='tel' ></span> <input id='itel' type=text name=tel>
email  <span id='mail' ></span>  <input id='email' type=text name=email>
  <input type=hidden name=vin value='<?php echo $vin;?>'>
  <input type=hidden name=car value='<?php echo $auto;?>'>
  <input id='sbut' type=submit value='Schimba'>
</form>
<hr>
<?php 
if (isset($_GET['pag'])) {$pag = $_GET['pag']; ?>
<a href='<?php echo $_SERVER['PHP_SELF'];?>?pag=<?php echo $pag+1 ;?>'>NEXT</a>
<br/><br/>
<?php } ?>
<br/>


<p>
 <a href='../api/deletecar?vin=<?php echo $vin;?>&auto=<?php echo $auto;?>' target=_blank>DELETE</a>
</p>
</h4>
<?php } ?>
 <script> here(); </script>
</body>
</html>

