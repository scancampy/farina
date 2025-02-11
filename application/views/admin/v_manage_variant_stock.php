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
            <form method="post" action="<?php echo base_url('admin/product/variant'); ?>">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo $title; ?></h3>
                <div class="card-tools">
                  <button type="submit" value="Submit" name="btnApply" id="btnApply" class="btn btn-primary">Update Stock</button>
                </div>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="callout callout-info">
                  <h5>Bulk Update</h5>

                  <p>Untuk melakukan update stok secara bersamaan. Silahkan beri tanda centang pada produk yang ingin diubah stoknya, lalu isikan jumlah stok di bawah ini. Validasi dengan menekan tombol "Bulk Update"</p>
                  <div class="form-row">
                    <div class="col-md-2">
                      <input type="number"  class="form-control" id="bulkstok" name="bulkstok"  >
                    </div>
                    <div class="col">
                      <button type="submit" value="Submit" name="btnApplyBulk" id="btnApplyBulk" class="btn btn-primary">Bulk Update</button>
                    </div>
                  </div>
                </div>
                <table id="tablebrand" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th><input type='checkbox' id='checkall' /></th>
                    <th>Product Name</th>
                    <th>Variant</th>
                    <th>Stock</th>
                    <th>Active</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                 // print_r($variants);
                   foreach ($variants as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><input type='checkbox' name="bulkqty[]" value="<?php echo $value->id; ?>" /></td>
                      <td><?php echo $value->prodname; ?></td>
                      <td><?php echo $value->name; ?></td>
                      <td><input type="number" min="0" value="<?php echo $value->stok; ?>" name="stok[]"/><input type="hidden" name="hiddenidvariant[]" value="<?php echo $value->id; ?>"></td>
                      <td><?php if($value->is_active) { echo '<span class="badge badge-success">active</span>'; } else { echo '<span class="badge badge-secondary">inactive</span>'; } ?></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th></th>
                    <th>Product Name</th>
                    <th>Variant</th>
                    <th>Stock</th>
                    <th>Active</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </form>
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