
<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">
						<h1 class="page-header__title"><?php echo $article[0]->title; ?></h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(''); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('article'); ?>" class="breadcrumbs__link">Article</a>
									</li>
									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('article/read/'.$article[0]->title.'/'.url_title($article[0]->title)); ?>" class="breadcrumbs__link">Read</a>
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

					<?php if($article[0]->article_type =="exclusive") { ?>
						<div class="page__content">

							<h2><span class="gold"><i class="fas fa-star"></i> Exclusive Article</span></h2>

							<p>Artikel ini hanya tersedia untuk member VIP</p>

							<p>
								<a href="#" class="lsvr-button">How to become VIP</a>
							</p>

						</div>
					<?php } else { ?>
<?php if(count($photo) >0) { ?>
	<div class="splide" style="width: 100%; margin-bottom: 20px;">
		<div class="splide__track">
			<ul class="splide__list">
				<?php for($i = 0; $i<count($photo); $i++) { if($photo[$i]->media_type =="photo") { ?>
				<li class="splide__slide">
					<img src="<?php echo base_url('img/article/'.$photo[$i]->filename); ?>" style="width:100%;"  alt="<?php echo $article[0]->title; ?>">
					
				</li>
				<?php } else { ?>
				<li class="splide__slide">
					<?php echo $photo[$i]->youtube_link; ?>
				</li>
				<?php } } ?>
			</ul>
		</div>
	</div>
<?php } ?>

					<!-- COLUMNS GRID : begin -->
					<div class="core__columns-grid lsvr-grid">

						<!-- MAIN COLUMN : begin -->
						<div class="core__columns-col core__columns-col--main core__columns-col--left lsvr-grid__col lsvr-grid__col--span-9 lsvr-grid__col--md-span-12" >

							<!-- MAIN : begin -->
							<main id="main">
								<div class="main__inner">

									<!-- PAGE : begin -->
									<div class="page blog-post-page blog-post-single">
										<div class="page__content">

											<!-- POST : begin -->
											<article class="post blog-post">
												<div class="post__inner">



									

													<!-- POST CONTENT : begin -->
													<div class="post__content">
														<p style="    font-size: 1.125em; line-height: 1.5em;">
															<?php echo $article[0]->content; ?>
														</p>

													</div>
													<!-- POST CONTENT : end -->

													<!-- POST FOOTER : begin -->
													<footer class="post__footer">

														<p class="post__meta">

															<span class="post__meta-date"><?php echo strftime("%B %d, %Y", strtotime($article[0]->created)); ?></span>


															<span class="post__meta-categories">
																in <a href="<?php echo base_url('article'); ?>?catid=<?php echo $article[0]->category_id; ?>" class="post__meta-link"><?php echo $article[0]->categoryname; ?></a>
															</span>

														</p>

													</footer>
													<!-- POST FOOTER : end -->

												</div>
											</article>
											<!-- POST : end -->

											<!-- POST NAVIGATION : begin -->
											<div class="post-navigation">
												<ul class="post-navigation__list">

													<!-- NAVIGATION PREV : begin -->
													<li class="post-navigation__prev">
														<div class="post-navigation__next-inner">
															<h6 class="post-navigation__title">
																<a href="blog-single.html" class="post-navigation__title-link">Previous</a>
															</h6>
															<a href="blog-single.html" class="post-navigation__link">The main professionals that provide therapeutic</a>
														</div>
													</li>
													<!-- NAVIGATION PREV : end -->

													<!-- NAVIGATION NEXT : begin -->
													<li class="post-navigation__next">
														<div class="post-navigation__next-inner">
															<h6 class="post-navigation__title">
																<a href="blog-single.html" class="post-navigation__title-link">Next</a>
															</h6>
															<a href="blog-single.html" class="post-navigation__link">The dyeing of hair is an ancient art that involves</a>
														</div>
													</li>
													<!-- NAVIGATION NEXT : end -->

												</ul>
											</div>
											<!-- POST NAVIGATION : end -->

										</div>
									</div>
									<!-- PAGE : end -->

								</div>
							</main>
							<!-- MAIN : end -->

						</div>
						<!-- MAIN COLUMN : end -->

						<!-- SIDEBAR COLUMN : begin -->
						<div class="core__columns-col core__columns-col--sidebar core__columns-col--right lsvr-grid__col lsvr-grid__col--span-3 lsvr-grid__col--md-span-12">

							<!-- SIDEBAR : begin -->
							<aside id="sidebar">
								<div class="sidebar__inner">

									<!-- LSVR FEATURED POST WIDGET : begin -->
									<div class="widget lsvr-post-featured-widget">
										<div class="widget__inner">
											<h3 class="widget__title">Featured Post</h3>
											<div class="widget__content">

												<!-- POST THUMB : begin -->
												<p class="lsvr-post-featured-widget__thumb">
													<a href="blog-single.html" class="lsvr-post-featured-widget__thumb-link">
														<img src="images/blog_02.jpg" class="lsvr-post-featured-widget__thumb-img" alt="The main professionals that provide therapeutic">
													</a>
												</p>
												<!-- POST THUMB : end -->

												<!-- POST CONTENT : begin -->
												<div class="lsvr-post-featured-widget__content-inner">

													<h4 class="lsvr-post-featured-widget__title">
														<a href="blog-single.html" class="lsvr-post-featured-widget__title-link">The main professionals that provide therapeutic</a>
													</h4>

													<p class="lsvr-post-featured-widget__date">August 23, 2020</p>

									                <p class="lsvr-post-featured-widget__category">
									                    in <a href="blog-archive.html" class="lsvr-post-featured-widget__category-link">Spa Treatments</a>
									                </p>

									                <div class="lsvr-post-featured-widget__excerpt">
        												<p>Many types of practices are associated with massage and include bodywork, manual therapy, energy medicine, neural mobilization and breathwork. Other names for massage.</p>
    												</div>

									                <p class="widget__more">
									                    <a href="blog-archive.html" class="widget__more-link">More Posts</a>
									                </p>

								                </div>
								                <!-- POST CONTENT : end -->

							                </div>
						                </div>
					                </div>
					                <!-- LSVR FEATURED POST WIDGET : end -->

									<!-- LSVR POST LIST WIDGET : begin -->
									<div class="widget lsvr-post-list-widget">
										<div class="widget__inner">
											<h3 class="widget__title">Latest Blog Posts</h3>
											<div class="widget__content">

												<!-- POST LIST : begin -->
												<ul class="lsvr-post-list-widget__list">

													<!-- POST ITEM : begin -->
													<li class="lsvr-post-list-widget__item">
														<div class="lsvr-post-list-widget__item-inner">

															<!-- POST CONTENT : begin -->
															<div class="lsvr-post-list-widget__item-content">
																<h4 class="lsvr-post-list-widget__item-title">
																	<a href="blog-single.html" class="lsvr-post-list-widget__item-title-link">A spa is a location where mineral-rich spring water </a>
																</h4>
																<p class="lsvr-post-list-widget__item-date">August 23, 2020</p>
																<p class="lsvr-post-list-widget__item-category"> in <a href="blog-archive" class="lsvr-post-list-widget__item-category-link">Spa Treatments</a></p>
															</div>
															<!-- POST CONTENT : end -->

														</div>
													</li>
													<!-- POST ITEM : end -->

													<!-- POST ITEM : begin -->
													<li class="lsvr-post-list-widget__item">
														<div class="lsvr-post-list-widget__item-inner">

															<!-- POST CONTENT : begin -->
															<div class="lsvr-post-list-widget__item-content">
																<h4 class="lsvr-post-list-widget__item-title">
																	<a href="blog-single.html" class="lsvr-post-list-widget__item-title-link">The main professionals that provide therapeutic </a>
																</h4>
																<p class="lsvr-post-list-widget__item-date">July 18, 2020</p>
																<p class="lsvr-post-list-widget__item-category"> in <a href="blog-archive" class="lsvr-post-list-widget__item-category-link">Spa Treatments</a></p>
															</div>
															<!-- POST CONTENT : end -->

														</div>
													</li>
													<!-- POST ITEM : end -->

													<!-- POST ITEM : begin -->
													<li class="lsvr-post-list-widget__item">
														<div class="lsvr-post-list-widget__item-inner">

															<!-- POST CONTENT : begin -->
															<div class="lsvr-post-list-widget__item-content">
																<h4 class="lsvr-post-list-widget__item-title">
																	<a href="blog-single.html" class="lsvr-post-list-widget__item-title-link">The dyeing of hair is an ancient art that involves</a>
																</h4>
																<p class="lsvr-post-list-widget__item-date">June 25, 2020</p>
																<p class="lsvr-post-list-widget__item-category"> in <a href="blog-archive" class="lsvr-post-list-widget__item-category-link">Hair Care</a></p>
															</div>
															<!-- POST CONTENT : end -->

														</div>
													</li>
													<!-- POST ITEM : end -->

												</ul>
												<!-- POST LIST : end -->

								                <p class="widget__more">
								                    <a href="blog-archive.html" class="widget__more-link">More Posts</a>
								                </p>

											</div>
										</div>
									</div>
									<!-- LSVR POST LIST WIDGET : end -->

								</div>
							</aside>
							<!-- SIDEBAR : end -->

						</div>
						<!-- SIDEBAR COLUMN : end -->

					</div>
					<!-- COLUMNS GRID : end -->
				<?php } ?>
				</div>
			</div>
		</div>
		<!-- CORE COLUMNS : end -->

	</div>
</div>

<style type="text/css">
	iframe { width: 100% !important;  }
	.gold {
		 background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
          color: white;
          padding: 3px 10px;
          border-radius: 12px;
          margin-top:5px;	
          display: inline-block;
	}
</style>
<!-- CORE : end -->