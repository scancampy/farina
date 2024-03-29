	<!-- CORE : begin -->
			<div id="core">
				<div class="core__inner">

					<!-- PAGE HEADER : begin -->
					<div class="page-header">
						<div class="page-header__inner">
							<div class="lsvr-container">
								<div class="page-header__content">

									<h1 class="page-header__title"><?php echo $product[0]->brandname.' '.$product[0]->name; ?></h1>

									<!-- BREADCRUMBS : begin -->
									<div class="breadcrumbs">
										<div class="breadcrumbs__inner">
											<ul class="breadcrumbs__list">

												<li class="breadcrumbs__item">
													<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
												</li>

												<li class="breadcrumbs__item">
													<a href="<?php echo base_url('product'); ?>" class="breadcrumbs__link">Product</a>
												</li>

												<?php

											//	print_r($breadcrumb);
												for($k = count($breadcrumb)-1; $k >=0; $k--) { 
				echo '<li class="breadcrumbs__item">';
				echo '<a href="'.base_url('product?category='.$breadcrumb[$k]->id).'" class="breadcrumbs__link">'.$breadcrumb[$k]->name.'</a>';
				echo '</li>';
							  
							}
												?>

												<li class="breadcrumbs__item">
													<a href="#" class="breadcrumbs__link"><?php echo $product[0]->name; ?></a>
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

								<!-- COLUMNS GRID : begin -->
								<div class="core__columns-grid lsvr-grid">

									<!-- MAIN COLUMN : begin -->
									<div class="core__columns-col core__columns-col--main core__columns-col--left lsvr-grid__col lsvr-grid__col--span-9 lsvr-grid__col--md-span-12">
	<!-- MAIN : begin -->
	<main id="main">
		<div class="main__inner">

			<!-- PAGE : begin -->
			<div class="page product-post-page product-post-single">
				<div class="page__content">
					<?php if(!empty($brand[0]->logo_filename)) { ?>
					<img style="display: block;
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 40px;
    width: 140px;" src="<?php echo base_url('images/brand/'.$brand[0]->logo_filename); ?>"/><?php } ?>

					<!-- POST : begin -->
					<article class="post product-post">
						<div class="post__inner">

							<?php if($product[0]->price_het > $product[0]->price) { ?>
									<div class="disc_circle_at_home"><?php echo number_format((($product[0]->price_het-$product[0]->price)/$product[0]->price_het)*100,0,'.','.').'%'; ?></div>
							<?php	} ?>	

							<div class="lsvr-grid">

								<div class="lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--sm-span-12">

									<!-- POST GALLERY : begin -->
									<div class="post__gallery">

										<?php if(count($photo) >0) { ?>

										<!-- POST GALLERY FEATURED : begin -->
										<p class="post__gallery-featured">
											<a href="<?php echo base_url('img/product/'.$photo[0]->filename); ?>" class="post__gallery-featured-link open-in-lightbox">
												<img src="<?php echo base_url('img/product/'.$photo[0]->filename); ?>" class="post__gallery-featured-img" alt="<?php echo $product[0]->name; ?>">
											</a>
										</p>
										<?php } else { ?>
											<p class="post__gallery-featured">
											<a href="<?php echo base_url('image_not_available.png'); ?>" class="post__gallery-featured-link open-in-lightbox">
												<img src="<?php echo base_url('image_not_available.png'); ?>" class="post__gallery-featured-img" alt="<?php echo $product[0]->name; ?>">
											</a>
										</p>
										<?php } ?>
										<div style="text-align:center;">
											<?php if($total >0) { ?>

											<?php for($i = 1; $i<= $ratings; $i++) { ?>
												<i style="color: #ff007c;" class="fas fa-regular fa-star"></i>
											<?php }  

											if($ratings % 4 > 0) { ?>
												<i style="color: #ff007c;" class="fas fa-regular fa-star-half"></i>
											<?php }
											?>

											<?php echo $ratings; ?> (<?php echo $total;	  ?> reviews)
										<?php } else { echo 'No review yet'; } ?>
										</div>
										<!-- POST GALLERY FEATURED : end -->

										<!-- POST GALLERY LIST : begin -->
										<ul class="post__gallery-list">
											<?php for($i = 1; $i<count($photo); $i++) { ?>
												<!-- POST GALLERY ITEM : begin -->
											<li class="post__gallery-item">
												<a href="<?php echo base_url('img/product/'.$photo[$i]->filename); ?>" class="post__gallery-item-link open-in-lightbox">
													<img src="<?php echo base_url('img/product/'.$photo[$i]->filename); ?>" class="post__gallery-item-img" alt="<?php echo $product[0]->name; ?>">
												</a>
											</li>
											<!-- POST GALLERY ITEM : end -->
											<?php } ?>
								 		</ul>
								 		<!-- POST GALLERY LIST : end -->

									</div>
									<!-- POST GALLERY : end -->

								</div>

								<div class="lsvr-grid__col lsvr-grid__col--span-8 lsvr-grid__col--sm-span-12">

									<!-- POST INTRO : begin -->
									<div class="post__intro">
										<p><?php echo $product[0]->description; ?></p>
										

									</div>
									<div  class="post__content">
										<table>
										    <thead>
										        <tr>
										            <th colspan="2">Keterangan</th>
										        </tr>
										    </thead>
										    <tbody>
										        <tr>
										            <td>Ukuran</td>
										            <td><?php echo $product[0]->weight.' '.$product[0]->unit_name; ?></td>
										        </tr>
										        <tr>
										            <td>Brand</td>
										            <td><a href="<?php echo base_url('product?brand='.$product[0]->brand_id); ?>"><?php echo $product[0]->brandname; ?></a></td>
										        </tr>
										    </tbody>
										</table>
									</div>
									<!-- POST INTRO : end -->


									<!-- POST CONTENT : begin -->
									<?php if(count($variant) >0) { ?>
									<div class="post__content">
										<p>Choose Product Variant:</p>
										<div style="display: flex; flex-wrap:wrap;">

										<?php foreach ($variant as $key => $value) { ?>
											<div>
												<span attrid="<?php echo $value->id; ?>" class="post__gallery-featured-link variantobj <?php if($key == 0) { echo 'selectedvariant'; } ?> " style="width: 75px; height: 75px; 
												margin-left:10%;
												display: inline-block;
												overflow: hidden;
												background: url(<?php echo base_url('img/variant/'.$value->filename); ?>);
												border-radius: 50%; background-size: cover;
												background-repeat:no-repeat;
												background-position: center center;
												border:2px solid #ecf0f1; margin-right: 40px;" >
												<?php if($value->filename != '') { ?>
												<img src="<?php echo base_url('img/variant/'.$value->filename); ?>"  alt="<?php echo $value->name; ?>" >
											<?php } else { ?>
												<img src="<?php echo base_url('image_not_available.png'); ?>""  alt="<?php echo $value->name; ?>" >
											<?php } ?>
												</span>
												<p style="text-align: center; font-size:10pt;"><?php echo $value->name; ?>
												<?php if($value->stok ==0) { echo '<br>(tidak tersedia)'; } ?>
												</p>

											</div>
										<?php } ?>	
										</div>
									</div>
									<?php } ?>
									<!-- POST CONTENT : end -->

									<!-- POST FORM : begin -->
									<form class="post__form" method="post" action="<?php echo base_url('cart'); ?>">

										<!-- POST STOCK : begin -->
										<?php if($product[0]->in_stock == 1) { ?>
										<p class="post__stock post__stock--in-stock"><!-- You can use "in-stock", "on-order" and "unavailable" modifiers -->
											<strong class="post__stock-status">In Stock</strong>
											<span class="post__stock-inventory">Ready to deliver</span>
										</p>
									<?php } else {  ?>
										<p class="post__stock post__stock--unavailable"><!-- You can use "in-stock", "on-order" and "unavailable" modifiers -->
											<strong class="post__stock-status">Out of Stock</strong>
										</p>
									<?php } ?>
										<!-- POST STOCK : end -->

										<!-- POST PRICE : begin -->
										<p class="post__price">
											<?php if($product[0]->price_het > $product[0]->price) { ?>
											<span class="post__price-old" title="Old price">Rp. <?php  echo number_format($product[0]->price_het,0,",","."); ?></span>
											<strong class="post__price-current">Rp. <?php  echo number_format($product[0]->price,0,",","."); ?></strong>
											<?php } else { ?>
											<strong class="post__price-current">Rp. <?php  echo number_format($product[0]->price,0,",","."); ?></strong>
											<?php } ?>
										</p>
										<!-- POST PRICE : end -->

										<!-- POST ADD TO CART : begin -->
										<p class="post__add-to-cart">
												<input type="hidden" name="hidprodid" value="<?php echo $product[0]->id; ?>">
												<input type="hidden" name="hidvariantchosen"  id="hidvariantchosen" value="<?php if(count($variant) >0) { 
													echo $variant[0]->id;
												 } ?>"/>
												<button type="submit" name="btnsubmit" value="submit" class="post__add-to-cart-btn lsvr-button">Add To Cart</button>
											
										</p>
										<!-- POST ADD TO CART : end -->

									</form>
									<!-- POST FORM : end -->


								</div>

							</div>
							<hr/>
							<div>
								<h4>Customer Reviews (<?php echo $total; ?>)</h4>
								<?php foreach ($reviews as $key => $value) { ?>
								<div class="customerreview">
									<div class="ratingblock">
										<div>
											<?php for($i = 1; $i<= $value->rating; $i++) { ?>
												<i style="color: #ff007c;" class="fas fa-regular fa-star"></i>
											<?php }  ?>
											&nbsp;
											<strong><?php echo $value->rating; ?></strong>
											<br/><span><?php echo $value->first_name; ?></span><br/>
											<?php if(!empty($value->variantname)) { ?>
											<span>Variant: <?php echo $value->variantname; ?></span>
										<?php } ?>
										</div>
										<div>
											
			<?php // olah tanggal
$currentDate = new DateTime();
//$givenDate = DateTime::createFromFormat('Y-m-d', );
//echo $givenDate;
$givenDate = new DateTimeImmutable($value->order_placed_date);
$interval = $currentDate->diff($givenDate);
$years = $interval->y;
$months = $interval->m;
$days = $interval->d;
$hours = $interval->h;
$minutes = $interval->i;
$seconds = $interval->s;

$display = '';
if ($years > 0) {
    $display =  $years . " year" . ($years > 1 ? "s" : "") . " ago";
} elseif ($months > 0) {
    $display =  $months . " month" . ($months > 1 ? "s" : "") . " ago";
} elseif ($days > 0) {
    $display =  $days . " day" . ($days > 1 ? "s" : "") . " ago";
} elseif ($hours > 0) {
    $display =  $hours . " hour" . ($hours > 1 ? "s" : "") . " ago";
} elseif ($minutes > 0) {
    $display =  $minutes . " minute" . ($minutes > 1 ? "s" : "") . " ago";
} else {
    $display =  $seconds . " second" . ($seconds > 1 ? "s" : "") . " ago";
}


			 ?>
											<span><?php echo $display; ?></span>
										</div>
									</div>
									<p class="reviewblock">
										<?php echo $value->review; ?>
									</p>
								</div>
								<?php } ?>
							</div>

						</div>
					</article>
					<!-- POST : end -->

				</div>
			</div>
			<!-- PAGE : end -->

		</div>
	</main>
	<!-- MAIN : end -->

									</div>
									<!-- MAIN COLUMN : end -->

									

								</div>
								<!-- COLUMNS GRID : end -->

							</div>
						</div>
					</div>
					<!-- CORE COLUMNS : end -->

				</div>
			</div>
			<!-- CORE : end -->