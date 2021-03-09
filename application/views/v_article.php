<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Beauty Article</h1>

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
							<div class="page blog-post-page blog-post-archive">
								<div class="page__content">

									<!-- POST ARCHIVE CATEGORIES : begin -->
									<div class="post-archive-categories">
										<h6 class="screen-reader-text">Categories:</h6>
										<ul class="post-archive-categories__list">

											<li class="post-archive-categories__item post-archive-categories__item--all <?php if($selectedcatid =='all') { echo 'post-archive-categories__item--active'; } ?>"><a href="<?php echo base_url('article'); ?>" class="post-archive-categories__item-link">All</a></li>

											<?php foreach ($category as $key => $value) { ?>
												<li class="post-archive-categories__item post-archive-categories__item--category <?php if($selectedcatid == $value->id) { echo 'post-archive-categories__item--active'; } ?>">
													<a href="<?php echo base_url('article'); ?>?catid=<?php echo $value->id; ?>" class="post-archive-categories__item-link"><?php echo $value->name; ?> </a>
												</li>
											<?php } ?>
										</ul>
									</div>
									<!-- POST ARCHIVE CATEGORIES : end -->

									<!-- POST ARCHIVE LIST : begin -->
									<div class="post-archive__list lsvr-grid lsvr-grid--masonry lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-1-cols">

										<!-- POST COLUMN : begin -->
										<?php foreach ($article as $key => $value) { ?>
											<div class="lsvr-grid__col">

											<!-- POST : begin -->
											<article class="post blog-post post--has-thumbnail">
												<div class="post__inner">

													<!-- POST THUMB : begin -->
													<?php if(count($photo[$key])>0) { ?>
													<p class="post__thumbnail">
														<a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="post__thumbnail-link">
															<?php if($photo[$key][0]->media_type == "photo") { ?>
															<img src="<?php echo base_url('img/article/'.$photo[$key][0]->filename); ?>" class="post__thumbnail-img" alt="<?php echo $value->title; ?>">
														<?php } else { echo $photo[$key][0]->youtube_link; }
														 ?>
														</a>
													</p>
													<?php } ?>
													<!-- POST THUMB : end -->

													<!-- POST HEADER : begin -->
													<header class="post__header">

														<h2 class="post__title">
															<a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="post__title-link"><?php echo $value->title; ?></a>
														</h2>

														<p class="post__meta">

															

															<span class="post__meta-date"><?php echo strftime("%B %d, %Y", strtotime($value->created)); ?></span>

															<span class="post__meta-categories">
																in <a href="<?php echo base_url('article'); ?>?catid=<?php echo $value->category_id; ?>" class="post__meta-link"><?php echo $value->categoryname; ?></a>
															</span>
															<br/>
															<?php if($value->article_type =="exclusive") { ?>
																<span class="gold"> <i class="fas fa-star"></i> Exclusive</span>
															<?php } ?>

														</p>

    												</header>
    												<!-- POST HEADER : end -->

    												<!-- POST CONTENT : begin -->
    												<div class="post__content">

    													<p><?php echo $value->short_desc; ?></p>

    													<p class="post__permalink">
    														<a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="post__permalink-link">Read More</a>
    													</p>

    												</div>
    												<!-- POST CONTENT : end -->

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

											<li class="pagination__item pagination__item--prev">
												<a href="#" class="pagination__item-link">Previous</a>
											</li>

											<li class="pagination__item">
												<a href="#" class="pagination__item-link">1</a>
											</li>

											<li class="pagination__item pagination__item--current">
												<span class="pagination__item-link">2</span>
											</li>

											<li class="pagination__item">
												<a href="#" class="pagination__item-link">3</a>
											</li>

											<li class="pagination__item pagination__item--dots" aria-hidden="true">...</li>

											<li class="pagination__item">
												<a href="#" class="pagination__item-link">10</a>
											</li>

											<li class="pagination__item pagination__item--next">
												<a href="#" class="pagination__item-link">Next</a>
											</li>

										</ul>
									</nav>
									<!-- PAGINATION : end -->

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

<style type="text/css">
	iframe { width: 100% !important; height: 100% !important; }
	.gold {
		 background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
          color: white;
          padding: 3px 10px;
          border-radius: 12px;
          margin-top:5px;	
          display: inline-block;
	}
	.post__thumbnail {
		pointer-events: none;
background: url('null.png');
	}
</style>	
<!-- CORE : end -->