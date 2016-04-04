<?php
$blog = $this->blog_sys->GetBlog($this->DATA['id']);
if ($blog) {
	echo "<div class=\"blog\">";                
	echo "<h4 class=\"blog-title\">{$blog['title']}</h4>";
	echo "<div class=\"blog-minitext\">{$blog['content']}</div>";
	echo "</div>";
}
?>