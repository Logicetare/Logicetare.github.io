<?php

ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';


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

$currentPage = "tools";
$pageon = "Port Scan";
$plansql = $odb -> prepare("SELECT `users`.*,`plans`.`name`, `plans`.`mbt`,`plans`.`max_boots` AS `pboots` FROM `users`, `plans` WHERE `plans`.`ID` = `users`.`membership` AND `users`.`ID` = :id LIMIT 1");
$plansql -> execute(array(":id" => $_SESSION['ID']));
$userInfo = $plansql -> fetch(PDO::FETCH_ASSOC);
						
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
	
	<script type="text/javascript" src="js/main.js"></script>
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
						<i class="pe-7f-gleam"></i>
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
<?php

$result = "";
$success = false;

if (isset($_POST['runScan'], $_POST['address']) && !empty($_POST['address'])) {
	if (filter_var($_POST['address'], FILTER_VALIDATE_IP) || filter_var($_POST['address'], FILTER_VALIDATE_URL)) {
		if (!preg_match("/^(192\.168\.|127)/is", $_POST['address']) &&
			!preg_match("/(linux-solution.net)/is", $_POST['address'])) {
			$addr = preg_replace("/(https?:\/\/)/is", "", $_POST['address']);
			$addr = rtrim($addr, "/");
			$addr = escapeshellarg($addr);
			exec("nmap -T5 --host-timeout 4s --min-rate 1000 -PN -p U:1194,T:21,22,25,53,80,110,111,143,443,465,993,995,3306,8443,553,554,1080,3128,6515,6588,8000,8008,8080,8081,8088,8090,8118,8880,8909,1723,7080 " . $addr . " 2>&1", $results);
			$success = true;
			
			array_shift($results);
			array_shift($results);
		} else {
			$result = "What do you think you are doing?";
		}
	} else {
		$result = "Please enter a valid IP address or domain.";
	}
}

if (!empty($result)) {
	echo "<div class='alert alert-" . ($success ? "success" : "danger") . "'>" . $result . "</div>";
}

?>

			
					<div class="<?php echo ($success === false ? "col-md-6 col-md-offset-3" : "col-md-7"); ?>">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title" style="width:100%;">
									<i class="pe-7s-server"></i><h3>Port Scanner</h3>
								</div>
							</header>

							<div class="widget__content">
							<form action="" method="POST">
								<input name="address" type="text" placeholder="Address or domain"/>
								<button type="submit" name="runScan">Run Port Scanner</button>
							</form>
						</div>
						</article>
					</div>
<?php
if ($success === true) {
?>
			
					<div class="col-md-5">
						<article class="widget widget__form">
							<header class="widget__header">
								<div class="widget__title" style="width:100%;">
									<i class="pe-7s-server"></i><h3>Port Scan Results</h3>
								</div>
							</header>

							<div class="widget__content filled">
								<pre style="overflow:hidden;height:auto;width:100%;background:none;border:none;color:#FFF;">

<?php echo implode(PHP_EOL, $results); ?>

								</pre>
							</div>
						</article>
					</div>

<?php
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