<?php
include('controller/database.php');

$settings_val = $mysqli->query("SELECT * from pos_settings");
$sval = $settings_val->fetch_row();

$email = $_GET['email'];
$name  = $_GET['name'];

$mysqli->query("UPDATE pos_customer set is_active = 1 where email='$email'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo $sval[1];?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
	
	
    <!-- Favicon -->
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
<body>

  <main>
    <div class="">

        <div class="">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-4 justify-content-center">

              <div class="d-flex justify-content-center py-4">
               <img src="admin/assets/logo/<?php echo $sval[7];?>" width="200px">
              </div><!-- End Logo -->

              <div class="card">

                <div class="card-body">
					<br><br>
					Your Account is confirmed!
					<br>
					<br>
					Login using your account details!
					<br>
					<br>
					
					Thank You!
					
					<br>
					<br>
					<a href="login.php"> LOGIN </a>
					<br>

                </div>
              </div>

             

            </div>
          </div>
        </div>


    </div>
  </main><!-- End #main -->

</body>

</html>