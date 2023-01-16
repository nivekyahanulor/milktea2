<?php
include('../controller/database.php');


$customer = $mysqli->query("SELECT a.* , b.name as category, b.category_id from pos_items a 
							LEFT JOIN pos_item_category b on b.category_id  = a.category
							");

$sales = $mysqli->query("select a.* , b.*  FROM  pos_items a left join pos_order b on a.item_id = b.item_id where b.status =1");

if(isset($_POST['search'])){
	$item_code = $_POST['item_code'];
	$mysqli->query("select *  FROM  pos_items where item_code ='$item_code' ");
    $row = $mysqli->fetch_row();
	echo json_encode($row);
}

if(isset($_POST['add-item'])){
	
	$name           = $_POST['name'];
	$category       = $_POST['category'];
	$description    = $_POST['description'];
	$is_best        = $_POST['is_best'];
	$small          = $_POST['small'];
	$meduim         = $_POST['meduim'];
	$large          = $_POST['large'];

	$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
    $image_name = addslashes($_FILES['image']['name']);
    $image_size = getimagesize($_FILES['image']['tmp_name']);
    move_uploaded_file($_FILES["image"]["tmp_name"], "assets/menu/" . $_FILES["image"]["name"]);
	$location   =  $_FILES["image"]["name"];
	
	
	$mysqli->query("INSERT INTO pos_items (item_name , category,image,description,is_best_seller,small,meduim,large) 
						VALUES ('$name','$category','$location','$description','$is_best','$small','$meduim','$large')");
		
		

  	        echo '<script>
					Swal.fire({
							title: "Success! ",
							text: "Product Data Successfully Added",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "products.php";
							});
			</script>';
	
}

if(isset($_POST['delete-item'])){
	
	$id       = $_POST['id'];

	$mysqli->query("DELETE FROM  pos_items where item_id ='$id' ");
	
	
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: " Product Data is Successfully Deleted",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "products.php";
							});
			</script>';
	
}

if(isset($_POST['update-item'])){
	
	$id             = $_POST['id'];
	$name           = $_POST['name'];
	$price          = $_POST['price'];
	$category       = $_POST['category'];
	$letter  	    = $_POST['image1'];
	$stock          = $_POST['stock'];
	$description    = $_POST['description'];
	$is_best        = $_POST['is_best'];
	$small          = $_POST['small'];
	$meduim         = $_POST['meduim'];
	$large          = $_POST['large'];
	$is_available   = $_POST['is_available'];
	
	if ($letter == "") {
		$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
		$image_name = addslashes($_FILES['image']['name']);
		$image_size = getimagesize($_FILES['image']['tmp_name']);
		move_uploaded_file($_FILES["image"]["tmp_name"], "assets/menu/" . $_FILES["image"]["name"]);
		$location   =  $_FILES["image"]["name"];
	} else {
		if ($_FILES["image"]["name"] == "") {
			$location = $letter;
		} else {
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);
			move_uploaded_file($_FILES["image"]["tmp_name"], "assets/menu/" . $_FILES["image"]["name"]);
			$location   =  $_FILES["image"]["name"];
		}
	}

	$mysqli->query("UPDATE pos_items  SET item_name           = '$name',
										  item_price          = '$price',
										  category            = '$category',
										  stock               = '$stock',
										  description         = '$description',
										  is_best_seller      = '$is_best',
										  small               = '$small',
										  meduim              = '$meduim',
										  large               = '$large',
										  is_available        = '$is_available',
										  image               = '$location'
					WHERE item_id = '$id'");

		
	echo '  <script>
					Swal.fire({
							title: "Success! ",
							text: "Product Details is Successfully Updated",
							icon: "success",
							type: "success"
							}).then(function(){
								window.location = "products.php";
							});
			</script>';
	
}