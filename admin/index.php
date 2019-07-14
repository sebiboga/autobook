<?php 
  require_once('dbconnect.php');
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
<style>
li {
	list-style-type: none;
}

* {
  box-sizing: border-box;
}

/* Create two unequal columns that floats next to each other */
.column {
  float: left;
}

.left {
  width: 15%;
  max-height: 49em;
  overflow: auto;
}
.blackandwhite {
	background-color: #000;
    color: white;
}

.right {
  width: 73%;
  padding-left: 3em;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.goright{float:right;}

.activ {
	    background-color: #737373;	
}
</style>
<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
</head>
<?php 
 $sql="SELECT * FROM autobook_vin ";
 $result = $con -> query($sql);
?>
<body>

<h2>Administrare autovehicole</h2>

<div class="row">
  <div class="column left blackandwhite" >
    <h2>Numere auto</h2>
    <ul>
	<?php 
	
	 if ($result->num_rows > 0) {
		 while ($rws=$result->fetch_assoc()){
	              $auto = $rws['rn'];
				  $vin	= $rws['vin'];
				  $vin=str_replace('"','',$vin);
				  $vin=str_replace("'","",$vin);
				  $rca = $rws['rca'];
				  $itp = $rws['itp'];
				  $vigneta = $rws['rovigneta'];
				  
				  ?>
				  <button onclick=showdata($(this).text(),'<?php echo $vin;?>','<?php echo $rca;?>','<?php echo $itp;?>','<?php echo $vigneta;?>');><?php echo strtoupper($auto);	  ?></button>
				<?php  }}
	   
	?>

	</ul>
  </div>
  <div class="column right" style="background-color:#bbb;">
  <button class="goright" onClick=admin();> publish </button>
    <h2>Datele autovehicolului</h2>
		
    <ul>
	  <li id="nrauto"></li>
	  <li id="seriesasiu"></li>
	  
	</ul>
	<hr/>
	
	<div>
	  <div class="section">
	    <h2>RCA</h2>
		<table>
		 <tr>
		 <td>
		    <input type="date" name="rca" id="rca">
		  </td>
		  <td>
		   <a href="https://www.rcam.ro/ro/polite-rca" target="_blank"><img src='img/rca.png'></a><br/>
		  </td>
		  
		</tr>
		</table>
		
		<hr/>
	 </div>
	 <div class="section ">
	    <h2>ITP</h2>
		<table>
		<tr>
		<td>
		<input type="date" name="itp" id="itp">
		</td>
		
		 <td>
		<a href="http://prog.rarom.ro/rarpol/rarpol.asp" target="_blank"><img src='img/rarom.png' width=300></a><br/>
		</td>
		</tr>
		</table>
			<hr/>
	 </div>
	 <div class="section">
	    <h2>ROVIGNETA</h2>
		<table>
		<tr>
		 <td>
		<input type="date" name="vigneta" id="vigneta">
		</td> 
		<td>
		<a href="http://www.cnadnr.ro/ro/verificare-rovinieta" target="_blank"><img src='img/cnair.png'></a><br/>
		</td>
		</tr>
		</table>
			<hr/>
	</div>	
	</div>
  </div>
</div>

<script>
 function showdata(x,y,rca,itp,vigneta) {
	 
	document.getElementById("nrauto").innerHTML = x; 
	document.getElementById("seriesasiu").innerHTML = y;
	document.getElementById("rca").value = rca;
	document.getElementById("itp").value = itp;
	document.getElementById("vigneta").value = vigneta;
 }
 
 function admin() {
	 var nrauto = document.getElementById("nrauto").innerHTML;
	 var seriesasiu = document.getElementById("seriesasiu").innerHTML;
	 var rca = document.getElementById("rca").value;
	 var itp = document.getElementById("itp").value;
	 var vigneta = document.getElementById("vigneta").value;
	 
	 console.log(nrauto);
	 console.log(seriesasiu);
	 console.log(rca);
	 console.log(itp);
	 console.log(vigneta);
	 
	 
	 
var values = { 
            'car'   	:nrauto,
			'rca'		:rca,
			'itp'		:itp,
			'vigneta'	:vigneta,
			'vin'		:seriesasiu
        };

 $.ajax({
        url: "controller.php",
        type: "post",
        data: values ,
		dataType  : 'json',
        success: function (response) {

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
 }
</script>

</body>
</html>

