
<!-- CORE : begin -->
<div id="core" class="core--fullwidth">
	<div class="core__inner">

		<!-- CORE COLUMNS : begin -->
		<div class="core__columns">
			<div class="core__columns-inner">

				<!-- MAIN : begin -->
				<main id="main">
					<div class="main__inner">

						<!-- PAGE : begin -->
						<div class="page">
							<div class="page__content">

								<!-- LSVR SLIDE LIST : begin -->
								<section class="lsvr-slide-list"><!-- To enable autoplay add: data-autoplay="5" -->

								    <div class="lsvr-slide-list__bg">
								        <div class="lsvr-slide-list__inner">
								        	<div class="lsvr-slide-list__list">

								        		<?php foreach ($slides as $key => $value) { ?>
								        			<!-- SLIDE : begin -->
								        		<div class="lsvr-slide-list__item">
			                            			<div class="lsvr-slide-list__item-bg" style="background-image: url( 'img/slides/<?php echo $value->filename; ?>' );">
			                                			<div class="lsvr-slide-list__item-inner">
			                                				<div class="lsvr-slide-list__item-content-wrapper">
			                                					<div class="lsvr-slide-list__item-content">
			                                						<div class="lsvr-container">
			                               								<div class="lsvr-slide-list__item-content-inner">

			                                                            	<h2 class="lsvr-slide-list__item-title"><?php echo $value->title; ?></h2>

			                                                            	<div class="lsvr-slide-list__item-text">
			                                                            		<p>
			                                                            			<?php echo $value->short_desc; ?>
			                                                            		</p>
			                                                            	</div>

				                                                            <p class="lsvr-slide-list__item-button">
				                                                                <a href="<?php echo $value->url; ?>" class="lsvr-button lsvr-slide-list__item-button-link"><?php echo $value->url_caption; ?></a>
				                                                            </p>

			                                                    		</div>
			                                                		</div>
			                                            		</div>
			                                        		</div>
			                                			</div>
			                            			</div>
			                        			</div>
			                        			<!-- SLIDE : end -->
								        		<?php } ?>
								        	
			                    			</div>
							        	</div>
							    	</div>

							    	<!-- SLIDE LIST NAV : begin -->
							    	<div class="lsvr-slide-list__nav">
							    		<button type="button" class="lsvr-slide-list__nav-button lsvr-slide-list__nav-button--prev">
							    			<span class="lsvr-slide-list__nav-button-icon" aria-hidden="true"></span>
							    		</button>
							    		<button type="button" class="lsvr-slide-list__nav-button lsvr-slide-list__nav-button--next">
							    			<span class="lsvr-slide-list__nav-button-icon" aria-hidden="true"></span>
							    		</button>
							    	</div>
							    	<!-- SLIDE LIST NAV : end -->

								</section>
								<!-- LSVR SLIDE LIST : end -->

								<!-- LSVR SERVICES : begin -->
								<section class="lsvr-services lsvr-services--has-dark-background">
								    <div class="lsvr-services__inner">
								        <div class="lsvr-services__content">

											<!-- SERVICES HEADER : begin -->
								        	<div class="lsvr-services__header-wrapper">
			                    				<div class="lsvr-container">
			                    					<header class="lsvr-services__header">

			                    						<h2 class="lsvr-services__title">
			                    							<a href="service-archive.html" class="lsvr-services__title-link">Features Products</a>
			                    						</h2>

			                    						<h3 class="lsvr-services__subtitle">Max Femme menyediakan produk berkualitas dengan harga terjangkau</h3>

			                    					</header>
			                    				</div>
			                    			</div>
			                    			<!-- SERVICES HEADER : end -->
<!-- POST LIST : begin -->
			<!-- SERVICE LIST : begin -->
			<div class="lsvr-services__list-wrapper">
				<div class="lsvr-container">
					<div class="lsvr-services__list lsvr-grid lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-1-cols">

