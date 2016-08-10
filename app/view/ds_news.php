<section class="row">
	<?php
		foreach ($this->blog_sys->GetBlogsLimit($this->DATA['step'] * ($this->DATA['page'] - 1), $this->DATA['step']) as $value)
		{
			if ($value === null)
				continue;

		    echo '<div class="col-md-12">';
				echo '<div class="style_box">';
					echo '<div class="row">';
						echo '<div class="col-md-12">';
							echo '<div class="head">'.$value['title'].'</div>';
						echo '</div>';
					echo '</div>';
					echo '<div class="row">';
						echo '<div class="col-md-12">';
							echo '<div class="body">';
								echo '<div class="news">';
									echo '<div class="row">';
										echo '<div class="col-md-12">'.$value['preview'].'</div>';
										echo '<div class="col-md-12"><a href="#blog-move" class="pull-right blog_move" onClick="ajax_load({mod: \'blog\', id: \''.$value['id'].'\'});">Читать далее...</a></div>';
									echo '</div>';
								echo '</div>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
	?>
	<?php } ?>
	<div class="col-md-12 text-center">
		<nav aria-label="Page navigation">
			<ul class="pagination">
				<?php $Previous_class = ''; if ($this->DATA['page'] == 1) $Previous_class = 'class="disabled"'; ?>
				<li <?php echo $Previous_class; ?> >
					<a id="Previous" href="#" onClick="previous_nav(event)" aria-label="Previous">
						<span aria-hidden="true">&laquo;</span>
					</a>
				</li>
				<?php
					for ($i=1; $i < $this->DATA['link_count'] + 1; $i++) { 
						$class = '';
						if ($this->DATA['page'] == $i)
							$class = 'class="active"';

						echo '<li '.$class.'><a class="nav_link" href="#nav" onClick="it_nav(event, '.$i.')">'.$i.'</a></li>';
					}
				?>
				<?php $Next_class = ''; if ($this->DATA['page'] == $this->DATA['link_count']) $Next_class = 'class="disabled"'; ?>
				<li <?php echo $Next_class; ?> >
					<a id="Next" href="#next"  onClick="next_nav(event)" aria-label="Next">
						<span aria-hidden="true">&raquo;</span>
					</a>
				</li>
			</ul>
		</nav>
	</div>
</section>
<script type="text/javascript">
	function previous_nav(event)
	{
		event.preventDefault();

		var p = <?php echo $this->DATA['page'] - 1; ?>;

		var page = {mod: "blog", news: '', page: p};

		window.history.pushState({load_state: true, pageObj: page}, 'Новости', SitePath+"/news/page/"+p);
		$('title').html('Новости');

		ajax_load(page);
	}

	function it_nav(event, _id)
	{
		event.preventDefault();

		var page = {mod: "blog", news: '', page: _id};

		window.history.pushState({load_state: true, pageObj: page}, 'Новости', SitePath+"/news/page/"+_id);
		$('title').html('Новости');

		ajax_load(page);
	}

	function next_nav(event)
	{
		event.preventDefault();

		var p = <?php echo $this->DATA['page'] + 1; ?>;

		var page = {mod: "blog", news: '', page: p};

		window.history.pushState({load_state: true, pageObj: page}, 'Новости', SitePath+"/news/page/"+p);
		$('title').html('Новости');

		ajax_load(page);
	}
</script>