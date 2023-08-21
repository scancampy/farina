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
               <li class="breadcrumb-item "><?php echo $title; ?></li>
             
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
                <h3 class="card-title p-3">Manage Registration - <?php echo $event[0]->name; ?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <p>Event Details:</p>
                <?php // print_r($event); ?>
                <dl>
                  <dt>Date</dt>
                  <dd><?php echo strftime("%A, %d %B %Y %H:%M", strtotime($event[0]->event_date)); ?></dd>
                  <dt>Event Fee</dt>
                  <dd>IDR <?php echo number_format($event[0]->event_fee,0,',','.'); ?></dd>
                  <dt>Points Earned</dt>
                  <dd><?php echo $event[0]->points; ?></dd>
                </dl>

                <table id="tablearticle" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Member</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Register Date</th>
                    <th class="text-center">Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($members as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                      <td><?php echo $value->phone; ?></td>
                      <td><?php echo $value->email; ?></td>
                      <td><?php echo strftime("%d-%m-%Y", strtotime($value->payment_confirmation_date)); ?></td>   
                      <td class="text-center">
                        <?php
                        if($value->status == 'pending') {
                          echo '<span class="badge badge-secondary">Verify Request in Progress</span>';
                        } else  if($value->status == 'registered') {
                          echo '<span class="badge badge-success">Registered</span>';
                        } else  if($value->status == 'cancelled') {
                          echo '<span class="badge badge-dark">Canceled</span>';
                        }
                         ?>
                        
                      </td>
                          
                      <td class="text-center">
                        <a href="#"  data-toggle="modal"  data-target="#modalverify" memberid="<?php echo $value->member_id; ?>" eventid="<?php echo $value->event_id; ?>" class="btn btn-xs btn-primary mr-1 verifyregis"><i class="nav-icon fas fa-edit"></i> Verify</a> 
                       </td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Member</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Register Date</th>
                    <th class="text-center">Status</th>
                    <th>Action</th>
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

   <div class="modal fade" id="modalverify" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="<?php echo base_url('admin/events/registration/'.$event[0]->id); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Verify Member Registration</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" id="eventid" name="eventid"/>
              <input type="hidden" id="memberid" name="memberid"/>
              <label for="name">Payment Proof</label>
              <img class="image" style="width: 100%;" id="imgproof" class="img-thumbnail" />
            </div>
             <div class="form-group">
              <label for="status">Status</label>
              <select class="form-control" name="status" id="status">
                <option value="pending">Verify Request in Progress</option>
                <option value="registered">Registered</option>
                <option value="cancelled">Canceled</option>
              </select>
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