<?php foreach ($product as $key => $value) { ?>
<!-- POST ITEM : begin -->
			<div class="lsvr-posts__item lsvr-grid__col">
				<article class="lsvr-posts__post">
					<div class="lsvr-posts__post-inner">
    				<?php if($value->price_het > $value->price) { ?>
											<div class="disc_circle_at_home" ><?php echo number_format((($value->price_het-$value->price)/$value->price_het)*100,0,'.','.').'%'; ?></div>
									<?php	} ?>
						<!-- POST ITEM THUMB : begin -->
						<?php if(count($photo_product[$key])>0) { ?>
						 <p class="lsvr-posts__post-thumbnail lsvr-posts__post-thumbnail post__thumbnail parent_product_image">
							<a href="<?php echo base_url('product/detail/'.$value->id.'/'.url_title($value->name)); ?>" class="lsvr-posts__post-thumbnail-link product_image" style="background-image: url('<?php echo base_url('img/product/'.$photo_product[$key][0]->filename); ?>');">
								
								
							</a>
						</p>
						<?php } ?>
                      
                        <!-- POST ITEM THUMB : end -->

                        <!-- POST ITEM HEADER : begin -->
                        <header class="lsvr-posts__post-header">



                            <h3 class="lsvr-posts__post-title">
                                <a href="<?php echo base_url('product/detail/'.$value->id.'/'.url_title($value->name)); ?>" class="lsvr-posts__post-title-link"><?php echo $value->name; ?></a>
                            </h3>

                            <p class="lsvr-posts__post-meta">
                        		<span class="lsvr-posts__post-meta-categories">
                            		<a href="<?php echo base_url('product?brand='.$value->brand_id); ?>" class="lsvr-posts__post-meta-link"><?php echo $value->brandname; ?></a>
                        		</span>
                			</p>
                			<p class="post__price">
                				
											<?php if($value->price_het > $value->price) { ?>
											<span class="post__price-old" title="Old price"><strike>Rp. <?php  echo number_format($value->price_het,0,",","."); ?></strike></span>
											<strong class="post__price-current" style="color:#ff007c;">Rp. <?php  echo number_format($value->price,0,",","."); ?></strong>
											<?php } else { ?>
											<strong class="post__price-current">Rp. <?php  echo number_format($value->price,0,",","."); ?></strong>
											<?php } ?>
										</p>

        				</header>
    				</div>
				</article>
			</div>
			<!-- POST ITEM : end -->
<?php } ?>
						

						

					</div>
				</div>
			</div>
			<!-- POST LIST : end -->

	<!-- SERVICE LIST : begin -->
	<div class="lsvr-services__list-wrapper">
		<div class="lsvr-container">
			<div class="lsvr-services__list lsvr-grid lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-1-cols">

				<!-- SERVICE ITEM : begin -->
				<div class="lsvr-services__item lsvr-grid__col lsvr-services__item--has-thumbnail">
					<article class="lsvr-beautyspot-services__post">
						<div class="lsvr-services__post-bg" style="background-image: url( 'images/service_01.jpg' ); ">
                    		<div class="lsvr-services__post-inner">

                    			<!-- SERVICE ITEM HEADER : begin -->
                				<header class="lsvr-services__post-header">
                            		<div class="lsvr-services__post-header-inner">

                            			<span class="lsvr-services__post-icon icon-powder-brush" aria-hidden="true"></span>

                            			<h3 class="lsvr-services__post-title">
                            				<a href="service-single.html" class="lsvr-services__post-title-link">Garnier</a>
                        				</h3>

                                	</div>
                        		</header>
                        		<!-- SERVICE ITEM HEADER : end -->

                        		<!-- SERVICE ITEM DESCRIPTION : begin -->
                        		<div class="lsvr-services__post-description">
                                	<div class="lsvr-services__post-description-inner">
                                    	<p>Cosmetics are substances or products used to enhance or alter the appearance of the face or fragrance and texture of the body.</p>
                                	</div>
                            	</div>
                            	<!-- SERVICE ITEM DESCRIPTION : end -->

                                <a href="service-single.html" class="lsvr-services__post-overlay-link">
                                    <span class="screen-reader-text">More Info</span>
                                </a>

                    		</div>
                		</div>
            		</article>
    			</div>
    			<!-- SERVICE ITEM : end -->

				<!-- SERVICE ITEM : begin -->
				<div class="lsvr-services__item lsvr-grid__col lsvr-services__item--has-thumbnail">
					<article class="lsvr-beautyspot-services__post">
						<div class="lsvr-services__post-bg" style="background-image: url( 'images/service_02.jpg' ); ">
                    		<div class="lsvr-services__post-inner">

                    			<!-- SERVICE ITEM HEADER : begin -->
                				<header class="lsvr-services__post-header">
                            		<div class="lsvr-services__post-header-inner">

                            			<span class="lsvr-services__post-icon icon-hair-dryer" aria-hidden="true"></span>

                            			<h3 class="lsvr-services__post-title">
                            				<a href="service-single.html" class="lsvr-services__post-title-link">Hairdressing</a>
                        				</h3>

                                	</div>
                        		</header>
                        		<!-- SERVICE ITEM HEADER : end -->

                        		<!-- SERVICE ITEM DESCRIPTION : begin -->
                        		<div class="lsvr-services__post-description">
                                	<div class="lsvr-services__post-description-inner">
                                    	<p>Hairdressing as an occupation dates back thousands of years. Ancient art drawings and paintings have been discovered.</p>
                                	</div>
                            	</div>
                            	<!-- SERVICE ITEM DESCRIPTION : end -->

                                <a href="service-single.html" class="lsvr-services__post-overlay-link">
                                    <span class="screen-reader-text">More Info</span>
                                </a>

                    		</div>
                		</div>
            		</article>
    			</div>
    			<!-- SERVICE ITEM : end -->

				<!-- SERVICE ITEM : begin -->
				<div class="lsvr-services__item lsvr-grid__col lsvr-services__item--has-thumbnail">
					<article class="lsvr-beautyspot-services__post">
						<div class="lsvr-services__post-bg" style="background-image: url( 'images/service_03.jpg' ); ">
                    		<div class="lsvr-services__post-inner">

                    			<!-- SERVICE ITEM HEADER : begin -->
                				<header class="lsvr-services__post-header">
                            		<div class="lsvr-services__post-header-inner">

                            			<span class="lsvr-services__post-icon icon-beard" aria-hidden="true"></span>

                            			<h3 class="lsvr-services__post-title">
                            				<a href="service-single.html" class="lsvr-services__post-title-link">Barber</a>
                        				</h3>

                                	</div>
                        		</header>
                        		<!-- SERVICE ITEM HEADER : end -->

                        		<!-- SERVICE ITEM DESCRIPTION : begin -->
                        		<div class="lsvr-services__post-description">
                                	<div class="lsvr-services__post-description-inner">
                                    	<p>A barber is a person whose occupation is mainly to cut, dress, groom, style and shave men’s and boys’ hair. Most barbers now specialize.</p>
                                	</div>
                            	</div>
                            	<!-- SERVICE ITEM DESCRIPTION : end -->

                                <a href="service-single.html" class="lsvr-services__post-overlay-link">
                                    <span class="screen-reader-text">More Info</span>
                                </a>

                    		</div>
                		</div>
            		</article>
    			</div>
    			<!-- SERVICE ITEM : end -->

				<!-- SERVICE ITEM : begin -->
				<div class="lsvr-services__item lsvr-grid__col lsvr-services__item--has-thumbnail">
					<article class="lsvr-beautyspot-services__post">
						<div class="lsvr-services__post-bg" style="background-image: url( 'images/service_04.jpg' ); ">
                    		<div class="lsvr-services__post-inner">

                    			<!-- SERVICE ITEM HEADER : begin -->
                				<header class="lsvr-services__post-header">
                            		<div class="lsvr-services__post-header-inner">

                            			<span class="lsvr-services__post-icon icon-spa-lotion" aria-hidden="true"></span>

                            			<h3 class="lsvr-services__post-title">
                            				<a href="service-single.html" class="lsvr-services__post-title-link">Massages</a>
                        				</h3>

                                	</div>
                        		</header>
                        		<!-- SERVICE ITEM HEADER : end -->

                        		<!-- SERVICE ITEM DESCRIPTION : begin -->
                        		<div class="lsvr-services__post-description">
                                	<div class="lsvr-services__post-description-inner">
                                    	<p>Massage is the manipulation of soft tissues in the body. Massage techniques are commonly applied with hands, fingers, elbows.</p>
                                	</div>
                            	</div>
                            	<!-- SERVICE ITEM DESCRIPTION : end -->

                                <a href="service-single.html" class="lsvr-services__post-overlay-link">
                                    <span class="screen-reader-text">More Info</span>
                                </a>

                    		</div>
                		</div>
            		</article>
    			</div>
    			<!-- SERVICE ITEM : end -->

				<!-- SERVICE ITEM : begin -->
				<div class="lsvr-services__item lsvr-grid__col lsvr-services__item--has-thumbnail">
					<article class="lsvr-beautyspot-services__post">
						<div class="lsvr-services__post-bg" style="background-image: url( 'images/service_05.jpg' ); ">
                    		<div class="lsvr-services__post-inner">

                    			<!-- SERVICE ITEM HEADER : begin -->
                				<header class="lsvr-services__post-header">
                            		<div class="lsvr-services__post-header-inner">

                            			<span class="lsvr-services__post-icon icon-lotus-flower" aria-hidden="true"></span>

                            			<h3 class="lsvr-services__post-title">
                            				<a href="service-single.html" class="lsvr-services__post-title-link">Body Treatments</a>
                        				</h3>

                                	</div>
                        		</header>
                        		<!-- SERVICE ITEM HEADER : end -->

                        		<!-- SERVICE ITEM DESCRIPTION : begin -->
                        		<div class="lsvr-services__post-description">
                                	<div class="lsvr-services__post-description-inner">
                                    	<p>A manicure is a cosmetic beauty treatment for the fingernails and hands performed at home or in a nail salon.</p>
                                	</div>
                            	</div>
                            	<!-- SERVICE ITEM DESCRIPTION : end -->

                                <a href="service-single.html" class="lsvr-services__post-overlay-link">
                                    <span class="screen-reader-text">More Info</span>
                                </a>

                    		</div>
                		</div>
            		</article>
    			</div>
    			<!-- SERVICE ITEM : end -->

				<!-- SERVICE ITEM : begin -->
				<div class="lsvr-services__item lsvr-grid__col lsvr-services__item--has-thumbnail">
					<article class="lsvr-beautyspot-services__post">
						<div class="lsvr-services__post-bg" style="background-image: url( 'images/service_06.jpg' ); ">
                    		<div class="lsvr-services__post-inner">

                    			<!-- SERVICE ITEM HEADER : begin -->
                				<header class="lsvr-services__post-header">
                            		<div class="lsvr-services__post-header-inner">

                            			<span class="lsvr-services__post-icon icon-essence-candle-1" aria-hidden="true"></span>

                            			<h3 class="lsvr-services__post-title">
                            				<a href="service-single.html" class="lsvr-services__post-title-link">Aromatherapy</a>
                        				</h3>

                                	</div>
                        		</header>
                        		<!-- SERVICE ITEM HEADER : end -->

                        		<!-- SERVICE ITEM DESCRIPTION : begin -->
                        		<div class="lsvr-services__post-description">
                                	<div class="lsvr-services__post-description-inner">
                                    	<p>Aromatherapy uses aromatic materials, including essential oils, and other aroma compounds, with claims for improving.</p>
                                	</div>
                            	</div>
                            	<!-- SERVICE ITEM DESCRIPTION : end -->

                                <a href="service-single.html" class="lsvr-services__post-overlay-link">
                                    <span class="screen-reader-text">More Info</span>
                                </a>

                    		</div>
                		</div>
            		</article>
    			</div>
    			<!-- SERVICE ITEM : end -->

			</div>
		</div>
	</div>
	<!-- SERVICE LIST : end -->

			        					</div>
			    					</div>
								</section>
								<!-- LSVR SERVICES : end -->

