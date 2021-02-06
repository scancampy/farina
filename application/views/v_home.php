<!DOCTYPE html>
<html lang="en-US">
	<head>

		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home | BeautySpot - HTML Template for Beauty Salons</title>
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/general.css'); ?>"><!-- Default styles generated from assets/scss/general.scss (do not edit) -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/color-schemes/default.css'); ?>"><!-- Default color scheme generated from assets/scss/color-schemes/default.scss (change to other pre-defined or custom color scheme) -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('style.css'); ?>"><!-- Place your own CSS into this file -->
		<!-- STYLESHEETS : end -->

	</head>
	<body>

		<!-- WRAPPER : begin -->
		<div id="wrapper">

			<!-- HEADER : begin -->
			<header id="header" class="header--has-languages header--has-search header--has-cta header--has-contact header--has-social-links header--has-collision-detection header--has-expanded-panel"
				style="background-image: url( 'images/header_bg.jpg' )">
				<div class="header__inner">
					<div class="header__content">

						<!-- HEADER LANGUAGES : begin -->
						<div class="header-languages">

							<span class="screen-reader-text">Choose language</span>
							<ul class="header-languages__list">

								<li class="header-languages__item header-languages__item--active">
									<a href="#en" class="header-languages__item-link">EN</a>
								</li>

								<li class="header-languages__item">
									<a href="#de" class="header-languages__item-link">DE</a>
								</li>

								<li class="header-languages__item">
									<a href="#es" class="header-languages__item-link">ES</a>
								</li>

							</ul>

							<button type="button" class="header-languages__toggle" title="Choose language">
								<span class="header-languages__toggle-icon icon-close" aria-hidden="true"></span>
								<span class="header-languages__toggle-label">EN</span>
							</button>

						</div>
						<!-- HEADER LANGUAGES : end -->

						<!-- HEADER BRANDING : begin -->
						<div class="header-branding">
							<div class="header-branding__inner">

								<!-- HEADER LOGO : begin -->
								<div class="header-logo">
									<a href="index.html" class="header-logo__link">
										<img src="images/logo.png" class="header-logo__image" alt="Logo">
									</a>
								</div>
								<!-- HEADER LOGO : end -->

								<!-- HEADER TITLE TAGLINE : begin -->
								<div class="header-title-tagline">

									<div class="header-title">
										<a href="index.html" class="header-title__link">BeautySpot</a>
									</div>

									<p class="header-tagline">
										HTML Template for Beauty Salons
									</p>

								</div>
								<!-- HEADER TITLE TAGLINE : end -->

							</div>
						</div>
						<!-- HEADER BRANDING : end -->

						<!-- HEADER MENU : begin -->
						<nav class="header-menu" aria-label="Header menu">

							<ul class="header-menu__list" role="menu">

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item header-menu__item--current header-menu__item--has-children">

									<span class="header-menu__item-link-wrapper">
										<a href="index.html" class="header-menu__item-link">Home</a>
									</span>

									<button type="button" class="header-menu__submenu-toggle" title="Expand submenu">
										<span class="header-menu__submenu-toggle-icon" aria-hidden="true"></span>
									</button>

									<ul class="header-menu__submenu">

										<li class="header-menu__item header-menu__item--current">
											<a href="index.html" class="header-menu__item-link" role="menuitem">Home 1</a>
										</li>

										<li class="header-menu__item">
											<a href="index-2.html" class="header-menu__item-link" role="menuitem">Home 2</a>
										</li>

									</ul>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item">

									<span class="header-menu__item-link-wrapper">
										<a href="service-archive.html" class="header-menu__item-link">Our Services</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item header-menu__item--has-children">

									<span class="header-menu__item-link-wrapper">
										<a href="product-archive.html" class="header-menu__item-link">Store</a>
									</span>

									<button type="button" class="header-menu__submenu-toggle" title="Expand submenu">
										<span class="header-menu__submenu-toggle-icon" aria-hidden="true"></span>
									</button>

									<ul class="header-menu__submenu">

										<li class="header-menu__item">
											<a href="product-archive.html" class="header-menu__item-link" role="menuitem">Products</a>
										</li>

										<li class="header-menu__item">
											<a href="product-cart.html" class="header-menu__item-link" role="menuitem">Cart</a>
										</li>

										<li class="header-menu__item">
											<a href="product-checkout.html" class="header-menu__item-link" role="menuitem">Checkout</a>
										</li>

									</ul>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item header-menu__item--has-children">

									<span class="header-menu__item-link-wrapper">
										<a href="blog-archive.html" class="header-menu__item-link">About Us</a>
									</span>

									<button type="button" class="header-menu__submenu-toggle" title="Expand submenu">
										<span class="header-menu__submenu-toggle-icon" aria-hidden="true"></span>
									</button>

									<ul class="header-menu__submenu">

										<li class="header-menu__item">
											<a href="blog-archive.html" class="header-menu__item-link" role="menuitem">Blog</a>
										</li>

										<li class="header-menu__item">
											<a href="gallery-archive.html" class="header-menu__item-link" role="menuitem">Galleries</a>
										</li>

										<li class="header-menu__item">
											<a href="person-archive.html" class="header-menu__item-link" role="menuitem">Our Team</a>
										</li>

										<li class="header-menu__item">
											<a href="testimonial-archive.html" class="header-menu__item-link" role="menuitem">Testimonials</a>
										</li>

										<li class="header-menu__item">
											<a href="faq-archive.html" class="header-menu__item-link" role="menuitem">FAQ</a>
										</li>

									</ul>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item">

									<span class="header-menu__item-link-wrapper">
										<a href="contact.html" class="header-menu__item-link">Contact</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item header-menu__item--has-children">

									<span class="header-menu__item-link-wrapper">
										<a href="typography.html" class="header-menu__item-link">More</a>
									</span>

									<button type="button" class="header-menu__submenu-toggle" title="Expand submenu">
										<span class="header-menu__submenu-toggle-icon" aria-hidden="true"></span>
									</button>

									<ul class="header-menu__submenu">

										<li class="header-menu__item">
											<a href="typography.html" class="header-menu__item-link" role="menuitem">Typography</a>
										</li>

										<li class="header-menu__item">
											<a href="elements.html" class="header-menu__item-link" role="menuitem">Elements</a>
										</li>

										<li class="header-menu__item">
											<a href="sidebar-left.html" class="header-menu__item-link" role="menuitem">Left Sidebar</a>
										</li>

										<li class="header-menu__item">
											<a href="sidebar-right.html" class="header-menu__item-link" role="menuitem">Right Sidebar</a>
										</li>

										<li class="header-menu__item">
											<a href="search-results.html" class="header-menu__item-link" role="menuitem">Search Results</a>
										</li>

										<li class="header-menu__item">
											<a href="404.html" class="header-menu__item-link" role="menuitem">Error 404 Page</a>
										</li>

									</ul>

								</li>
								<!-- MENU ITEM : end -->

							</ul>

						</nav>
						<!-- HEADER MENU : end -->

						<!-- HEADER SEARCH : begin -->
						<div class="header-search">
							<div class="header-search__form">

								<!-- SEARCH FORM : begin -->
								<form class="search-form" action="search-results.html" method="get" role="search">
									<div class="search-form__inner">
										<div class="search-form__input-holder">

											<input class="search-form__input" type="text" name="s" placeholder="Search..." value="">

											<button class="search-form__button" type="submit" title="Search">
												<span class="search-form__button-icon" aria-hidden="true"></span>
											</button>

										</div>
									</div>
								</form>
								<!-- SEARCH FORM : end -->

							</div>

							<button type="button" class="header-search__toggle"
								title="Search">
								<span class="header-search__toggle-icon" aria-hidden="true"></span>
							</button>

						</div>
						<!-- HEADER SEARCH : end -->

						<!-- HEADER PANEL : begin -->
						<div class="header-panel">
							<div class="header-panel__inner">

								<!-- HEADER PANEL TOP : begin -->
								<div class="header-panel__top">
									<div class="header-panel__top-inner">

										<!-- HEADER CTA : begin -->
										<div class="header-cta">
											<a href="contact.html" class="header-cta__button">Make An Appointment</a>
										</div>
										<!-- HEADER CTA : end -->

										<!-- HEADER CONTACT : begin -->
										<div class="header-contact">
											<div class="header-contact__inner">

												<ul class="header-contact__list">

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon">
														<span class="header-contact__item-icon icon-phone" aria-hidden="true"></span>
														<a href="tel:12346789">(123) 456 789</a>
													</li>
													<!-- CONTACT ITEM : end -->

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon">
														<span class="header-contact__item-icon icon-envelope-o" aria-hidden="true"></span>
														<a href="mailto:example@example.com">example@example.com</a>
													</li>
													<!-- CONTACT ITEM : end -->

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon">
														<span class="header-contact__item-icon icon-map-marker" aria-hidden="true"></span>
														<p>
															BeautySpot<br>
															9015 Sunset Boulevard<br>
															Ca 90069
														</p>
													</li>
													<!-- CONTACT ITEM : end -->

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon">
														<span class="header-contact__item-icon icon-clock-o" aria-hidden="true"></span>
														<dl>
															<dt>Mo. - Fr.:</dt>
															<dd>10am - 4pm</dd>
															<dt>Sa.:</dt>
															<dd>9am - 2pm</dd>
															<dt>Su.:</dt>
															<dd>Closed</dd>
														</dl>
													</li>
													<!-- CONTACT ITEM : end -->

												</ul>

											</div>
										</div>
										<!-- HEADER CONTACT : end -->

									</div>
								</div>
								<!-- HEADER PANEL TOP : end -->

								<!-- HEADER PANEL BOTTOM : begin -->
								<div class="header-panel__bottom">
									<div class="header-panel__bottom-inner">

										<!-- HEADER SOCIAL : begin -->
										<div class="header-social">
											<ul class="header-social__list">

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--facebook">
													<a class="header-social__item-link" href="#facebook" target="_blank" title="Facebook">
														<span class="header-social__icon icon-facebook" aria-hidden="true"></span>
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--instagram">
													<a class="header-social__item-link" href="#instagram" target="_blank" title="Instagram">
														<span class="header-social__icon icon-instagram" aria-hidden="true"></span>
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--twitter">
													<a class="header-social__item-link" href="#twitter" target="_blank" title="Twitter">
														<span class="header-social__icon icon-twitter" aria-hidden="true"></span>
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--youtube">
													<a class="header-social__item-link" href="#youtube" target="_blank" title="YouTube">
														<span class="header-social__icon icon-youtube" aria-hidden="true"></span>
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

											</ul>
										</div>
										<!-- HEADER SOCIAL : end -->

										<span class="header-panel__bottom-decor" aria-hidden="true"></span>

										<!-- HEADER CART : begin -->
										<div class="header-cart">

											<a href="product-cart.html"
												class="header-cart__button">
												<span class="header-cart__button-icon" aria-hidden="true"></span>
												<span class="header-cart__button-info">3</span>
											</a>

										</div>
										<!-- HEADER CART : end -->

									</div>
								</div>
								<!-- HEADER PANEL BOTTOM : end -->

							</div>

							<button type="button" class="header-panel__toggle">
								<span class="header-panel__toggle-icon" aria-hidden="true"></span>
							</button>

						</div>
						<!-- HEADER PANEL : end -->

						<button type="button" class="header-mobile-toggle">
							<span class="header-mobile-toggle__icon" aria-hidden="true"></span>
						</button>

					</div>
				</div>
			</header>
			<!-- HEADER : end -->

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

											        		<!-- SLIDE : begin -->
											        		<div class="lsvr-slide-list__item">
						                            			<div class="lsvr-slide-list__item-bg" style="background-image: url( 'images/slide_01.jpg' );">
						                                			<div class="lsvr-slide-list__item-inner">
						                                				<div class="lsvr-slide-list__item-content-wrapper">
						                                					<div class="lsvr-slide-list__item-content">
						                                						<div class="lsvr-container">
						                               								<div class="lsvr-slide-list__item-content-inner">

						                                                            	<h2 class="lsvr-slide-list__item-title">Welcome to BeautySpot</h2>

						                                                            	<div class="lsvr-slide-list__item-text">
						                                                            		<p>
						                                                            			HTML Template for Beauty Salons, Hairdressers, Wellness or Spa
						                                                            		</p>
						                                                            	</div>

							                                                            <p class="lsvr-slide-list__item-button">
							                                                                <a href="service-archive.html" class="lsvr-button lsvr-slide-list__item-button-link">See Our Services</a>
							                                                            </p>

						                                                    		</div>
						                                                		</div>
						                                            		</div>
						                                        		</div>
						                                			</div>
						                            			</div>
						                        			</div>
						                        			<!-- SLIDE : end -->

											        		<!-- SLIDE : begin -->
											        		<div class="lsvr-slide-list__item">
						                            			<div class="lsvr-slide-list__item-bg" style="background-image: url( 'images/slide_02.jpg' );">
						                                			<div class="lsvr-slide-list__item-inner">
						                                				<div class="lsvr-slide-list__item-content-wrapper">
						                                					<div class="lsvr-slide-list__item-content">
						                                						<div class="lsvr-container">
						                               								<div class="lsvr-slide-list__item-content-inner">

						                                                            	<h2 class="lsvr-slide-list__item-title">Read Professional Beauty Tips</h2>

						                                                            	<div class="lsvr-slide-list__item-text">
						                                                            		<p>
						                                                            			Get inspired by our beauty tips on cosmetics, hair and body treatments
						                                                            		</p>
						                                                            	</div>

							                                                            <p class="lsvr-slide-list__item-button">
							                                                                <a href="blog-archive.html" class="lsvr-button lsvr-slide-list__item-button-link">See Our Blog</a>
							                                                            </p>

						                                                    		</div>
						                                                		</div>
						                                            		</div>
						                                        		</div>
						                                			</div>
						                            			</div>
						                        			</div>
						                        			<!-- SLIDE : end -->

											        		<!-- SLIDE : begin -->
											        		<div class="lsvr-slide-list__item">
						                            			<div class="lsvr-slide-list__item-bg" style="background-image: url( 'images/slide_03.jpg' );">
						                                			<div class="lsvr-slide-list__item-inner">
						                                				<div class="lsvr-slide-list__item-content-wrapper">
						                                					<div class="lsvr-slide-list__item-content">
						                                						<div class="lsvr-container">
						                               								<div class="lsvr-slide-list__item-content-inner">

						                                                            	<h2 class="lsvr-slide-list__item-title">Hundreds of Happy Clients</h2>

						                                                            	<div class="lsvr-slide-list__item-text">
						                                                            		<p>
						                                                            			Read what some of our customers are saying about our beauty salon
						                                                            		</p>
						                                                            	</div>

							                                                            <p class="lsvr-slide-list__item-button">
							                                                                <a href="testimonial-archive.html" class="lsvr-button lsvr-slide-list__item-button-link">See Our Testimonials</a>
							                                                            </p>

						                                                    		</div>
						                                                		</div>
						                                            		</div>
						                                        		</div>
						                                			</div>
						                            			</div>
						                        			</div>
						                        			<!-- SLIDE : end -->

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
						                    							<a href="service-archive.html" class="lsvr-services__title-link">Our Services</a>
						                    						</h2>

						                    						<h3 class="lsvr-services__subtitle">Our salon offers a wide variety of beauty services</h3>

						                    					</header>
						                    				</div>
						                    			</div>
						                    			<!-- SERVICES HEADER : end -->

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
							                                                    				<a href="service-single.html" class="lsvr-services__post-title-link">Cosmetics</a>
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
										            					<a href="blog-archive.html" class="lsvr-posts__title-link">Latest Blog Posts</a>
										            				</h2>

										            				<h3 class="lsvr-posts__subtitle">Read our tips about makeup, hairdressing and body treatments</h3>

										            			</header>
									            			</div>
									            		</div>
									            		<!-- POSTS HEADER : end -->

														<!-- POST LIST : begin -->
														<div class="lsvr-posts__list-wrapper">
															<div class="lsvr-container">
						                    					<div class="lsvr-posts__list lsvr-grid lsvr-grid--masonry lsvr-grid--3-cols lsvr-grid--md-2-cols lsvr-grid--sm-1-cols">

						                    						<!-- POST ITEM : begin -->
						                    						<div class="lsvr-posts__item lsvr-grid__col">
						                    							<article class="lsvr-posts__post">
						                    								<div class="lsvr-posts__post-inner">

						                    									<!-- POST ITEM THUMB : begin -->
									                                            <p class="lsvr-posts__post-thumbnail">
									                                                <a href="blog-single.html" class="lsvr-posts__post-thumbnail-link">
									                                                    <img src="images/blog_01.jpg" class="lsvr-posts__post-thumbnail-img" alt="A spa is a location where mineral-rich spring water">
									                                                </a>
									                                            </p>
									                                            <!-- POST ITEM THUMB : end -->

									                                            <!-- POST ITEM HEADER : begin -->
									                                            <header class="lsvr-posts__post-header">

										                                            <h3 class="lsvr-posts__post-title">
										                                                <a href="blog-single.html" class="lsvr-posts__post-title-link">A spa is a location where mineral-rich spring water</a>
										                                            </h3>

										                                            <p class="lsvr-posts__post-meta">

								                                                        <span class="lsvr-posts__post-meta-date">
								                                                            August 23, 2020
								                                                        </span>

						                                                        		<span class="lsvr-posts__post-meta-categories">
						                                                            		in <a href="blog-archive.html" class="lsvr-posts__post-meta-link">Spa Treatments</a>
						                                                        		</span>

						                                                			</p>

						                                        				</header>
						                                        				<!-- POST ITEM HEADER : end -->

						                                        				<!-- POST ITEM CONTENT : begin -->
						                                        				<!--div class="lsvr-posts__post-content">

						                                                			<p>The term is derived from the name of the town of Spa, Belgium, whose name is known back from Roman times, when the location was called Aquae Spadanae, sometimes incorrectly connected to the Latin word spargere meaning to scatter, sprinkle or moisten.</p>

						                                            			</div-->
						                                            			<!-- POST ITEM CONTENT : end -->

										                                        <p class="lsvr-posts__post-permalink">
										                                           <a href="blog-single.html" class="lsvr-posts__post-permalink-link">Read More</a>
										                                        </p>

						                                    				</div>
						                                				</article>
						                            				</div>
						                            				<!-- POST ITEM : end -->

						                    						<!-- POST ITEM : begin -->
						                    						<div class="lsvr-posts__item lsvr-grid__col">
						                    							<article class="lsvr-posts__post">
						                    								<div class="lsvr-posts__post-inner">

						                    									<!-- POST ITEM THUMB : begin -->
									                                            <p class="lsvr-posts__post-thumbnail">
									                                                <a href="blog-single.html" class="lsvr-posts__post-thumbnail-link">
									                                                    <img src="images/blog_02.jpg" class="lsvr-posts__post-thumbnail-img" alt="The main professionals that provide therapeutic">
									                                                </a>
									                                            </p>
									                                            <!-- POST ITEM THUMB : end -->

									                                            <!-- POST ITEM HEADER : begin -->
									                                            <header class="lsvr-posts__post-header">

										                                            <h3 class="lsvr-posts__post-title">
										                                                <a href="blog-single.html" class="lsvr-posts__post-title-link">The main professionals that provide therapeutic</a>
										                                            </h3>

										                                            <p class="lsvr-posts__post-meta">

								                                                        <span class="lsvr-posts__post-meta-date">
								                                                            August 20, 2020
								                                                        </span>

						                                                        		<span class="lsvr-posts__post-meta-categories">
						                                                            		in <a href="blog-archive.html" class="lsvr-posts__post-meta-link">Spa Treatments</a>
						                                                        		</span>

						                                                			</p>

						                                        				</header>
						                                        				<!-- POST ITEM HEADER : end -->

										                                        <p class="lsvr-posts__post-permalink">
										                                           <a href="blog-single.html" class="lsvr-posts__post-permalink-link">Read More</a>
										                                        </p>

						                                    				</div>
						                                				</article>
						                            				</div>
						                            				<!-- POST ITEM : end -->

						                    						<!-- POST ITEM : begin -->
						                    						<div class="lsvr-posts__item lsvr-grid__col">
						                    							<article class="lsvr-posts__post">
						                    								<div class="lsvr-posts__post-inner">

						                    									<!-- POST ITEM THUMB : begin -->
									                                            <p class="lsvr-posts__post-thumbnail">
									                                                <a href="blog-single.html" class="lsvr-posts__post-thumbnail-link">
									                                                    <img src="images/blog_03.jpg" class="lsvr-posts__post-thumbnail-img" alt="The dyeing of hair is an ancient art that involves">
									                                                </a>
									                                            </p>
									                                            <!-- POST ITEM THUMB : end -->

									                                            <!-- POST ITEM HEADER : begin -->
									                                            <header class="lsvr-posts__post-header">

										                                            <h3 class="lsvr-posts__post-title">
										                                                <a href="blog-single.html" class="lsvr-posts__post-title-link">The dyeing of hair is an ancient art that involves</a>
										                                            </h3>

										                                            <p class="lsvr-posts__post-meta">

								                                                        <span class="lsvr-posts__post-meta-date">
								                                                            August 18, 2020
								                                                        </span>

						                                                        		<span class="lsvr-posts__post-meta-categories">
						                                                            		in <a href="blog-archive.html" class="lsvr-posts__post-meta-link">Hair Care</a>
						                                                        		</span>

						                                                			</p>

						                                        				</header>
						                                        				<!-- POST ITEM HEADER : end -->

										                                        <p class="lsvr-posts__post-permalink">
										                                           <a href="blog-single.html" class="lsvr-posts__post-permalink-link">Read More</a>
										                                        </p>

						                                    				</div>
						                                				</article>
						                            				</div>
						                            				<!-- POST ITEM : end -->

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
										                                <a href="testimonial-archive" class="lsvr-testimonials__title-link">Our Clients Testimonials</a>
										                            </h2>

										                            <h3 class="lsvr-testimonials__subtitle">What our customers are saying about us</h3>

										                        </header>
										                    </div>
									                    </div>
									                    <!-- TESTIMONIALS HEADER : end -->

									                    <!-- TESTIMONIAL LIST : begin -->
									                    <div class="lsvr-testimonials__list-wrapper">
									                    	<div class="lsvr-container">
									                    		<div class="lsvr-testimonials__list lsvr-grid lsvr-grid--masonry lsvr-grid--2-cols lsvr-grid--sm-1-cols">

						                        					<!-- TESTIMONIAL ITEM : begin -->
						                            				<div class="lsvr-testimonials__item lsvr-grid__col">
						                            					<div class="lsvr-testimonials__post">
						                                    				<div class="lsvr-testimonials__post-inner">
						                                    					<div class="lsvr-testimonials__post-content-wrapper">

						                                    						<!-- TESTIMONIAL BLOCKQUOTE : begin -->
						                                    						<blockquote class="lsvr-testimonials__post-quote">

						                                    							<p>Eye shadow is a pigmented powder/cream or substance used to accentuate the eye area, traditionally on, above, and under the eyelids. Many colours may be used at once and blended together to create different effects using a blending brush.</p>

						                                    							<footer class="lsvr-testimonials__post-footer lsvr-testimonials__post-footer--has-thumbnail">

						                                    								<p class="lsvr-testimonials__post-thumbnail">
						                                    									<a href="testimonial-single.html" class="lsvr-testimonials__post-thumbnail-link">
						                                                                			<img src="images/client_01.jpg" class="lsvr-testimonials__post-thumbnail-img" alt="Sandra Olson">
						                                                                		</a>
						                                                                	</p>

						                                                                	<cite class="lsvr-testimonials__post-title">
						                                                                		<a href="testimonial-single.html" class="lsvr-testimonials__post-title-link">Sandra Olson</a>
						                                                                		<span class="lsvr-testimonials__post-title-description">Pharmacist</span>
						                                                                	</cite>

						                                                				</footer>

						                                            				</blockquote>
						                                            				<!-- TESTIMONIAL BLOCKQUOTE : end -->

						                                        				</div>
						                                   					 </div>
						                                				</div>
						                            				</div>
						                            				<!-- TESTIMONIAL ITEM : end -->

						                        					<!-- TESTIMONIAL ITEM : begin -->
						                            				<div class="lsvr-testimonials__item lsvr-grid__col">
						                            					<div class="lsvr-testimonials__post">
						                                    				<div class="lsvr-testimonials__post-inner">
						                                    					<div class="lsvr-testimonials__post-content-wrapper">

						                                    						<!-- TESTIMONIAL BLOCKQUOTE : begin -->
						                                    						<blockquote class="lsvr-testimonials__post-quote">

						                                    							<p>Bronzer gives skin a bit of color and contours the face for a sharper definition or creates a tan-look. Bronzer is considered to be more of a natural look and can be used for everyday wear. Bronzer enhances the color of the face. It comes in either matte, semi-matte/satin, or shimmer finishes.</p>

						                                    							<footer class="lsvr-testimonials__post-footer lsvr-testimonials__post-footer--has-thumbnail">

						                                    								<p class="lsvr-testimonials__post-thumbnail">
						                                    									<a href="testimonial-single.html" class="lsvr-testimonials__post-thumbnail-link">
						                                                                			<img src="images/client_02.jpg" class="lsvr-testimonials__post-thumbnail-img" alt="Donna Kittrell">
						                                                                		</a>
						                                                                	</p>

						                                                                	<cite class="lsvr-testimonials__post-title">
						                                                                		<a href="testimonial-single.html" class="lsvr-testimonials__post-title-link">Donna Kittrell</a>
						                                                                		<span class="lsvr-testimonials__post-title-description">Receptionist</span>
						                                                                	</cite>

						                                                				</footer>

						                                            				</blockquote>
						                                            				<!-- TESTIMONIAL BLOCKQUOTE : end -->

						                                        				</div>
						                                   					 </div>
						                                				</div>
						                            				</div>
						                            				<!-- TESTIMONIAL ITEM : end -->

						                        					<!-- TESTIMONIAL ITEM : begin -->
						                            				<div class="lsvr-testimonials__item lsvr-grid__col">
						                            					<div class="lsvr-testimonials__post">
						                                    				<div class="lsvr-testimonials__post-inner">
						                                    					<div class="lsvr-testimonials__post-content-wrapper">

						                                    						<!-- TESTIMONIAL BLOCKQUOTE : begin -->
						                                    						<blockquote class="lsvr-testimonials__post-quote">

						                                    							<p>Face powder sets the foundation and under eye concealer, giving it a matte finish while also concealing small flaws or blemishes. It can also be used to bake the foundation, so that it stays on longer and create a matte finish.</p>

						                                    							<footer class="lsvr-testimonials__post-footer lsvr-testimonials__post-footer--has-thumbnail">

						                                    								<p class="lsvr-testimonials__post-thumbnail">
						                                    									<a href="testimonial-single.html" class="lsvr-testimonials__post-thumbnail-link">
						                                                                			<img src="images/client_03.jpg" class="lsvr-testimonials__post-thumbnail-img" alt="Angela Chambers">
						                                                                		</a>
						                                                                	</p>

						                                                                	<cite class="lsvr-testimonials__post-title">
						                                                                		<a href="testimonial-single.html" class="lsvr-testimonials__post-title-link">Angela Chambers</a>
						                                                                		<span class="lsvr-testimonials__post-title-description">Computer analyst</span>
						                                                                	</cite>

						                                                				</footer>

						                                            				</blockquote>
						                                            				<!-- TESTIMONIAL BLOCKQUOTE : end -->

						                                        				</div>
						                                   					 </div>
						                                				</div>
						                            				</div>
						                            				<!-- TESTIMONIAL ITEM : end -->

						                        					<!-- TESTIMONIAL ITEM : begin -->
						                            				<div class="lsvr-testimonials__item lsvr-grid__col">
						                            					<div class="lsvr-testimonials__post">
						                                    				<div class="lsvr-testimonials__post-inner">
						                                    					<div class="lsvr-testimonials__post-content-wrapper">

						                                    						<!-- TESTIMONIAL BLOCKQUOTE : begin -->
						                                    						<blockquote class="lsvr-testimonials__post-quote">

						                                    							<p>Most modern barbershops have special barber chairs, and special equipment for rinsing and washing hair. In some barbershops, people can read magazines or watch TV while the barber works.</p>

						                                    							<footer class="lsvr-testimonials__post-footer lsvr-testimonials__post-footer--has-thumbnail">

						                                    								<p class="lsvr-testimonials__post-thumbnail">
						                                    									<a href="testimonial-single.html" class="lsvr-testimonials__post-thumbnail-link">
						                                                                			<img src="images/client_04.jpg" class="lsvr-testimonials__post-thumbnail-img" alt="Thomas Wadsworth">
						                                                                		</a>
						                                                                	</p>

						                                                                	<cite class="lsvr-testimonials__post-title">
						                                                                		<a href="testimonial-single.html" class="lsvr-testimonials__post-title-link">Thomas Wadsworth</a>
						                                                                		<span class="lsvr-testimonials__post-title-description">Librarian</span>
						                                                                	</cite>

						                                                				</footer>

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

											<!-- LSVR CTA : begin -->
											<section class="lsvr-cta lsvr-cta--has-button">
											    <div class="lsvr-cta__inner">
											        <div class="lsvr-container">
											            <div class="lsvr-cta__content">

											            	<h3 class="lsvr-cta__title">BeautySpot HTML Template</h3>

											            	<div class="lsvr-cta__text">
											            		<p>A perfect HTML template for your beauty salon website!</p>
						                    				</div>

						                    				<p class="lsvr-cta__button">
						                        				<a href="https://themeforest.net/item/beautyspot-html-template-for-beauty-salons/7734629" class="lsvr-cta__button-link lsvr-button" target="_blank">Purchase BeautySpot</a>
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

			<!-- FOOTER : begin -->
			<footer id="footer">
				<div class="footer__inner">

					<!-- FOOTER WIDGETS : begin -->
					<div class="footer-widgets" style="background-image: url( 'images/footer_bg.jpg' )">
						<div class="footer-widgets__inner">
							<div class="lsvr-container">

								<!-- WIDGETS GRID : begin -->
								<div class="footer-widgets__grid lsvr-grid">

									<!-- GRID COLUMN : begin -->
									<div class="footer-widgets__grid-col lsvr-grid__col lsvr-grid__col--span-8 lsvr-grid__col--md-span-12">

										<!-- TEXT WIDGET : begin -->
										<div class="widget lsvr-text-widget">
											<div class="widget__inner">

												<h3 class="widget__title">About BeautySpot</h3>
												<div class="widget__content">

													<p>BeautySpot is an ideal HTML template for beauty salons, hairdressers, wellness or spa websites.
													Clean and fast code is wrapped in unique design.</p>
													<p>You can buy this HTML template on <a href="https://themeforest.net/item/beautyspot-html-template-for-beauty-salons/7734629" target="_blank">ThemeForest</a>.</p>

												</div>

											</div>
										</div>
										<!-- TEXT WIDGET : end -->

									</div>
									<!-- GRID COLUMN : end -->

									<!-- GRID COLUMN : begin -->
									<div class="footer-widgets__grid-col lsvr-grid__col lsvr-grid__col--span-4 lsvr-grid__col--md-span-12">

										<!-- IMAGE GRID WIDGET : begin -->
										<div class="widget lsvr-image-grid-widget">
											<div class="widget__inner">

												<h3 class="widget__title">We Endorse These Brands</h3>
												<div class="widget__content">

													<div class="lsvr-images-widget__grid lsvr-grid lsvr-grid--4-cols lsvr-grid--sm-2-cols">

														<div class="lsvr-grid__col">
															<p><img src="images/brand_01.png" alt="Brand 1"></p>
														</div>

														<div class="lsvr-grid__col">
															<p><img src="images/brand_02.png" alt="Brand 2"></p>
														</div>

														<div class="lsvr-grid__col">
															<p><img src="images/brand_03.png" alt="Brand 3"></p>
														</div>

														<div class="lsvr-grid__col">
															<p><img src="images/brand_04.png" alt="Brand 4"></p>
														</div>

													</div>

												</div>

											</div>
										</div>
										<!-- IMAGE GRID WIDGET : end -->

									</div>
									<!-- GRID COLUMN : end -->

								</div>
								<!-- WIDGETS GRID : end -->

							</div>
						</div>
					</div>
					<!-- FOOTER WIDGETS : end -->

					<!-- FOOTER BOTTOM : begin -->
					<div class="footer-bottom">
						<div class="lsvr-container">
							<div class="footer-bottom__inner">

								<!-- FOOTER MENU : begin -->
								<nav class="footer-menu">
									<ul class="footer-menu__list">

										<li class="footer-menu__item">
											<a href="index.html">Home</a>
										</li>

										<li class="footer-menu__item">
											<a href="https://themeforest.net/item/beautyspot-html-template-for-beauty-salons/7734629" target="_blank">Purchase</a>
										</li>

										<li class="footer-menu__item">
											<a href="http://docs.lsvr.sk/beautyspot.html/" target="_blank">Documentation</a>
										</li>

										<li class="footer-menu__item">
											<a href="demo-credits.html">Demo Credits</a>
										</li>

										<li class="footer-menu__item">
											<a href="../beautyspot.rtl/index.html">RTL Version</a>
										</li>

									</ul>
								</nav>
								<!-- FOOTER MENU : end -->

								<!-- FOOTER TEXT : begin -->
								<div class="footer-text">
									<p>
										<a href="https://themeforest.net/item/beautyspot-html-template-for-beauty-salons/7734629" target="_blank">BeautySpot</a> - HTML Template for Beauty Salons
									</p>
								</div>
								<!-- FOOTER TEXT : end -->

							</div>
						</div>
					</div>
					<!-- FOOTER BOTTOM : end -->

				</div>
			</footer>
			<!-- FOOTER : end -->

		</div>
		<!-- WRAPPER : end -->

		<!-- SCRIPTS : begin -->
		<script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/third-party-scripts.min.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/scripts.js'); ?>" type="text/javascript"></script>
		<!-- SCRIPTS : end -->

	</body>
</html>