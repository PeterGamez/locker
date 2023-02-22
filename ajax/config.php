<?php
// Site
$_cfg['site_name'] = 'Locker';
$_cfg['site_logo'] = '/images/icon/locker/favicon.png';

// MySQL
$_cfg['sql_host'] = 'localhost';
$_cfg['sql_user'] = 'locker';
$_cfg['sql_pass'] = '';
$_cfg['sql_db'] = 'locker';


// connect mysql
$conn = mysqli_connect($_cfg['sql_host'], $_cfg['sql_user'], $_cfg['sql_pass'], $_cfg['sql_db']);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($conn, 'utf8');
date_default_timezone_set("Asia/Bangkok");
