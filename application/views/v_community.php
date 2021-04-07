<!-- CORE : begin -->
<div id="core">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">Community</h1>

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
							<div>
								<p style="display: flex;justify-content: flex-end;">
									<a href="<?php echo base_url('community/newpost'); ?>" class="lsvr-button lsvr-button--small"><i class="fas fa-paper-plane"></i> New Post</a>
								</p>
							</div>
							<?php foreach ($post as $key => $value) { ?>
								<div class="mycard">
								<div class="header">
									<div class="propic" style="text-align: center;">
										<i class="fa fa-user"></i>
									</div>
									<div class="proname">
										<strong><?php echo $value->first_name; ?></strong><br/>
										<?php echo $value->member_type; ?>
									</div>									
								</div>
								<div class="body">

									
								<!-- LSVR SLIDE LIST : begin -->
								<?php if(count($photo[$key]) >0 ) { ?>
								<section class="lsvr-slide-list"><!-- To enable autoplay add: data-autoplay="5" -->
									
								    <div class="lsvr-slide-list__bg">
								        <div class="lsvr-slide-list__inner">
								        	<div class="lsvr-slide-list__list">
								        		<?php foreach ($photo[$key] as $key2 => $value2) { ?>
								        			<!-- SLIDE : begin -->
								        		<div class="lsvr-slide-list__item">
			                            			<div class="lsvr-slide-list__item-bg" style="background-image: url( 'img/post/<?php echo $value2->filename; ?>' );">
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
							<?php } ?>
								<!-- LSVR SLIDE LIST : end -->
								<div class="likes">
										<?php if($likes[$key] == true) { ?>
										<span class="likesbutton" likeid="<?php echo $value->id; ?>" style="color: #ff007c;"><i class="fas fa-heart"></i></span>
										<?php } else { ?>
											<span class="likesbutton" likeid="<?php echo $value->id; ?>"><i class="fas fa-heart"></i></span>
										<?php } ?>
										<br/>
										<strong>3 likes</strong>
									</div>
									<div class="content">
										<p><?php echo nl2br($value->content); ?></p>
										<p style="margin-bottom: 0px;">05 April 2021</p>
									</div>
									<div class="comment">
										<div><strong>yourname</strong> tes kirim pesan...</div>
										<div><strong>yourname</strong> tes kirim pesan...</div>
										<div><strong>yourname</strong> tes kirim pesan...</div>
									</div>

								</div>
								<div class="footer">
									<input type="text" name="txtcomment" placeholder="Tulis komentar" />
								</div>
							</div>
						   <?php	} ?>
 
							<div class="mycard">
								<div class="header">
									<div class="propic">
										<img src="https://i.pravatar.cc/150" />
									</div>
									<div class="proname">
										<strong>Andre</strong><br/>
										Admin
									</div>									
								</div>
								<div class="body">

									
								<!-- LSVR SLIDE LIST : begin -->
								<section class="lsvr-slide-list"><!-- To enable autoplay add: data-autoplay="5" -->

								    <div class="lsvr-slide-list__bg">
								        <div class="lsvr-slide-list__inner">
								        	<div class="lsvr-slide-list__list">

								        		<?php foreach ($slides as $key => $value) { ?>
								        			<!-- SLIDE : begin -->
								        		<div class="lsvr-slide-list__item">
			                            			<div class="lsvr-slide-list__item-bg" style="background-image: url( 'img/slides/<?php echo $value->filename; ?>' );">
			                                			
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
								<div class="likes">
										<span><i class="fas fa-heart"></i></span>
										<br/>
										<strong>3 likes</strong>
									</div>
									<div class="content">
										<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
										proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
										<p style="margin-bottom: 0px;">05 April 2021</p>
									</div>
									<div class="comment">
										<div><strong>yourname</strong> tes kirim pesan...</div>
										<div><strong>yourname</strong> tes kirim pesan...</div>
										<div><strong>yourname</strong> tes kirim pesan...</div>
									</div>

								</div>
								<div class="footer">
									<input type="text" name="txtcomment" placeholder="Tulis komentar" />
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