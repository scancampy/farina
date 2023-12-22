
<?php if(!empty(@$setting->whatsapp)) { ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://api.whatsapp.com/send?phone=<?php echo $setting->whatsapp; ?>&text=<?php echo $setting->default_whatsapp_message; ?>" class="float" target="_blank">
<i class="fa fa-whatsapp my-float"></i>
</a>
<?php } ?>

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

													<p><?php echo $setting->about_website; ?></p>

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
														<li><a href="<?php echo base_url('product'); ?>">Our Products</a></li>
														<li><a href="<?php echo base_url('member'); ?>">Member Access</a></li>
														<li><a href="<?php echo base_url('confirm'); ?>">Confirm Payment</a></li>
														<li><a href="<?php echo base_url('event'); ?>">Event</a></li>
														<li><a href="<?php echo base_url('article'); ?>">Beauty Article</a></li><li><a href="<?php echo base_url('community'); ?>">Community</a></li>
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

								

								<!-- FOOTER TEXT : begin -->
								<div class="footer-text">
									<p>
										<a href="<?php echo base_url(); ?>" target="_blank"><?php echo $setting->website_name; ?></a>
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
				$('#myprofile').on('click', function() {
					$('.loading').show();
				});
			});
		</script>
	</body>
</html>