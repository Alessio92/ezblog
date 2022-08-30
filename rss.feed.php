<?php
header('Content-Type: text/xml');

$posts = get_all_posts();
$count = count_posts();
$pages = ceil($count / POSTS_PER_PAGE);

?>
<?xml version="1.0" encoding="UTF-8" ?>
<rss version="2.0">
<channel>
 <title><?=NAME?></title>
 <description><?=DESCRIPTION?></description>
 <link><?=URL?></link>
 <copyright><?=date('Y')?> <?=$_SERVER['HTTP_HOST']?> All rights reserved.</copyright>
 <ttl>1800</ttl>
 <?php
    foreach($posts as $post) {
        $content = trim(strip_tags($post['post_content']));
        $direct_link = URL . '/posts/' . $post['id'];
?>
<item>
  <title><?=substr($content, 0, 32)?></title>  
  <description>
  <![CDATA[ <img src="https://alessiocarello.tk/mb/assets/logo.png" /><a href="<?=$direct_link?>" target="_blank"><?=$content?></a> ]]>
  </description>
  <link><?=$direct_link?></link>
  <guid isPermaLink="true"><?='POST_#' . $post['id']?></guid>
  <pubDate><?=date('c', $post['post_timestamp'])?></pubDate>
 </item> 
<?php } ?>
</channel>
</rss>