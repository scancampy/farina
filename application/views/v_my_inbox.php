<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">My Inbox</h1>

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
										<a href="<?php echo base_url('member/myinbox'); ?>" class="breadcrumbs__link">My Inbox</a>
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
		<div class="product-cart__item-col product-cart__item-col--title" style="padding:0px; flex-grow:0;">
			<h4 style="margin:0px;">Date</h4>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--quantity" style="padding:0px; flex-grow:1; text-align: center;" >
			<h4 style="margin:0px;">Title</h4>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--price" style="padding:0px; text-align: center;">
			<h4 style="margin:0px;">Read</h4>
		</div>
		<!-- ITEM ITEM COL : end -->

	</li>
		<?php foreach ($inbox as $key => $value) { ?>
<!-- CART ITEM : begin -->
	<li class="product-cart__item" style="<?php if($value->is_read) { ?>background-color:#fbe7ef;<?php } ?> margin-top:0px; padding-bottom: 10px;">

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--title" style="padding:0px; flex-grow: 0;">
			<a style="text-decoration: none;" href="<?php echo base_url('member/read/'.$value->msgid); ?>">
				<?php echo strftime("%d %B %Y", strtotime($value->created)); ?>
			</a>
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--quantity" style="padding:0px; flex-grow: 1;" >
			<!-- ITEM TITLE : begin -->
			<h4 class="product-cart__item-title" style="margin-bottom:0px; padding-left:20px;">
				<a style="text-decoration: none;" href="<?php echo base_url('member/read/'.$value->msgid); ?>">
				<?php echo $value->title; ?>
			</a>
			</h4>
			<!-- ITEM TITLE : end -->
		</div>
		<!-- ITEM ITEM COL : end -->

		<!-- ITEM ITEM COL : begin -->
		<div class="product-cart__item-col product-cart__item-col--price" style="padding:0px; text-align: center;">
<a style="text-decoration: none;" href="<?php echo base_url('member/read/'.$value->msgid); ?>">
			<?php if($value->is_read) { ?>
			<i class="fas fa-envelope-open"></i>
			<?php } else { ?>
			<i class="fas fa-envelope"></i>
			<?php }?>
		</a>
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