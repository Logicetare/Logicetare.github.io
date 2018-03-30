<?php


date_default_timezone_set("America/New_York");

define('DB_HOST', 'localhost');
define('DB_NAME', 'purestress');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', 'LinuxSolutions123');

$odb = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USERNAME, DB_PASSWORD);
$odb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//$odb->query("SET time_zone = 'America/New_York'");
