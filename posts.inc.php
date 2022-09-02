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

    /*
     Check if user has submitted a new comment for this post
    */
    if (isset($_POST['content']) && isset($_POST['username'])) {
        $comment_content = $_POST['content'];
        $comment_username = $_POST['username'];
        $comment_post = $_POST['post'];

        $result = add_comment($comment_post, $comment_username, $comment_content);
        if ($result > 0) {
            header('HTTP/1.1 303 See Other');
            header('Location: ' . URL . '/posts/'. $_POST['post']);
            die();
        }
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
            <div class="post-info"><a href="posts/<?=$post['id']?>"><?=array_key_exists($post['id'], $comments_count) ? $comments_count[$post['id']] : 0 ?> comments</a></div>
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
if ($single_page) { ?>
    <div class="post-wrapper">
    <div class="post-content">
        <div class="body-copy w-richtext">
            <h1>Add Comment</h1>
        </div>
        <div class="form-wrapper w-form">
            <form id="new-comment" name="new-comment" data-name="Comment Form" method="POST" action="./posts/<?=$id?>">
                <input type="hidden" id="post" name="post" data-name="post" required="" value="<?=$id?>" />
                <!--label for="username">Username</label--><input type="text" id="username" name="username" placeholder="Enter your username" data-name="username" required="" class="text-field w-input" />
                <!--label for="content">Content</label--><textarea id="content" name="content" placeholder="Enter your content" maxlength="512" data-name="content" required="" class="text-field text-area w-input"></textarea>
                <input type="submit" value="Submit" data-wait="Please wait..." class="button w-button">
            </form>
        </div>
    </div>
    </div>

    <div class="button-wrapper"><a href="posts" class="button w-button">All Posts&nbsp;→</a></div>
    <?php
} else {
    echo('<p style="margin-bottom: 0;margin-top: 40px;">' . $count . ' total posts - ' . $pages .' pages</p>');
}
?>