<!-- LSVR POSTS : begin -->
<section class="lsvr-posts">
    <div class="lsvr-posts__inner">
        <div class="lsvr-posts__content">

        	<!-- POSTS HEADER : begin -->
        	<div class="lsvr-posts__header-wrapper">
        		<div class="lsvr-container">
        			<header class="lsvr-posts__header">

        				<h2 class="lsvr-posts__title">
        					<a href="<?php echo base_url('artilce'); ?>" class="lsvr-posts__title-link">Latest Beauty Article</a>
        				</h2>

        				<h3 class="lsvr-posts__subtitle">Temukan tips terbaik untuk makeup, hairdressing dan body treatments</h3>

        			</header>
    			</div>
    		</div>
    		<!-- POSTS HEADER : end -->

			<!-- POST LIST : begin -->
			<div class="lsvr-posts__list-wrapper">
				<div class="lsvr-container">
					<div class="lsvr-posts__list lsvr-grid lsvr-grid--masonry lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-1-cols">

<?php foreach ($article as $key => $value) { ?>
<!-- POST ITEM : begin -->
			<div class="lsvr-posts__item lsvr-grid__col">
				<article class="lsvr-posts__post">
					<div class="lsvr-posts__post-inner">

						<!-- POST ITEM THUMB : begin -->
						<?php if(count($photo_article[$key])>0) { ?>
						 <p class="lsvr-posts__post-thumbnail lsvr-posts__post-thumbnail post__thumbnail">
							<a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="lsvr-posts__post-thumbnail-link">
								<?php if($photo_article[$key][0]->media_type == "photo") { ?>
								<img src="<?php echo base_url('img/article/'.$photo_article[$key][0]->filename); ?>" class="lsvr-posts__post-thumbnail-img" alt="<?php echo $value->title; ?>">
							<?php } else { echo $photo_article[$key][0]->youtube_link; }
							 ?>
							</a>
						</p>
						<?php } else { ?>
 						<p class="lsvr-posts__post-thumbnail lsvr-posts__post-thumbnail post__thumbnail">
							<a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="lsvr-posts__post-thumbnail-link product_image" >
								<img src="<?php echo base_url('image_not_available.png'); ?>" class="lsvr-posts__post-thumbnail-img" alt="<?php echo $value->title; ?>"/>
							</a>
						</p>
						<?php } ?>
                      
                        <!-- POST ITEM THUMB : end -->

                        <!-- POST ITEM HEADER : begin -->
                        <header class="lsvr-posts__post-header">

                            <h3 class="lsvr-posts__post-title">
                                <a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="lsvr-posts__post-title-link"><?php echo $value->title; ?></a>
                            </h3>

                            <p class="lsvr-posts__post-meta">

                                <span class="lsvr-posts__post-meta-date">
                                    <?php echo strftime("%B %d, %Y", strtotime($value->created)); ?>
                                </span>


                        		<span class="lsvr-posts__post-meta-categories">
                            		in <a href="<?php echo base_url('article?catid='.$value->category_id); ?>" class="lsvr-posts__post-meta-link"><?php echo $value->categoryname; ?></a>
                        		</span>

                        		<?php if($value->article_type =="exclusive") { ?>
																<span class="gold"> <i class="fas fa-star"></i> Exclusive</span>
															<?php } ?>

                			</p>

        				</header>
        				<!-- POST ITEM HEADER : end -->

        				<!-- POST ITEM CONTENT : begin -->
        				<!--div class="lsvr-posts__post-content">

                			<p>The term is derived from the name of the town of Spa, Belgium, whose name is known back from Roman times, when the location was called Aquae Spadanae, sometimes incorrectly connected to the Latin word spargere meaning to scatter, sprinkle or moisten.</p>

            			</div-->
            			<!-- POST ITEM CONTENT : end -->

                        <p class="lsvr-posts__post-permalink">
                           <a href="<?php echo base_url('article/read/'.$value->id.'/'.url_title($value->title)); ?>" class="lsvr-posts__post-permalink-link">Read More</a>
                        </p>

    				</div>
				</article>
			</div>
			<!-- POST ITEM : end -->
<?php } ?>
						

						

					</div>
				</div>
			</div>
			<!-- POST LIST : end -->

		</div>
	</div>
