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

										<!-- CART LIST : begin -->
										<ul class="product-cart__list">
		<?php foreach ($myorder as $key => $value) { ?>
<!-- CART ITEM : begin -->
	<li class="product-cart__item">

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--title">

			<!-- ITEM TITLE : begin -->
			<h4 class="product-cart__item-title" style="margin-bottom:0px;">
				<a href="<?php echo base_url('member/myorderdetails/'.$value->id); ?>" class="product-cart__item-title-link">Order ID: <?php echo $value->id; ?></a><br/>
				<small><?php echo strftime("%d %B %Y %H:%I:%S", strtotime($value->order_placed_date)); ?></small>
			</h4>
			<?php if($value->status == 'order_placed') { ?> 
					<small>Already made payment? confirm <a href="<?php echo base_url('confirm?order_id='.$value->id); ?>">here</a></small> 
				<?php } ?>
			<!-- ITEM TITLE : end -->

		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--quantity" style="flex-grow:1;">
			<?php if($value->is_cancelled == 1) { ?>
			<span class="pill_red"><?php echo 'ORDER CANCELLED'; ?></span>
			<?php } else if($value->status == 'order_placed') { ?>
			<span class="pill_yellow"><?php echo str_replace("_"," ",strtoupper($value->status)); ?></span>
			<?php } else if($value->status == 'order_prepared') { ?>
			<span class="pill_green"><?php echo str_replace("_"," ",strtoupper($value->status)); ?></span>
			<?php } else if($value->status == 'order_in_transit') { ?>
			<span class="pill_green"><?php echo str_replace("_"," ",strtoupper($value->status)); ?></span>
			<?php } else if($value->status == 'order_delivered') { ?>
			<span class="pill_green"><?php echo str_replace("_"," ",strtoupper($value->status)); ?></span>
			<?php } ?>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--price">

			<!-- ITEM PRICE : begin -->
			<p class="product-cart__item-price">
				<?php $tot = $value->total_trans + $value->shipping_cost- $value->discount-$value->discount_ongkir;  echo 'Rp. '.number_format($tot,0,',','.'); ?>
			</p>
			<!-- ITEM PRICE : end -->

		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--remove" style="display:flex; text-align: left; ">
			<a href="<?php echo base_url('cart/myinvoice/'.$value->id); ?>" style="margin-right: 5px;" target="_blank"><span class="fa fa-print"></span></a>

			<a style="margin-right: 5px;" href="<?php echo base_url('member/myorderdetails/'.$value->id); ?>"><span class="fa fa-list-alt"></span></a>

			<?php if($value->status == 'order_delivered' && $value->is_reviewed == null) { ?>
			<a href="<?php echo base_url('review?order_id='.$value->id); ?>"><span class="fa fa-star"></span></a>
		<?php } ?>
		</div>
		<!-- ITEM ITEM COL : end -->

	</li>
	<!-- CART ITEM : end -->
		<?php } ?>

											

										</ul>
										<!-- CART LIST : end -->

										
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