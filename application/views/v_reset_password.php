<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title"><?php echo $title; ?></h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('member'); ?>" class="breadcrumbs__link">Member</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('member/resetpassword/'.$sha1); ?>" class="breadcrumbs__link"><?php echo $title; ?></a>
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

					<?php if(!$this->session->flashdata('notif')) { ?>
					<div class="lsvr-alert-message">
						<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
						<h3 class="lsvr-alert-message__title"><?php echo $title; ?> Message</h3>
						<p>Please enter your new password below and confirm it by entering the same password in the 'Repeat Password' field.</p>
					</div>
				<?php } ?>

					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">

							<?php if($this->session->flashdata('notif')) { 
								$notif = $this->session->flashdata('notif');
								?>
							<?php if($notif['result'] == 'success') { ?>
									<div class="lsvr-alert-message lsvr-alert-message--success">
										<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
										<h3 class="lsvr-alert-message__title"><?php echo $title; ?> Success</h3>
										<p><?php echo $notif['msg']; ?></p>
									</div>
									<?php } else { ?> 
									<div class="lsvr-alert-message lsvr-alert-message--warning">
										<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
										<h3 class="lsvr-alert-message__title"><?php echo $title; ?> Failed</h3>
										<p><?php echo $notif['msg']; ?></p>
									</div>
									<?php } ?>
						    <?php } ?>

						   

							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--checkout">
								<div class="page__content">
									<!-- PRODUCT CHECKOUT : begin -->
									<form class="product-checkout lsvr-form" id="formsignin" method="post" action="<?php 

									echo base_url('member/resetpassword/'.$sha1);
									?>">

										<!-- VALIDATION ERROR MESSAGE : begin -->
										<?php if(@$error != '') { ?>

										<div style="display: block;" class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning">
											<span class="lsvr-alert-message__icon" ></span>
											<p><?php echo $error; ?></p>
										</div>
									<?php  } ?>
										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-email">New Password</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--text lsvr-form__field-input--required"
									                	type="password" value="" name="password" id="password">
									            </p>
									        </div>
									        <!-- GRID COL : end -->

											
								        </div>
								        <!-- GRID : end -->

										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-address">Repeat Password*</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
									                	type="password" name="repeat_password" id="repeat_password">
									            </p>
									            
									        </div>
									        <!-- GRID COL : end -->
								        </div>
								        <!-- GRID : end -->

										<!-- ORDER FOOTER : begin -->
										<div class="product-order__footer">

											<!-- FOOTER CHECKOUT : begin -->
											<p class="product-order__footer-checkout">
												<button type="submit" id="btnsubmit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Reset Password</button>
												<input type="hidden" name="token" id="token">
											</p>
											

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