</section>
<!-- LSVR POSTS : end -->

								<!-- LSVR TESTIMONIALS : begin -->
								<section class="lsvr-testimonials lsvr-testimonials--has-dark-background">
								    <div class="lsvr-testimonials__inner">
								    	<div class="lsvr-testimonials__content">

								    		<!-- TESTIMONIALS HEADER : begin -->
								    		<div class="lsvr-testimonials__header-wrapper">
								    			<div class="lsvr-container">
			                    					<header class="lsvr-testimonials__header">

							                            <h2 class="lsvr-testimonials__title">
							                                <a href="<?php echo base_url('event'); ?>" class="lsvr-testimonials__title-link">Upcoming Event</a>
							                            </h2>

							                            <h3 class="lsvr-testimonials__subtitle">Ikuti event-event seru dari Max Femme</h3>

							                        </header>
							                    </div>
						                    </div>
						                    <!-- TESTIMONIALS HEADER : end -->

<?php if(count($event) >0) { ?>
    <!-- TESTIMONIAL LIST : begin -->
    <div class="lsvr-testimonials__list-wrapper">
    	<div class="lsvr-container">
    		<div class="lsvr-testimonials__list lsvr-grid lsvr-grid--masonry ">

				<!-- TESTIMONIAL ITEM : begin -->
				<div class="lsvr-testimonials__item lsvr-grid__col">
					<div class="lsvr-testimonials__post">
        				<div class="lsvr-testimonials__post-inner">
        					<div class="lsvr-testimonials__post-content-wrapper">

        						<!-- TESTIMONIAL BLOCKQUOTE : begin -->
        						<blockquote class="lsvr-testimonials__post-quote" style="display: flex;">
        							<?php if(count($photo) > 0) { ?>
        							<div style="margin-right: 20px;" class="post__thumbnail">
        								<?php if($photo[0]->media_type =="photo") { ?>
	        								<img src="<?php echo base_url('img/events/'.$photo[0]->filename); ?>"/>
	        							<?php } else { echo $photo[0]->youtube_link; } ?>
        							</div>
        						<?php } ?>
        							<div style="font-style: normal !important;">
	        							<footer class="lsvr-testimonials__post-footer lsvr-testimonials__post-footer--has-thumbnail">

	        								<p class="lsvr-testimonials__post-thumbnail " style="
	background-color: #ff007c;
	height: 40px;
	width: 40px;
	color: white;
	display: flex !important;
	text-align: center;
	justify-content: center;
	flex-direction: column;
	display: inline-block;
	border-radius:50%;">
	        									<i style="color: white" class="fas fa-<?php echo $event[0]->icon; ?>"></i>
	                                    	</p>

	                                    	<cite class="lsvr-testimonials__post-title">
	                                    		<a href="<?php echo base_url('event/details/'.$event[0]->id.'/'.url_title($event[0]->name)); ?>" class="lsvr-testimonials__post-title-link"><?php echo $event[0]->name; ?></a>
	                                    		<span class="lsvr-testimonials__post-title-description"><?php echo strftime("%B %d, %Y", strtotime($event[0]->event_date)); ?></span>
	                                    	</cite>

	                    				</footer>

	        							<p style="margin: 10px 0px;"><?php echo $event[0]->short_desc; ?></p>
	        							<a href="<?php echo base_url('event/details/'.$event[0]->id.'/'.url_title($event[0]->name)); ?>" class="lsvr-button lsvr-button--small">Details</a>
        							</div>

                				</blockquote>
                				<!-- TESTIMONIAL BLOCKQUOTE : end -->

            				</div>
       					 </div>
    				</div>
				</div>
				<!-- TESTIMONIAL ITEM : end -->

			</div>
		</div>
	</div>
	<!-- TESTIMONIAL LIST : end -->

			            				</div>
			        				</div>
								</section>
								<!-- LSVR TESTIMONIALS : end -->
							<?php } ?>

								<!-- LSVR CTA : begin -->
								<section class="lsvr-cta lsvr-cta--has-button">
								    <div class="lsvr-cta__inner">
								        <div class="lsvr-container">
								            <div class="lsvr-cta__content">

								            	<h3 class="lsvr-cta__title">Max Femme</h3>

								            	<div class="lsvr-cta__text">
								            		<p>Temukan produk menarik dan bermanfaat untuk anda</p>
			                    				</div>

			                    				<p class="lsvr-cta__button">
			                        				<a href="<?php echo base_url('product'); ?>" class="lsvr-cta__button-link lsvr-button" target="_blank">Browse Product</a>
			                        			</p>

			            					</div>
			        					</div>
			    					</div>
								</section>
								<!-- LSVR CTA : end -->

							</div>
						</div>
						<!-- PAGE : end -->

					</div>
				</main>
				<!-- MAIN : end -->

			</div>
		</div>
		<!-- CORE COLUMNS : end -->

	</div>
</div>
<!-- CORE : end -->
<style type="text/css">
	iframe { width: 100% !important; height: 150px !important; }
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