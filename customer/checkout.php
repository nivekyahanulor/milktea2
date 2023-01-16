	<?php include("header.php");?>

    <!-- Cart Start -->
    <div class="container-fluid pt-5">

		<div class="row px-xl-5 justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
			<br><br>
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
	                            <tr  style="background-color:#F3E3C3 !important;">
	                                <th>Name</th>
	                                <th>Price</th>
	                                <th>Quantity</th>
									<th>Size</th>
									<th>Add-ons</th>
	                                <th>Total</th>
	                            </tr>
	                        </thead>
	                        <tbody>
							
							<?php
							    $total = 0;
							    $totalons = 0;
							    $totalons1 = 0;
								while($val = $orders->fetch_object()){	
								if($val->size == "Small"){ $length = $val->small;}
								if($val->size == "Meduim"){ $length = $val->meduim;}
								if($val->size == "Large"){ $length = $val->large; }
								if($val->addons !=0){
									$a = $val->addprice;
								} else {
									$a = 0;
								}
								$total += ($length * $val->qty) + $a;
								$ons = 10;
								$totalons  = (10 * $val->countons) * $val->qty;
								$totalons1  += (10 * $val->countons) * $val->qty;
							?>
							<form method="post">
	                            <tr>
	                                <td><?php echo $val->item_name;?></td>   
									<td>₱ <?php 
										  if($val->size == "Small"){ $length = $val->small;}
										  if($val->size == "Meduim"){ $length = $val->meduim;}
										  if($val->size == "Large"){ $length = $val->large; }
										  
										 
										  echo number_format(($length * $val->qty),2);
										  
										  ?> </td>
	                                <td>
	                                  	<?php echo $val->qty;?>
	                                </td>
									<td><?php echo $val->size;?></td>   
	                                <td><?php if($val->addons !="null"){ echo $val->addons . ' - ₱'. number_format($totalons,2) ;}?></td>   
									
	                                <td>₱ <?php echo number_format(($length* $val->qty) + $a,2);?> </td>
	                               
	                            </tr>
							</form>
							<?php } ?>  
	                        </tbody>
	                    </table>
	                  
            </div>

        </div>
		  <div class="row px-xl-5 justify-content-center"> 
            <div class="col-lg-4">
              <form method="post">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0"  style="background-color:#F3E3C3 !important;" >
                        <h4 class="font-weight-semi-bold m-0">Cart Summary</h4>
                    </div>
                    <div class="card-body">
					<?php
						while($val2 = $checkout->fetch_object()){	
							
								if($val2->voucher !=""){
								$voucher =  (($val2->voucher / 100) * $total);
								} else {
								$voucher =  0;
								}
								
						}

						?>
						<div class="col-12">
						DELIVERY OPTION : <b><?php echo $_GET['delivery'];?></b> <br>
						<?php if( $_GET['delivery'] == 'Delivery'){?>
							ADDRESS : <b><?php echo $_SESSION['address'];?></b>
						<?php } ?>
						</div>
						</p>
						<hr>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">₱ <?php echo number_format($total + $totalons1 , 2);?></h6>
                        </div> 
						<div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Discount Voucher</h6>
                            <h6 class="font-weight-medium">(-) ₱ <?php echo number_format($voucher  , 2);?></h6>
                        </div>
						<?php if($_GET['delivery'] == 'COD'){
						    $del = 38;
						?>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">
                            For Delivery Fee : ₱ 38.00 <br>
                        </div>
						<?php } else { $del = 0; } ?>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">₱ <?php echo number_format(($total + $totalons1 + $del) - $voucher ,2);?></h5>
                        </div>
						<input type="hidden" name="total" value="<?php echo ($total + $totalons1 + $del)- $voucher;?>">
						<?php if($_GET['delivery'] == 'COD'){ ?>
                        <button class="btn btn-block btn-primary my-3 py-3" name="confirm-order">Proceed To Payment</button>
						<?php } else { ?>
                        <button class="btn btn-block btn-primary my-3 py-3" name="payment-order">Proceed To Payment</button>
						<?php } ?>
                    </div>
                </div>
				</form>
            </div>
		</div>
    </div>
    <!-- Cart End -->
	<?php include("footer.php");?>