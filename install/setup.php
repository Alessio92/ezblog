<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-26T22:43:00Z    |
'----------------------------'
*/

if (ob_get_level() == 0) { ob_start(); }
echo('<pre style="white-space: pre-line">');
echo('STEP 1 - DB INSTALLATION'."\n");

require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php');
require_once(__DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'utils.php');

$db->exec('CREATE TABLE IF NOT EXISTS posts (
    id integer PRIMARY KEY NOT NULL,
    post_content TEXT,
    post_timestamp integer(128)
);');
$db->exec('INSERT OR IGNORE INTO posts (id, post_content, post_timestamp) VALUES (1, \'I have just installed <b>EZBlog!</b> \', ' . NOW . ')');

echo('STEP 1 - DB INSTALLATION DONE'."\n");
ob_flush();
flush();
sleep(2);
echo('DONE'."\n");
echo('</pre>');
ob_end_flush();


strong_rmdir(__DIR__);