<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
include("includes/googl.php");
error_reporting(0);
ini_set("display_errors", "on");
if (!($user -> LoggedIn()))
{
	header('location: login.php');
	die();
}
if (!($user->hasMembership($odb)))
{
	header('location: purchase.php');
	die();
}
if (!($user -> notBanned($odb)))
{
	header('location: login.php');
	die();
}
$plansql = $odb -> prepare("SELECT `users`.*,`plans`.`name`, `plans`.`mbt`,`plans`.`max_boots` AS `pboots` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id LIMIT 1");
$plansql -> execute(array(":id" => $_SESSION['ID']));
$userInfo = $plansql -> fetch(PDO::FETCH_ASSOC);

$currentPage = "tools";
$pageon = "IP Logger";
$page = "main";
$pages = array("main", "logger","purge","create","empty");

if (isset($_GET['page']) && !empty($_GET['page']) && is_string($_GET['page'])
		&& in_array($_GET['page'], $pages))
	$page = $_GET['page'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $bootername; ?><?php echo $pageon ?></title>
	
	<link rel="icon" sizes="192x192" href="img/touch-icon.png" /> 
	<link rel="apple-touch-icon" href="img/touch-icon-iphone.png" /> 
	<link rel="apple-touch-icon" sizes="76x76" href="img/touch-icon-ipad.png" /> 
	<link rel="apple-touch-icon" sizes="120x120" href="img/touch-icon-iphone-retina.png" />
	<link rel="apple-touch-icon" sizes="152x152" href="img/touch-icon-ipad-retina.png" />
	
	<link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico" />

	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/main.min.css">
	
	<script type="text/javascript" src="js/main.js?v1"></script>
</head>
<body>

	<header class="top-bar">
			<?php include "includes/template/header.php"; ?>
			
	</header> <!-- /top-bar -->


	<div class="wrapper">

		<aside class="sidebar">
	<?php include "includes/template/sidebar.php"; ?>
			
		</aside> <!-- /sidebar -->
		
		<section class="content">
			<header class="main-header">
				<div class="main-header__nav">
					<h1 class="main-header__title">
						<i class="pe-7s-display2"></i>
						<span><?php echo $pageon ?></span>
					</h1>
					<ul class="main-header__breadcrumb">
						<li><a href="#" onclick="return false;"><?php include 'includes/name.php'; ?></a></li>
						<li><a href="#" onclick="return false;"><?php echo $pageon ?></a></li>
						
					</ul>
				</div>
				
				<div class="main-header__date">
					<input type="radio" id="radio_date_1" name="tab-radio" value="today" checked><!--
					--><input type="radio" id="radio_date_2" name="tab-radio" value="yesterday"><!--
					--><button>
						<i class="pe-7f-date"></i>
						<span><?php echo date('m-d-Y' ,$userInfo['expire']); ?></span>
					</button>
				</div>
			</header> 

				<!-- /main-header -->
<!-- /row -->
<?php
	$error = null;
	switch ($page)
	{
		case "logger":
		case "empty":
			if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id']))
			{
				$getLogger = $odb->prepare("
					SELECT `ul`.*, `l`.`address`
					FROM `users_loggers` AS `ul`
					LEFT JOIN `loggers` AS `l`
					ON `l`.`logger_id` = `ul`.`logger_id`
					WHERE `ul`.`id` = :id AND `ul`.`user_id` = :uid
				");
				$getLogger->execute(array(
					":id" => $_GET['id'],
					":uid" => $_SESSION['ID'],
				));
				
				if ($getLogger->rowCount()) {
					$logger = $getLogger->fetch(PDO::FETCH_ASSOC);
					
					if ($page == "empty") {
						$wipeIps = $odb->prepare("DELETE FROM `loggers_ips` WHERE `logger_id` = :id");
						$wipeIps->execute(array(
							":id" => $_GET['id'],
						));
						
						echo "<div class='alert alert-success'>Removed " . $wipeIps->rowCount() . " from this logger</div>";
					}
?>
<div class="row"> 
					<div class="col-md-12">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title" >
									<i class="pe-7s-menu"></i><h3>Your Logger: <?php echo htmlentities($logger['name']); ?></h3>
								</div>
								<div class="widget__config">
									<a href="?page=main" class="override"><i class="pe-7s-close"></i></a>
									<a href="?page=empty&id=<?php echo $_GET['id']; ?>" class="override" onclick="return confirm('Are you sure you wish to remove all addresses from this logger? This action cannot be undone!');"><i class="pe-7s-trash"></i></a>
								</div>
							</header>

							<div class="widget__content">
									<!-- Don't ask -->
								 <input name="LOLLOOOLLOLNIGIGIGILOOOOOOOOLapplejuiceLovesJuice[]" value="<?php echo str_replace("%", $logger['id'], $logger['address']); ?>" type="text" readonly="readonly" />
								 <?php
									echo (isset($logger['minified_url']) && !empty($logger['minified_url']) && !is_null($logger['minified_url']) ?
										'<input name="minified_url" value="' . $logger['minified_url'] .'" type="text" readonly="readonly" />' : ''); ?>
								
						</div>
					</div>
					

					
						</article><!-- /widget -->

					<div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title" style="width:100%;">
									<i class="pe-7s-display2"></i><h3>Logged IP'S</h3>
								</div>
							</header>

							<div class="widget__content table-responsive">
								
								<table class="table table-striped media-table">
									  	<thead>
									  		<tr>
                                               
                                                    <th style="width:50%">IP</th>
                                                    <th>Date</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
								$SQLGetLogs = $odb -> prepare("SELECT * FROM `loggers_ips` WHERE `logger_id`=:id ORDER BY ABS(`date`) DESC;");
								$SQLGetLogs -> execute(array(':id' => $logger['id']));
								if ($SQLGetLogs->rowCount() != 0) {
									while($getInfo = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
									{
										$loggedIP = htmlentities($getInfo['ip']);
										$date = date("m-d-Y, h:i:s a" ,$getInfo['date']);
										echo '<tr class="spacer"></tr><tr><td><center>'.$loggedIP.'</center></td><td><center>'.$date.'</center></td></tr>';
									}
								} else {
									echo "<tr class='spacer'></tr><tr><td colspan='2'>No IP addresses logged</td></tr>";
								}
									
								?>
								</tbody>
										</table>
										



							</div>
						</article><!-- /widget --> 
					</div>
					
					
<?php
				} else {
					echo "<div class='g_12'><div class='alert alert-danger'>ERROR: Either this logger does not exist, or you do not have access to it.</div></div>";
				}
			} else {
				echo "<div class='g_12'><div class='alert alert-danger'>ERROR: Either this logger does not exist, or you do not have access to it.</div></div>";
			}
		break;
		case "create":
			/**
			 * Logger create start
			 */
			 if (isset($_POST['create'])) {
				if (isset($_POST['name']) && !empty($_POST['name']) && is_string($_POST['name'])) {
					if (mb_strlen($_POST['name']) <= 36) {
						$name = $_POST['name'];
					} else {
						$error = "Name cannot be more than 36 chars.";
					}
				} else {
					$error = "Name is required";
				}
				
				if (isset($_POST['logger']) && !empty($_POST['logger']) && is_numeric($_POST['logger']))
				{
					$getLogger = $odb->prepare("SELECT * FROM `loggers` WHERE `logger_id` = :lid");
					$getLogger->execute(array(":lid" => $_POST['logger']));
					if ($getLogger->rowCount() != 0) {
						$logger = $getLogger->fetch(PDO::FETCH_ASSOC);
					} else {
						$error = "Invalid logger chosen";
					}
				}
				
				if ($error === null)
				{
					$createLoggers = $odb->prepare("
						INSERT INTO `users_loggers`
						(`name`,`logger_id`,`user_id`,`date`)
						VALUE(:name,:lid,:uid,UNIX_TIMESTAMP(NOW()))
					");
					$createLoggers->execute(array(
						":name" => $name,
						":lid" => $logger['logger_id'],
						":uid" => $_SESSION['ID'],
					));
					
					if ($createLoggers->rowCount() != 0) {
						$loggerId = $odb->lastInsertId("id");
						
						$googl = new Googl();
						$addr = $googl->shorten(str_replace("%", $loggerId, $logger['address']));
						
						$updateLogger = $odb->prepare("UPDATE `users_loggers` SET `minified_url` = :url WHERE `id`=:id");
						$updateLogger->execute(array(
							":url" => $addr,
							":id" => $loggerId,
						));
						
						echo "<div class='g_12'><div class='alert alert-success'>SUCCESS: Your logger has been created!</div></div>";
					} else {
						$error = "Unexpected error whilst creating the logger, please contact support";
					}
					
					
				}
			 }
			 
			 if ($error !== null) {
				 echo "<div class=\"g_12\"><div class=\"alert alert-danger\">ERROR: " . $error . "</div></div>";
			 }
?>
<div class="row">
 <form action="" method="POST">
					<div class="col-md-12">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-menu"></i><h3>Create Logger</h3>
								</div>
								<div class="widget__config" >
									<a href="?page=main" class="override"><i class="pe-7s-close"></i></a>
								</div>
							</header>

							<div class="widget__content">
								 <input name="name" maxlength="36" value="" placeholder="Logger Name" type="text"/>
								
								<label for="logger">Logger Address:</label>
								<select name="logger" id="logger" class="btn btn-block gray dropdown-toggle" style='color:#000'>
<?php
	$fetchLoggers = $odb->query("SELECT * FROM `loggers`");
	if ($fetchLoggers->rowCount() != 0)
	{
		while ($row = $fetchLoggers->fetch(PDO::FETCH_ASSOC))
		{
			echo "<option value=\"" . $row['logger_id'] . "\">" . $row['address'] . "</option>";
		}
	}
?>
								</select>
								<p>Notice: The percentage (%) represents the ID of your logger!</p>
								
								
								
								<button type="submit" name="create">Create</button>
								<a href="?page=main" class='btn blue'>Cancel</a>
								
						</div>
					</div>
					

					
						</article><!-- /widget -->
					</div>
<?php
			/**
			 * Logger create end
			 */
		break;
		default:
			// render pages with main page (to be faannccyyyyyyyyyy)
			switch ($page)
			{
				case "purge":
					$purgeAddrs = $odb->prepare("
						DELETE FROM `loggers_ips`
						WHERE `logger_id` IN (
							SELECT `id`
							FROM `users_loggers`
							WHERE `user_id` = :uid
						)
					");
					$purgeAddrs->execute(array(
						":uid" => $_SESSION['ID'],
					));
					
					echo "<div class='g_12'><div class='alert alert-success'>
						Successfully deleted " . $purgeAddrs->rowCount() . " addresses
						</div></div>";
				break;
			}
			/**
			 * Main page start
			 */
?>
<div class="row">
 <form action="" method="POST">
					<div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title">
									<i class="pe-7s-display2"></i><h3>Your IP Loggers</h3>
								</div>
								<div class="widget__config">
									<a href="?page=create" class="override"><i class="pe-7s-plus"></i></a>
									<a href="?page=purge" class="override" onclick="return confirm('Are you sure you wish to purge all logged ip addresses? This action cannot be undone!');"><i class="pe-7s-trash"></i></a>
								</div>
							</header>

						<div class="widget__content table-responsive">
								
								<table class="table table-striped media-table">
									  	<thead>
									  		<tr>
                                               
                                                    <th>ID</th>
													<th>Name</th>
													<th>Address</th>
													<th>Minified URL</th>
                                                    <th>Date Created</th>
                                                    <th>Actions</th>
                                                 
                                                </tr>
                                            </thead>
                                            <tbody>
                                               <?php
								$SQLGetLogs = $odb -> prepare("
									SELECT `ul`.*, `l`.`address`
									FROM `users_loggers` AS `ul`
									LEFT JOIN `loggers` AS `l`
									ON `l`.`logger_id` = `ul`.`logger_id`
									WHERE `ul`.`user_id` = :id
								");
								$SQLGetLogs -> execute(array(':id' => $_SESSION['ID']));
								if ($SQLGetLogs->rowCount() != 0) {
									while($row = $SQLGetLogs -> fetch(PDO::FETCH_ASSOC))
									{
										echo '<tr class="spacer"></tr>
											<tr>
											<td>' . htmlentities($row['id']) . '</td>
											<td>' . htmlentities($row['name']) . '</td>
											<td>' . htmlentities(str_replace("%", $row['id'], $row['address'])) . '</td>
											<td>' . htmlentities($row['minified_url']) . '</td>
											<td>' . date("m-d-Y, h:i:s a" ,$row['date']) . '</td>
											<td><a href="?page=logger&id=' . $row['id'] . '">View IPs</a></td>
										</tr>';
									}
								} else {
									echo "<tr class='spacer'></tr><tr><td colspan='6'>You have no IP loggers, create one!</td></tr>";
								}
									
								?>
								</tbody>
										</table>



										
							</div>
						</article><!-- /widget --> 
					</div>
<?php
			/**
			 * Main page end
			 */
		break;
	}
?>

		</section> <!-- /content -->

	</div>


	<script type="text/javascript" src="js/amcharts/amcharts.js"></script>
	<script type="text/javascript" src="js/amcharts/serial.js"></script>
	<script type="text/javascript" src="js/amcharts/pie.js"></script>
	<script type="text/javascript" src="js/chart.js"></script>
	
	<script type="text/javascript" src="js/countdown/jquery.plugin.js"></script>
	<script type="text/javascript" src="js/countdown/jquery.countdown.js"></script>
</body>
</html>