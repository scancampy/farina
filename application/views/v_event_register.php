
<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">
						<h1 class="page-header__title">Event <?php echo $event[0]->name; ?> Registration</h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(''); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('event'); ?>" class="breadcrumbs__link">Events</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('event/details/'.$event[0]->id.'/'.url_title($event[0]->name)); ?>" class="breadcrumbs__link"><?php echo $event[0]->name; ?></a>
									</li>
									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('event/register/'.$event[0]->id.'/'.url_title($event[0]->name)); ?>" class="breadcrumbs__link">Registration</a>
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
				<form class="product-checkout lsvr-form" method="post" action="<?php echo base_url('event/register/'.$event[0]->id.'/'.url_title($event[0]->name)); ?>" enctype="multipart/form-data">

					<?php if(!empty(@$notif)) { ?>
					<!-- VALIDATION ERROR MESSAGE : begin -->
					<div class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning" style="display:block;">
						<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
						<p><?php echo $msg; ?></p>
					</div>
					<!-- VALIDATION ERROR MESSAGE : begin -->
				<?php } ?>

				<?php if(!empty(@$notifsuccess)) { ?>
					<!-- VALIDATION ERROR MESSAGE : begin -->
					<div class="lsvr-alert-message lsvr-alert-message--success" style="display:block;">
						<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
						<p><?php echo $msg; ?></p>
					</div>
					<!-- VALIDATION ERROR MESSAGE : begin -->
				<?php } ?>

				<?php if($registrant) { 
					if($registrant->status == 'pending') {
					?>
					<!-- VALIDATION ERROR MESSAGE : begin -->
					<div class="lsvr-alert-message " style="display:block;">
						<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
						<p>We have received your registration payment proof successfully. Our team will now process your payment and proceed with your registration request.</p>
					</div>
					<!-- VALIDATION ERROR MESSAGE : begin -->
				<?php } else if($registrant->status == 'registered') {
					?>
					<!-- VALIDATION ERROR MESSAGE : begin -->
					<div class="lsvr-alert-message lsvr-alert-message--success" style="display:block;">
						<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
						<p>We're excited to inform you that your registration for the upcoming event is confirmed! Thank you for choosing to be a part of this exciting experience.</p>
					</div>
					<!-- VALIDATION ERROR MESSAGE : begin -->
				<?php } else if($registrant->status == 'cancelled') {
					?>
					<!-- VALIDATION ERROR MESSAGE : begin -->
					<div class="lsvr-alert-message lsvr-alert-message--notification" style="display:block;">
						<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
						<p>We regret to inform you that the registration process for the this event has been canceled.</p>
					</div>
					<!-- VALIDATION ERROR MESSAGE : begin -->
				<?php } } ?>


			        <h3>Event Details</h3>

        			<!-- DEFINITION LIST : begin -->
					<dl class="lsvr-definition-list__list">

						<!-- ITEM : begin -->
					    <dt class="lsvr-definition-list__item-title">
					    	Event Date & Time
					    </dt>
					    <dd class="lsvr-definition-list__item-text"><?php  echo strftime("%A, %d %B %Y", strtotime($event[0]->event_date)); ?> &nbsp; <?php  echo strftime("%H:%M", strtotime($event[0]->event_date)); ?></dd>
					    <!-- ITEM : end -->

						<!-- ITEM : begin -->
					    <dt class="lsvr-definition-list__item-title">
					    	Hosted By
					    </dt>
					    <dd class="lsvr-definition-list__item-text"><?php echo $event[0]->host; ?></dd>
					    <!-- ITEM : end -->

					    <?php if($event[0]->event_fee != null) { ?>
						<!-- ITEM : begin -->
					    <dt class="lsvr-definition-list__item-title">
					    	Registration Fee
					    </dt>
					    <dd class="lsvr-definition-list__item-text"><?php echo "IDR ".number_format($event[0]->event_fee,0,',','.'); ?></dd>
						<?php } ?>
					    <!-- ITEM : end -->

					    <?php if($event[0]->points != null) { ?>
						<!-- ITEM : begin -->
					    <dt class="lsvr-definition-list__item-title">
					    	Points Earned
					    </dt>
					    <dd class="lsvr-definition-list__item-text"><?php echo $event[0]->points; ?></dd>
					    <?php } ?>

					    <?php if($registrant != null) { ?>
						<!-- ITEM : begin -->
					    <dt class="lsvr-definition-list__item-title">
					    	Register Date
					    </dt>
					    <dd class="lsvr-definition-list__item-text"><?php echo 
strftime("%A, %d %B %Y", strtotime($registrant->payment_confirmation_date));
?></dd>

<dt class="lsvr-definition-list__item-title">
					    	Registration Status
					    </dt>
					    <dd class="lsvr-definition-list__item-text">
					    	<?php if($registrant->status == 'pending') { ?>
					    		<strong style="color:#ff007c;">Verify Request in Progress</strong>
					    	<?php } else if($registrant->status == 'registered') { ?>
					    		<strong style="color:#ff007c;">Registered</strong>
					    	<?php } else if($registrant->status == 'cancelled') { ?>
					    		<strong style="color:#ff007c;">Cancelled</strong>
					    	<?php } ?>
					    </dd>
					    <?php } ?>
					    <!-- ITEM : end -->

					</dl>
					<!-- DEFINITION LIST : end -->


					 <!-- SEPARATOR : begin -->
			        <hr class="lsvr-separator">
			        <!-- SEPARATOR : end -->

			        <?php if(!$registrant) { ?>

					<h3>Registration Form</h3>

					<!-- GRID : begin -->
					<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-1-cols">

						<!-- GRID COL : begin -->
						<div class="lsvr-grid__col">

				            <p class="lsvr-form__field">
				                <label class="lsvr-form__field-label" for="first-name">First Name*</label>
				                <input class="lsvr-form__field-input lsvr-form__field-input--text "
				                	type="text" name="first-name" id="first-name" readonly disabled value="<?php echo $member[0]->first_name; ?>">
				            </p>

				        </div>
				        <!-- GRID COL : end -->

						<!-- GRID COL : begin -->
						<div class="lsvr-grid__col">

				            <p class="lsvr-form__field">
				                <label class="lsvr-form__field-label" for="last-name">Last Name*</label>
				                <input class="lsvr-form__field-input lsvr-form__field-input--text " readonly disabled
				                	type="text" name="last-name" id="last-name" value="<?php echo $member[0]->last_name; ?>">
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
				                <label class="lsvr-form__field-label" for="email">Your Email*</label>
				                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--email"
				                	type="text" name="email" id="email" disabled readonly value="<?php echo $member[0]->email; ?>">
				            </p>

				        </div>
				        <!-- GRID COL : end -->

						<!-- GRID COL : begin -->
						<div class="lsvr-grid__col">

				            <p class="lsvr-form__field">
				                <label class="lsvr-form__field-label" for="phone">Your Phone*</label>
				                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required"
				                	type="text" name="phone" id="phone">
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
				                <label class="lsvr-form__field-label" for="buktibayar">Informasi Pembayaran</label>
				                <p>The registration fee is <strong style="color:#ff007c;">
								<?php echo "IDR ".number_format($event[0]->event_fee,0,',','.'); ?></strong>. Please make payment at your earliest convenience using the following details:<br/>
								<?php
									echo '<strong>'.$setting->bank1.'</strong><br/>';
									echo '<strong>No. Rek: '.$setting->no_akun_bank1.'</strong><br/>';
									echo '<strong>A/N: '.$setting->nama_akun_bank1.'</strong><br/><br/>';
									echo '<strong>'.$setting->bank2.'</strong><br/>';
									echo '<strong>No. Rek: '.$setting->no_akun_bank2.'</strong><br/>';
								echo '<strong>A/N: '.$setting->nama_akun_bank2.'</strong>';
								 ?>
							</p>
				            </p>

				        </div>
				        <!-- GRID COL : end -->

						<!-- GRID COL : begin -->
						<div class="lsvr-grid__col">

				            <p class="lsvr-form__field">
				                <label class="lsvr-form__field-label" for="buktibayar">Upload Payment Proof (Bukti Bayar)*</label>
				                <input class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required" accept="image/png, image/gif, image/jpeg"
				                	type="file" name="buktibayar" id="buktibayar">
				            </p>

				        </div>
				        <!-- GRID COL : end -->

						
			        </div>
			        <!-- GRID : end -->

					
					

			        <!-- SPACER : begin -->
			        <hr class="lsvr-spacer lsvr-spacer--small">
			        <!-- SPACER : end -->

			        

			       

					<!-- ORDER FOOTER : begin -->
					<div class="product-order__footer">

						

						<!-- FOOTER CHECKOUT : begin -->
						<p class="product-order__footer-checkout">
							<button type="submit" value="submit" name="btnsubmit" class="product-order__footer-checkout-btn lsvr-button">Submit</button>
						</p>
						<!-- FOOTER CHECKOUT : end -->

					</div>
					<!-- ORDER FOOTER : end -->
				<?php } ?>
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

<style type="text/css">
	iframe { width: 100% !important;  }
	.gold {
		 background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
          color: white;
          padding: 3px 10px;
          border-radius: 12px;
          margin-top:5px;	
          display: inline-block;
	}
</style>
<!-- CORE : end -->