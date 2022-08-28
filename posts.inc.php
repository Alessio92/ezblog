<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-27T07:35:00Z    |
'----------------------------'
*/

$posts = get_all_posts();
?>
<div class="w-dyn-list">
    <div role="list" class="w-dyn-items">
<?php foreach($posts as $post) { ?>

<div class="post-wrapper">
    <div class="post-content">
        <a class="blog-title-link w-inline-block">
            <h1 class="blog-title"><?=trim($post['post_content'])?></h1>
        </a>
        <div class="post-info-wrapper">
            <div class="post-info"><?=timestamp_to_readable_time($post['post_timestamp'])?></div>
            <div class="post-info">|</div>
            <!--a href="categories/travel" class="post-info link">Travel</a-->
        </div>
    </div>
</div>    
<?php } ?>
    </div>
</div>
<!--div class="button-wrapper"><a href="all-posts" class="button w-button">All Posts&nbsp;→</a></div-->