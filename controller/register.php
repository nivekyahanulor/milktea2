<?php
include('database.php');

	// error_reporting(0);
	
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/vendor/phpmailer/phpmailer/src/Exception.php';
	require 'phpmailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require 'phpmailer/vendor/phpmailer/phpmailer/src/SMTP.php';
	
	if(isset($_POST['register'])){
		
		$firstname    = $_POST['firstname'];
		$lastname     = $_POST['lastname'];
		$email        = $_POST['email'];
		$zipcode      = $_POST['zipcode'];
		$barangay     = $_POST['barangay'];
		$city         = $_POST['city'];
		$address      = $_POST['address'];
		$contact 	  = $_POST['contact'];
		$password     = $_POST['password'];
		$username     = $_POST['username'];
		$name         = $firstname .' '.$lastname;
		
		$check        = $mysqli->query("SELECT * from pos_customer where email='$email'");
		$count        = $check->num_rows;
		
		if($count !=0){
			echo "<script> window.location.href='../register.php?duplicate'; </script>";
		} else {
			
			$check        = $mysqli->query("SELECT * from pos_customer where contact='$contact'");
			$count        = $check->num_rows;
			if($count !=0){
				
				echo "<script> window.location.href='../register.php?cduplicate'; </script>";
			
			} else { 
			
			$mail = new PHPMailer();
			$mail->isSMTP();
			$mail->Host     = 'smtp.hostinger.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'support@breweddelights.shop';
			$mail->Password = '@Programmer2013';
			$mail->SMTPSecure = 'ssl'; // tls
			$mail->Port     = 465; // 587
			$mail->setFrom('support@breweddelights.shop', 'Brewed Delights');
			$mail->addAddress($email);
			$mail->Subject = 'Account Confirmation';
			$mail->isHTML(true);


			$mail->Body = "<html>
								<body>
									<h1>Hello , " .$name ." </h1>
									<p> Thank you for registering to Brewed Delights</p>
									<p> Kindly confirm your email address via the link below in order to start using your profile</p>
									<p> <a href='https://breweddelights.shop/confirm.php?name=$name&email=$email'> Link Here </a> </p>
								</body>
							</html>";

			if ($mail->send()) {
				$message = 'success';
			} else {
				$message = 'failed';
			}
			
		$mysqli->query("INSERT INTO pos_customer (firstname,lastname,email,address,city,barangay,zipcode,contact,password,username) 
								VALUES ('$firstname','$lastname','$email','$address','$city','$barangay','$zipcode','$contact','$password','$username')");
		echo "<script> window.location.href='../login.php?registered'; </script>";
	}
	}
	}
