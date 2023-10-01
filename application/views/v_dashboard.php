<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title"><?php echo $title; ?></h1>

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

							<!-- PAGE : begin -->
							<div class="page product-post-page product-post-order product-post-order--checkout">
								<div class="page__content">
									<div style="display:flex; justify-content: space-between;">
									<h3>Welcome, <?php
									$member = $this->session->userdata('member');
									echo $member->first_name;
									 ?></h3>
									 <a href="<?php echo base_url('member/signout'); ?>" style="text-decoration: none; "><i class="fas fa-door-open"></i> Sign Out</a>
									</div>
									<nav class="member_nav">
										<div>
											<a href="<?php echo base_url('member/profile'); ?>"><i class="fas fa-user"></i></a>
											<a href="<?php echo base_url('member/profile'); ?>">My Profile</a>
										</div>
										<div>									
											<a href="<?php echo base_url('member/voucher'); ?>"><i class="fas fa-ticket-alt"></i></a>
											<a href="<?php echo base_url('member/voucher'); ?>">My Voucher</a>
										</div>
										<div>
											<a href="<?php echo base_url('member/myorders'); ?>"><i class="fas fa-shopping-cart"></i></a>
											<a href="<?php echo base_url('member/myorders'); ?>">My Orders</a>
										</div>
										<div>
											<a href="<?php echo base_url('member/mypoints'); ?>"><i class="fas fa-star"></i></a>
											<a href="<?php echo base_url('member/mypoints'); ?>">My Points</a>
										</div>
										<div>
											<a href="<?php echo base_url('member/myevents'); ?>"><i class="fas fa-calendar-day"></i></a>
											<a href="<?php echo base_url('member/myevents'); ?>">My Events</a>
										</div>
										<div>
											<a href="<?php echo base_url('member/myinbox'); ?>"><i class="fas fa-envelope"></i></a>
											<a href="<?php echo base_url('member/myinbox'); ?>">My Inbox</a>
										</div>
									</nav>
									<hr class="lsvr-spacer" aria-hidden="true">

<div class="lsvr-grid lsvr-grid--2-cols lsvr-grid--sm-1-cols">

	<?php if(count($orders) >0) { ?>
    <div class="lsvr-grid__col">

    	<!-- LSVR PRICING TABLE : begin -->
		<div class="lsvr-pricing-table">
		    <div class="lsvr-pricing-table__inner">

		        <h3 class="lsvr-pricing-table__title">Orders</h3>

		        <p class="lsvr-pricing-table__price">
		        	<span class="lsvr-pricing-table__price-value"><?php echo count($orders); ?></span>
		        	<em class="lsvr-pricing-table__price-description">ongoing orders</em>
		        </p>

		        <p class="lsvr-pricing-table__button">
		        	<a href="<?php echo base_url('member/myorders'); ?>" class="lsvr-pricing-table__button-link lsvr-button">Check Now</a>
		        </p>

		    </div>
		</div>
		<!-- LSVR PRICING TABLE : end -->

	</div>
<?php } ?>

    <?php if(count($vouchers) >0) { ?>
    <div class="lsvr-grid__col">

    	<!-- LSVR PRICING TABLE : begin -->
		<div class="lsvr-pricing-table">
		    <div class="lsvr-pricing-table__inner">

		        <h3 class="lsvr-pricing-table__title">Voucher</h3>

		        <p class="lsvr-pricing-table__price">
		        	<span class="lsvr-pricing-table__price-value"><?php echo count($vouchers); ?></span>
		        	<em class="lsvr-pricing-table__price-description">available vouchers</em>
		        </p>

		        <p class="lsvr-pricing-table__button">
		        	<a href="<?php echo base_url('member/voucher'); ?>" class="lsvr-pricing-table__button-link lsvr-button">Check Now</a>
		        </p>

		    </div>
		</div>
		<!-- LSVR PRICING TABLE : end -->

	</div>
<?php } ?>

</div>

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