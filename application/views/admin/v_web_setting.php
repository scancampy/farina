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
          <div class="col-12 col-sm-12">
            <form method="post" action="<?php echo base_url('admin/setting/web'); ?>">
              <div class="card card-primary card-outline card-tabs">
                <div class="card-header p-0 pt-1 border-bottom-0">
                  <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true">Lokasi</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-profile-tab" data-toggle="pill" href="#custom-tabs-three-profile" role="tab" aria-controls="custom-tabs-three-profile" aria-selected="false">Kontak</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-messages-tab" data-toggle="pill" href="#custom-tabs-three-messages" role="tab" aria-controls="custom-tabs-three-messages" aria-selected="false">Template Email</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-settings-tab" data-toggle="pill" href="#custom-tabs-three-settings" role="tab" aria-controls="custom-tabs-three-settings" aria-selected="false">Rekening Pembayaran</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link" id="custom-tabs-three-poin-tab" data-toggle="pill" href="#custom-tabs-three-poin" role="tab" aria-controls="custom-tabs-three-poin" aria-selected="false">Poin</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body">
                  <div class="tab-content" id="custom-tabs-three-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                       <div class="form-group">
                      <input type="hidden" id="hiddenid" name="hiddenid"/>
                      <label for="Alamat">Alamat</label>
                      <textarea class="form-control" id="Alamat" name="alamat" required ><?php echo @$address['address']; ?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="kodepos">Kode Pos</label>
                      <input type="text" class="form-control" value="<?php echo @$address['kodepos']; ?>" id="kodepos" required name="kodepos"  >
                    </div>

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="url">Propinsi</label>
                          <select class="form-control" name="propinsi" id="propinsi">
                              <option value="-">[Pilih Provinsi]</option>
                              <?php foreach ($propinsi as $key => $value) { ?>
                                <option <?php if(@$address['propinsi'] == $value->province_id) { echo 'selected="selected"'; } ?> value="<?php echo $value->province_id; ?>"><?php echo $value->province; ?></option>
                              <?php } ?>
                          </select>
                        </div>
                      </div>                    
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="url">Kota/Kabupaten</label>
                          <select class="form-control" name="kota" id="kota">
                              <option value="-">[Pilih Kota/Kabupaten]</option>
                             <?php if(!empty($kota)) { foreach ($kota as $key => $value) { ?>
                              <option <?php if(@$address['kota'] == $value->city_id) { echo 'selected="selected"'; } ?> value="<?php echo $value->city_id; ?>"><?php echo $value->city_name; ?></option>
                            <?php } } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="url">Kecamatan</label>
                          <select class="form-control" name="kecamatan" id="kecamatan">
                              <option value="-">[Pilih Kecamatan]</option>
                         <?php if(!empty($kecamatan)) { foreach ($kecamatan as $key => $value) { ?>
                            <option <?php if(@$address['kecamatan'] == $value->subdistrict_id) { echo 'selected="selected"'; } ?> value="<?php echo $value->subdistrict_id; ?>"><?php echo $value->subdistrict_name; ?></option>
                          <?php } } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-profile" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                      <div class="form-group">
                        <label for="kodepos">Whatsapp</label>
                        <input type="text" class="form-control" value="<?php echo @$address['whatsapp']; ?>" id="whatsapp" required name="whatsapp"  >
                      </div>
                       <div class="form-group">
                        <label for="default_whatsapp_message">Pesan Default Whatsapp</label>
                        <textarea class="form-control" id="default_whatsapp_message" name="default_whatsapp_message" required ><?php echo @$address['default_whatsapp_message']; ?></textarea>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-messages" role="tabpanel" aria-labelledby="custom-tabs-three-messages-tab">
                       Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-settings" role="tabpanel" aria-labelledby="custom-tabs-three-settings-tab">
                      <h5>Bank #1</h5>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="bank1">Nama Bank</label>
                            <input type="text" class="form-control" value="<?php echo @$address['bank1']; ?>" id="bank1" required name="bank1"  >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="no_akun_bank1">No Rekening</label>
                            <input type="text" class="form-control" value="<?php echo @$address['no_akun_bank1']; ?>" id="no_akun_bank1" required name="no_akun_bank1"  >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nama_akun_bank1">Nama Rekening</label>
                            <input type="text" class="form-control" value="<?php echo @$address['nama_akun_bank1']; ?>" id="nama_akun_bank1" required name="nama_akun_bank1"  >
                          </div>
                        </div>
                      </div>

                      <h5>Bank #2</h5>
                      <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="bank2">Nama Bank</label>
                            <input type="text" class="form-control" value="<?php echo @$address['bank2']; ?>" id="bank2" required name="bank2"  >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="no_akun_bank2">No Rekening</label>
                            <input type="text" class="form-control" value="<?php echo @$address['no_akun_bank2']; ?>" id="no_akun_bank2" required name="no_akun_bank2"  >
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label for="nama_akun_bank2">Nama Rekening</label>
                            <input type="text" class="form-control" value="<?php echo @$address['nama_akun_bank2']; ?>" id="nama_akun_bank2" required name="nama_akun_bank2"  >
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-three-poin" role="tabpanel" aria-labelledby="custom-tabs-three-poin-tab">
                       <div class="form-group row">
                        <label for="kodepos">1 Poin = </label>
                        <div class="input-group col-md-4">
                          <div class="input-group-prepend">
                            <span class="input-group-text">Rp. </span>
                          </div>
                          <input type="text" class="form-control" value="<?php echo @$address['kurs_poin']; ?>" name="kurs_poin">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <input type="submit" class="btn  btn-primary" value="Submit" name="btnSubmit" id="btnSubmit" />
                </div>
                <!-- /.card -->
              </div>

            </form>
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