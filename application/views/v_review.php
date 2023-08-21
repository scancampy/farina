<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">
		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">
						<h1 class="page-header__title">Product Review</h1>
						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">
									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
									</li>
									<li class="breadcrumbs__item">
										<a href="#" class="breadcrumbs__link">Product Review</a>
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
								<div class="page__content">
									<form method="post" action="<?php echo base_url('review?order_id='.$id); ?>">
										<input type="hidden" name="hid_order_id" value="<?php echo $id; ?>"/>

										<input type="hidden" name="token" id="token"/>
										
										<!-- CART LIST : begin -->
										<ul class="product-cart__list">
		<?php foreach ($order['detil'] as $key => $value) { ?>
<!-- CART ITEM : begin -->
	<li class="product-cart__item">

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--title">

			<div style="display: flex; align-items: center;">
				<?php if(empty($value->filename)) { ?>
				<img style="width:50px; margin-right: 10px;" src="<?php echo base_url('image_not_available.png'); ?>"  alt="<?php echo $value->name; ?>"  >
				<?php } else { ?>
				<img style="width:50px; margin-right: 10px;" src="<?php echo base_url('img/product/'.$value->filename); ?>" alt="<?php echo $value->name; ?>" >
				<?php } ?>
				<!-- ITEM TITLE : begin -->
				<h4 class="product-cart__item-title" style="margin-bottom:0px;">
					<?php echo $value->name; ?>
					<?php if($value->variantname != '') { ?> 
						<br/>
					<small>Variant: <?php echo $value->variantname; ?></small>
				<?php } ?>
				</h4>
			</div>

			<div class="rate">
    <input type="radio" id="star_<?php echo $value->id; ?>_5" name="rate_<?php echo $value->id; ?>" value="5" <?php if($value->rating == 5) { echo 'checked'; } ?> />
    <label for="star_<?php echo $value->id; ?>_5" title="text">5 stars</label>
    <input type="radio" id="star_<?php echo $value->id; ?>_4" name="rate_<?php echo $value->id; ?>" value="4" <?php if($value->rating == 4) { echo 'checked'; } ?> />
    <label for="star_<?php echo $value->id; ?>_4" title="text">4 stars</label>
    <input type="radio" id="star_<?php echo $value->id; ?>_3" name="rate_<?php echo $value->id; ?>" value="3" <?php if($value->rating == 3) { echo 'checked'; } ?>/>
    <label for="star_<?php echo $value->id; ?>_3" title="text">3 stars</label>
    <input type="radio" id="star_<?php echo $value->id; ?>_2" name="rate_<?php echo $value->id; ?>" value="2" <?php if($value->rating == 2) { echo 'checked'; } ?>/>
    <label for="star_<?php echo $value->id; ?>_2" title="text">2 stars</label>
    <input type="radio" id="star_<?php echo $value->id; ?>_1" name="rate_<?php echo $value->id; ?>" value="1" <?php if($value->rating == 1) { echo 'checked'; } ?> />
    <label for="star_<?php echo $value->id; ?>_1" title="text">1 star</label>
  </div>
			<p style="margin-bottom:0px; margin-top: 10px; clear:left;">Write your review for <?php echo $value->name; ?></p>
			<textarea name="comment_<?php echo $value->id; ?>"><?php echo $value->review; ?></textarea>
						<!-- ITEM TITLE : end -->

		</div>
		<!-- ITEM ITEM COL : end -->

		

	</li>
	<!-- CART ITEM : end -->
		<?php } ?>

											

										</ul>
										<!-- CART LIST : end -->
<!-- PAGE : end -->
							<div style="margin-right:20px; margin-top: 20px; display: flex; justify-content: flex-end;">
	<p class="product-order__footer-checkout">
		<button type="submit" name="btnsubmit" value="submit" class="product-order__footer-checkout-btn lsvr-button">Submit</button>
	</p>
</div>
									
									</form>	
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
<!-- CORE : end -->