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
            <div class="callout callout-warning">
              <h5>Perhatian!</h5>

              <p>Proses edit pesan terbatas. Hanya judul, konten, dan file yang dapat diubah.</p>
            </div>
          </div>
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Message</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/messaging/edit/'.$id); ?>">
                <div class="card-body">
                  
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Message Title" value="<?php echo $messages[0]->title; ?>">
                  </div>
                  <div class="form-group">
                    <label >Delivered To</label>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" id="toall" name="radiodelivered" value="all" disabled <?php if($messages[0]->delivered_to == 'all') { echo 'checked'; } ?>>
                      <label class="form-check-label" for="toall">All</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="vip" type="radio" id="tovip" name="radiodelivered" disabled <?php if($messages[0]->delivered_to == 'vip') { echo 'checked'; } ?>>
                      <label class="form-check-label" for="tovip">VIP</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="regular" type="radio" id="toregular" name="radiodelivered" disabled  <?php if($messages[0]->delivered_to == 'regular') { echo 'checked'; } ?>>
                      <label class="form-check-label" for="toregular">Regular Member</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" value="individual" type="radio" id="tospesific" disabled name="radiodelivered" <?php if($messages[0]->delivered_to == 'individual') { echo 'checked'; } ?>>
                      <label class="form-check-label" for="tospesific">Spesific Members</label>
                    </div>
                  </div>
                <div class="form-group" id="pickmemberdiv" <?php if($messages[0]->delivered_to != 'individual') { ?>style="display:none;"<?php } ?>>
                  <label>Members</label>
                  <p>
                    <?php foreach ($messagemembers as $key => $value) { ?>
                      <span class="badge badge-primary"><?php echo $value->first_name.' '.$value->last_name; ?></span>
                    <?php } ?>
                  </p>
                </div>

                  <div class="form-group">
            <label for="content">Content</label>
           <textarea class="textarea" placeholder="Enter article content" name="content"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo $messages[0]->content; ?></textarea>
          </div>

          <?php if(!empty($files)) { ?>
          <div class="form-group">
            <label for="title">Current Files</label>
            <ul>
              <?php foreach ($files as $key => $value) { 
                $ext =  explode(".", $value->filename );
                ?>
                <li><a target="_blank" href="<?php echo base_url('files/'.$value->filename); ?>"><?php echo $value->title.'.'.$ext[1]; ?></a> <span onclick="return confirm('Yakin hapus file <?php echo $value->title; ?> ini?');" class="btn btn-xs btn-outline-danger btndelfile" fileid="<?php echo $value->id; ?>"><i class="fas fa-trash"></i></span></li>
              <?php } ?>
            </ul>
          </div>
          <?php } ?>



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