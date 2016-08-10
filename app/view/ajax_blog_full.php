<?php
$blog = $this->blog_sys->GetBlog($this->DATA['id']);
if ($blog) {
?>
<section class="row">
	<div class="col-md-12">
		<div class="style_box">
			<div class="row">
				<div class="col-md-12">
					<div class="head"><?php echo $blog['title']; ?></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="body">
						<div class="blog">
							<div class="row">
								<div class="col-md-12"><?php echo ($blog['content']); ?></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php $this->comments_sys->GetComments('blog_'.$this->DATA['id']); ?>
</section>
<?php } ?>