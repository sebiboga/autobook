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
				  ?>
				  <button onclick=showdata($(this).text(),'<?php echo $vin;?>');><?php echo strtoupper($auto);	  ?></button>
				<?php  }}
	   
	?>

	</ul>
  </div>
  <div class="column right" style="background-color:#bbb;">
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
		    <input type="date" name="rca">
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
		<input type="date" name="itp">
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
		<input type="date" name="vigneta">
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
 function showdata(x,y) {
	 
	document.getElementById("nrauto").innerHTML = x; 
	document.getElementById("seriesasiu").innerHTML = y;
 }
</script>

</body>
</html>

