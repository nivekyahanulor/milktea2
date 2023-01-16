  <?php include("header.php");?>
  <?php include("nav.php");?>
  <?php include('controller/inventory.php');?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
                <div class="col-lg-12 col-md-12 order-1">
				<div class="card">
				<br>
                 <table class="table table-striped table-bordered" id="table_id">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Item Name</th>
                    <th scope="col"  class="text-center">Size</th>
                    <th scope="col"  class="text-center">Amount</th>
                    <th scope="col"  class="text-center"> Qty</th>
                    <th scope="col"  class="text-center">Date Ordered</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $sales->fetch_object()){ ?>
				  <tr>
                    <td class="text-center"><?php echo $val->item_name;?></td>
                    <td class="text-center"><?php echo strtoupper($val->size);?></td>
                    <td class="text-center"> ₱ <?php 
					if($val->size == "Small"){ $length1 = $val->small;}
					if($val->size == "Meduim"){ $length1 = $val->meduim;}
					if($val->size == "Large"){ $length1 = $val->large; }
					echo number_format($length1 * $val->qty,2);?></td>
                    <td class="text-center"><?php echo $val->qty;?></td>
                    <td class="text-center"><?php echo $val->created_at;?></td>
                  
                  </tr>
		
                <?php } ?>
                </tbody>
                </table>
                </div>
                </div>
         
              </div>
            
            </div>

		
    <?php include("footer.php");?>      