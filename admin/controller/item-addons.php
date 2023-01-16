<?php
include('../controller/database.php');


$category = $mysqli->query("SELECT * from pos_addons");

if(isset($_POST['add-category'])){
	
	$name       = $_POST['category'];

	$mysqli->query("INSERT INTO pos_addons (name) VALUES ('$name')");

  	        echo '<script>
					Swal.fire({
							title: "Success! ",
							text: "Add-Onsuccessfully Added",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "addons.php";
							});
			</script>';
	
}

if(isset($_POST['delete-category'])){
	
	$id       = $_POST['id'];

	$mysqli->query("DELETE FROM  pos_addons where addons_id ='$id' ");
	
	
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: " Add-Ons is Successfully Deleted",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "addons.php";
							});
			</script>';
	
}

if(isset($_POST['update-category'])){
	
	$id          = $_POST['id'];
	$name       = $_POST['category'];



	$mysqli->query("UPDATE  pos_addons SET name ='$name' 
										 WHERE addons_id ='$id'
					");
		
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: "Add-Ons is Successfully Updated",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "addons.php";
							});
			</script>';
	
}