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
               <li class="breadcrumb-item ">Article</li>
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
                <h3 class="card-title p-3">Manage Article Data</h3>
                <div class="ml-auto p-3">
                  <a href="#" data-toggle="modal" data-target="#modalAddArticle" id="btnaddarticle" class="btn btn-primary btn-xs"><i class="nav-icon fas fa-plus"></i> Add New Article</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablearticle" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Viewed</th>
                    <th>Published</th>
                    <th>Created</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($article as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->title; ?></td>
                      <td><?php echo $value->categoryname; ?></td>
                      <td><?php if($value->article_type == "normal") { echo '<span class="badge badge-dark">Normal</span>'; } else {
                         echo '<span class="badge badge-success">Exclusive</span>';
                      } ?></td>
                      <td><?php echo $value->viewed; ?></td>
                      <td><?php if($value->is_published ==0) { echo '<span class="badge badge-warning">Not published</span>'; } else {
                         echo '<span class="badge badge-success">Published</span>';
                      } ?></td>
                      <td><?php echo strftime("%d-%m-%Y %H:%M", strtotime($value->created)); ?></td>         
                      <td class="d-flex justify-content-end">
                        <a href="#" articleid="<?php echo $value->id; ?>" class="btn btn-xs btn-primary mr-1 articleedit"><i class="nav-icon fas fa-edit"></i> Edit</a> 
                        <a href="<?php echo base_url('admin/article/delarticle/'.$value->id); ?>" onclick="return confirm('Are you sure want to delete <?php echo $value->title; ?>?');" class="btn btn-xs btn-danger m-0"><i class="nav-icon fas fa-trash"></i> Delete</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Type</th>
                    <th>Viewed</th>
                    <th>Published</th>
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

  <div class="modal fade " id="modalAddArticle" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/article/master'); ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Article</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" required placeholder="Enter article title">
          </div>

          <div class="form-group">
            <label for="category_id">Category</label>
            <select class="form-control " name="category_id" id="category_id">
              <?php foreach ($category as $key => $value) { ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="short_desc">Short Description</label>
            <input type="text" class="form-control" id="short_desc" name="short_desc"  placeholder="">
          </div>

          <div class="form-group">
            <label for="content">Content</label>
           <textarea class="textarea" placeholder="Enter article content" name="content"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>

          <div class="form-group">
            <label for="article_type">Article Type</label>
            <div class="form-check">
              <input class="form-check-input" id="normal_type" type="radio" name="article_type" value="normal" checked>
              <label class="form-check-label">Normal (publicly available)</label>
            </div>
            <div class="form-check">
              <input class="form-check-input" id="exclusive_type" type="radio" name="article_type" value="exclusive" >
              <label class="form-check-label">Exclusive (only available for VIP member)</label>
            </div>
          </div>

          <div class="form-group">
            <label for="is_published">Published Status</label>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="is_published" value="1" name="is_published">
              <label class="form-check-label" for="is_published">Published (available to public)</label>
            </div>
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="fotoproduct">Article Media (photo or Youtube)</label>
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