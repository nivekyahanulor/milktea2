<?php include("header.php");?>

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <p><?php echo $_GET['name'];?></p>
        </div>

        <div class="row gy-4">
		<?php
		$id         = $_GET['data'];
		$products   = $mysqli->query("SELECT * from pos_items where category='$id'");
		while($val3 = $products->fetch_object()){	
		?>
          <div class="col-lg-5 position-relative about-img"  data-aos="fade-up" data-aos-delay="150">
			<img src="admin/assets/menu/<?php echo $val3->image;?>" width="400">
		  </div>
          <div class="col-lg-7" data-aos="fade-up" data-aos-delay="300">
            <div class="content ">
            
              <p class="fst-italic">
                <p class="mb-4"><b>Description :</b> <br> <?php echo $val3->description;?></p>
				<p class="mb-4"><b>Small :</b> <br>  ₱ <?php echo number_format($val3->small,2);?></p>
                <p class="mb-4"><b>Meduim :</b> <br>  ₱ <?php echo number_format($val3->meduim,2);?></p>
                <p class="mb-4"><b>Large :</b> <br>  ₱ <?php echo number_format($val3->large,2);?></p>
				<hr>
				
              </p>
            
            </div>
          </div>
		<?php } ?>
        </div>

      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

 <?php include("footer.php");?>