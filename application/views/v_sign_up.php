<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Sign Up</h1>

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
										<a href="<?php echo base_url('member/signup'); ?>" class="breadcrumbs__link">Sign Up</a>
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
							<div class="page product-post-page product-post-archive">
								<div class="page__content">
									
									<?php if($notif['type'] == 'success') { ?>
									<div class="lsvr-alert-message lsvr-alert-message--success">
										<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
										<h3 class="lsvr-alert-message__title">Registration Success</h3>
										<p><?php echo $notif['msg']; ?></p>
									</div>
									<?php } else { ?> 
									<div class="lsvr-alert-message lsvr-alert-message--warning">
										<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
										<h3 class="lsvr-alert-message__title">Registration Failed</h3>
										<p><?php echo $notif['msg']; ?></p>
									</div>
									<?php } ?>

									<p>
										<a href="<?php echo base_url('member/signin'); ?>" class="lsvr-button">Back to Sign In</a>
									</p>
								</div>
							</div>
						    <?php } else { ?>

							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--checkout">
								<div class="page__content">

									<!-- PRODUCT CHECKOUT : begin -->
									<form class="product-checkout lsvr-form" id="formsignup" method="post" action="<?php 
									if(!empty($_SERVER['QUERY_STRING'])) {
										echo base_url('member/signup?'.$_SERVER['QUERY_STRING']); 
									} else {
										echo base_url('member/signup'); 
									}

									if(isset($_GET['refcode'])) { echo '?refcode='.$_GET['refcode']; } ?>">

										<!-- VALIDATION ERROR MESSAGE : begin -->
										<?php if(@$error != '') { ?>

										<div style="display: block;" class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning">
											<span class="lsvr-alert-message__icon" ></span>
											<p><?php echo $error; ?></p>
										</div>
									<?php  } ?>
										<!-- VALIDATION ERROR MESSAGE : begin -->

										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-first-name">First Name*</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
									                	type="text" value="<?php echo set_value('first_name'); ?>" required autofocus name="first_name" id="first_name">
									            </p>

									        </div>
									        <!-- GRID COL : end -->

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-last-name">Last Name</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
									                	type="text" value="<?php echo set_value('last_name'); ?>" name="last_name" id="last_name">
									            </p>

									        </div>
									        <!-- GRID COL : end -->

								        </div>
								        <!-- GRID : end -->

										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--1-cols lsvr-grid--sm-1-cols">

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-email">Your Email*</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email lsvr-form__field-input--required"
									                	type="text" value="<?php echo set_value('email'); ?>" name="email" id="email">
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

									        </div>
									        <!-- GRID COL : end -->

											<!-- GRID COL : begin -->
											<div class="lsvr-grid__col">

									            <p class="lsvr-form__field">
									                <label class="lsvr-form__field-label" for="order-billing-city">Repeat Password*</label>
									                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
									                	type="password" name="repeat_password" id="repeat_password">
									            </p>

									        </div>
									        <!-- GRID COL : end -->

								        </div>
								        <!-- GRID : end -->

									


								        <!-- SHIPPING CHECKBOX : begin -->
								        <p class="lsvr-form__field">
								        	<label for="check_aggreement" class="lsvr-form__field-label lsvr-form__field-label--checkbox">
								        		<input type="checkbox" value="true" class="lsvr-form__field-input lsvr-form__field-input--checkbox"
								        			name="check_aggreement" id="check_aggreement"
								        			
								        			data-toggle-element="order-form-shipping-fields">
								        		<span>I agree with the <a href="<?php echo base_url('info/1/'.url_title($terms->title)); ?>" target="_blank">terms and conditions</a></span>
								        	</label>
							        	</p>


								    
										<!-- ORDER FOOTER : begin -->
										<div class="product-order__footer">

											<!-- FOOTER CHECKOUT : begin -->
											<p class="product-order__footer-checkout">
												<button type="submit" name="btnsubmit" id="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Sign Up</button>
												<input type="hidden" name="token" id="token">
											</p>
											<p>Already have account? Click <a href="<?php 
											if(!empty($_SERVER['QUERY_STRING'])) {
												echo base_url('member/signin?'.$_SERVER['QUERY_STRING']); 
											} else {
												echo base_url('member/signin'); 
											} ?>">here</a> to sign in </p>
											<!-- FOOTER CHECKOUT : end -->

										</div>
										<!-- ORDER FOOTER : end -->

									</form>
									<!-- PRODUCT CHECKOUT : end -->

								</div>
							</div>
							<!-- PAGE : end -->
						<?php } ?>

						</div>
					</main>
					<!-- MAIN : end -->

				</div>
			</div>
		</div>
		<!-- CORE COLUMNS : end -->
	</div>
</div>