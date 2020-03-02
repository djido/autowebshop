<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$Name=$_POST['Name'];
$LastName=$_POST['LastName']; 
$message=$_POST['message'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO  tblbooking(userEmail,VehicleId,Name,LastName,message,Status) VALUES(:useremail,:vhid,:Name,:LastName,:message,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':Name',$Name,PDO::PARAM_STR);
$query->bindParam(':LastName',$LastName,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Rezervacija uspješna.');</script>";
}
else 
{
echo "<script>alert('Nešto je pošlo po zlu. Probajte ponovo!');</script>";
}

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Car Deals</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>

<!--Header-->
<?php include('includes/header.php');?>
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT tblvehicles.*,tblbrands.BrandName,tblbrands.id as bid  from tblvehicles join tblbrands on tblbrands.id=tblvehicles.VehiclesBrand where tblvehicles.id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
$_SESSION['brndid']=$result->bid;  
?>  




<!--Listing-detail-->

<section class="page-header listing_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1><?php echo htmlentities($result->BrandName);?> <?php echo htmlentities($result->VehiclesTitle);?></h1>
      </div>
    </div>
  </div>
  <!-- Orange Overlay-->
  <div class="orange-overlay"></div>
</section>

<section class="listing-detail">
<div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-12">
	<h3>Ključne informacije o automobilu:</h3>
      </div>
    </div>
	 <div class="main_features">
          <ul>
			<li> 
				<h5>Proizvođač:</h5>
              <h4><?php echo htmlentities($result->BrandName);?></h4>
            </li>
            <li> 
			<h5>Godina proizvodnje:</h5>
              <h4><?php echo htmlentities($result->ModelYear);?></h4>          
            </li>
			<li> 
              <h5>Klasa automobila:</h5>
			   <h4><?php echo htmlentities($result->VehiclesOverview);?></h4>
            </li>
            <li> 
			  <h5>Pogonsko gorivo:</h5>
              <h4><?php echo htmlentities($result->FuelType);?></h4>    
            </li>
            <li> 
			<h5>Pređenih kilometara:</h5>
              <h4><?php echo htmlentities($result->Kilometers  );?> km</h4>
            </li>
			<li> 
			<h5>Cijena:</h5>
              <h4><?php echo htmlentities($result->Price);?> KM</h4>
            </li>
          </ul>
        </div>

	</div>
</section>

<section>

 <!-- Images used to open the lightbox -->
<div class="rowa">
  <div class="columna">
	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" onclick="openModal();currentSlide(2)" class="hover-shadow">
  </div>
  <div class="columna">
	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" onclick="openModal();currentSlide(2)" class="hover-shadow">
  </div>
  <div class="columna">
	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" onclick="openModal();currentSlide(2)" class="hover-shadow">
  </div>
  <div class="columna">
	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" onclick="openModal();currentSlide(2)" class="hover-shadow">
   </div>
</div>

<!-- The Modal/Lightbox -->
<div id="myModall" class="mod">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">

    <div class="mySlides">
      <div class="numbertext">1 / 4</div>
	  	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" style="width:100%">

    </div>

    <div class="mySlides">
      <div class="numbertext">2 / 4</div>
	  	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" style="width:100%">
   </div>

    <div class="mySlides">
      <div class="numbertext">3 / 4</div>
	  	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" style="width:100%">
</div>

    <div class="mySlides">
      <div class="numbertext">4 / 4</div>
 	  	<img src="admin/img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" style="width:100%">
   </div>

    <!-- Next/previous controls -->
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <!-- Caption text -->
    <div class="caption-container">
      <p id="caption"></p>
    </div>

  </div>
</div> 
</section>

<section class="listing-detail">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
       
              <!-- Accessories -->
              <div id="accessories"> 
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Dodatna Oprema</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Klima</td>
<?php if($result->AirConditioner==1)
{
?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?> 
   <td><i class="fa fa-close" aria-hidden="true"></i></td>
   <?php } ?> </tr>

<tr>
<td>Alarm</td>
<?php if($result->AntiLockBrakingSystem==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>

<tr>
<td>Servo</td>
<?php if($result->PowerSteering==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   

<tr>

<td>Elektroničko otvaranje prozora</td>

<?php if($result->PowerWindows==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>
                   
 <tr>
<td>Kazetofon</td>
<?php if($result->CDPlayer==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Kožna sjedala</td>
<?php if($result->LeatherSeats==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Centralno zaključavanje</td>
<?php if($result->CentralLocking==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Daljinsko otključavanje</td>
<?php if($result->PowerDoorLocks==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
                    </tr>
                    <tr>
<td>Pomoć pri kočenju</td>
<?php if($result->BrakeAssist==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php  } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Zračni jastuci za vozača</td>
<?php if($result->DriverAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
 </tr>
 
 <tr>
 <td>Zračni jastuci za ostale putnike</td>
 <?php if($result->PassengerAirbag==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else {?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

<tr>
<td>Zadnji senzori</td>
<?php if($result->CrashSensor==1)
{
?>
<td><i class="fa fa-check" aria-hidden="true"></i></td>
<?php } else { ?>
<td><i class="fa fa-close" aria-hidden="true"></i></td>
<?php } ?>
</tr>

                  </tbody>
                </table>
              </div>
           
          </div>
          
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-4">
      
       
        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5>Rezervirajte automobil</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="Name" placeholder="Ime" required>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="LastName" placeholder="Prezime" required>
            </div>
            <div class="form-group">
              <textarea rows="4" class="form-control" name="message" placeholder="Poruka" required></textarea>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Rezervacija">
              </div>
              <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Prijavite se prvo.</a>

              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
 
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>

<script>
// Open the Modal
function openModal() {
  document.getElementById("myModall").style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById("myModall").style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>