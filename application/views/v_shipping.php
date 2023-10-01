<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Shipping</h1>

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

									<li class="breadcrumbs__item">
										<a href="#" class="breadcrumbs__link">Shipping</a>
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

									<form class="product-checkout lsvr-form" method="post" action="<?php echo base_url('cart/shipping'); ?>">
									

									<div class="box-div">
										<h5>Alamat Pengiriman</h5>
											<strong>
											<?php echo $address['firstname'].' '.$address['lastname']; ?>
										</strong>
											<?php echo $address['address'].', '; ?>
											<?php echo $kecamatan->subdistrict_name.', '.$kecamatan->type.' '.$kecamatan->city.', '.$kecamatan->province.', '.$address['kodepos']; ?>
										
									</div>

									<div class="box-div">
										<h5>Opsi Pengiriman</h5>

										
										<table>
											<tr>
												<th colspan="2">Pilih Layanan</th>
												<th>Biaya Kirim</th>
												<th>Estimasi</th>
											</tr>
											<?php 
											$shipingcost = 0;
											foreach ($sicepat[0]->costs as $key => $value) {  ?>
												<tr>
													<td style="width: 20px;
    text-align: right;
    margin: 0px;
    padding: 0px;"><input style="margin-left:20px;  margin-top:20px;" class=" radioongkir lsvr-form__field-label--radio" type="radio" name="radiokirim" id="radio<?php echo $value->service; ?>" <?php if($key==0) { echo 'checked'; $shipingcost =$value->cost[0]->value;  }  ?> cost="<?php echo $value->cost[0]->value; ?>"  value="<?php echo $value->service; ?>" /> &nbsp;</td>
													<td><?php  echo '<label for="radio'.$value->service.'"><strong >'.$sicepat[0]->name.'</strong> '.$value->description; ?></td>
													<td><?php 
													echo 'Rp. '.number_format($value->cost[0]->value,0,',','.'); ?></td>
													<td><?php 
													if($value->cost[0]->etd != '') {
														echo $value->cost[0]->etd.' hari'; 
													} else {
														echo 'N/A';
													} ?></td>
												</tr>
											<?php } ?>
											<?php
											foreach ($jnt[0]->costs as $key => $value) { 
											 ?>
												<tr>
													<td style="width: 20px;
    text-align: right;
    margin: 0px;
    padding: 0px;"><input style="margin-left:20px; margin-top:20px;" class="radioongkir lsvr-form__field-label--radio" type="radio" name="radiokirim" id="radio<?php echo $value->service; ?>" cost="<?php echo $value->cost[0]->value; ?>"  value="<?php echo $value->service; ?>" /> &nbsp;</td>
													<td><?php  echo '<label for="radio'.$value->service.'"><strong >'.$jnt[0]->name.'</strong> '.$value->description; ?></td>
													<td><?php 
													echo 'Rp. '.number_format($value->cost[0]->value,0,',','.'); ?></td>
													<td><?php 
													if($value->cost[0]->etd != '') {
														echo $value->cost[0]->etd.' hari';
													} else {
														echo 'N/A';
													} ?></td>
												</tr>
											<?php } ?>
											
										</table>
									</div>


									<div class="box-div">
										<h5>Ringkasan Produk</h5>
										<table>
											<tr>
												<th colspan="2">Produk</th>
												<th style="text-align: center;">Qty</th>
												<th style="text-align: right;">Subtotal</th>
											</tr>
											<?php $subtotal = 0; foreach ($product as $key => $value) { ?>
											<tr>
												<td style="width: 60px;">
												<?php if(empty($value['img'][0]->filename)) { ?>
													<img style="width:50px;" src="<?php echo base_url('image_not_available.png'); ?>"  alt="<?php echo $value['product'][0]->name; ?>" >
												<?php } else { ?>
													<img style="width:50px;" src="<?php echo base_url('img/product/'.$value['img'][0]->filename); ?>"  alt="<?php echo $value['product'][0]->name; ?>" >
												<?php } ?>
												</td>
												<td><?php echo $value['product'][0]->name;
												if(!empty($value['variant'])) {
													echo '<br/><small>Variant: '.$value['variant'][0]->name; 
												}
												 ?></td>
												<td style="text-align: center;"><?php echo $value['qty']; ?></td>
												<td style="text-align: right;"><?php echo 'Rp. '.number_format($value['product'][0]->price * $value['qty'],0,',','.');  $subtotal+=$value['product'][0]->price * $value['qty']; ?>
													

												</td>
											</tr>
											<?php } ?>
											<tr>
												<td colspan="2">
													<small>Total weight: <?php echo $totalweight/1000; ?> kg</small>
												</td>
												<td style="text-align:right;">SUBTOTAL</td>
												<td style="text-align: right;"><?php echo 'Rp. '.number_format($subtotal,0,',','.');   ?></td>
												<input type="hidden" id="hiddentotal" value="<?php echo $subtotal; ?>" />
											</tr>
											<?php 

	$diskon = 0;
	$diskonongkir = 0;

	if(!empty($voucher)) {
		if($voucher[0]->voucher_type == 'global') {
			if($subtotal >= $voucher[0]->min_order) {
				if($voucher[0]->discount_value > 0) {
					$diskon = $voucher[0]->discount_value;
				} else { 
					$diskon = $subtotal * ($voucher[0]->discount_percentage/100); 
				}
			}
		} else if($voucher[0]->voucher_type == 'private') {

			if($subtotal >= $voucher[0]->min_order && @$private_voucher_eligible) {

				if($voucher[0]->discount_value > 0) {
					$diskon = $voucher[0]->discount_value;
				} else { 
					$diskon = $subtotal * ($voucher[0]->discount_percentage/100); 
				}
			}
		} else if($voucher[0]->voucher_type == 'vip') {
			if($subtotal >= $voucher[0]->min_order && @$member->member_type=='VIP') {
				if($voucher[0]->discount_value > 0) {
					$diskon = $voucher[0]->discount_value;
				} else { 
					$diskon = $subtotal * ($voucher[0]->discount_percentage/100); 
				}
			}
		} else if($voucher[0]->voucher_type == 'produk') {
			$adaproduk = false;
			foreach ($product as $key => $value) {
				if($value['product'][0]->id == $voucher[0]->product_id) {
					$harga = ($value['product'][0]->price * $value['qty']);
					if($voucher[0]->min_order <= $harga) {  
						if($voucher[0]->discount_value > 0) { 
							$diskon = $voucher[0]->discount_value;
						} else {  
							$diskon = $harga * ($voucher[0]->discount_percentage/100); 
						}
					}

					$adaproduk = true;
					break;
				}
			}
		} else if($voucher[0]->voucher_type == 'brand') {
			$adaproduk = false;
			$totalbrand =0;
			foreach ($product as $key => $value) {
				if($value['product'][0]->brand_id == $voucher[0]->brand_id) {
					$totalbrand += ($value['product'][0]->price * $value['qty']);
					$adaproduk = true;
				}
			}

			if($adaproduk) {
				if($voucher[0]->min_order <= $totalbrand) { 
					if($voucher[0]->discount_value > 0) { 
						$diskon = $voucher[0]->discount_value;
					} else { 
						$diskon = $totalbrand * ($voucher[0]->discount_percentage/100); 
					}
				}
			}
		}

												if($diskon > 0) { ?>
											<tr>
												<td colspan="3" style="text-align:right;"><strong style="color:#ff007c;"><?php echo $voucher[0]->voucher_code; ?></strong> VOUCHER APPLIED</td>
												<td style="text-align: right;" id="voucherdisc"><?php echo '- Rp. '.number_format($diskon,0,',','.');   ?></td>

											</tr>
											<?php	}
											}
											?>
											
											<tr>
												<input type="hidden" id="hiddendiskon" name="hiddendiskon" value="<?php echo $diskon; ?>">

												

												<td colspan="3" style="text-align:right;">SHIPPING COST</td>
												<td style="text-align: right;" id="shippingcost"><?php echo 'Rp. '.number_format($shipingcost,0,',','.');   ?></td>
											</tr>
