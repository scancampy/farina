<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">
		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">
						<h1 class="page-header__title">Payment Confirmation</h1>
						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">
									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
									</li>
									<li class="breadcrumbs__item">
										<a href="#" class="breadcrumbs__link">Payment Confirmation</a>
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
									<?php 

										$adaisi = false; 
										$methodstr = '';
										if(!empty($order)) { 
											$adaisi = true; 
											$methodstr = 'method="post"'; 
										} else { 

											$adaisi = false; 
											$methodstr  = 'method="get"'; 
										} ?>
									<!-- PRODUCT CHECKOUT : begin -->
									<form id="formpayment" class="product-checkout lsvr-form" <?php  echo $methodstr; ?> enctype="multipart/form-data" action="<?php
										echo base_url('confirm');
										?>">
										<!-- VALIDATION ERROR MESSAGE : begin -->
										<?php if(@$error != '') { ?>
										<div style="display: block;" class="lsvr-form__message lsvr-form__message--validation-error lsvr-alert-message lsvr-alert-message--warning">
											<span class="lsvr-alert-message__icon" ></span>
											<p><?php echo $error; ?></p>
										</div>
										<?php  } ?>
										<!-- VALIDATION ERROR MESSAGE : begin -->
										<?php if(@$success != '') { ?>
										<div style="display: block;" class="lsvr-alert-message lsvr-alert-message--success">
											<span class="lsvr-alert-message__icon" ></span>
											<p><?php echo $success; ?></p>
										</div>
										<?php  } ?>
										<!-- GRID : begin -->
										<div class="lsvr-grid lsvr-grid--1-cols lsvr-grid--sm-1-cols">
											<!-- GRID COL : begin -->
											<?php if(empty(@$order)) { ?>
											<div class="lsvr-grid__col">
												<p class="lsvr-form__field">
													<label class="lsvr-form__field-label" for="order_id">Order ID*</label>
													<input autofocus class="lsvr-form__field-input lsvr-form__field-input--text lsvr-form__field-input--required" placeholder="Enter 12 digit of your order ID"
													type="text" value="" name="order_id" id="order_id">
												</p>
											</div>
											<?php } else { ?>
											<div class="box-div" style="width:100%;">
												<div style="display:flex; flex-wrap:wrap;">
													<div style="margin-right:30px;">
														<h4 style="margin-bottom: 0px;">Order ID</h4>
														<div class="category-container" style="margin-top: 10px; margin-bottom: 20px;">
															<strong class="btncategory" style="color:#ff007c;">#<?php echo $order['trans']->id; ?></strong>
														</div>
													</div>
													<?php if($order['trans']->is_cancelled ==0) { ?>
													<div>
														<h4 style="margin-bottom: 0px;">Order Status</h4>
														<div class="category-container" style="margin-top: 10px; margin-bottom: 20px;">
															<span class="btncategory"><?php echo str_replace("_"," ", strtoupper($order['trans']->status)); ?></span>
														</div>
													</div>
													<?php } ?>
												</div>
												<?php if($order['trans']->is_cancelled ==1) { ?>
												<div class="lsvr-alert-message lsvr-alert-message--warning">
													<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
													<h3 class="lsvr-alert-message__title">Order is Cancelled</h3>
												</div>
												<?php } else if($order['trans']->status == 'order_placed') { ?>
												<p>The total amount due for your order is <strong style="color:#ff007c;">
													Rp. <?php $tot = $order['trans']->total_trans + $order['trans']->shipping_cost - $order['trans']->discount - $order['trans']->discount_ongkir;
														echo number_format($tot,0,',','.');
													?></strong>. Please make payment at your earliest convenience using the following details:<br/>
													<?php
														echo '<strong>'.$setting->bank1.'</strong><br/>';
														echo '<strong>No. Rek: '.$setting->no_akun_bank1.'</strong><br/>';
														echo '<strong>A/N: '.$setting->nama_akun_bank1.'</strong><br/><br/>';
														echo '<strong>'.$setting->bank2.'</strong></p>';
														
												} else { ?>
												<p>Payment has been received. Thank you for your order.</p>
												<?php } ?>
											</div>
											<?php if($order['trans']->status == 'order_placed' && $order['trans']->is_cancelled == 0) { ?>
											<div class="box-div" style="width:auto;">
												<h5>Confirm Payment</h5>
												<p>
													If you have already made a payment, please confirm it by providing the payment details in the form below:
												</p>
												<!-- GRID : begin -->
												<div class="lsvr-grid">
													<!-- GRID COL : begin -->
													<div class="lsvr-grid__col lsvr-grid__col--span-12 lsvr-grid__col--md-span-12">
														<p class="lsvr-form__field">
															<label class="lsvr-form__field-label" for="proof">Upload Payment Proof (Bukti Bayar)*</label>
															<input accept="image/*" class=""
															type="file"  name="proof" id="proof"/>
															<input type="hidden" name="hiddenid" value="<?php echo $order['trans']->id; ?>" />
														</p>
													</div>
													<!-- GRID COL : end -->
													<!-- GRID COL : begin -->
													<div class="lsvr-grid__col lsvr-grid__col--span-12 lsvr-grid__col--md-span-12">
														<p class="lsvr-form__field">
															<label class="lsvr-form__field-label" for="trans_to">Transfer To (Bank Tujuan)*</label>
															<select class="lsvr-form__field-input lsvr-form__field-input--required"
																name="trans_to" id="trans_to">
																<option value="1"><?php echo $setting->bank1.' ('.$setting->no_akun_bank1.' a/n '.$setting->nama_akun_bank1.')'; ?></option>
																
															</select>
														</p>
													</div>
													<!-- GRID COL : end -->
												</div>
											</div>
											<?php }  ?>
											<?php } ?>
											<!-- GRID COL : end -->
											
										</div>
										<!-- GRID : end -->
										
										
										<!-- ORDER FOOTER : begin -->
										<div class="product-order__footer">
											<input type="hidden" name="token" id="token"/>
											<?php if(empty(@$order['trans'])) { ?>
											<!-- FOOTER CHECKOUT : begin -->
											<p class="product-order__footer-checkout">
												<button type="submit" id="btnsubmit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">CHECK ORDER</button>
											</p>
											<?php } else if($order['trans']->status == 'order_placed') { ?>
											<p class="product-order__footer-checkout">
												<button type="submit" id="btnsubmitconfirm" name="btnsubmitconfirm" value="submit" class="product-order__footer-checkout-btn lsvr-button">CONFIRM PAYMENT</button>
											</p>
											<?php } ?>
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
<!-- CORE : end -->