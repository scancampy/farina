<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content" style="display: flex; justify-content:space-between; align-items:flex-end;">

						<h1 class="page-header__title">Product</h1>
						<div>
							<form method="get" action="<?php echo base_url('product'); ?>" id="formcategory">
								<select name="brand" id="brand" >
									<option value="all">All</option>
									<?php foreach ($brand as $key => $value) { ?>
										<option value="<?php echo $value->id; ?>" <?php if($this->input->get('brand') == $value->id) { echo 'selected'; } ?>><?php echo $value->name; ?></option>
									<?php } ?>							
								</select>
							</form>
						</div>

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
													<p class="post__price">Rp. <?php echo number_format($value->price,0,",","."); ?></p>
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