<?php
/*
.----------------------------.
|      Alessio Carello       |
|           EZBLOG           |
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
    require_once($file_to_include);
    die();
}

/* If not, redirect to HOME page */
header('Location: ' . str_replace(str_replace($_SERVER['PHP_SELF'], '', $_SERVER['SCRIPT_FILENAME']), '', __DIR__) . '/' . HOME);