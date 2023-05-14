<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<h1 class="page-header__title"><a href="<?php echo base_url('product'); ?>" style="text-decoration: none;
    color: black;">Product</a></h1>
						
					<?php 
					$cat ='';
					if($this->input->get('category') != null) {
						$cat = '?category='.$this->input->get('category');
					} ?>
					<form method="get" action="<?php echo base_url('product'.$cat); ?>" id="formcategory">
					<div class="page-header__content" style="display: flex; justify-content:space-between; align-items:flex-end;">

						<?php if($this->input->get('category') != null) { ?>

						<input type="hidden" name="category" value="<?php echo $current_cat[0]->id; ?>" />
						<?php 
							echo '<h3 class="page-header__title">';
							for($k = count($breadcrumb)-1; $k >=0; $k--) { 
							 echo '<a style="text-decoration: none;
    color: black;" href="'.base_url('product?category='.$breadcrumb[$k]->id).'">'.$breadcrumb[$k]->name.'</a>';
							 if($k != 0) {
							 	echo ' > ';
							 } 
							} 
							echo '</h3>';
						 } else { ?><span>&nbsp;</span>
						<?php } ?>
						<div>
							
								<select name="brand" id="brand" >
									<option value="all">All</option>
									<?php foreach ($brand as $key => $value) { ?>
										<option value="<?php echo $value->id; ?>" <?php if($this->input->get('brand') == $value->id) { echo 'selected'; } ?>><?php echo $value->name; ?></option>
									<?php } ?>							
								</select>
							
						</div>

					</div>
					<div class="category-container">
						<?php foreach ($category as $key => $value) { ?>
							<button type="submit" name="category" class="btncategory" value="<?php echo $value->id.'-'.$value->name; ?>"><?php echo $value->name; ?></button>
						<?php } ?>
					</div>
					<?php if(!empty($this->input->get('brand') && $this->input->get('brand') != 'all')) { ?>
						<br/>
						<?php if($this->input->get('category') != null) { ?>
							
					<p>Menampilkan produk <strong style="color:#ff007c;"><?php echo $current_cat[0]->name; ?></strong> dari brand <strong style="color:#ff007c;"><?php echo $currentbrand[0]->name; ?></strong></p>
						<?php } else { ?>
					<p>Menampilkan produk dari brand <strong style="color:#ff007c;"><?php echo $currentbrand[0]->name; ?></strong></p>
						<?php } ?>
					<?php } else if($this->input->get('category') != null) { ?>
						<br/>
						<p>Menampilkan produk <strong style="color:#ff007c;"><?php echo $current_cat[0]->name; ?></strong></p>
					<?php } ?>

					<?php if(!empty($currentbrand[0]->logo_filename)) { ?>
					<img style="display: block;
    margin-left: auto;
    margin-right: auto;
    width: 140px;" src="<?php echo base_url('images/brand/'.$currentbrand[0]->logo_filename); ?>"/><?php } ?>
					</form>
					
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
							<div class="page product-post-page product-post-archive">
								<div class="page__content">
									<?php if(count($product)==0) { ?>

									<div class="lsvr-alert-message">
										<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
										<h3 class="lsvr-alert-message__title">Produk tidak ditemukan</h3>
										<p>Mohon menggunakan kata kunci lain atau mengganti kategori pencarian anda</p>
									</div>

									<p>
										<a href="<?php echo base_url('product'); ?>" class="lsvr-button">Lihat Produk Lain</a>
									</p>

									<?php } else { 
										?>

									<!-- POST ARCHIVE LIST : begin -->
									<div class="post-archive__list lsvr-grid lsvr-grid--masonry lsvr-grid--4-cols lsvr-grid--xl-3-cols lsvr-grid--md-2-cols lsvr-grid--sm-1-cols">

										<?php foreach ($product as $key => $value) { ?>
											<!-- POST COLUMN : begin -->
										<div class="lsvr-grid__col">
											<!-- POST : begin -->
											<article class="post product-post">
												<div class="post__inner">
													<?php if($value->price_het > $value->price) { ?>
														<div class="disc_circle"><?php echo number_format((($value->price_het-$value->price)/$value->price_het)*100,0,'.','.').'%'; ?></div>
												<?php	} ?>
													<!-- POST THUMB : begin -->
													<p class="post__thumbnail">
														<a href="<?php echo base_url('product/detail/'.$value->id.'/'.url_title($value->name)); ?>" class="post__thumbnail-link">
															<?php if(count($photo[$key]) >0) { ?>
															<img src="<?php echo base_url('img/product/'.$photo[$key][0]->filename); ?>" class="post__thumbnail-img" alt="<?php echo $value->name; ?>">
															<?php } else { ?>
<img src="<?php echo base_url('image_not_available.png'); ?>" class="post__thumbnail-img" alt="<?php echo $value->name; ?>">
															<?php } ?>
														</a>
													</p>
													<!-- POST THUMB : end -->

													<!-- POST HEADER : begin -->
													<header class="post__header">

														<h2 class="post__title">
															<a href="<?php echo base_url('product/detail/'.$value->id.'/'.url_title($value->name)); ?>" class="post__title-link"><?php echo $value->name; ?></a>
														</h2>

													</header>
													<!-- POST HEADER : end -->

													<p class="category"><!-- You can use "in-stock", "on-order" and "unavailable" modifiers -->
														<?php echo $value->brandname; ?>
													</p>

													<!-- POST PRICE : begin -->
													<p class="post__price"><?php
														if($value->price_het > $value->price) { echo '<strike>'.number_format($value->price_het,0,",",".").'</strike><br/><strong style="color:#ff007c;">Rp. '.number_format($value->price,0,",",".").'</strong>'; } else { echo '<strong>Rp. '.number_format($value->price,0,",",".").'</strong>';}
													  ?></p>
													<!-- POST PRICE : end -->

													<!-- POST BUY : begin -->
													<p class="post__buy">
														<a href="<?php echo base_url('product/detail/'.$value->id.'/'.url_title($value->name)); ?>" class="lsvr-button lsvr-button--type-2 post__buy-link">Purchase</a>
													</p>
													<!-- POST BUY : end -->

												</div>
											</article>
											<!-- POST : end -->
										</div>
										<!-- POST COLUMN : end -->
										<?php } ?>

									</div>
									<!-- POST ARCHIVE LIST : end -->

									<!-- PAGINATION : begin -->
									<nav class="pagination">
										<h2 class="screen-reader-text">Pagination</h2>
										<ul class="pagination__list">

											<?php echo $paging; ?>
										</ul>
									</nav>
									<!-- PAGINATION : end -->
								<?php } ?>

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