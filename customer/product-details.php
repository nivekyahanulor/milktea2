 <?php include("header.php");?>

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p><?php echo $_GET['name'];?></p>
        </div>

        <div class="row gy-4">
		<?php
		$id         = $_GET['data'];
		$products   = $mysqli->query("SELECT * from pos_items where item_id ='$id'");
		while($val3 = $products->fetch_object()){	
		?>
          <div class="col-lg-5 position-relative about-img"  data-aos="fade-up" data-aos-delay="150">
			<img src="../admin/assets/menu/<?php echo $val3->image;?>" width="400">
		  </div>
        
            <div class="col-lg-7 pb-5">
				<?php if(isset($_GET['added'])){?>
				<div class="alert alert-info alert-dismissable">
					<strong>Order Added!</strong> Please see your cart!
				</div>
				<?php } ?>
				<form method="post">

                <p class="mb-4"><b>Description :</b> <br> <?php echo $val3->description;?></p>
                <p class="mb-4"><b>Size :</b> <br>
				<div class="col-4">
					<select class="form-control" name="size" required>
						<option value=""> - Select Size -  </option>
						<option> Small </option>
						<option> Meduim </option>
						<option> Large </option>
					</select>
				</div>
				</p>
               <p class="mb-4"><b>Add Ons :</b> <br>
				<div class="col-4">
					<select class="form-control" name="addons[]" multiple>
						<option value=""> - Select Add-Ons -  </option>
						<?php
							$category = $mysqli->query("SELECT * from pos_addons");
								while($val2 = $category->fetch_object()){
									echo "<option value=". $val2->name  .">" .  $val2->name . "</option>";
							}
						?>
					</select>
				</div>
				</p>
              
				
                
                <div class="d-flex align-items-center mb-4 pt-2">
					<input type="hidden" value="<?php echo $_GET['data'];?>" name="id">
					<input type="hidden" value="<?php echo $val3->item_id;?>" name="item_id">
					<input type="hidden" value="<?php echo $_SESSION['id'];?>" name="customer_id">
					<?php if($val3->is_available==1){ echo "<font color=red><b> Item Not Available </b></font>"; } else { ?>
						<button type="submit" class="btn btn-primary px-3"  name="add-order"><i class="fa fa-shopping-cart mr-1" ></i> Add To Cart</button>
					<?php } ?>
                </div>
				</form>
               
            </div>
		<?php } ?>
        </div>

      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

 <?php include("footer.php");?>