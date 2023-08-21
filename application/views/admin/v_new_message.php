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
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Compose New Message</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/messaging/new'); ?>">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Message Title">
                  </div>
                  <div class="form-group">
                    <label >Delivered To</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="toall" name="radiodelivered" value="all" checked>
                      <label class="form-check-label" for="toall">All</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="vip" type="radio" id="tovip" name="radiodelivered">
                      <label class="form-check-label" for="tovip">VIP</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="regular" type="radio" id="toregular" name="radiodelivered"  >
                      <label class="form-check-label" for="toregular">Regular Member</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="individual" type="radio" id="tospesific" name="radiodelivered" >
                      <label class="form-check-label" for="tospesific">Spesific Members</label>
                    </div>
                  </div>
                <div class="form-group" id="pickmemberdiv" style="display:none;">
                  <label>Pick Members</label>
                  <select class="select2bs4" name="members[]" multiple="multiple" data-placeholder="Select members"
                          style="width: 100%;">
                   <?php foreach ($members as $key => $value) { ?>
                     <option value="<?php echo $value->id; ?>"><?php echo $value->first_name.' '.$value->last_name.' ('.$value->email.')'; ?></option>
                   <?php } ?>
                  </select>
                </div>

                  <div class="form-group">
            <label for="content">Content</label>
           <textarea class="textarea" placeholder="Enter article content" name="content"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>
          <div id="divfile">
            <div class="form-group">
              <label for="filemessage1">File input #1</label>
              <div class="input-group" style="margin-bottom:10px;">
                 <input type="text" class="form-control" id="filetitle1" name="filetitle[]" placeholder="Tuliskan judul file">
              </div>
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="custom-file-input" name="filemessage[]" id="filemessage1">
                  <label class="custom-file-label" for="filemessage1">Choose file</label>
                </div>
              </div>
            </div>
          </div>
          <div>
            <input type="hidden" id="countfiles" name="countfiles" value="1"/>
            <button class="btn btn-outline-primary" id="btnaddfiles" type="button">Add Files</button>
          </div>
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="btnsubmit" id="btnsubmit" value="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<style type="text/css">
  iframe {
    width: 100% !important;
    height: 100% !important;
  }
</style>