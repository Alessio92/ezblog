<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBlog!           |
|    2022-08-26T22:55:00Z    |
'----------------------------'
*/

require_once(__DIR__ . DIRECTORY_SEPARATOR . 'config.php');
try {
    $db = new PDO(DBMS . ':' . DB_FILE_PATH);
} catch(PDOException $e) {
	print 'Exception : '.$e->getMessage();
	die('cannot connect to or open the database');
}