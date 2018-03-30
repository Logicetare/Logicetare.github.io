<?php

require_once 'includes/db.php';
require_once 'includes/init.php';

if (isset($_GET['id']) && !empty($_GET['id']) && ctype_digit($_GET['id'])) {
	$loggerExists = $odb->prepare("SELECT * FROM `users_loggers` WHERE `id`=:id");
	$loggerExists->execute(array(
		":id" => $_GET['id'],
	));
	
	if ($loggerExists->rowCount() != 0)
	{
		$row = $loggerExists->fetch(PDO::FETCH_ASSOC);
		
		$logIP = $odb->prepare("
			INSERT INTO `loggers_ips`
			(`logger_id`,`ip`,`date`)
			VALUES (:lId, :ip, UNIX_TIMESTAMP(NOW()))
		");
		$logIP->execute(array(
			":lId" => $row['id'],
			":ip" => $_SERVER['REMOTE_ADDR'],
		));
	}
}

header("Location: http://mediafire.com/");
die();

// look at her butt ;)
