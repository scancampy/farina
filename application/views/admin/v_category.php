  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Category</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                <h3 class="card-title p-3">Manage Category Data</h3>
                <div class="ml-auto p-3 d-flex" >
                  <a href="#" data-toggle="modal" data-target="#modalAddCategory" id="btnaddcategory" class="btn btn-primary btn-xs pt-2 pl-2 pr-2" ><i class="nav-icon fas fa-plus"></i> Add New Root Category</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div style="width:800px;">
                <?php
                echo $tree_html;

                ?>
              </div>
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

  <div class="modal fade " id="modalAddCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="<?php echo base_url('admin/category'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Add Root Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" id="hiddenid" name="hiddenid"/>
              <label for="name">Name</label>
              <input type="text" class="form-control" id="name" name="name" required placeholder="Enter category name">
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

  <div class="modal fade " id="modalRenameCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="<?php echo base_url('admin/category'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Rename Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" id="hiddenrenameid" name="hiddenrenameid"/>
              <label for="name">Name</label>
              <input type="text" class="form-control" id="rename" name="rename" required placeholder="Enter category name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" value="submit" name="btnRenameSubmit" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div> 

  <div class="modal fade " id="modalAddSubCategory" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <form action="<?php echo base_url('admin/category'); ?>" method="post" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Add Sub Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" id="hiddenrootid" name="hiddenrootid"/>
              <label for="name">Name</label>
              <input type="text" class="form-control" id="namesub" name="namesub" required placeholder="Enter category name">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" value="submit" name="btnSubmitSub" class="btn btn-primary">Save changes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div> 