<?php 
	
	if(!empty($voucherongkir)) { 
		if($voucherongkir[0]->voucher_type == 'ongkir') {

			if($subtotal >= $voucherongkir[0]->min_order) {
				
				if($voucherongkir[0]->discount_value > 0) {
					$diskonongkir = $voucherongkir[0]->discount_value;
				} else { 
					$diskonongkir = $subtotal * ($voucherongkir[0]->discount_percentage/100); 
				}
				if($diskonongkir > $shipingcost) {
					$diskonongkir = $shipingcost;
				}
		 ?>
<tr>
	<td colspan="3" style="text-align:right;"><strong style="color:#ff007c;"><?php echo $voucherongkir[0]->voucher_code; ?></strong> VOUCHER ONGKIR APPLIED</td>
	<td style="text-align: right;" id="voucherongkirdisc"><?php echo '- Rp. '.number_format($diskonongkir,0,',','.');   ?></td>
</tr>
		<?php	}
		}
	}
?>
											<tr>
												<input type="hidden" id="hiddendiskonongkir" name="hiddendiskonongkir" value="<?php echo $diskonongkir; ?>">
												<td colspan="3" style="text-align:right;"><strong>TOTAL</strong></td>
												<td  style="text-align: right;" id="totalcost"><strong><?php echo 'Rp. '.number_format($shipingcost+$subtotal-$diskon-$diskonongkir,0,',','.');   ?></strong></td>
											</tr>
										</table>
									</div>

									<!-- ORDER FOOTER : begin -->
									<div class="product-order__footer">

										<!-- FOOTER CHECKOUT : begin -->
										<p class="product-order__footer-checkout">
											<button type="submit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Confirm Shipping</button>
										</p>
										<!-- FOOTER CHECKOUT : end -->

									</div>
									<!-- ORDER FOOTER : end -->

									
									<!-- PRODUCT CHECKOUT : end -->
</form>
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