<section class="row">
	<div class="index">
		<div class="col-md-6">
			<div class="box tow_box">
				<div class="row">
					<div class="col-md-12">
						<div class="title text-center">Блог</div>
					</div>
					<div class="col-md-12">
						<div class="body" style="padding: 5px 0;">
							<div class="nano">
								<div class="nano-content" style="padding: 15px;">
									<?php
									if ($this->blog_sys) {
										$count = $this->blog_sys->GetBlogCount();
										$count = ($count > 10) ? 10 : $count + 1;
										for ($id = 0; $id < $count; $id++)
										{
											$blog = $this->blog_sys->GetBlog($id);
											if ($blog === null) {
												continue;
											}
											echo "<div class=\"blog\">";                
												echo "<h4 class=\"blog_title\">{$blog['title']}</h4>";
												echo "<div class=\"blog_text\">{$blog['preview']}</div>";
												echo '<a href="#blog-'.$blog['id'].'" class="move pull-right" onClick="blog_move(event, '.$blog['id'].', \''.$blog['title'].'\')">Читать далее...</a>';
											echo "</div>";
										}
									}
									?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="box">
				<div class="row">
					<div class="col-md-12">
						<div class="title text-center">Матчи</div>
					</div>
					<div class="col-md-12">
						<div class="body" style="padding: 5px 0;">
							<div class="nano">
								<div class="nano-content" style="padding: 15px;">
									<div class="row">
										<?php
											$url = "http://dailydota2.com/match-api";
											$json_object = file_get_contents($url);
											$json_decoded = json_decode($json_object);

											// var_dump($json_decoded->matches);

											foreach ($json_decoded->matches as $value)
											{
												// var_dump($value);

												$start_time = new DateTime($value->starttime);
												$now_time = new DateTime('now');
												$time = $now_time->diff($start_time);

												$time_show = $time->format('%h');
												$time_show = ($time->format('%h') == "0") ? $time->format('Через %i минут') : $time->format('Через %h часов %i минут');
												
												echo '<div class="col-md-12">';
													echo '<div class="match">';
														echo '<div class="row">';
															echo '<div class="col-md-12 match_time">'.$time_show.'</div>';
															echo '<div class="col-md-12 match_time text-right">'.$value->league->name.'</div>';
															echo '<div class="col-md-4 text-center match_name">'.$value->team1->team_name.'</div>';
															echo '<div class="col-md-4 text-center">vs</div>';
															echo '<div class="col-md-4 text-center match_name">'.$value->team2->team_name.'</div>';
														echo '</div>';
													echo '</div>';
												echo '</div>';
											}
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="box">
				<div class="row">
					<div class="col-md-12">
						<div class="title text-center">Наши видео</div>
					</div>
					<div class="col-md-12">
						<div class="body" style="padding: 5px 0;">
							<div class="nano">
								<div class="nano-content" style="padding: 15px;">
									<div class="row">
										<?php
											$api_key = 'AIzaSyAFrR_GNn-F-s1JEty-1YOIPP8TY_KbClM';
		    								$playlist = 'LL6c6x0RFLfahwTldSJ_8CiQ';

											$url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet'
										        . '&playlistId=' . $playlist
										        // . '&maxResults=' . $limit
										        . '&key=' . $api_key;

									        $json_object = file_get_contents($url);
									        $json_decoded = json_decode($json_object);

									        // var_dump($json_decoded);

									        foreach ($json_decoded->items as $value) {
									        	$snippet = $value->snippet;
									        	// var_dump($snippet);
									        	echo '<a href="https://www.youtube.com/watch?v='.$snippet->resourceId->videoId.'" target="_blank">';
										            echo '<div class="col-md-12">';
														echo '<div class="youtube">';
															echo '<div class="row">';
																echo '<div class="col-md-4"><img src="'.$snippet->thumbnails->medium->url.'" class="img-responsive youtube_img" alt=""></div>';
																echo '<div class="col-md-8 youtube_title">'.$snippet->title.'</div>';
															echo '</div>';
														echo '</div>';
													echo '</div>';
												echo '</a>';
									        }
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	function blog_move(event, _id, name)
	{
		event.preventDefault();

		var page = {mod: "blog", id: _id};

		window.history.pushState({load_state: true, pageObj: page}, 'Новости - ' + name, SitePath+"/blog/"+_id);
		$('title').html('Новости - ' + name);

		ajax_load(page);
	}

	$(document).ready(function() {
		$(".nano").nanoScroller();
	});
</script>