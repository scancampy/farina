
<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content" style="display: flex; justify-content:space-between; align-items:flex-end;">

						<h1 class="page-header__title">Event</h1>
						

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

							<div class="uk-container uk-padding">
    <div class="uk-timeline">
    	<?php foreach ($event as $key => $value) { ?>
    		<div class="uk-timeline-item">
            <div class="uk-timeline-icon">
                <span class="uk-badge"><span class="fas fa fa-<?php echo $value->icon; ?>"></span></span>
            </div>
            <div class="uk-timeline-content">
                <div class="uk-card uk-card-default uk-margin-medium-bottom uk-overflow-auto">
                  
                    <div class="uk-card-body">

                    	<?php if(count($photo[$key]) >0) { ?>
	                    	<div class="uk-img">
	                    		<?php if($photo[$key][0]->media_type == "photo") { ?>
									<img src="<?php echo base_url('img/events/'.$photo[$key][0]->filename); ?>" class="post__thumbnail-img" alt="<?php echo $value->name; ?>">
								<?php } else { echo $photo[$key][0]->youtube_link; }
								 ?>
	                    	</div>
	                    <?php } ?>
                    	<div>
                    		<h4><?php echo $value->name; ?></h4>
                    		<h5><?php  echo strftime("%B %d, %Y start at %H:%M", strtotime($value->event_date)); ?></h5>
							<p class="uk-text-success"><?php echo $value->short_desc; ?>
							<?php if($value->need_registration) { echo '<br/><small><em>(registration required)</em></small>';  } ?>
	                        </p>
	                        <?php if($value->host != '') { ?>
		                        <p><strong>Host: <?php echo $value->host; ?></strong></p>
		                    <?php } ?>
	                        <a href="<?php echo base_url('event/details/'.$value->id.'/'.url_title($value->name)); ?>" class="lsvr-button lsvr-button--small">Details</a>
	                    </div>
							
                    </div>
                </div>
            </div>
        </div>
    	<?php } ?>
    </div>
</div>
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
	iframe { width: 150px !important; height: 100% !important; }
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