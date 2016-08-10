<section class="row">
	<div class="col-md-12">
		<div class="style_box">
			<div class="row">
				<div class="col-md-12">
					<div class="head"><?php echo $this->DATA['blog']['title']; ?></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="blog">
							<div class="row">
								<div class="col-md-12"><?php echo ($this->DATA['blog']['content']); ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->comments_sys->GetComments('blog_'.$this->DATA['id']); ?>
</section>