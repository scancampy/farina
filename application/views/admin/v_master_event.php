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
               <li class="breadcrumb-item ">Events</li>
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
                <h3 class="card-title p-3">Manage Events Data</h3>
                <div class="ml-auto p-3">
                  <a href="#" data-toggle="modal" data-target="#modalAddEvent" id="btnaddevent" class="btn btn-primary btn-xs"><i class="nav-icon fas fa-plus"></i> Add New Event</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablearticle" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Registration</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($events as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->name; ?></td>
                      <td><?php echo strftime("%d-%m-%Y %H:%M", strtotime($value->event_date)); ?></td>   
                      <td><?php if($value->need_registration == true) { echo '<span class="badge badge-warning">Member only</span>'; } else {
                         echo '<span class="badge badge-dark">No registration</span>';
                      } ?></td>
                          
                      <td class="d-flex justify-content-end">
                        <a href="#" eventid="<?php echo $value->id; ?>" class="btn btn-xs btn-primary mr-1 eventedit"><i class="nav-icon fas fa-edit"></i> Edit</a> 
                        <a href="<?php echo base_url('admin/events/delevent/'.$value->id); ?>" onclick="return confirm('Are you sure want to delete <?php echo $value->name; ?>?');" class="btn btn-xs btn-danger m-0"><i class="nav-icon fas fa-trash"></i> Delete</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Event Name</th>
                    <th>Date</th>
                    <th>Registration</th>
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
      <form action="<?php echo base_url('admin/events'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Event</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="name">Event Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter event name">
          </div>

          <div class="form-group">
            <label for="short_desc">Short Description</label>
            <input type="text" class="form-control" id="short_desc" name="short_desc"  placeholder="">
          </div>

          <div class="form-group">
            <label for="content">Content</label>
           <textarea class="textarea" placeholder="Enter event content" name="content"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>

          <div class="form-group">
            <label for="need_registration">Registration</label>
            <div class="form-check">
              <input class="form-check-input" id="no_registration" type="radio" name="need_registration" value="0" checked>
              <label class="form-check-label">No Registration</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" id="member_registration" type="radio" name="need_registration" value="1" >
              <label class="form-check-label">Member Only</label>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="eventdate">Event Date</label>
                 <div class="input-group date" id="eventdate" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input eventdate" id="eventdate" name="eventdate" data-target="#eventdate"/>
                    <div class="input-group-append" data-target="#eventdate" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                    <label>Event Time</label>

                    <div class="input-group date" id="timepicker" data-target-input="nearest">
                      <input type="text" name="eventtime" class="form-control eventtime datetimepicker-input" data-target="#timepicker">
                      <div class="input-group-append" data-target="#timepicker" data-toggle="datetimepicker">
                          <div class="input-group-text"><i class="far fa-clock"></i></div>
                      </div>
                    </div>
                    <!-- /.input group -->
               </div>
            </div>
          </div>

          <div class="form-group">
            <label for="host">Event Host</label>
            <input type="text" class="form-control" id="host" name="host" required >
          </div>

          <div class="form-group">
            <label for="icon">Icon</label>
            <input type="text" class="form-control" id="icon" name="icon" required >
            <small id="emailHelp" class="form-text text-muted">Search icon <a href="https://fontawesome.com/icons?d=gallery&p=2&m=free" target="_blank">here</a></small>
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="fotoproduct">Event Media (photo or Youtube)</label>
              <div>
                <a href="#" class="btn m-1   btn-xs btn-info" id="btnAddMediaPhoto"><i class="nav-icon fas fa-plus"></i> Add Photo</a>
                <a href="#" class="btn m-1   btn-xs btn-info" id="btnAddMediaYoutube"><i class="nav-icon fas fa-plus"></i> Add Youtube</a>
              </div>
            </div>
            <div id="mediaContainer" class="row mb-2"></div>
            <div id="containerMedia">
              <div class="row">
                <div class="col-md-12">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control"  name="photo[]">
                    </div>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control" name="youtube[]"  placeholder="Copy paste Youtube embed link here">
                  </div>
                </div>
              </div>
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

<style type="text/css">
  iframe {
    width: 100% !important;
    height: 100% !important;
  }
</style>