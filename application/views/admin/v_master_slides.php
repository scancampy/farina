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
               <li class="breadcrumb-item ">Setting</li>
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
                <h3 class="card-title p-3">Manage Slides Data</h3>
                <div class="ml-auto p-3">
                  <a href="#" data-toggle="modal" data-target="#modalAddSlide" id="btnaddslide" class="btn btn-primary btn-xs"><i class="nav-icon fas fa-plus"></i> Add New Slide</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tableslide" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Display Order</th>
                    
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($slides as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->title; ?></td>
                      <td><img src="<?php echo base_url('img/slides/'.$value->filename); ?>" style="width: 200px;" /></td>
                      <td><?php echo $value->display_order; ?> 
                      <?php if($key != 0) { ?>
                      <a href="<?php echo base_url('admin/setting/slidesup/'.$value->id); ?>"><span class="nav-icon fas fa-chevron-up"></span></a> 
                    <?php } ?>
                     <?php if($key != count($slides)-1) { ?>
                      <a href="<?php echo base_url('admin/setting/slidesdown/'.$value->id); ?>"><span class="nav-icon fas fa-chevron-down"></span></a>
                    <?php } ?>
                    </td>    
                      <td class="d-flex justify-content-end">
                        <a href="#" slideid="<?php echo $value->id; ?>" class="btn btn-xs btn-primary mr-1 slideedit"><i class="nav-icon fas fa-edit"></i> Edit</a> 
                        <a href="<?php echo base_url('admin/setting/delslide/'.$value->id); ?>" onclick="return confirm('Are you sure want to delete <?php echo $value->title; ?>?');" class="btn btn-xs btn-danger m-0"><i class="nav-icon fas fa-trash"></i> Delete</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Display Order</th>
                    
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

  <div class="modal fade " id="modalAddSlide" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/setting/slides'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Slide</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Enter Slides title">
          </div>

          <div class="form-group">
            <label for="short_desc">Short Description</label>
            <input type="text" class="form-control" id="short_desc" name="short_desc"  placeholder="">
          </div>

          <div class="form-group">
            <label for="url">URL</label>
            <input type="url" class="form-control" id="url" name="url"  placeholder="">
          </div>

          <div class="form-group">
            <label for="url_caption">URL Button Caption</label>
            <input type="text" class="form-control" id="url_caption" name="url_caption"  placeholder="">
          </div>

          <div id="currentimage"></div>

          <div class="form-group">
            <label for="filename">Upload Slide Image</label>
            <div class="custom-file">
              <input type="file" class="form-control"  name="filename">
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