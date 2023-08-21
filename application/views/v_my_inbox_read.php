<!-- CORE : begin -->
<div id="core" class="core--narrow">
	<div class="core__inner">

		<!-- PAGE HEADER : begin -->
		<div class="page-header">
			<div class="page-header__inner">
				<div class="lsvr-container">
					<div class="page-header__content">

						<h1 class="page-header__title">My Inbox - Read</h1>

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

							<h3><?php echo $inbox[0]->title; ?><br/><small><?php echo strftime("%d %B %Y", strtotime($inbox[0]->created)); ?></small></h3>
							<p><?php echo $inbox[0]->content; ?></p>

							<?php if(!empty($files)) { ?>
							<p style="margin-bottom:0px;"><strong>Downloads</strong></p>
						<?php } ?>

							<div style="display:flex;">
							<?php foreach ($files as $key => $value) { 
								$ext = explode(".", $value->filename);

								if($ext[1] == 'png' || $ext[1] == 'gif' || $ext[1] == 'jpg' || $ext[1] == 'jpeg' ) { ?>
									<a href="<?php echo base_url('files/'.$value->filename); ?>" target="_blank" style="    display: block;
    width: fit-content;
    padding: 10px;
    margin-right: 20px;
    margin-bottom: 20px;
    border-radius: 20px;
    border: 1px solid lightgray; text-align:center;">
										<div style="background-image:url('<?php echo base_url('files/'.$value->filename); ?>');  width:150px; background-size: cover; height: 150px; border-radius:10px;"  >
										</div>
										<?php echo $value->title; ?>
									</a>
							<?php	
							} else { ?>
<a href="<?php echo base_url('files/'.$value->filename); ?>" target="_blank" style="    display: block;
    width: fit-content;
    padding: 10px;
    margin-right: 20px;
    margin-bottom: 20px;
    border-radius: 20px;
    border: 1px solid lightgray; text-align:center;">
										<div style=" width:150px; height: 150px;     display: flex;
    align-items: center;
    justify-content: center;"  >
    <span class="fas fa-file-alt fa-6x"></span>
										</div>
										<?php echo $value->title; ?>
									</a>
						<?php	} 
						} ?>
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