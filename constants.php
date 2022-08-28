<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-26T22:07:00Z    |
'----------------------------'
*/

// common
define('NAME',               'EZBlog!');
define('HOME',               'posts');
define('DECRIPTION',         '<b>EZBlog!</b> (easyblog) is a new, fast, powerful and beautiful microblog software. I am creating it for fun and the purpose will be to host it on my website and then publish all my stuff.');
define('SOCIAL_TWITTER',     '');
define('SOCIAL_FACEBOOK',    '');
define('SOCIAL_INSTAGRAM',   '');

// utils
define('NOW',                 time());

// posts
define('POSTS_PER_PAGE',     9999);

// setup
define('INSTALL_FOLDER',     'install');
define('INSTALL_SCRIPT',     'setup.php');

// DB
define('DB_NAME',             'ezblog.db');
define('DB_FILE_PATH',        __DIR__ . DIRECTORY_SEPARATOR . DB_NAME);
define('DBMS',               'sqlite');
