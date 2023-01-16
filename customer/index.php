 
 <?php include("header.php");?>
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">Welcome To</h2>
          <h2 data-aos="fade-up">Brewed Delights by Tea Spot</h2>

          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="../assets/img/brewed.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">

    <!-- ======= About Section ======= -->
        <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
          <p>Learn More <span>About Us</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url(../assets/img/about.jpg) ;" data-aos="fade-up" data-aos-delay="150">
          
          </div>
          <div class="col-lg-5 " data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
				<?php echo $sval[8];?>
             
            </div>
          </div>
        </div>

      </div>
    </section><!-- End About Section -->
    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Products</h2>
          <p>Check Our <span>Brewed Delights</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <li class="nav-item">
				<a href="index.php?data=ALL#menu" class="nav-link">
					 <h4>ALL</h4>
				</a>
			</li>
			<?php
			$category1 = $mysqli->query("SELECT * from pos_item_category ");
			while($val1 = $category1->fetch_object()){	
			?>
			<li class="nav-item">
				<a href="index.php?data=<?php echo $val1->name;?>#menu" class="nav-link">
					 <h4><?php echo $val1->name;?></h4>
				</a>
			</li>
			<?php } ?>
        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">
		<?php
		$name       = $_GET['data'];
			if($name == "ALL"){
			$category2  = $mysqli->query("SELECT * from pos_item_category ");
			} else {
			$category2  = $mysqli->query("SELECT * from pos_item_category where name='$name'");
			}
			while($val2 = $category2->fetch_object()){	
			
			$id         = $val2->category_id;
			$products   = $mysqli->query("SELECT * from pos_items where category='$id'");
		
		?>
          <div>
            <div class="tab-header text-center">
              <h3><?php echo $name;?></h3>
            </div>
            <div class="row gy-5">
            <?php 	while($val3 = $products->fetch_object()){	 ?>
              <div class="col-lg-4 menu-item">
                <a href="product-details.php?data=<?php echo $val3->item_id;?>&name=<?php echo $val3->item_name;?>"><img src="../admin/assets/menu/<?php echo $val3->image;?>"  class="menu-img img-fluid" alt=""></a>
                <h4><?php echo $val3->item_name;?></h4>
                <p class="ingredients">
                 SMALL - <?php echo $val3->small;?> | MEDIUM - <?php echo $val3->meduim;?>  | LARGE - <?php echo $val3->large;?>
                </p>
              
              </div><!-- Menu Item -->
              <?php } ?>
            </div>
          </div>
		<?php } ?>
        </div>

      </div>
    </section><!-- End Menu Section -->

   
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contact</h2>
          <p>Need Help? <span>Contact Us</span></p>
        </div>

        <div class="mb-3">
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621" frameborder="0" allowfullscreen></iframe>
        </div><!-- End Google Maps -->


        <form action="forms/contact.php" method="post" role="form" class="php-email-form p-3 p-md-4">
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>
        <!--End Contact Form -->

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
  
  
  <?php include("footer.php");?>