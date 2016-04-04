<?php
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
?>