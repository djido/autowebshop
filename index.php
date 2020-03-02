<?php 
session_start();
include('includes/config.php');
error_reporting(0);

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Car Deals</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<link href="assets/css/slick.css" rel="stylesheet">
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<link href="assets/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet"> 
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>
<body>
      
<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<section class="section-padding">
  <div class="container">
<div class="title-auto">
	<h2>Najnovije iz naše ponude</h2></div>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.Price,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.Kilometers  ,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand Limit 8";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> 
<a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>

</div>
<div class="car-title-m">
<h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?>  <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
<span class="infor"><strong>Godina proizvodnje</strong>: <?php echo htmlentities($result->ModelYear);?></span> 
<span class="infor"><strong>Cijena</strong>: <?php echo htmlentities($result->Price);?> KM</span> 
<span class="infor"><strong>Kilometraža</strong>: <?php echo htmlentities($result->Kilometers );?> km</span> 
</div>
</div>
</div>
<?php }}?>
       
      </div>
    </div>
  </div>
</section>

<section id="banner" class="banner-section">
  <div class="container">
    <div class="div_zindex">
      <div class="row">
        <div class="col-md-12">
          <div class="banner_content">
            <h1>AutoWebShop</h1>
            <p>Pronađite odgovarajući automobil za sebe!<br>
			U ponudi za Vas više od 50 novih i polovnih automobila.</p>
            <a href="car-listing.php" class="btn">Saznajte Više</a> </div>
			
			
        </div>
      </div>
    </div>
		<div class="dark-overlay"></div>
  </div>
</section>

<section class="section-padding">
  <div class="container">
<div class="title-auto">
	<h2>Novo auto za manje od 20 tisuća!</h2></div>
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="resentnewcar">

<?php $sql = "SELECT tblvehicles.VehiclesTitle,tblbrands.BrandName,tblvehicles.Price,tblvehicles.FuelType,tblvehicles.ModelYear,tblvehicles.id,tblvehicles.Kilometers  ,tblvehicles.VehiclesOverview,tblvehicles.Vimage1 from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where price <= 20000";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>  

<div class="col-list-3">
<div class="recent-car-list">
<div class="car-info-box"> 
<a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>">
<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" class="img-responsive" alt="image"></a>

</div>
<div class="car-title-m">
<h6><a href="vehical-details.php?vhid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->BrandName);?>  <?php echo htmlentities($result->VehiclesTitle);?></a></h6>
<span class="infor"><strong>Godina proizvodnje</strong>: <?php echo htmlentities($result->ModelYear);?></span> 
<span class="infor"><strong>Cijena</strong>: <?php echo htmlentities($result->Price);?> KM</span> 
<span class="infor"><strong>Kilometraža</strong>: <?php echo htmlentities($result->Kilometers );?> km</span> 
</div>
</div>
</div>
<?php }}?>
       
      </div>
    </div>
  </div>
</section>

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 


<!--Login, Register, Forgot Password -->
<?php include('includes/login.php');?>

<?php include('includes/registration.php');?>

<?php include('includes/forgotpassword.php');?>


<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>