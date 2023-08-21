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
               <li class="breadcrumb-item ">Messaging</li>
             
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
                <h3 class="card-title p-3">Manage Messaging</h3>
                 <div class="ml-auto p-3">
                  <a href="<?php echo base_url('admin/messaging/new'); ?>"class="btn btn-primary btn-xs"><i class="nav-icon fas fa-plus"></i> Compose New Message</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablearticle" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Title</th>
                    <th>Delivered To</th>
                    <th>Created</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($messages as $key => $value) { ?>
                    <tr>
                     
                      <td><?php echo $value->title; ?></td>
                      <td><?php echo $value->delivered_to; ?></td>
                      <td><?php echo strftime("%d %B %Y", strtotime($value->created)); ?></td>
                      <td class="d-flex justify-content-end">
                        <a href="<?php echo base_url('admin/messaging/edit/'.$value->id); ?>" class="btn btn-xs btn-primary mr-1 memberedit"><i class="nav-icon fas fa-edit"></i> Edit</a> 
                        <a href="<?php echo base_url('admin/messaging/del/'.$value->id); ?>" class="btn btn-xs btn-danger mr-1" onclick="return confirm('Yakin hapus?');"><i class="nav-icon fas fa-trash"></i> Hapus</a>
                      </td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>Title</th>
                    <th>Delivered To</th>
                    <th>Created</th>
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

  <div class="modal fade " id="modalEditMember" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/member'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Edit Member</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
          </div>

          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
          </div>


          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email"  readonly>
          </div>

          <div class="form-group">
            <label for="member_type">Member Type</label>
            <select class="form-control" id="member_type" name="member_type">
              <option value="regular">Regular</option>
              <option value="VIP">VIP</option>
            </select>
          </div>


          <div class="form-group">
            <label for="status">Member Status</label>
            <select class="form-control" id="status" name="status">
              <option value="active">Active</option>
              <option value="pending">Pending</option>
              <option value="banned">Banned</option>
            </select>
             <small id="statusHelp" class="form-text text-muted">User tidak dapat login jika status pending atau banned</small>
          </div>

          <div class="form-group">
            <label for="referral">Referral</label>
            <input type="text" class="form-control" id="referral" name="referral"  readonly>
          </div>


          <div class="form-group">
            <label for="joined_date">Joined Date</label>
            <input type="text" class="form-control" id="joined_date" name="joined_date"  readonly>
          </div>


          <div class="form-group">
            <label for="became_vip_date">Became VIP Since</label>
            <input type="text" class="form-control" id="became_vip_date" name="became_vip_date"  readonly>
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

<style type="text/css">
  iframe {
    width: 100% !important;
    height: 100% !important;
  }
</style>