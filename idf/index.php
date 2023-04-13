<?php
session_start();
ini_set("log_errors", 1);
ini_set("error_log", "error.log");
date_default_timezone_set("Asia/Jerusalem");
header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("Strict-Transport-Security:max-age=7776000");
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $location);
    exit;
}
$param = array();
if ($_SERVER['REQUEST_URI'] === '/') {
    $page = 'index';
    $module = 'index';
} else {
    $url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $url_parts = explode('/', trim($url_path, '/'));
    $page = array_shift($url_parts);
    $module = array_shift($url_parts);
    if (!empty($module)) {
        for ($i = 0; $i < count($url_parts); $i++) $param[$i] = $url_parts[$i];
    }
}
$page = urldecode($page);
$module = urldecode($module);
if ($page === "index" && $module === "index") include "pages/index.php";
else if($page === "clear" && empty($module)) {
    clearstatcache();
    opcache_reset();
    header("Location: /");
}
else header("Location: https://idf.dacs.co.il/"); 