<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Checkout</h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('cart'); ?>" class="breadcrumbs__link">Cart</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('cart/checkout'); ?>" class="breadcrumbs__link">Checkout</a>
									</li>

								</ul>

							</div>
						</div>
						<!-- BREADCRUMBS : end -->

					</div>
				</div>
			</div>
		</div>
		<!-- PAGE HEADER : end -->
<!-- CORE COLUMNS : begin -->
		<div class="core__columns">
			<div class="core__columns-inner">
				<div class="lsvr-container">

					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">

							<?php if(!empty($warning)) { ?>
							<div class="lsvr-alert-message lsvr-alert-message--warning">
								<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
								<h3 class="lsvr-alert-message__title">Warning Message</h3>
								<p><?php echo $warning; ?>	</p>
							</div>
						    <?php } ?>

						   

							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--checkout">
								<div class="page__content">
									<h4>Informasi Penerima</h4>
									<!-- PRODUCT CHECKOUT : begin -->
									<form class="product-checkout lsvr-form" method="post" action="<?php echo base_url('cart/checkout'); ?>">

									<!-- GRID COL : begin -->
									<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--md-2-cols">
										<div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="firstname">Nama Depan*</label>
								                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	type="text" name="firstname" id="firstname">
								            </p>
								        </div>

								        <div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="lastname">Nama Belakang*</label>
								                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	type="text" id="lastname" name="lastname">
								            </p>
								        </div>
							        </div>
							        <!-- GRID COL : end -->

							        <!-- GRID COL : begin -->
									<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--md-2-cols">
										<div class="lsvr-grid__col ">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="handphone">Handphone*</label>
								                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	type="text" id="handphone" name="handphone">
								            </p>
								        </div>
							        </div>
							        <!-- GRID COL : end -->

							        <h4>Alamat Penerima</h4>

							        <!-- GRID COL : begin -->
									<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--md-2-cols">
										<div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="propinsi">Provinsi*</label>
								                <select class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	name="propinsi" id="propinsi">
								                	<option value="-">[Pilih Provinsi]</option>
								        <?php foreach ($propinsi as $key => $value) { ?>
								        	<option value="<?php echo $value->province_id; ?>"><?php echo $value->province; ?></option>
								        <?php } ?>
								                </select>
								            </p>
								        </div>

								        <div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="kota">Kota/Kabupaten*</label>
								               <select class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	name="kota" id="kota">
								                	<option value="-">[Pilih Kota/Kabupaten]</option>
								                </select>
								            </p>
								        </div>
							        </div>
							        <!-- GRID COL : end -->
									
									<!-- GRID COL : begin -->
									<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--md-2-cols">
										<div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="kecamatan">Kecamatan*</label>
								                <select class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	name="kecamatan" id="kecamatan">
								                	<option value="-">[Pilih Kecamatan]</option>
								       
								                </select>
								            </p>
								        </div>

								       
							        </div>
							        <!-- GRID COL : end -->

							        <p class="lsvr-form__field">
						                <label class="lsvr-form__field-label" for="address">Alamat Lengkap*</label>
						                <textarea class="lsvr-form__field-input lsvr-form__field-input--textarea lsvr-form__field-input--required" name="address" id="address" cols="40" rows="5"></textarea>
						            </p>

						            <!-- GRID COL : begin -->
									<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--md-2-cols">
										<div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <label class="lsvr-form__field-label" for="kodepos">Kode Pos*</label>
								                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
								                	type="text"  id="kodepos" name="kodepos">
								            </p>
								        </div>
							        </div>
							        <!-- GRID COL : end -->

							        <!-- GRID COL : begin -->
									<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--md-2-cols">
										<div class="lsvr-grid__col">
								            <p class="lsvr-form__field">
								                <input type="checkbox" id="simpandefault" name="simpandefault" value="true" >
								                <label class="lsvr-form__field-label--checkbox" for="simpandefault">Save as default address</label>
								            </p>
								        </div>
							        </div>
							        <!-- GRID COL : end -->
									


								    
										<!-- ORDER FOOTER : begin -->
										<div class="product-order__footer">

											<!-- FOOTER CHECKOUT : begin -->
											<p class="product-order__footer-checkout">
												<button type="submit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Continue</button>
											</p>
											<!-- FOOTER CHECKOUT : end -->

										</div>
										<!-- ORDER FOOTER : end -->

									</form>
									<!-- PRODUCT CHECKOUT : end -->

								</div>
							</div>
							<!-- PAGE : end -->

						</div>
					</main>
					<!-- MAIN : end -->

				</div>
			</div>
		</div>
		<!-- CORE COLUMNS : end -->
	</div>
</div>