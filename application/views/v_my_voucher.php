<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">My Voucher</h1>

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
										<a href="<?php echo base_url('member/myorders'); ?>" class="breadcrumbs__link">My Orders</a>
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

<?php foreach ($myvoucher as $key => $value) { ?>
<div class="wrap">
  <div class="coupon">
    <div class="coupon-left">
    	<img src="<?php echo base_url('images/logo.png'); ?>" class="header-logo__image" alt="Logo">
    </div>
    <div class="coupon-con">
    	<h4><?php echo character_limiter($value->title,20); ?></h4>
    	<p ><?php echo $value->description; ?><br/><small>Valid until <?php echo strftime("%d %B %Y", strtotime($value->exp_date)); ?></small></p>
    	<span ><strong><?php echo $value->voucher_code; ?></strong><button class="buttoncopy" vouchercode="<?php echo $value->voucher_code; ?>">COPY</button></span>
    </div>
  </div>
</div>	
<?php } ?>


										
										
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