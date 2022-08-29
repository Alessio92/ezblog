<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-29T21:31:00Z    |
'----------------------------'
*/

if (is_logged_in()) {
    redirect_to_path(HOME);
    die();
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $logged = $_POST['username'] == USER && $_POST['password'] == PASSWORD;

    if ($logged) {
        $domain = $_SERVER['HTTP_HOST'];
        setcookie(TOKEN_KEY, sha1($domain . NAME . USER . SECRET), NOW + COOKIE_LIFETIME, '/', $domain, false);
        redirect_to_path('new');
        die();
    }

}

?>

<div class="post-wrapper">
   <div class="post-content">
      <div class="body-copy w-richtext">
         <h1>Login</h1>
      </div>
      <div class="form-wrapper w-form">
         <div class="w-form-fail" <?php if (isset($logged) && !$logged) { echo(' style="display: block" '); } ?>>
            <p style="margin: 0">Invalid credentials</p>
         </div>
         <form id="login" name="login" data-name="Login Form" method="POST" action="./login">
            <label for="content">Username</label><input type="text" id="username" name="username" placeholder="Username" data-name="username" required="" class="text-field input w-input" />
            <label for="content">Password</label><input type="password" id="password" name="password" placeholder="Password" data-name="password" required="" class="text-field input w-input" />
            <input type="submit" value="Login" data-wait="Please wait..." class="button w-button">
        </form>
      </div>
   </div>
</div>