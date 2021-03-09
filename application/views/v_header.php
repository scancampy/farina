<!DOCTYPE html>
<html lang="en-US">
	<head>

		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title.' - '.$setting->website_name; ?></title>
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/general.css'); ?>"><!-- Default styles generated from assets/scss/general.scss (do not edit) -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/color-schemes/default.css'); ?>"><!-- Default color scheme generated from assets/scss/color-schemes/default.scss (change to other pre-defined or custom color scheme) -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('style.css'); ?>"><!-- Place your own CSS into this file -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
		<!-- STYLESHEETS : end -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

	</head>
	<body>

		<!-- WRAPPER : begin -->
		<div id="wrapper">

			<!-- HEADER : begin -->
			<header id="header" class="header--has-languages header--has-search header--has-cta header--has-contact header--has-social-links header--has-collision-detection header--has-expanded-panel"
				style="background-image: url( 'images/header_bg.jpg' )">
				<div class="header__inner">
					<div class="header__content">

						

						<!-- HEADER BRANDING : begin -->
						<div class="header-branding">
							<div class="header-branding__inner">

								<!-- HEADER LOGO : begin -->
								<div class="header-logo">
									<a href="index.html" class="header-logo__link">
										<img src="<?php echo base_url('images/logo.png'); ?>" class="header-logo__image" alt="Logo">
									</a>
								</div>
								<!-- HEADER LOGO : end -->

								<!-- HEADER TITLE TAGLINE : begin -->
								<div class="header-title-tagline">

									<div class="header-title">
										<a href="<?php echo base_url(''); ?>" class="header-title__link"><?php echo $setting->website_name; ?></a>
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
								<li class="header-menu__item <?php if ($this->uri->segment(1) == '') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="<?php echo base_url(''); ?>" class="header-menu__item-link">Home</a>
									</span>

									

								</li>
								<!-- MENU ITEM : end -->

								

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(1) == 'product') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="<?php echo base_url('product'); ?>" class="header-menu__item-link">Products</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(1) == 'article') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="<?php echo base_url('article'); ?>" class="header-menu__item-link">Beauty Article</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(1) == 'event') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="#" class="header-menu__item-link">Event</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(1) == 'community') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="#" class="header-menu__item-link">Community</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item header-menu__item--has-children <?php if ($this->uri->segment(1) == 'member') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="blog-archive.html" class="header-menu__item-link">User Menu</a>
									</span>

									<button type="button" class="header-menu__submenu-toggle" title="Expand submenu">
										<span class="header-menu__submenu-toggle-icon" aria-hidden="true"></span>
									</button>

									<ul class="header-menu__submenu">

										<li class="header-menu__item">
											<a href="blog-archive.html" class="header-menu__item-link" role="menuitem">My Profile</a>
										</li>

										<li class="header-menu__item">
											<a href="gallery-archive.html" class="header-menu__item-link" role="menuitem">My Voucher</a>
										</li>

										<li class="header-menu__item">
											<a href="person-archive.html" class="header-menu__item-link" role="menuitem">My Orders</a>
										</li>

										<li class="header-menu__item">
											<a href="testimonial-archive.html" class="header-menu__item-link" role="menuitem">My Points</a>
										</li>

										<li class="header-menu__item">
											<a href="testimonial-archive.html" class="header-menu__item-link" role="menuitem">My Inbox</a>
										</li>

										<li class="header-menu__item">
											<a href="faq-archive.html" class="header-menu__item-link" role="menuitem">Sign Out</a>
										</li>

									</ul>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(2) == 'contact') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="contact.html" class="header-menu__item-link">Contact</a>
									</span>

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
											<?php 
											$this->load->helper('cookie');
											$product = unserialize(get_cookie('product'));
			
											 ?>

											<a href="<?php echo base_url('cart'); ?>"
												class="header-cart__button">
												<span class="header-cart__button-icon" aria-hidden="true"></span>
												<?php if(count($product) >0) { ?>
												<span class="header-cart__button-info"><?php echo count($product); ?></span>
											<?php } ?>
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