	<?php include("header.php");?>
	<?php include('controller/order-history.php');?>
			   <br><br><br><br>
				<div class="row justify-content-center">
			
				<div class="col-lg-10">
							
					<table class="table table-bordered table-hover" id="table_id">
		                 <thead>
                        <tr style="background-color:#F3E3C3;">
                                <th data-priority="1">Transaction Code</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Date Ordered</th>

                            </tr>
                        </thead>
                        <tbody><!-- Button trigger modal -->

						<?php while($val1 = $checkout1->fetch_object()){	?>
                            <tr>
                                <td><a href="#" data-toggle="modal" data-target="#view-details<?php echo $val1->transcode;?>"><?php echo $val1->transcode;?></a></td>
                                <td>₱ <?php echo number_format( $val1->total,2);?>
								</td>
                                <td><?php 
								if($val1->order_status==1){ echo 'Pending'; } 	
								else if($val1->order_status==2){ echo 'Approved'; } 
								else if($val1->order_status==5){ echo 'Cancelled'; } 
								else if($val1->order_status==6){ echo 'Completed'; } 
								?></td>
                                <td><?php echo $val1->date_added;?></td>
                            </tr>
							<div class="modal fade" id="view-details<?php echo $val1->transcode;?>"  role="dialog"  tabindex="-1">
							<div class="modal-dialog modal-dialog-centered">
							  <div class="modal-content">
								<div class="modal-header">
								  <h5 class="modal-title"> Order Details </h5>
								  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
								<?php
								$transcode  = $val1->transcode;
								$orders1    = $mysqli->query(
								"SELECT a.* ,b.*,c.* from pos_order a 
								left join pos_items b on a.item_id = b.item_id
								left join pos_addons c on c.addons_id  = a.addons 								
								where a.status = 1 and a.trans_code='$transcode' "
								);
								while($val2 = $orders1->fetch_object()){	
								?>
								 <div class="alert alert-info">
									Item Name : <?php echo $val2->item_name;?><br>
									Price : <?php	
											if($val2->size == "Small"){ $length1 = $val2->small;}
											if($val2->size == "Meduim"){ $length1 = $val2->meduim;}
											if($val2->size == "Large"){ $length1 = $val2->large; }
											if($val2->addons !=""){
												$a = $val2->addprice;
											} else {
												$a = 0;
											}
											
											echo $length1 + $a;
								
								?><br>
									Qty : <?php echo $val2->qty;?><br>
									Total : <?php echo number_format($length1  * $val2->qty,2);?>
								</div>
								<?php } ?>
								</div>
								<div class="modal-footer">
								<button type="button" class="btn btn-default btn-warning" data-dismiss="modal">Close</button>
								</div>
							  </div>
							</div>
						</div>
						<?php } ?>
                        </tbody>
                    </table>
            </div>
        </div>
     
    <br> <br> <br> <br> <br>
    <br> <br> <br> <br> <br>
	<?php include("footer.php");?>