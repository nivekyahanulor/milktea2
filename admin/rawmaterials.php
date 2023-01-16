  <?php include("header.php");?>
  <?php include("nav.php");?>
  <?php include('controller/rawmaterials.php');?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
				<h5 class="card-title"><button class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#add-item"> <i class="bi bi-plus-square"></i> Add Raw Materials </button></h5>
                <div class="col-lg-12 col-md-12 order-1">
				<div class="card">
				<br>
                 <table class="table table-striped table-bordered" id="table_id">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Materials</th>
                    <th scope="col"  class="text-center">Supplier</th>
                    <th scope="col"  class="text-center">Quantity</th>
                    <th scope="col"  class="text-center">Date Added</th>
                    <th scope="col"  class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php 
				// $in  = 0;
				// $out = 0;
				while($val = $raw_materials->fetch_object()){ ?>
				  <tr>
                    <td class="text-center"><a href="rawmaterials-details.php?data=<?php echo $val->id;?>"><?php echo $val->material;?></a></td>
                    <td class="text-center"><?php echo $val->name;?></td>
					<td class="text-center"><?php
						$mids = $val->id;
						
						$raw_materials_details1 = $mysqli->query("SELECT sum(quantity)INS from stock_list_materials where material_id='$mids' and type = 1");
						$raw_materials_details2 = $mysqli->query("SELECT sum(quantity)OUTS from stock_list_materials where material_id='$mids' and type = 2");
						
						$inval  = $raw_materials_details1->fetch_row();
						$outval = $raw_materials_details2->fetch_row();

						echo $inval[0] - $outval[0];
					
					?></td>
                    <td class="text-center"><?php echo $val->date_added;?></td>
                    <td class="text-center">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit-item<?php echo $val->id;?>"> <i class="bi bi-pencil-square"></i> </button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete-item<?php echo $val->id;?>"> <i class="bi bi-trash"></i> </button>
					</td>
                  </tr>
				  
				  
					 <div class="modal fade" id="edit-item<?php echo $val->id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered ">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Update Materials</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						   <form class="row g-3" enctype="multipart/form-data" method="post">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label"> Material Name: </label>
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->id;?>" required>
							  <input type="text" class="form-control" name="name" value="<?php echo $val->material;?>" required>
							</div>
							<div class="col-12">
							<br>
								  <label for="inputNanme4" class="form-label">Material Supplier: </label>
								  <select class="form-control" name="item_supplier_id" required>
									<option value=""> - Select Supplier - </option>
									<?php
										$supplier = $mysqli->query("SELECT * from pos_supplier");
											while($val1 = $supplier->fetch_object()){
												if($val->supplier == $val1->supplier_id){
													echo "<option value=". $val1->supplier_id ." selected>" .  $val1->name . "</option>";
												} else {
													echo "<option value=". $val1->supplier_id .">" .  $val1->name . "</option>";
												}
											}
									?>
								  </select>
								</div>
						
							</div>
							
								<div class="modal-footer">
								  <button type="submit" class="btn btn-primary" name="update-item">Save </button>
								  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
								</div>
								</form>
						</div>
						</div>
					</div>
					
					 <div class="modal fade" id="delete-item<?php echo $val->id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Delete Raw Material</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						 <form class="row g-3" method="post">
							<div class="col-12">
							 <br>
							  Are your sure to delete this Data?
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->id;?>" required>
							</div>
						</div>
						<div class="modal-footer">
						  <button type="submit" class="btn btn-warning" name="delete-item">Delete </button>
						  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						</div>
						</form>
					  </div>
					</div>
					</div>
                <?php } ?>
                </tbody>
                </table>
                </div>
                </div>
         
              </div>
            
            </div>
            <!-- / Content -->
		<div class="modal fade" id="add-item" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title"> Raw Material Details </h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                     <form method="post"  enctype="multipart/form-data">
					 <div class="row">
						<div class="col-12">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label"> Name: </label>
							  <input type="text" class="form-control" name="name" required>
							</div>
						</div>
					
						<div class="col-12">
							<br>
								  <label for="inputNanme4" class="form-label">Material Supplier: </label>
								  <select class="form-control" name="item_supplier_id" required>
									<option value=""> - Select Supplier - </option>
									<?php
										$supplier = $mysqli->query("SELECT * from pos_supplier");
											while($val1 = $supplier->fetch_object()){
												echo "<option value=". $val1->supplier_id .">" .  $val1->name . "</option>";
											}
									?>
								  </select>
								</div>
					</div>
					<hr>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="add-item">Save </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
        </div>
		
    <?php include("footer.php");?>      