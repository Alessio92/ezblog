<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-27T06:51:00Z    |
'----------------------------'
*/

if (isset($_POST['content'])) {
    $new_content = $_POST['content'];

    $result = add_post($new_content);
    $added = false;
    if ($result > 0) {
        $added = true;
    }
}

?>

<div class="post-wrapper">
   <div class="post-content">
      <div class="body-copy w-richtext">
         <h1>New post</h1>
      </div>
      <div class="form-wrapper w-form">
         <form id="new-post" name="new-post" data-name="Email Form" method="POST" action="./new" <?php if (isset($added)) { echo(' style="display: none" '); } ?>>
            <label for="content">Content</label><textarea id="content" name="content" placeholder="Enter your content" maxlength="5000" data-name="content" required="" class="text-field text-area w-input"></textarea>
            <input type="submit" value="Submit" data-wait="Please wait..." class="button w-button">
        </form>
         <div class="success-message w-form-done" <?php if (isset($added) && $added) { echo(' style="display: block" '); } ?>>
            <p class="success-text">Thank you! Your submission has been received!</p>
         </div>
         <div class="w-form-fail" <?php if (isset($added) && !$added) { echo(' style="display: block" '); } ?>>
            <p>Oops! Something went wrong while submitting the form</p>
         </div>
      </div>
   </div>
</div>