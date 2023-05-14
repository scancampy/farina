	<!-- FOOTER : begin -->
			<footer id="footer">
				<div class="footer__inner">

					<!-- FOOTER WIDGETS : begin -->
					<div class="footer-widgets" style="background-image: url( '<?php echo base_url('images/footer_bg.jpg'); ?>' )">
						<div class="footer-widgets__inner">
							<div class="lsvr-container">

								<!-- WIDGETS GRID : begin -->
								<div class="footer-widgets__grid lsvr-grid">

									<!-- GRID COLUMN : begin -->
									<div class="footer-widgets__grid-col lsvr-grid__col lsvr-grid__col--span-8 lsvr-grid__col--md-span-12">

										<!-- TEXT WIDGET : begin -->
										<div class="widget lsvr-text-widget">
											<div class="widget__inner">

												<h3 class="widget__title">About <?php echo $setting->website_name; ?></h3>
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

												<h3 class="widget__title">Quick Links</h3>
												<div class="widget__content">
													<ul>
														<li><a href="#">How to register</a></li>
														<li><a href="#">How to make transaction</a></li>
														<li><a href="#">VIP Benefit</a></li>
														<li><a href="#">S&K</a></li>
														<li><a href="#">FAQ</a></li>
													</ul>
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
		
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.js"></script>
		<script src="<?php echo base_url('assets/js/scripts.js'); ?>" type="text/javascript"></script>

		<script src="https://www.google.com/recaptcha/api.js?render=6LdODPMlAAAAANqZ8s-N-ozy2Gz9dOFmni_1fPOl"></script>

		<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

		<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
		<!-- SCRIPTS : end -->
		<script type="text/javascript">
			$(document).ready(function() {
				<?php if(isset($js)) { echo $js; } ?>
			});
		</script>
	</body>
</html>