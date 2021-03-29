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
               <li class="breadcrumb-item ">Product</li>
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
                <h3 class="card-title p-3">Manage Products Data</h3>
                <div class="ml-auto p-3 d-flex" >
                  <form method="get" id="formcategory" class=" mr-2" action="<?php echo base_url('admin/product/master'); ?>">
                    <select class="form-control" name="brand_id_filter" id="brand_id_filter">
                      <option value="-">All Brand</option>
                      <?php foreach ($brand as $key => $value) { ?>
                        <option value="<?php echo $value->id; ?>" <?php if($this->input->get('brand_id_filter') == $value->id) { echo 'selected'; } ?>><?php echo $value->name; ?></option>
                      <?php } ?>
                    </select>
                  </form>

                  <a href="#" data-toggle="modal" data-target="#modalAddProduct" id="btnaddproduct" class="btn btn-primary btn-xs pt-2 pl-2 pr-2" ><i class="nav-icon fas fa-plus"></i> Add New Product</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tablebrand" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Availability</th>
                    <th>Price</th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
                   <?php 
                   foreach ($product as $key => $value) { ?>
                    <tr>
                      <td><?php echo $key+1; ?></td>
                      <td><?php echo $value->name; ?></td>
                      <td><?php echo $value->brandname; ?></td>
                      <td><?php if($value->in_stock ==0) { echo '<span class="badge badge-warning">Out of stock</span>'; } else {
                         echo '<span class="badge badge-success">In stock</span>';
                      } ?></td>
                      <td>Rp. <?php echo number_format($value->price,0,',','.'); ?></td>
                      <td class="d-flex justify-content-end">
                        <a href="#" prodid="<?php echo $value->id; ?>" class="btn btn-xs btn-primary mr-1 prodedit"><i class="nav-icon fas fa-edit"></i> Edit</a> 
                        <a href="<?php echo base_url('admin/product/delproduct/'.$value->id); ?>" onclick="return confirm('Are you sure want to delete <?php echo $value->name; ?>?');" class="btn btn-xs btn-danger m-0"><i class="nav-icon fas fa-trash"></i> Delete</a></td>
                    </tr>
                   <?php }
                   ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Product Name</th>
                    <th>Brand</th>
                    <th>Availability</th>
                    <th>Price</th>
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

  <div class="modal fade " id="modalAddProduct" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <form action="<?php echo base_url('admin/product/master'); ?><?php if($this->input->get('brand_id_filter')) { echo '?brand_id_filter='.$this->input->get('brand_id_filter'); } ?>" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" id="hiddenid" name="hiddenid"/>
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required placeholder="Enter product name">
          </div>

          <div class="form-group">
            <label for="brand_id">Brand</label>
            <select class="form-control " name="brand_id" id="brand_id">
              <?php foreach ($brand as $key => $value) { ?>
                <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="short_desc">Short Description</label>
            <input type="text" class="form-control" id="short_desc" name="short_desc"  placeholder="">
          </div>

          <div class="form-group">
            <label for="description">Description</label>
           <textarea class="textarea" placeholder="Enter description" name="description"
                          style="width: 100%; height: 400px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
          </div>


          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="product_unit_id">Unit</label>
                <select class="form-control " name="product_unit_id" id="product_unit_id">
                  <?php foreach ($unit as $key => $value) { ?>
                    <option value="<?php echo $value->id; ?>"><?php echo $value->unit_name; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="weight">Weight</label>
                <div class="input-group ">
                  <input type="number" min="1" class="form-control" id="weight" name="weight" required placeholder="">
                  <div class="input-group-append">
                    <span class="input-group-text">gr</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="price">Price</label>
            <div class="input-group ">
              <div class="input-group-prepend">
                <span class="input-group-text">Rp</span>
              </div>
              <input type="number" min="1" class="form-control" id="price" name="price" required placeholder="">
            </div>
          </div>

          <div class="form-group">
            <label for="in_stock  ">Availability</label>
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="in_stock" value="1" name="in_stock">
              <label class="form-check-label" for="exampleCheck1">Product in stock</label>
            </div>
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="fotoproduct">Product Photo</label>
              <a href="#" class="btn m-1   btn-xs btn-info" id="btnAddPhoto"><i class="nav-icon fas fa-plus"></i> Add More Photo</a>
            </div>
            <div id="uploadedFoto" class="row mb-1"></div>
            <div id="containerFoto">
              <div class="input-group">
                <div class="custom-file">
                  <input type="file" class="form-control" id="fotoproduct" name="fotoproduct[]">
                </div>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="d-flex justify-content-between">
              <label for="fotoproduct">Variant</label>
              <a href="#" class="btn m-1   btn-xs btn-info" id="btnAddVariant"><i class="nav-icon fas fa-plus"></i> Add More Variant</a>
            </div>
            <div id="variantContainer" class="row mb-2"></div>
            <div id="containerVariant">
              <div class="row">
                <div class="col-md-6">
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="form-control"  name="fotovariant[]">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="variant[]"  placeholder="Write Variant Name here...">
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