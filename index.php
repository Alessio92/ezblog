<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-26T22:05:00Z    |
'----------------------------'
*/

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . 'utils.php');

// Check for installation folder
if (is_dir(__DIR__ . DIRECTORY_SEPARATOR . INSTALL_FOLDER))
{
    require_once(__DIR__ . DIRECTORY_SEPARATOR . INSTALL_FOLDER . DIRECTORY_SEPARATOR . INSTALL_SCRIPT);
    die();
}

$file_to_include = realpath(__DIR__ . DIRECTORY_SEPARATOR . get_route() . '.inc.php');
/* If page exists, load it */
if ($file_to_include && str_starts_with($file_to_include, __DIR__))
{
    ?>
<!DOCTYPE html>
<html class="w-mod-js w-mod-ix wf-lato-i3-active wf-lato-n4-active wf-lato-n7-active wf-lato-i7-active wf-lato-i1-active wf-lato-n9-active wf-lato-n1-active wf-lato-i4-active wf-lato-i9-active wf-lato-n3-active wf-active">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title><?=NAME?></title>
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/fontawesome.min.css" rel="stylesheet">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="css/milton-template.webflow.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/latofont.css" media="all">
    <link rel="stylesheet" href="css/style.css" media="all">
    <link rel="icon" type="image/x-icon" href="./favicon.ico">
  </head>
  <body>
    <div class="sidebar-wrapper">
      <div class="header">
        <a href="" aria-current="page" class="site-name w--current"><?=NAME?></a>
        <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        <p class="site-description"><?=DECRIPTION?></p>
        <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        <nav class="navigation">
            <a href="./" class="nav-link">home</a>
            <a href="./new" class="nav-link">new</a>
            <div class="grey-rule w-hidden-small w-hidden-tiny"></div>
        </nav>
        <div class="social-link-group">
          <a href="<?=SOCIAL_GITHUB?>" class="social-icon-link w-inline-block"><img src="assets/gh.svg" width="25" alt=""></a>
          <a href="<?=SOCIAL_FACEBOOK?>" class="social-icon-link w-inline-block"><img src="assets/fb.svg" width="25" alt=""></a>
          <a href="<?=SOCIAL_INSTAGRAM?>" class="social-icon-link w-inline-block"><img src="assets/in.svg" width="25" alt=""></a>
          <a href="<?=SOCIAL_TWITTER?>" class="social-icon-link w-inline-block"><img src="assets/tw.svg" width="25" alt=""></a>
        </div>
      </div>
    </div>
    <div class="content-wrapper">
    <?php
    require_once(__DIR__ . DIRECTORY_SEPARATOR . 'db.php');
    require_once($file_to_include);
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="js/webflow.js" type="text/javascript"></script>
    <script src="js/webfont.js" type="text/javascript"></script>
  </body>
</html>
    <?php
    die();
}

/* If not, redirect to HOME page */
header('Location: ' . str_replace(str_replace($_SERVER['PHP_SELF'], '', $_SERVER['SCRIPT_FILENAME']), '', __DIR__) . '/' . HOME);
?>