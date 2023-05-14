<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">
		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">
						<h1 class="page-header__title">My Orders</h1>
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
										<a href="<?php echo base_url('member/myorders'); ?>" class="breadcrumbs__link">My Orders</a>
									</li>
									<li class="breadcrumbs__item">
										<a href="#" class="breadcrumbs__link">My Orders Details</a>
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
							
						</div>
					</main>
					<!-- MAIN : end -->
					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">
							
							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--cart">
								<div class="page__content">
									<h5>Order ID #<?php echo $myorder[0]->id; ?></h5>
									<?php if($myorder[0]->is_cancelled == 1) { ?>
									<div class="lsvr-alert-message lsvr-alert-message--warning">
										<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
										<h3 class="lsvr-alert-message__title">Order is Cancelled</h3>
									</div>
									<?php } else { ?>
									<div class="circle_container">
										<div class="circle_order">
											<span class="icofont-shopping-cart icofont-2x circle_order_icon pink-bg white-color"></span>
											Order Placed
										</div>
										<div class="circle_order">
											<span class="icofont-package icofont-2x circle_order_icon <?php if($myorder[0]->status == 'order_prepared' || $myorder[0]->status == 'order_in_transit' || $myorder[0]->status == 'order_delivered') { echo 'pink-bg white-color'; } ?>"></span>
											Order Prepared
										</div>
										<div class="circle_order">
											<span class="icofont-truck-loaded icofont-2x circle_order_icon <?php if($myorder[0]->status == 'order_in_transit' || $myorder[0]->status == 'order_delivered') { echo 'pink-bg white-color'; } ?>"></span>
											Order In Transit
										</div>
										<div class="circle_order">
											<span class="icofont-tick-boxed icofont-2x circle_order_icon <?php if($myorder[0]->status == 'order_delivered') { echo 'pink-bg white-color'; } ?>"></span>
											Order Delivered
										</div>
									</div>
									<?php } ?>
									<div class="line"></div>
									<div class="box-div">
										<h5>Alamat Pengiriman</h5>
										<strong>
										<?php echo $myorder[0]->firstname_receiver.' '.$myorder[0]->lastname_receiver; ?>
										</strong>
										<?php echo $myorder[0]->address.', '; ?>
										<?php echo $myorder[0]->kecamatan.', '.$myorder[0]->kota.' '.$myorder[0]->propinsi.', '.$myorder[0]->kodepos; ?>
										<br/>
										Jasa pengiriman menggunakan <strong><?php echo $myorder[0]->shipping_service; ?></strong>
										<?php if($myorder[0]->no_resi) {
											echo '<br/><br/>No. Resi: <strong>'.$myorder[0]->no_resi.'</strong>';
										} else { ?>
										<small><br/><br/>No Resi belum tersedia</small>
										<?php } ?>
									</div>
									
									<div class="box-div">
										<h5>Ringkasan Produk</h5>
										<table>
											<tr>
												<th colspan="2">Produk</th>
												<th style="text-align: center;">Qty</th>
												<th style="text-align: right;">Subtotal</th>
											</tr>
											<?php $subtotal = 0;
											foreach ($myorderdetails as $key => $value) { ?>
											<tr>
												<td style="width: 60px;">
													<?php if(empty($value->filename)) { ?>
													<img style="width:50px;" src="<?php echo base_url('image_not_available.png'); ?>"  alt="<?php echo $value->name; ?>" >
													<?php } else { ?>
													<img style="width:50px;" src="<?php echo base_url('img/product/'.$value->filename); ?>"  alt="<?php echo $value->name; ?>" >
													<?php } ?>
												</td>
												<td><?php echo $value->name;
													if(!empty($value->variantname)) {
														echo '<br/><small>Variant: '.$value->variantname;
													}
												?></td>
												<td style="text-align: center;"><?php echo $value->qty; ?></td>
												<td style="text-align: right;"><?php echo 'Rp. '.number_format($value->harga * $value->qty,0,',','.');
													$subtotal+=$value->harga * $value->qty; ?>
													
												</td>
											</tr>
											<?php } ?>
											<tr>
												<td colspan="2">
													<small>Total weight: <?php echo $myorder[0]->total_weight/1000; ?> kg</small>
												</td>
												<td style="text-align:right;">SUBTOTAL</td>
												<td style="text-align: right;"><?php echo 'Rp. '.number_format($subtotal,0,',','.');   ?></td>
												<input type="hidden" id="hiddentotal" value="<?php echo $subtotal; ?>" />
											</tr>
											<?php if($myorder[0]->discount > 0) { ?>
											<tr>
												<td colspan="3" style="text-align:right;"><strong style="color:#ff007c;"><?php echo $myorder[0]->voucher_code; ?></strong> VOUCHER APPLIED</td>
												<td style="text-align: right;" id="voucherdisc"><?php echo '- Rp. '.number_format($myorder[0]->discount,0,',','.');   ?></td>
											</tr>
											<?php }	?>
											<tr>
												<td colspan="3" style="text-align:right;">SHIPPING COST</td>
												<td style="text-align: right;" id="shippingcost"><?php echo 'Rp. '.number_format($myorder[0]->shipping_cost,0,',','.');   ?></td>
											</tr>
											<tr>
												<td colspan="3" style="text-align:right;"><strong>TOTAL</strong></td>
												<td  style="text-align: right;" id="totalcost"><strong><?php echo 'Rp. '.number_format($myorder[0]->shipping_cost+$subtotal-$myorder[0]->discount,0,',','.');   ?></strong></td>
											</tr>
										</table>
										
									</div>
								</div>
								<!-- PAGE : end -->
								<div class="lsvr-grid">
									<div class="lsvr-grid__col">
										<p>
											Already made a payment?<br/>
											<!-- BUTTON : begin -->
											<a href="<?php echo base_url('confirm?order_id='.$myorder[0]->id); ?>" class="lsvr-button lsvr-button--small">Confirm Payment</a>
											<!-- BUTTON : end -->
										</p>
									</div>
								</div>
							</div>
						</main>
						<!-- MAIN : end -->
					</div>
					
				</div>
			</div>
			<!-- CORE COLUMNS : end -->
		</div>
	</div>