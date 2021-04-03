	<!-- CORE : begin -->
			<div id="core" class="core--narrow">
				<div class="core__inner">

					<!-- PAGE HEADER : begin -->
					<div class="page-header">
						<div class="page-header__inner">
							<div class="lsvr-container">
								<div class="page-header__content">

									<h1 class="page-header__title">Your Cart</h1>

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
										<div class="page product-post-page product-post-order product-post-order--cart">

											<?php if(count($product) > 0) { ?>
											<div class="page__content">

												<!-- PRODUCT CART : begin -->
												<form class="product-cart" method="post" action="<?php echo base_url('cart'); ?>">


													<!-- CART LIST : begin -->
													<ul class="product-cart__list">
														<?php 
														$total = 0;
														$adaoutstock = false;
														foreach ($product as $key => $value) { 
															
															?>
															<!-- CART ITEM : begin -->
														<li class="product-cart__item" id="lst<?php echo $key; ?>">

															<!-- ITEM ITEM COL : begin -->
															<div class="product-cart__item-col product-cart__item-col--thumb">

																<!-- ITEM THUMB : begin -->
																<p class="product-cart__item-thumb">
																	
																	<a href="<?php echo base_url('product/detail/'.$value[0]->id.'/'.url_title($value[0]->name)); ?>" class="product-cart__item-thumb-link">
																		<?php if($photo[$key] != '') { ?>
																		<img src="<?php echo base_url('img/product/'.$photo[$key]); ?>" class="product-cart__item-thumb-img" alt="<?php echo $value[0]->name; ?>">
																	<?php } else {  ?>
																		<img src="<?php echo base_url('image_not_available.png'); ?>" class="product-cart__item-thumb-img" alt="<?php echo $value[0]->name; ?>">
																	<?php } ?>
																	</a>
																</p>
																<!-- ITEM THUMB : end -->

															</div>
															<!-- ITEM ITEM COL : end -->

															<!-- ITEM ITEM COL : begin -->
															<div class="product-cart__item-col product-cart__item-col--title" style="flex-grow:0; flex-basis: 50%;">

																<!-- ITEM TITLE : begin -->
																<h4 class="product-cart__item-title">
																	<a href="product-single.html" class="product-cart__item-title-link"><?php echo $value[0]->brandname.' '.$value[0]->name; ?></a>
																</h4>

																<?php if($variant[$key] != '') { ?>
																	<p style="margin-bottom: 0px;">
																		<?php echo 'Variant: '.$variant[$key][0]->name; ?>
																	</p>
																<?php }  ?>
																<!-- ITEM TITLE : end -->

																<!-- ITEM STATUS : begin -->
																<?php if($value[0]->in_stock == 1) { ?>
																<p class="product-cart__item-status product-cart__item-status--in-stock"><!-- You can use "in-stock", "on-order" and "unavailable" modifiers -->
																	In Stock
																</p>
															<?php } else {  $adaoutstock = true; ?>
																<p class="product-cart__item-status product-cart__item-status--unavailable"><!-- You can use "in-stock", "on-order" and "unavailable" modifiers -->
																	Out of Stock
																</p>
															<?php } ?>
																<!-- ITEM STATUS : end -->

															</div>
															<!-- ITEM ITEM COL : end -->

															<!-- ITEM ITEM COL : begin -->
															<div class="product-cart__item-col product-cart__item-col--quantity">

																<!-- ITEM QUANTITY : begin -->
																<p class="product-cart__item-quantity quantity-field" <?php if($value[0]->in_stock == 0) { echo 'style="display:none;"'; } ?>>

																	<input type="text" id="qty<?php echo $key; ?>" min="1" class="quantity-field__input" value="<?php echo $qty[$key]; ?>" <?php if($value[0]->in_stock == 0) { echo 'disabled="disabled"'; } ?>>

																	<button type="button" <?php if($value[0]->in_stock == 0) { echo 'disabled="disabled"'; } ?> class="quantity-field__btn quantity-field__btn--add" idx="<?php echo $key; ?>" title="Add one">
																		<span class="quantity-field__btn-icon" aria-hidden="true"></span>
																	</button>

																	<button type="button" <?php if($value[0]->in_stock == 0) { echo 'disabled="disabled"'; } ?> class="quantity-field__btn quantity-field__btn--remove" idx="<?php echo $key; ?>" title="Remove one">
																		<span class="quantity-field__btn-icon" aria-hidden="true"></span>
																	</button>

																	<input type="hidden" id="baseprice<?php echo $key; ?>" value="<?php echo $value[0]->price; ?>" />
																

																</p>
																<!-- ITEM QUANTITY : end -->

															</div>
															<!-- ITEM ITEM COL : end -->

															<!-- ITEM ITEM COL : begin -->
															<div class="product-cart__item-col product-cart__item-col--price">

																<!-- ITEM PRICE : begin -->
																<p class="product-cart__item-price" id="price<?php echo $key; ?>" style="font-size: 12pt;">
																	<?php if($value[0]->in_stock == 1) { ?>
																	Rp. <?php  echo number_format($qty[$key]*$value[0]->price, 0, ",","."); ?>
																<?php } else { echo '-'; } ?>
																</p>
																<!-- ITEM PRICE : end -->
																<?php if($value[0]->in_stock == 1) { ?>
																<?php $total +=  $qty[$key]*$value[0]->price; ?>
															<?php } ?>
															</div>
															<!-- ITEM ITEM COL : end -->

															<!-- ITEM ITEM COL : begin -->
															<div class="product-cart__item-col product-cart__item-col--remove">

																<!-- ITEM REMOVE : begin -->
																<p class="product-cart__item-remove">
																	<button type="button" class="product-cart__item-remove-btn" idx="<?php echo $key; ?>">
																		<span class="product-cart__item-remove-btn-icon" aria-hidden="true"></span>
																	</button>
																</p>
																<!-- ITEM REMOVE : end -->

															</div>
															<!-- ITEM ITEM COL : end -->

														</li>
														<!-- CART ITEM : end -->
														<?php } ?>

													</ul>
													<!-- CART LIST : end -->

													<!-- CART SUMMARY : begin -->
													<div class="product-cart__summary">

														<!-- CART COUPON : begin -->
														<p class="product-cart__coupon">
															<input type="text" style="text-transform:uppercase" maxlength="20" class="product-cart__coupon-input" placeholder="Voucher Code" name="voucher_code">
															<button type="submit" value="apply" class="product-cart__coupon-btn lsvr-button lsvr-button--type-2" name="btnApply">Apply Voucher</button>
														</p>
														<!-- CART COUPON : end -->

														<!-- CART TOTAL : begin -->
														<p class="product-cart__total">
															<span class="product-cart__total-label">Total</span>
															<strong class="product-cart__total-price" id="totalidr">Rp. <?php  echo number_format($total, 0, ",","."); ?></strong>
														</p>
														<!-- CART TOTAL : end -->

													</div>
													<!-- CART SUMMARY : end -->
<!-- FOOTER BACK : end -->
														<?php if($adaoutstock == true) { ?>
														<div class="lsvr-alert-message lsvr-alert-message--warning" style="margin-top:20px; margin-bottom: 0px;">
															<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
															<h3 class="lsvr-alert-message__title">Item Out of Stock</h3>
															<p>Terdapat barang di dalam cart yang tidak tersedia. Hapus terlebih dahulu sebelum melakukan checkout.</p>
														</div>
													<?php } ?>
													<!-- ORDER FOOTER : begin -->
													<div class="product-order__footer">

														<!-- FOOTER BACK : begin -->
														<p class="product-order__footer-back">
															<a href="product-archive.html" class="product-order__footer-back-link">Back to Store</a>
														</p>
														

														<!-- FOOTER CHECKOUT : begin -->
														<p class="product-order__footer-checkout">
															<button type="submit" class="product-order__footer-checkout-btn lsvr-button">To Checkout</button>
														</p>
														<!-- FOOTER CHECKOUT : end -->

													</div>
													<!-- ORDER FOOTER : end -->

												</form>
												<!-- PRODUCT CART : end -->

											</div>

											<?php } else { ?>
												<div class="page__content">

												<h2>Your cart is empty</h2>

												<p>Temukan produk-produk menarik untuk kebutuhan anda</p>

												<p>
													<a href="<?php echo base_url('product'); ?>" class="lsvr-button">Browse Product</a>
												</p>

											</div>
											<?php } ?>
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