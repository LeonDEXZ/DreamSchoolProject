<section class="row">
	<div class="col-md-12">
		<div class="style_box">
			<div class="row">
				<div class="col-md-12">
					<div class="head"><?php echo $this->DATA['profile']['full_name']; ?></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="trainer_profile">
							<div class="row">
								<div class="col-md-2">
									<div class="photo"><img class="img-responsive" alt="" src="<?php echo DEX_SITE_PATH; ?>/images/trainer_profile/<?php echo $this->DATA['profile']['id']; ?>.jpg"></div>
								</div>
								<div class="col-md-10">
									<div class="info"><?php echo $this->DATA['profile']['info']; ?></div>
								</div>
							</div>									
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->comments_sys->GetComments('trainer_profile_'.$this->DATA['profile']['id']); ?>
</section>