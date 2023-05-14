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
                <h3 class="card-title p-3">Manage Transactions Data</h3>
                <div class="ml-auto p-3">
                  
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablearticle" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Nominal</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($trans as $key => $value) { ?>
                    <tr>
                      <td><?php echo $value->id; ?></td>
                      <td><?php echo strftime("%d-%m-%Y %H:%M", strtotime($value->order_placed_date)); ?></td>   
                      <td><?php 
                    if($value->is_cancelled == 1) { 
                      echo '<span class="badge badge-danger">Order Cancelled</span>';
                    } else if($value->status == 'order_placed') { echo '<span class="badge badge-warning">Order Placed</span>'; 
                    } else if($value->status == 'order_prepared') { 
                      echo '<span class="badge badge-info">Order Prepared</span>'; 
                    } else if($value->status == 'order_in_transit') { 
                      echo '<span class="badge badge-secondary">Order in Transit</span>'; 
                    } else if($value->status == 'order_delivered') { 
                      echo '<span class="badge badge-success">Order Delivered</span>'; 
                    } ?></td>
                      <td>Rp. <?php $tot = $value->total_trans+$value->shipping_cost-$value->discount; echo number_format($tot, 0, ',','.'); ?></td>
                          
                      <td class="d-flex justify-content-end">
                        <a href="#" transid="<?php echo $value->id; ?>" class="btn btn-xs btn-primary mr-1 transedit"><i class="nav-icon fas fa-cogs"></i> Manage</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Nominal</th>
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

  <div class="modal fade " id="modalAddEvent" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/trans'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Manage Transactions</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
         <div class="col-12 col-sm-12">
            <div class="card card-primary card-outline card-tabs">
              <div class="card-header p-0 pt-1 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Order Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Shipping Details</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Payment Confirmation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Order Status</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-three-tabContent">
                  <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                    <div class="form-group">
                      <input type="hidden" id="hiddenid" name="hiddenid"/>
                      <label for="transid">ID</label>
                      <input type="text" class="form-control" id="transid" name="transid" readonly>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="order_placed_date">Order Placed Date</label>
                          <input type="text" class="form-control" id="order_placed_date" name="order_placed_date" readonly>
                        </div>
                      </div>
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="customer">Customer</label>
                          <input type="text" class="form-control" id="customer" name="customer" readonly>
                        </div>
                      </div>
                    </div>

                    <hr/>
                    
                    <div class="form-group">
                      <label for="id">Item(s) Purchased</label>
                      <table id="tableitems" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th>Name</th>
                          <th>Qty</th>
                          <th>Price</th>
                          <th>Total</th>
                        </tr>
                        </thead>
                        <tbody id="tbody_items">
                        </tbody>
                        <tfoot>

                          <tr>
                            <td colspan="3" style="text-align:right;">Subtotal</td>
                            <td id="subtotal">Rp. </td>
                          </tr>
                          <tr>
                            <td colspan="3" id="discount_info" style="text-align:right;">Discount</td>
                            <td id="discount">- Rp. </td>
                          </tr>
                          <tr>
                            <td colspan="3" style="text-align:right;">Shipping Cost</td>
                            <td id="shippping">Rp. </td>
                          </tr>
                          <tr>
                            <td colspan="3" style="text-align:right;"><strong>TOTAL</strong></td>
                            <td id="total">Rp. </td>
                          </tr>
                        </tfoot>
                      </table>
                    </div>

                    
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                     <div class="row">
                      <div class="col-md-9">
                        <div class="form-group">
                          <label for="recipient">Recipient</label>
                          <input type="text" class="form-control" id="recipient" name="recipient" readonly>
                        </div>
                      </div>
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="phone">Recipient Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" readonly>
                        </div>
                      </div>
                    </div>
                     <div class="form-group">
                      <label for="address">Address</label>
                      <textarea class="form-control" id="address" name="address" readonly></textarea>
                    </div>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label for="weight">Total Weight</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="weight" name="weight" readonly>
                            <div class="input-group-append">
                              <span class="input-group-text">kg</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    

                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                    <div class="form-group">
                      <label for="address">Payment Proof</label>
                      <div id="proof_container">
                        <p>Not Available</p>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="payment_confirmation_date">Confirmation Date</label>
                      <input type="text" class="form-control" id="payment_confirmation_date" name="payment_confirmation_date" readonly>
                    </div>


                    <div class="form-group">
                      <label for="payment_to">Payment To</label>
                      <input type="text" class="form-control" id="payment_to" name="payment_to" readonly>
                      <input type="hidden" id="payment_to1" value="<?php echo $setting->bank1.' ('.$setting->no_akun_bank1.')'; ?>"> 
                      <input type="hidden" id="payment_to2" value="<?php echo $setting->bank2.' ('.$setting->no_akun_bank2.')'; ?>"> 
                    </div>
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                     <div class="form-group">
                        <label for="weight">Status</label>
                        <div class="callout callout-danger" 
                          id="callout-cancelled" style="display: none;"> <h5>Order is Cancelled</h5>
                        </div>
                          
                        <div id="radiostatus">
                          <div class="form-check">
                            <input class="form-check-input" type="radio" id="radio_order_placed" name="radiostatus" value="order_placed">
                            <label class="form-check-label" for="radio_order_placed">Order Placed</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" id="radio_order_prepared" name="radiostatus" value="order_prepared">
                            <label class="form-check-label" for="radio_order_prepared">Order Prepared</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" id="radio_order_in_transit" name="radiostatus" value="order_in_transit">
                            <label class="form-check-label" for="radio_order_in_transit">Order in Transit</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" id="radio_order_delivered" name="radiostatus" value="order_delivered">
                            <label class="form-check-label" for="radio_order_delivered">Order Delivered</label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="noresi">No. Resi</label>
                        <input type="text" class="form-control" id="noresi" name="noresi">
                      </div>
                      <div class="form-group">
                        <label for="shipping_service">Shipping Service</label>
                        <input type="text" readonly class="form-control" id="shipping_service" name="shipping_service">
                      </div>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <div class="col-md-12" style="display: flex;">
            <div class="col-md-6">
              <button type="submit" class="btn btn-danger" name="btnCancelSubmit" id="btnCancelSubmit" value="Cancel Order">Cancel Order</button>
            </div>
            <div class="col-md-6 text-right">
              <button type="submit" value="submit" name="btnSubmit"  id="btnSubmit" class="btn btn-primary">Save changes</button>
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div> 

<style type="text/css">
  iframe {
    width: 100% !important;
    height: 100% !important;
  }
</style>