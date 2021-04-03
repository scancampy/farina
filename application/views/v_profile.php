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
										<a href="<?php echo base_url('member/profile'); ?>" class="breadcrumbs__link">Profile</a>
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
							<!-- VALIDATION ERROR MESSAGE : begin -->
		<?php if(@$error != '') { ?>

		<div style="display: block;" class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning">
			<span class="lsvr-alert-message__icon" ></span>
			<p><?php echo $error; ?></p>
		</div>
	<?php  } ?>

							<?php if($this->session->flashdata('notif')) { 
								$notif = $this->session->flashdata('notif');
								?>
							<div class="lsvr-alert-message lsvr-alert-message--success">
								<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
								<h3 class="lsvr-alert-message__title">Message</h3>
								<p><?php echo $notif['msg']; ?>	</p>
							</div>
						    <?php } ?>
<form class="product-checkout lsvr-form" method="post" action="<?php echo base_url('member/profile'); ?>">

<div class="lsvr-tabs">
	<div class="lsvr-tabs__inner">

		<!-- TABS HEADER : begin -->
		<ul class="lsvr-tabs__header">

			<li class="lsvr-tabs__header-item lsvr-tabs__header-item--active">
				<a href="#lsvr-tabs__content-item-1" class="lsvr-tabs__header-item-link">
					Personal
				</a>
			</li>

			<li class="lsvr-tabs__header-item">
				<a href="#lsvr-tabs__content-item-2" class="lsvr-tabs__header-item-link">
					Default Address
				</a>
			</li>

			<li class="lsvr-tabs__header-item">
				<a href="#lsvr-tabs__content-item-3" class="lsvr-tabs__header-item-link">
					Change Password
				</a>
			</li>

		</ul>
		<!-- TABS HEADER : end -->

		<!-- TABS CONTENT : begin -->
		<!-- PRODUCT CHECKOUT : begin -->
		
	

		<div class="lsvr-tabs__content">

			<div class="lsvr-tabs__content-item lsvr-tabs__content-item--active" id="lsvr-tabs__content-item-1" style="">


				<!-- GRID : begin -->
				<div class="lsvr-grid lsvr-grid--1-cols lsvr-grid--sm-1-cols">
					<!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="email">Your Email</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email "
			                	type="text" value="<?php echo $profile[0]->email; ?>" readonly="readonly" name="email" id="email">
			            </p>
			        </div>
			        <!-- GRID COL : end -->					
		        </div>
		        <!-- GRID : end -->
		        <!-- GRID : begin -->
				<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-2-cols" style="margin-top: 20px;">
					<!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="first_name">First Name</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email "
			                	type="text" value="<?php echo $profile[0]->first_name; ?>" name="first_name" id="first_name">
			            </p>
			        </div>
			        <!-- GRID COL : end -->	

			        <!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="last_name">Last Name</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email "
			                	type="text" value="<?php echo $profile[0]->last_name; ?>" name="last_name" id="last_name">
			            </p>
			        </div>
			        <!-- GRID COL : end -->				
		        </div>
		        <!-- GRID : end -->

		        <!-- GRID : begin -->
				<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-2-cols" style="margin-top:20px;">
					<!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="member_type">Member Type</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email "
			                	type="text" value="<?php echo $profile[0]->member_type; ?>" readonly="readonly" name="member_type" id="member_type">
			            </p>
			        </div>
			        <!-- GRID COL : end -->	
			        <!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="status">Member Status</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email "
			                	type="text" value="<?php echo $profile[0]->status; ?>" readonly="readonly" name="status" id="status">
			            </p>
			        </div>
			        <!-- GRID COL : end -->						
		        </div>
		        <!-- GRID : end -->

		         <!-- GRID : begin -->
				<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-2-cols" style="margin-top:20px;">
					<!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="last_login">Last Login</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email "
			                	type="text" value="<?php echo strftime("%d %B %Y %H:%M:%S", strtotime($profile[0]->last_login)); ?>" readonly="readonly" name="last_login" id="last_login">
			            </p>
			        </div>
			        <!-- GRID COL : end -->					
		        </div>
		        <!-- GRID : end -->
			</div>

			<div class="lsvr-tabs__content-item" id="lsvr-tabs__content-item-2" style="display: none;">

				<p>The main reasons for this are cosmetic: to cover gray or white hair, to change to a color regarded as more fashionable or desirable.</p>

			</div>

			<div class="lsvr-tabs__content-item" id="lsvr-tabs__content-item-3" style="display: none;">

				<!-- GRID : begin -->
				<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-1-cols">

					<!-- GRID COL : begin -->
					<div class="lsvr-grid__col">

			            <p class="lsvr-form__field">
			                <label class="lsvr-form__field-label" for="order-billing-address">Password*</label>
			                <input class="lsvr-form__field-input lsvr-form__field-input--text"
			                	type="password" name="password" id="password">
			            </p>
			            <p>Forgot your password? Recover <a href="<?php echo base_url('member/recover'); ?>">here</a>

			        </div>
			        <!-- GRID COL : end -->

					

		        </div>
		        <!-- GRID : end -->

			</div>

		</div>
		<!-- TABS CONTENT : end -->
	</div>
	<!-- FOOTER CHECKOUT : begin -->
		
</div>
<div style="margin-top:20px; display: flex; justify-content: flex-end;">
	<p class="product-order__footer-checkout">
		<button type="submit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Submit</button>
	</p>
</div>
		</form>
						   

						</div>
					</main>
					<!-- MAIN : end -->

				</div>
			</div>
		</div>
		<!-- CORE COLUMNS : end -->
	</div>
</div>