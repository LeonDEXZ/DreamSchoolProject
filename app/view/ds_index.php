<section class="row info-boxs">
	<div class="col-md-6 info-box">
		<div class="info-box-title">Матчи</div>
		<div class="blog-content nano">
			<div class="nano-content">
				<div class="match-first" style="background-image: url(<?php echo DEX_SITE_PATH; ?>/images/match-bg.jpg);">
					<div class="match-first-info">
						<span class="match-first-info-name">Vega Squadron</span>
						<span class="match-first-vs">VS</span>
						<span class="match-first-info-name">Team Empire</span>
						<span class="match-first-BO">bo2</span>
						<span class="match-first-info-time">19-00</span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 info-box">
		<div class="info-box-title">Клозы</div>
		<div class="blog-content nano">
			<div class="nano-content">

			</div>
		</div>
	</div>
</section>
<section class="row info-boxs">
	<div class="col-md-6 info-box">
		<div class="info-box-title">Блог</div>
		<div class="blog-content nano">
			<div class="nano-content">
				<?php
				if ( $this->blog_sys) {
		           	$count = $this->blog_sys->GetBlogCount();
		           	$count = ($count > 10) ? 10 : $count + 1;
		            for ($id = 0; $id < $count; $id++)
		            {
		            	$blog = $this->blog_sys->GetBlog($id);
		            	if ($blog === null) {
		            		continue;
		            	}
		                echo "<div class=\"blog\">";                
		                echo "<h4 class=\"blog-title\">{$blog['title']}</h4>";
		                echo "<div class=\"blog-minitext\">{$blog['preview']}</div>";
		                echo '<a data-pjax href="'.DEX_SITE_PATH.'/blog/'.$blog['id'].'" class="pull-right">Читать далее...</a>';
		                echo "</div>";
		            }
		        }
	            ?>
			</div>
		</div>
	</div>
	<div class="col-md-6 info-box">
		<div class="info-box-title">Видео</div>
		<div class="blog-content nano">
			<div class="nano-content">

			</div>
		</div>
	</div>
</section>