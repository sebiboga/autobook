
<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.1, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.1, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="assets/images/logo4.png" type="image/x-icon">
  <meta name="description" content="">
	  <meta property="og:title" content="autobook.space" />
	  <meta property="og:type" content="website" />
	  <meta property="og:url" content="https://autobook.space/register/" />
	  <meta property="og:image" content="https://autobook.space/confirm/assets/images/mbr-1920x1281.jpg" />
	  <meta property="og:description"   content="totul despre masina ta" />
  <title>autobook.space</title>
  <link rel="stylesheet" href="assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="assets/tether/tether.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="assets/theme/css/style.css">
  <link rel="stylesheet" href="assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<style>
.b1 {
	opacity: 0.5;
    color: #35f1ad;
    background-color: rgb(0, 0, 0);
}
</style>
<body>
  <section class="cid-rrhgL5Sq9S mbr-fullscreen mbr-parallax-background" id="header2-0">

    

    <div class="mbr-overlay" style="opacity: 0.5; background-color: rgb(35, 35, 35);"></div>

    <div class="container align-center">
        <div class="row justify-content-md-center">
            <div class="mbr-white col-md-10">
			<?php 
				if (isset($_GET['id']) && ($_GET['id']!='')) {
					$id = $_GET['id'];
					//$id = str_replace("'","",$id);
				   require_once('dbconnect.php');
					 $sql="UPDATE autobook_link SET valid='1' WHERE id='$id'";
					 $result = $con -> query($sql);
				?>
			
                <h1 class="mbr-section-title mbr-bold pb-3 mbr-fonts-style display-1">
                    FELICITARI!</h1>
                
                <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    Acum sunteti membru autobook.space&nbsp;<br>Verifica Beneficiile</p>
                <div class="mbr-section-btn"><a class="btn btn-md btn-secondary display-4" href="https://autobook.space">ACASA</a>
                    <a class="btn btn-md btn-white-outline display-4" href="https://autobook.space/beneficii">BENEFICII</a></div>
              <?php } 	else {  ?>
				  
				  <p class="mbr-text pb-3 mbr-fonts-style display-5">
                    Nu reusim sa te identificam. Poate ai uitat sa <a class="b1" href="https://autobook.space/register/">te inregistrezi</a>.
				  
			<?php  }?>
			
                
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            
            
			</div>
        </div>
    </div>
    
</section>


  <section class="engine"><a href="https://mobirise.info/w">free html5 templates</a></section><script src="assets/web/assets/jquery/jquery.min.js"></script>
  <script src="assets/popper/popper.min.js"></script>
  <script src="assets/tether/tether.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/smoothscroll/smooth-scroll.js"></script>
  <script src="assets/parallax/jarallax.min.js"></script>
  <script src="assets/theme/js/script.js"></script>
  
 <!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5ce6621f006830a2"></script>


</body>
</html>