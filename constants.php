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
define('DESCRIPTION',        '<b>EZBlog!</b> (easyblog) is a new, fast, powerful and beautiful microblog software. I am creating it for fun and the purpose will be to host it on my website and then publish all my stuff.');
define('URL',                $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . str_replace(str_replace($_SERVER['PHP_SELF'], '', $_SERVER['SCRIPT_FILENAME']), '', __DIR__));
define('SOCIAL_TWITTER',     '');
define('SOCIAL_FACEBOOK',    '');
define('SOCIAL_INSTAGRAM',   '');
define('SOCIAL_GITHUB',      '');

// credentials
define('TOKEN_KEY',           'ezblogtoken');
define('USER',                'admin');
define('PASSWORD',            'admin');
define('SECRET',              '00000000-0000-0000-0000-000000000000');
define('COOKIE_LIFETIME',     3600 * 24);

// utils
define('NOW',                 time());
define('TIMEZONE',            new DateTimeZone('Europe/Rome'));

// posts
define('POSTS_PER_PAGE',      9999);

// setup
define('INSTALL_FOLDER',     'install');
define('INSTALL_SCRIPT',     'setup.php');

// DB
define('DB_NAME',             'ezblog.db');
define('DB_FILE_PATH',        __DIR__ . DIRECTORY_SEPARATOR . DB_NAME);
define('DBMS',               'sqlite');
