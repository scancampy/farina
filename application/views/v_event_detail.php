
<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">
						<h1 class="page-header__title"><?php echo $event[0]->name; ?></h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(''); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('event'); ?>" class="breadcrumbs__link">Events</a>
									</li>
									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('event/details/'.$event[0]->id.'/'.url_title($event[0]->name)); ?>" class="breadcrumbs__link">Details</a>
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
<?php if(count($photo) >0) { ?>
	<div class="splide" style="width: 100%; margin-bottom: 20px;">
		<div class="splide__track">
			<ul class="splide__list">
				<?php for($i = 0; $i<count($photo); $i++) { if($photo[$i]->media_type =="photo") { ?>
				<li class="splide__slide">
					<img src="<?php echo base_url('img/events/'.$photo[$i]->filename); ?>" style="width:100%;"  alt="<?php echo $event[0]->name; ?>">
					
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
														<div style="display: flex; justify-content: flex-start;">
															<div style=" margin-right: 30px;">
																<small style="margin-bottom: 0px;">Event Date</small><h4 style="margin-bottom: 0px;"><?php  echo strftime("%B %d, %Y", strtotime($event[0]->event_date)); ?></h4>
															</div>
															<div style=" margin-right: 30px;">
																<small style="margin-bottom: 0px;">Time</small><h4 style="margin-bottom: 0px;"><?php  echo strftime("%H:%M", strtotime($event[0]->event_date)); ?></h4>
															</div>
															<?php if($event[0]->host != '') { ?>
															<div style=" margin-right: 30px;">
																<small style="margin-bottom: 0px;">Hosted By</small><h4 style="margin-bottom: 0px;">
																<?php echo $event[0]->host; ?></h4></div>
															</div>
														<?php } ?>
														</div>
														<hr/>
														<p style="    font-size: 1.125em; line-height: 1.5em;">
															<?php echo $event[0]->content; ?>
														</p>


													</div>
													<!-- POST CONTENT : end -->
<p style="display: flex; justify-content: flex-end;">

															<!-- BUTTON : begin -->
															<a href="#" class="lsvr-button">Register Now</a>
															<!-- BUTTON : end -->

														</p>
												

												</div>
											</article>
											<!-- POST : end -->

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