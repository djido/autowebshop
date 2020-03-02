
<header>
  <div class="default-header">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 col-md-12">
		<div class="logo"> <a href="index.php"><img src="assets/images/auto.png" alt="image"></a> </div>
          <div class="header_info">
            
   <?php   if(strlen($_SESSION['login'])==0)
	{	
?>
 <div class="login_btn"> <a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Prijavite se</a> </div>
 <div class="login_btn"> <a href="#signupform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Registrirajte se</a> </div>
<?php }
else{ 

echo "";
 } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Navigation -->
  <nav id="navigation_bar" class="navbar navbar-default">
 
    <div class="container">
      <div class="navbar-header">
        <button id="menu_slide" data-target="#navigation" aria-expanded="false" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div class="header_wrap">
        <div class="user_login">
          <ul>
            <li class="dropdown"> <a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> 
<?php 
$email=$_SESSION['login'];
$sql ="SELECT FullName FROM tblusers WHERE EmailId=:email ";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
	{

	 echo htmlentities($result->FullName); }}?><i class="fa fa-angle-down" aria-hidden="true"></i></a>
              <ul class="dropdown-menu">
           <?php if($_SESSION['login']){?>
            <li><a href="profile.php">Postavke profila</a></li>
              <li><a href="update-password.php">Ažurirajte lozinku</a></li>
            <li><a href="my-booking.php">Moje rezervacije</a></li>
            <li><a href="logout.php">Odjava</a></li>
            <?php } else { ?>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Postavke profila</a></li>
              <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Ažurirajte lozinku</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Moje rezervacije</a></li>
            <li><a href="#loginform"  data-toggle="modal" data-dismiss="modal">Odjava</a></li>
            <?php } ?>
          </ul>
            </li>
          </ul>
        </div>
        
      </div>
      <div class="collapse navbar-collapse" id="navigation">
        <ul class="nav navbar-nav">
          <li><a href="index.php">Početna</a>    </li>
          <li><a href="car-listing.php">Ponuda vozila</a>
          <li><a href="contact-us.php">Kontakt</a></li>
        </ul>
    </div>
  </nav>
  <!-- Navigation end --> 
  
</header>