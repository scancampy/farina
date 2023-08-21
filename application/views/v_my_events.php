<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">My Events</h1>

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
										<a href="<?php echo base_url('member/myevents'); ?>" class="breadcrumbs__link">My Events</a>
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

<table>
	<tr>
		<th style="padding-left: 7px;"><h4 style="margin:0px;">Events</h4></th>
		<th style="padding-left: 7px;"><h4 style="margin:0px;">Date</h4></th>
		<th style="text-align:center;"><h4 style="margin:0px;">Status</h4></th>
	</tr>
	<?php foreach ($myevents as $key => $value) { ?>
		<tr>
			<td><a href="<?php echo base_url('event/details/'.$value->id.'/'.url_title($value->name)); ?>">
			<?php echo $value->name; ?>
		</a></td>
			<td><?php echo strftime("%A %d %B %Y", strtotime($value->event_date));  ?>
			</td>
			<td style="text-align:center;">
				<a href="<?php echo base_url('event/register/'.$value->id.'/'.url_title($value->name)); ?>">
				<?php if($value->status == 'pending') { ?>
					    		<strong style="color:#ff007c;">Verify Request in Progress</strong>
					    	<?php } else if($value->status == 'registered') { ?>
					    		<strong style="color:#ff007c;">Registered</strong>
					    	<?php } else if($value->status == 'cancelled') { ?>
					    		<strong style="color:#ff007c;">Cancelled</strong>
					    	<?php } ?>
				</a>
			</td>
		</tr>
	<?php } ?>
</table>

									
										
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