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
                <h3 class="card-title p-3">Manage Voucher Data</h3>
                <div class="ml-auto p-3">
                  <a href="#" data-toggle="modal" data-target="#modalAddProduct" id="btnaddvoucher" class="btn btn-primary btn-xs"><i class="nav-icon fas fa-plus"></i> Add New Voucher</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablebrand" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Voucher Code</th>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Expired Date</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($voucher as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->voucher_code; ?></td>
                      <td><?php echo $value->title; ?></td>
                      <td><?php echo $value->voucher_type; ?></td>                      
                      <td><?php echo $value->exp_date; ?></td>
                      
                      <td class="d-flex justify-content-end">
                        <a href="#" vouid="<?php echo $value->voucher_code; ?>" class="btn btn-xs btn-primary mr-1 voudedit"><i class="nav-icon fas fa-edit"></i> Edit</a> 
                        <a href="<?php echo base_url('admin/voucher/delvoucher/'.$value->voucher_code); ?>" onclick="return confirm('Are you sure want to delete <?php echo $value->voucher_code; ?>?');" class="btn btn-xs btn-danger m-0"><i class="nav-icon fas fa-trash"></i> Delete</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Availability</th>
                    <th>Price</th>
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

  <div class="modal fade " id="modalAddProduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/voucher'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Voucher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="voucher_code">Voucher Code</label>
            <input type="text" class="form-control" id="voucher_code" name="voucher_code" required placeholder="Enter voucher code">
          </div>

          <div class="form-group">
            <label for="voucher_type">Voucher Type</label>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="voucher_type" id="voucher_type_global" value="global" checked="">
                <label class="form-check-label">Global</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="voucher_type" id="voucher_type_vip" value="vip" >
                <label class="form-check-label">VIP</label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="voucher_type" id="voucher_type_private" value="private" >
                <label class="form-check-label">Private</label>
              </div>
            </div>

         

          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title"  placeholder="" required>
          </div>

          <div class="form-group">
            <label for="description">Description</label>
           <textarea class="textarea" placeholder="Enter description" name="description"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>




          <div class="row">
            
            <div class="col-sm-6">
              <div class="form-group">
                <label for="discount_percentage">Discount (%)</label>
                <input type="number" class="form-control" id="discount_percentage" name="discount_percentage"  placeholder="" value="0">  
              </div>
            </div>

            <div class="col-sm-6">
              <div class="form-group">
                <label for="discount_value">Discount (Rp)</label>
                <input type="number" class="form-control" id="discount_value" name="discount_value"  placeholder="" value="0">
                <small id="" class="form-text text-muted">
                  (if filled, discount in % will be ignored)
                </small>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="min_order">Min. Order</label>
                <input type="text" class="form-control" id="min_order" name="min_order"  placeholder="" value="0">
                <small id="" class="form-text text-muted">
                  (in Rupiah)
                </small>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="exp_date">Voucher Expired Date</label>
                 <div class="input-group date" id="expireddate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" id="exp_date" name="exp_date" data-target="#expireddate"/>
                    <div class="input-group-append" data-target="#expireddate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group" id="divcurrentvoucher" style="display: none;">
            <label for="exp_date">Current Voucher Image</label>
            <div id="divvoucherimage">
            </div>
          </div>

          <div class="form-group">
            <label for="exp_date">Upload Voucher Image</label>
            <div class="custom-file">
              <input type="file" class="form-control" id="fotovoucher" name="fotovoucher">
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" value="submit" name="btnSubmit" class="btn btn-primary">Save changes</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> 