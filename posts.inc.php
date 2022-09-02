<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-27T07:35:00Z    |
'----------------------------'
*/

$posts = array();
$comments_count = array();
$id = get_route(1);
$single_page = false;
if ($id != false) {
    $found = get_post($id);
    if ($found == null) {
        echo('<h1>Post not found.</h1>');
        die();
    }
    $posts[] = $found;
    $single_page = true;
    $comments_count = count_comments();
    $comments = get_comments($id);
}
else {
    $posts = get_all_posts();
    $comments_count = count_comments();
}

$count = count_posts();
$pages = ceil($count / POSTS_PER_PAGE);

?>
<div class="w-dyn-list">
    <div role="list" class="w-dyn-items">
<?php foreach($posts as $post) { ?>

<div class="post-wrapper">
    <div class="post-content">
        <a href="posts/<?=$post['id']?>" class="blog-title-link w-block">
            <h1 class="blog-title"><?=trim($post['post_content'])?></h1>
        </a>
        <div class="post-info-wrapper">
            <div class="post-info"><?=timestamp_to_readable_time($post['post_timestamp'])?></div>
            <div class="post-info">|</div>
            <div class="post-info"><?=in_array($post['id'], $comments_count) ? $comments_count[$post['id']] : 0 ?> comments</div>
            <!--a href="categories/travel" class="post-info link">Travel</a-->
        </div>
        <?php
        if ($single_page && $comments != null) {
            echo('<div class="post-summary-wrapper">');
            echo('<div class="grey-rule"></div>');
            foreach($comments as $comment) { ?>
            <div class="body-copy w-richtext">
                <b><?=$comment['comment_author']?> - <small><?=date('Y-m-d, G:i', $comment['comment_timestamp'])?></small></b>
                <blockquote><?=$comment['comment_content']?></blockquote>
            </div>
            <?php }
            echo('</div>');
        }
        ?>
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