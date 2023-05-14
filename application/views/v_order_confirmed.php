<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Order Confirmed</h1>

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
										<a href="#" class="breadcrumbs__link">Order Confirmed</a>
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
									<div class="box-div">
										<h5>Thank you for your order. Your order ID is <strong style="color:#ff007c;">#<?php echo $trans['trans']->id;  ?></strong></h5>
										<div style="display:flex;">
											<a href="<?php echo base_url('cart/myinvoice/'.$trans['trans']->id); ?>" target="_blank" style="padding: 20px; height: 20px;
    border: 1px solid lightgray;
    border-radius: 5px;
    margin-right: 20px;">
												<span class="fa fa-print"></span>
											</a>
											<p style="margin: 0px;">
							<?php if($trans['trans']->status == 'order_placed') { ?>
							    Your order has been received by our team. As soon as we receive your payment, we will begin processing your order. You will receive a confirmation email with your order details and estimated delivery date.
							<?php } else if($trans['trans']->status == 'order_prepared') { ?>
								We are delighted to inform you that your order has been successfully processed and the payment has been received. Our team is now working diligently to prepare your items for shipment.
							<?php } else if($trans['trans']->status == 'order_in_transit') { ?>
								We are thrilled to inform you that your eagerly awaited order has been successfully shipped and is en route to your doorstep. We couldn't be more excited for you to receive your purchase.<br/><br/>
								To track your shipment, simply visit the <strong style="color:#ff007c;"><?php echo $trans['trans']->shipping_service; ?></strong> website and enter your tracking number in the designated field. The tracking number is <strong style="color:#ff007c;"><?php echo $trans['trans']->no_resi; ?></strong> From there, you will have access to real-time updates on the status and location of your package.
							<?php } else if($trans['trans']->status == 'order_delivered') { ?>
								We are thrilled to inform you that your eagerly awaited order has successfully made its way to your doorstep, bringing a touch of excitement and joy to your day. Now that your order has reached its destination, we would like to kindly remind you of the importance of your feedback.<br/><br/>
								To leave a rating and review, simply visit "my order" menu and locate the product(s) you purchased. Click on the selected button, and you'll find an option to share your thoughts. We would love to hear your insights on the quality, functionality, and overall satisfaction of your new items. Your feedback will guide fellow shoppers as they explore our offerings and help us serve you better in the future.
							<?php } else if($trans['trans']->is_cancelled == true) { ?>
								We hope this message finds you well. We regret to inform you that this order has been cancelled. We sincerely apologize for any inconvenience this may have caused you. We understand that you may have questions or concerns regarding this cancellation, and we would be more than happy to assist you further. Please don't hesitate to reach out to our customer support team at <?php echo $setting->email; ?>. Our dedicated representatives are ready to address any inquiries you may have and offer alternative solutions or recommendations for similar products.
							<?php } ?>
							</p>
										</div>
									</div>
									<div class="box-div">
										<h5>Payment Information</h5>
										<p>The total amount due for your order is <strong style="color:#ff007c;">Rp. <?php $tot = $trans['trans']->total_trans + $trans['trans']->shipping_cost - $trans['trans']->discount; 

										echo number_format($tot,0,',','.'); 
									?></strong>. Please make payment at your earliest convenience using the following details:</p>
										<?php 
											echo '<strong>'.$setting->bank1.'</strong><br/>'; 
											echo '<strong>No. Rek: '.$setting->no_akun_bank1.'</strong><br/>';
											echo '<strong>A/N: '.$setting->nama_akun_bank1.'</strong><br/><br/>';


											echo '<strong>'.$setting->bank2.'</strong><br/>'; 
											echo '<strong>No. Rek: '.$setting->no_akun_bank2.'</strong><br/>';
											echo '<strong>A/N: '.$setting->nama_akun_bank2.'</strong><br/><br/>'; 
										?>
									</div>

									<div class="box-div">
										<h5>Payment Confirmation</h5>
										<p>If you have already made a payment, please confirm it by visiting this link <a href="<?php echo base_url('confirm?order_id='.$trans['trans']->id); ?>"><?php echo base_url('confirm?order_id='.$trans['trans']->id); ?></a></p>
									</div>
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