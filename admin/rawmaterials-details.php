  <?php include("header.php");?>
  <?php include("nav.php");?>
  <?php include('controller/rawmaterials.php');?>

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
              <div class="row">
				<h5 class="card-title"><button class="btn btn-info btn-md" data-bs-toggle="modal" data-bs-target="#add-item"> <i class="bi bi-plus-square"></i> Add Details </button></h5>
                <div class="col-lg-12 col-md-12 order-1">
				<div class="card">
				<br>
                 <table class="table table-striped table-bordered" id="table_id">
                <thead>
                  <tr>
                    <th scope="col"  class="text-center">Materials Quantity</th>
                    <th scope="col"  class="text-center">Materials Status</th>
                    <th scope="col"  class="text-center">Date Added</th>
                    <th scope="col"  class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
				<?php while($val = $raw_materials_details->fetch_object()){ ?>
				  <tr>
                    <td class="text-center"><?php echo $val->quantity;?></td>
                    <td class="text-center"><?php if( $val->type == 1) { echo "IN";} else { echo "OUT"; }?></td>
                  
                    <td class="text-center"><?php echo $val->date_created;?></td>
                    <td class="text-center">
						<button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#edit-item<?php echo $val->id;?>"> <i class="bi bi-pencil-square"></i> </button>
						<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#delete-item<?php echo $val->id;?>"> <i class="bi bi-trash"></i> </button>
					</td>
                  </tr>
				  
				  
					 <div class="modal fade" id="edit-item<?php echo $val->id;?>" tabindex="-1">
					 <div class="modal-dialog modal-dialog-centered ">
					  <div class="modal-content">
						<div class="modal-header">
						  <h5 class="modal-title">Update Details</h5>
						  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body">
						   <form class="row g-3" enctype="multipart/form-data" method="post">
							<div class="col-12">
							  <label for="inputNanme4" class="form-label"> Material Quantity: </label>
							  <input type="hidden" class="form-control" name="id" value="<?php echo $val->id;?>" required>
							  <input type="hidden" class="form-control" name="data" value="<?php echo $_GET['data'];?>" required>
							  <input type="number" class="form-control" name="name" value="<?php echo $val->quantity;?>" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label"> Material Status: </label>
							  <select  class="form-control" name="type" required>
							  <?php if( $val->type == 1 ){ ?>
								<option value="1" selected> IN </option>
								<option value="2"> OUT </option>
							  <?php } else { ?>
								<option value="1"> IN </option>
								<option  value="2" selected> OUT </option>
							  <?php } ?>
							  </select>
							</div>
						
							</div>
							
								<div class="modal-footer">
								  <button type="submit" class="btn btn-primary" name="update-material">Save </button>
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
							  <label for="inputNanme4" class="form-label"> Quantity: </label>
							  <input type="number" class="form-control" name="name" required>
							  <input type="hidden" class="form-control" name="data" value="<?php echo $_GET['data'];?>" required>
							</div>
							<div class="col-12">
							  <label for="inputNanme4" class="form-label"> Material Status: </label>
							  <select  class="form-control" name="type" required>
								<option value="" > - Select Status - </option>
								<option value="1" selected> IN </option>
								<option value="2"> OUT </option>
							  </select>
							</div>
						</div>
					
					</div>
					<hr>
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary" name="add-items">Save </button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
					</form>
                  </div>
                </div>
        </div>
        </div>
		
    <?php include("footer.php");?>      