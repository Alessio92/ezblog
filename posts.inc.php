<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-27T07:35:00Z    |
'----------------------------'
*/

$posts = array();
$id = get_route(1);
if (!$id) {
    $found = get_post($id);
    if ($found == null) {
        echo('<h1>Post not found.</h1>');
        die();
    }
    $posts[] = $found;
}
else {
    $posts = get_all_posts();
}

$count = count_posts();
$pages = ceil($count / POSTS_PER_PAGE);

?>
<div class="w-dyn-list">
    <div role="list" class="w-dyn-items">
<?php foreach($posts as $post) { ?>

<div class="post-wrapper">
    <div class="post-content">
        <a href="posts/<?=$post['id']?>" class="blog-title-link w-inline-block">
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
<?php
if ($single_page) {
    echo('<div class="button-wrapper"><a href="posts" class="button w-button">All Posts&nbsp;→</a></div>');
} else {
    echo('<p style="margin-bottom: 0;margin-top: 40px;">' . $count . ' total posts - ' . $pages .' pages</p>');
}
?>