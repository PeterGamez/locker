<?php
require_once './ajax/config.php';

$agent = $_SERVER['HTTP_USER_AGENT']; // รับค่า User-Agent ของผู้เข้าชมเว็บไซต์
$agent_url = $_SERVER['REQUEST_URI']; // รับค่า URL ของผู้เข้าชมเว็บไซต์
$agent_path = parse_url($agent_url, PHP_URL_PATH); // แยก URL ออกเป็น Path
$agent_request = explode('/', $agent_path); // แยก Path ออกเป็น Array

if ($agent_path == '/') {
    include './template/header.php';
    include './page/home.php';
    exit();
} else if (str_starts_with($agent_path, '/locker')) {
    include './template/header.php';
    include './page/locker/index.php';
    exit();
} else if (str_starts_with($agent_path, '/lock')) {
    include './template/header.php';
    include './page/locker/lock.php';
    exit();
} else if ($agent_path == '/backend') {
    include './template/header.php';
    include './page/backend/index.php';
    exit();
} else if ($agent_path == '/backend/add') {
    include './template/header.php';
    include './page/backend/add.php';
    exit();
} else if (str_starts_with($agent_path, '/backend/edit')) {
    include './template/header.php';
    include './page/backend/edit.php';
    exit();
}
echo "<script>window.location.href='/'</script>";
