<!DOCTYPE html>
<html lang="en-US">
	<head>
		<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PLX6VL6');</script>
<!-- End Google Tag Manager -->
		<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Z4C5WHJ8SK"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-Z4C5WHJ8SK');
</script>
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo $title.' - '.$setting->website_name; ?></title>
        <link rel="shortcut icon" href="images/favicon.ico">

        <!-- STYLESHEETS : begin -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/general.css'); ?>"><!-- Default styles generated from assets/scss/general.scss (do not edit) -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/color-schemes/default.css'); ?>"><!-- Default color scheme generated from assets/scss/color-schemes/default.scss (change to other pre-defined or custom color scheme) -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('style.css'); ?>"><!-- Place your own CSS into this file -->

		
<link rel="stylesheet" href="<?php echo base_url('assets/icofont/icofont.min.css'); ?>">
		<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.css" />
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
		<!-- STYLESHEETS : end -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">

	</head>
	<body>
		<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PLX6VL6"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

		<!-- WRAPPER : begin -->
		<div id="wrapper">
			<div class="loading" style="display:none;">Loading&#8230;</div>

			<!-- HEADER : begin -->
			<header id="header" class="header--has-languages header--has-search header--has-cta header--has-contact header--has-social-links header--has-collision-detection header--has-expanded-panel"
				style="background-image: url( 'images/header_bg.jpg' )">
				<div class="header__inner">
					<div class="header__content">
						<!-- HEADER BRANDING : begin -->
						<div class="header-branding">
							<div class="header-branding__inner">

								<!-- HEADER LOGO : begin -->
								<div class="header-logo" style="max-width: none; ">
									<a href="<?php echo base_url(); ?>" class="header-logo__link">
										<img src="<?php echo base_url('images/logo.png'); ?>" class="header-logo__image" alt="Logo">
									</a>
								</div>
								<!-- HEADER LOGO : end -->

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
										<a href="<?php echo base_url('event'); ?>" class="header-menu__item-link">Event</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(1) == 'community') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="<?php echo base_url('community'); ?>" class="header-menu__item-link">Community</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

								<!-- MENU ITEM : begin -->
								<li class="header-menu__item header-menu__item--has-children <?php if ($this->uri->segment(1) == 'member') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="<?php echo base_url('member'); ?>" class="header-menu__item-link">Member Menu</a>
									</span>
									<?php if($this->session->userdata('member')) { ?>
									<button type="button" class="header-menu__submenu-toggle" title="Expand submenu">
										<span class="header-menu__submenu-toggle-icon" aria-hidden="true"></span>
									</button>

									<ul class="header-menu__submenu">

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/profile'); ?>" class="header-menu__item-link" id="myprofile" role="menuitem">My Profile</a>
										</li>

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/voucher'); ?>" class="header-menu__item-link" role="menuitem">My Voucher</a>
										</li>

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/myorders'); ?>" class="header-menu__item-link" role="menuitem">My Orders</a>
										</li>

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/mypoints'); ?>" class="header-menu__item-link" role="menuitem">My Points</a>
										</li>

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/myevents'); ?>" class="header-menu__item-link" role="menuitem">My Events</a>
										</li>

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/myinbox'); ?>" class="header-menu__item-link" role="menuitem">My Inbox</a>
										</li>

										<li class="header-menu__item">
											<a href="<?php echo base_url('member/signout'); ?>" class="header-menu__item-link" role="menuitem">Sign Out</a>
										</li>

									</ul>
								<?php } ?>

								</li>
								<!-- MENU ITEM : end -->


								<!-- MENU ITEM : begin -->
								<li class="header-menu__item <?php if ($this->uri->segment(2) == 'confirm') { ?> header-menu__item--current <?php } ?>">

									<span class="header-menu__item-link-wrapper">
										<a href="<?php echo base_url('confirm'); ?>" class="header-menu__item-link">Payment Confirmation</a>
									</span>

								</li>
								<!-- MENU ITEM : end -->

							</ul>

						</nav>
						<!-- HEADER MENU : end -->

						

						<!-- HEADER PANEL : begin -->
						<div class="header-panel">
							<div class="header-panel__inner">

								<!-- HEADER PANEL TOP : begin -->
								<div class="header-panel__top">
									<div class="header-panel__top-inner">

										<!-- HEADER CTA : begin -->
										<div class="header-cta">
											<a href="https://api.whatsapp.com/send?phone=<?php echo $setting->whatsapp; ?>&text=<?php echo $setting->default_whatsapp_message; ?>" class="header-cta__button" target="_blank">CONTACT US</a>
										</div>
										<!-- HEADER CTA : end -->

										<!-- HEADER CONTACT : begin -->
										<div class="header-contact">
											<div class="header-contact__inner">

												<ul class="header-contact__list">

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon" style="width:100%;">
														<span class="header-contact__item-icon icon-phone" aria-hidden="true"></span>
														<a href="https://api.whatsapp.com/send?phone=<?php echo $setting->whatsapp; ?>&text=<?php echo $setting->default_whatsapp_message; ?>" target="_blank">+<?php echo $setting->whatsapp; ?> (whatsapp)</a>
													</li>
													<!-- CONTACT ITEM : end -->

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon" style="width:100%;">
														<span class="header-contact__item-icon icon-envelope-o" aria-hidden="true"></span>
														<a href="mailto:<?php echo $setting->email; ?>"><?php echo $setting->email; ?></a>
													</li>
													<!-- CONTACT ITEM : end -->

													<!-- CONTACT ITEM : begin -->
													<li class="header-contact__item header-contact__item--has-icon" style="width:100%;">
														<span class="header-contact__item-icon icon-map-marker" aria-hidden="true"></span>
														<p>
															<?php echo $setting->website_name; ?><br>
															<?php echo $setting->address; ?><br>
															Sidoarjo, Jawa Timur, Indonesia
														</p>
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
													<a class="header-social__item-link" href="<?php echo $setting->tiktok_link; ?>" target="_blank" title="TikTok">
														<img src="<?php echo base_url('images/tiktok_link.png'); ?>" style="max-width: 50%; padding-top:7px;" />
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--instagram">
													<a class="header-social__item-link" href="<?php echo $setting->ig_link; ?>" target="_blank" title="Instagram">
														<img src="<?php echo base_url('images/ig_link.png'); ?>" style="max-width: 50%; padding-top:7px;" />
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--instagram">
													<a class="header-social__item-link" href="<?php echo $setting->lazada_link; ?>" target="_blank" title="Lazada">
														<img src="<?php echo base_url('images/lazada_link.png'); ?>" style="max-width: 50%; padding-top:7px;" />
													</a>
												</li>
												<!-- SOCIAL ITEM : end -->

												<!-- SOCIAL ITEM : begin -->
												<li class="header-social__item header-social__item--instagram">
													<a class="header-social__item-link" href="<?php echo $setting->shopee_link; ?>" target="_blank" title="Shopee">
														<img src="<?php echo base_url('images/shopee_link.png'); ?>" style="max-width: 50%; padding-top:7px;" />
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
												<?php if(isset($product)) {
												if($product!='') { ?>
												<span class="header-cart__button-info"><?php echo count($product); ?></span>
											<?php } } ?>
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

			<!-- HEADER SEARCH : begin -->
						<div class="" style="margin:10px;">
							<div class="">

								<!-- SEARCH FORM : begin -->
								<form class="search-form" action="<?php echo base_url('product'); ?>" method="get" role="search">
									<div class="search-form__inner">
										<div class="search-form__input-holder">

											<input class="search-form__input" type="text" name="s" placeholder="Search..." value="<?php echo $this->input->get('s'); ?>">

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