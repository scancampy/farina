<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Create New Post</h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('community'); ?>" class="breadcrumbs__link">Community</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('community/newpost'); ?>" class="breadcrumbs__link">New Post</a>
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
							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--checkout">
								<div class="page__content">

									<!-- PRODUCT CHECKOUT : begin -->
									<form class="product-checkout lsvr-form" method="post" enctype="multipart/form-data" action="<?php
									echo base_url('community/newpost'); ?>">

										<!-- VALIDATION ERROR MESSAGE : begin -->
										<?php if(@$error != '') { ?>

										<div style="display: block;" class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning">
											<span class="lsvr-alert-message__icon" ></span>
											<h3 class="lsvr-alert-message__title">Warning Message</h3>
											<p><?php echo $error; ?></p>
										</div>
									<?php  } ?>
										<!-- VALIDATION ERROR MESSAGE : begin -->

										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--1-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-first-name">Write Post Content</label>
									                <textarea name="content" rows="10" autofocus required class="lsvr-form__field-input"><?php echo set_value('content'); ?></textarea>
									            </p>

									        </div>
									        <!-- GRID COL : end -->
								        </div>
								        <!-- GRID : end -->

										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--1-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">
												<div id="imagecontainer">
										            <p class="lsvr-form__field" id="templatephoto">
										                <label class="lsvr-form__field-label" for="order-billing-email">Upload Photo (optional)</label>
										                <input class="lsvr-form__field-input"
										                	type="file" name="image[]" >
										            </p>
										        </div>
									            <p>
									            	<span id="addmorephoto" class="lsvr-button lsvr-button--type-2 lsvr-button--small">Add More Photo</span>
									            </p>

									        </div>
									        <!-- GRID COL : end -->

											
								        </div>
								        <!-- GRID : end -->

								        <!-- SHIPPING CHECKBOX : begin -->
								        <p class="lsvr-form__field">
								        	<label for="order-shipping-checkbox" class="lsvr-form__field-label lsvr-form__field-label--checkbox">
								        		<input type="checkbox" value="true" class="lsvr-form__field-input lsvr-form__field-input--checkbox"
								        			name="check_aggreement" id="check_aggreement"
								        			
								        			data-toggle-element="order-form-shipping-fields">
								        		<span>Saya setuju dengan <a href="#" target="_blank">syarat dan ketentuan</a></span>
								        	</label>
							        	</p>


								    
										<!-- ORDER FOOTER : begin -->
										<div class="product-order__footer">

											<!-- FOOTER CHECKOUT : begin -->
											<p class="product-order__footer-checkout">
												<button type="submit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Submit</button>
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