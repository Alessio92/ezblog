<?php

function get_route($pos = 0) {
    $full_route = str_replace(dirname($_SERVER['SCRIPT_NAME']), '', $_SERVER['REQUEST_URI']);
    $route_fragments = (parse_url($full_route, PHP_URL_PATH));
    $route = explode('/', trim($route_fragments, '/'));

    if ($pos >= count($route)) {
        return false;
    }

    return $route[$pos];
}

function get_all_posts($post_timestamp = NOW, $posts_per_page = POSTS_PER_PAGE) {
    global $db;
    if (empty($db)) {
        echo('$db is empty');
        return false;
    }

    // todo: Multipage (offset)

    $query = $db->prepare('SELECT * FROM posts WHERE post_timestamp < :post_timestamp ORDER BY id DESC LIMIT :limit');
    $query->bindParam(':post_timestamp', $post_timestamp, PDO::PARAM_INT);
    $query->bindParam(':limit', $posts_per_page, PDO::PARAM_INT);
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        return false;
    }

    return $rows;
}

function get_post($id) {
    global $db;
    if (empty($db)) {
        echo('$db is empty');
        return false;
    }

    // todo: Multipage (offset)

    $query = $db->prepare('SELECT * FROM posts WHERE id = :post_id');
    $query->bindParam(':post_id', $id, PDO::PARAM_INT);
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    if (empty($row)) {
        return false;
    }

    return $row;
}

function add_post($post_content, $post_timestamp = NOW) {
    global $db;
    if (empty($db)) {
        echo('$db is empty');
        return false;
    }

    $query = $db->prepare('INSERT INTO posts  (post_content, post_timestamp) VALUES (:post_content, :post_timestamp)');
    $query->bindParam(':post_content', $post_content, PDO::PARAM_STR);
    $query->bindParam(':post_timestamp', $post_timestamp, PDO::PARAM_INT);
    $query->execute();
    
    return $db->lastInsertId();
}

function count_posts() {
    global $db;
    if (empty($db)) {
        return false;
    }

    $query = $db->prepare('SELECT COUNT(id) as total_posts FROM posts');
    $query->execute();
    $row = $query->fetch(PDO::FETCH_ASSOC);

    return (int) $row['total_posts'];
}

function count_comments($post_ids = null) {
    global $db;
    if (empty($db)) {
        return false;
    }

    $sql = 'SELECT post_id, COUNT(id) as total_comments FROM comments';

    if ($post_ids != null) {
        $sql .= ' WHERE post_id IN (' . str_repeat('?,', count($post_ids) - 1) . '?' . ')';
    }

    $sql .= ' GROUP BY post_id';

    $query = $db->prepare($sql);
    if ($post_ids != null) {
        $query->execute($post_ids);
    } else {
        $query->execute();
    }

    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        return false;
    }

    $map = array();
    foreach ($rows as $row) {
        $map[$row['post_id']] = $row['total_comments'];
    }
    return $map;
}

function get_comments($post_id) {
    global $db;
    if (empty($db)) {
        return false;
    }

    $sql = 'SELECT * FROM comments WHERE post_id = :post_id';

    $query = $db->prepare('SELECT * FROM comments WHERE post_id = :post_id');
    $query->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $query->execute();
    $rows = $query->fetchAll(PDO::FETCH_ASSOC);

    if (empty($rows)) {
        return false;
    }

    return $rows;
}

function strong_rmdir($dir) {
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!strong_rmdir($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

function timestamp_to_readable_time($timestamp) {
    $secs = (NOW - $timestamp);

    if ($secs < 60) {
        return $secs . 's';
    }

    if ($secs < 60 * 60) {
        return floor($secs/60) . 'min';
    }

    if ($secs < 60 * 60 * 24) {
        return floor($secs/(60 * 60)) . 'h';
    }

    return date('j F', $timestamp);
}

function redirect_to_path($path) {
    header('Location: ' . str_replace(str_replace($_SERVER['PHP_SELF'], '', $_SERVER['SCRIPT_FILENAME']), '', __DIR__) . '/' . $path);
}

function is_logged_in() {
    if (!isset($_COOKIE[TOKEN_KEY])) { return false; }

    return $_COOKIE[TOKEN_KEY] == sha1($_SERVER['HTTP_HOST'] . NAME . USER . SECRET);
}