<?php

function get_route()
{
    $full_route = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
    $route_fragments = (parse_url($full_route, PHP_URL_PATH));
    $route = explode('/', trim($route_fragments, '/'));

    return $route[0];
}