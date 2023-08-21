<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">My Points</h1>

						<!-- BREADCRUMBS : begin -->
						<div class="breadcrumbs">
							<div class="breadcrumbs__inner">
								<ul class="breadcrumbs__list">

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url(); ?>" class="breadcrumbs__link">Home</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('member'); ?>" class="breadcrumbs__link">Member</a>
									</li>

									<li class="breadcrumbs__item">
										<a href="<?php echo base_url('member/mypoints'); ?>" class="breadcrumbs__link">My Points</a>
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
					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">

							<?php if($this->session->flashdata('notif')) { 
								$notif = $this->session->flashdata('notif');
								?>
							<div class="lsvr-alert-message lsvr-alert-message--warning">
								<span class="lsvr-alert-message__icon" aria-hidden="true"></span>
								<h3 class="lsvr-alert-message__title">Warning Message</h3>
								<p><?php echo $notif['msg']; ?>	</p>
							</div>
						    <?php } ?>

						   
						</div>
					</main>
					<!-- MAIN : end -->

					<!-- MAIN : begin -->
					<main id="main">
						<div class="main__inner">

							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--cart">
								<div class="page__content">

										<!-- CART LIST : begin -->
										<ul class="product-cart__list">
		<li class="product-cart__item">

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--title" style="padding:0px;">
			<h4 style="margin:0px;">Notes</h4>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--quantity" style="padding:0px;" >
			<h4 style="margin:0px;">Points</h4>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--price" style="padding:0px; text-align: center;">
			<h4 style="margin:0px;">Earned</h4>
		</div>
		<!-- ITEM ITEM COL : end -->

	</li>
		<?php foreach ($poin as $key => $value) { ?>
<!-- CART ITEM : begin -->
	<li class="product-cart__item">

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--title" style="padding:0px;">
			<?php echo $value->notes; ?>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--quantity" style="padding:0px;" >
			<!-- ITEM TITLE : begin -->
			<h4 class="product-cart__item-title" style="margin-bottom:0px;">
				<?php echo $value->point; ?> Points
			</h4>
			<!-- ITEM TITLE : end -->
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--price" style="padding:0px; text-align: center;">

			<?php echo strftime("%d %B %Y", strtotime($value->point_earned)); ?>

		</div>
		<!-- ITEM ITEM COL : end -->

	</li>
	<!-- CART ITEM : end -->
		<?php } ?>
										</ul>
										<!-- CART LIST : end -->

										
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