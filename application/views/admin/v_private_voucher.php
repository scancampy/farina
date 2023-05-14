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

              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/voucher'); ?>">Voucher</a></li>
               
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
                <h3 class="card-title p-3">Private Voucher</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-3">
                    <?php if($voucher[0]->filename != null) { ?>
                      <img style="width:100%" src="<?php echo base_url('img/voucher/'.$voucher[0]->filename); ?>" />
                    <?php } ?>
                  </div>
                  <div class="col-md-9">
                    <p><strong>Voucher <?php echo $voucher[0]->voucher_code; ?></strong>
                    <br/>
                    <?php echo $voucher[0]->title; ?> 
                    <br/>
                    <?php if($voucher[0]->min_order >0 ) { echo "Minimum order: Rp. ".number_format($voucher[0]->min_order,0,',','.'); } else { echo "No Minimum Order"; } ?>
                    <br/>
                    <?php if($voucher[0]->discount_percentage >0) { echo "Discount: ".$voucher[0]->discount_percentage."%"; } else if($voucher[0]->discount_value >0) { echo "Discount: Rp. ".number_format($voucher[0]->discount_value,0,',','.'); } ?>
                    <br/>
                    <?php echo "Expired: ".strftime("%d %B %Y", strtotime($voucher[0]->exp_date)); ?>
                  </p>
                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
          <div class="col-md-12">
            
            <div class="card">
              <div class="card-header d-flex p-0">
                <h3 class="card-title p-3">Manage Member</h3>
                <div class="ml-auto p-3">
                  <a href="#" data-toggle="modal" vouid="<?php echo $voucher[0]->voucher_code; ?>"  data-target="#modalAddProduct" id="btnaddvoucher" class="btn btn-primary btn-xs"><i class="nav-icon fas fa-plus"></i> Assign Voucher To Member</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablebrand" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Member Email</th>
                    <th>Name</th>
                    <th>Voucher Is Used</th>
                    <th>Member Type</th>
                    <th >Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($member as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->email; ?></td>
                      <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                      <td><?php if(!$is_used[$key]) { echo '<span class="badge bg-secondary">used</span>'; } else { echo '-'; } ?></td>    
                      <td><?php echo $value->member_type; ?></td>                  
                      <td class="">
                        <a href="<?php echo base_url('admin/voucher/revokemember/'.$value->vassingn_id.'/'.$voucher[0]->voucher_code); ?>" onclick="return confirm('Are you sure want to revoke this member?');" class="btn btn-xs btn-danger m-0"><i class="nav-icon fas fa-trash"></i> Revoke</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Member Email</th>
                    <th>Name</th>
                    <th>Voucher Is Used</th>
                    <th>Member Type</th>
                    <th width="25%">Actions</th>
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
      <form action="<?php echo base_url('admin/voucher/privatemember/'.$voucher[0]->voucher_code); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Assign Voucher</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="voucher_code">Voucher Code</label>
            <input type="text" class="form-control" id="voucher_code" name="voucher_code" readonly>
          </div>

          <div class="form-group">
            <label for="title">Voucher Title</label>
            <input type="text" class="form-control" id="title" name="title" readonly>
          </div>

          <div class="form-group">
            <label for="member_search">Search Member</label>
            <input type="text" class="form-control" id="member_search" name="member_search" placeholder="Type email or name">
          </div>

          <div class="row">
            <div class="col-md-12">
              <table id="tablemembersearchresult" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Member Email</th>
                    <th>Member Type</th>
                    <th>Member Name</th>
                    <th>Assign</th>
                  </tr>
                </thead>
                <tbody id="container_member_result">
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div> 