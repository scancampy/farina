  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
               <li class="breadcrumb-item ">Product</li>
              <li class="breadcrumb-item active"><?php echo $title; ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Manage Products Review</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablebrand" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Num. of Rating</th>
                    <th>Current Rating</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                  // print_r($products)
                   foreach ($products as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value['data']->name; ?></td>
                      <td><?php echo $value['data']->brandname; ?></td>
                      <td><?php echo $value['total']; ?></td>
                      <td><?php echo $value['rating']; ?></td>
                      <td>
                        <?php for($i = 1; $i<= $value['data']->rating; $i++) { ?>
                      <i class="fas fa-regular fa-star"></i>
                    <?php } ?>
                      </td>
                      <td><?php if(empty($value['data']->show_review)) { echo '<span class="badge badge-secondary">N/A</span>'; } else if($value['data']->show_review == TRUE) {
                         echo '<span class="badge badge-success">Approved</span>';
                      } else if($value['data']->show_review == FALSE) {
                         echo '<span class="badge badge-warning">Rejected</span>';
                      } ?></td>
                     
                      <td class="d-flex justify-content-end">
                        <a href="#" data-toggle="modal" data-target="#modalinspect" transdetailid="<?php echo $value['data']->id; ?>" class="btn btn-xs btn-primary mr-1 inspect"><i class="nav-icon fas fa-search"></i> Inspect</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Num. of Rating</th>
                    <th>Current Rating</th>
                    <th>Rating</th>
                    <th>Status</th>
                    <th>Actions</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade " id="modalinspect" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/product/review'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Inspect Product Review</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" readonly >
          </div>

          <div class="form-group">
            <label for="brand_id">Brand</label>
            <input type="text" class="form-control" id="brand" name="brand" readonly >
          </div>

          <div class="form-group">
            <label for="brand_id">Rating</label>
            <input type="text" class="form-control" id="rating" name="rating" readonly >
          </div>
          

          <div class="form-group">
            <label for="review">Reviews</label>
           <textarea readonly class="textarea"  name="review" id="review"
                          style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" onclick="return confirm('Are you sure want to reject this user review?');" value="submit" name="btnReject" class="btn btn-outline-danger">Reject</button>
          <button type="submit" onclick="return confirm('Are you sure want to approve this user review?');" value="submit" name="btnApprove" class="btn btn-success">Approve</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> 