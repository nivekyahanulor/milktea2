	<?php include("header.php");?>

    <!-- Cart Start -->
	
    <div class="container-fluid pt-5">
	<br>
	<br>
			<div class="row px-xl-5 justify-content-center">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr style="background-color:#F3E3C3;">
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Size</th>
                            <th>Add-ons</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
						<?php
						    $totalons  = 0;
						    $totalons1  = 0;
						    $total  = 0;
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
										  echo number_format($length * $val->qty,2);?> </td>
	                                <td>
	                                  	<input type="number" name="cnt" class="" min="1" value="<?php echo $val->qty;?>" style="width:70px" >	
	                                </td> 
									
	                                <td><?php echo $val->size;?></td>   
	                                <td><?php if($val->addons !="null"){ echo $val->addons . ' - ₱'. number_format($totalons,2) ;}?></td>   
	                                <td>₱ <?php echo number_format(($length * $val->qty) + $totalons,2);?> </td>
	                                <td> 
	                                  	<input type="hidden" name="order_id" class="form-control" value="<?php echo $val->order_id;?>" >	
										<button type="submit" class="btn btn-sm btn-success" name="update-cart"> Update </button> 
										<button  type="submit" class="btn btn-sm btn-danger" name="delete-cart"> Remove </button> 
									</td>
	                              
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
					 <p class="mb-4"><b>Delivery Type :</b> <br>
						<div class="col-12">
							<select class="form-control" name="delivery_option" required>
								<option value=""> - Select Type -  </option>
								<option> Pick Up </option>
								<option> COD </option>
							</select>
						</div>
						</p>
							<p class="mb-4"><b>Discount Voucher:</b> <br>
						<div class="col-12">
							  <select class="form-control" name="voucher"  required>
								<option value=""> - Select Discount Voucher- </option>
								<?php
									$category = $mysqli->query("SELECT * from pos_voucher");
										while($val2 = $category->fetch_object()){
												echo "<option value=". $val2->discount .">" .  $val2->voucher . ' - '. $val2->discount . "% </option>";
										}
								?>
							  </select>
						</div>
						</p>
						<hr>
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Subtotal</h6>
                            <h6 class="font-weight-medium">₱ <?php echo number_format($total,2);?></h6>
                        </div>
                       <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">Add Ons</h6>
                            <h6 class="font-weight-medium">₱ <?php echo number_format($totalons1,2);?></h6>
                        </div>
                       
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">Total</h5>
                            <h5 class="font-weight-bold">₱ <?php echo number_format($total + $totalons1,2);?></h5>
                        </div>
						<input type="hidden" id="total" value="<?php echo $total;?>">
						<input type="hidden" name="transcode" value="<?php echo $_SESSION['transcode'];?>">
						<input type="hidden" name="customerid" value="<?php echo $_SESSION['id'];?>">
                        <button class="btn btn-block btn-primary my-3 py-3" name="checkout-order">Process To Checkout</button>
                    </div>
                </div>
				</form>
            </div>
		
		</div>

    </div>
    <!-- Cart End -->
	<?php include("footer.php");?>