<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Sign In</h1>

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
										<a href="<?php echo base_url('member/signin'); ?>" class="breadcrumbs__link">Sign In</a>
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

							<?php if($this->session->flashdata('notif')) { 
								$notif = $this->session->flashdata('notif');
								?>
							<div class="lsvr-alert-message lsvr-alert-message--warning">
								<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
								<h3 class="lsvr-alert-message__title">Warning Message</h3>
								<p><?php echo $notif['msg']; ?>	</p>
							</div>
						    <?php } ?>

						   

							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--checkout">
								<div class="page__content">
									<!-- PRODUCT CHECKOUT : begin -->
									<form class="product-checkout lsvr-form" method="post" action="<?php 

									if(!empty($_SERVER['QUERY_STRING'])) {
										echo base_url('member/signin?'.$_SERVER['QUERY_STRING']); 
									} else {
										echo base_url('member/signin'); 
									}
									?>">

										<!-- VALIDATION ERROR MESSAGE : begin -->
										<?php if(@$error != '') { ?>

										<div style="display: block;" class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning">
											<span class="lsvr-alert-message__icon" ></span>
											<p><?php echo $error; ?></p>
										</div>
									<?php  } ?>
										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--1-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-email">Your Email*</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email lsvr-form__field-input--required"
									                	type="text" value="" name="email" id="email">
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
									                <label class="lsvr-form__field-label" for="order-billing-address">Password*</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
									                	type="password" name="password" id="password">
									            </p>
									            <p>Forgot your password? Recover <a href="<?php echo base_url('member/recover'); ?>">here</a>

									        </div>
									        <!-- GRID COL : end -->

											

								        </div>
								        <!-- GRID : end -->

									


								    
										<!-- ORDER FOOTER : begin -->
										<div class="product-order__footer">

											<!-- FOOTER CHECKOUT : begin -->
											<p class="product-order__footer-checkout">
												<button type="submit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Sign In</button>
											</p>
											<p>Don't have account? Register <a href="<?php echo base_url('member/signup'); ?>">here</a>
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