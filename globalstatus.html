<?php
ob_start();
require_once 'includes/db.php';
require_once 'includes/init.php';
error_reporting(0);
//ini_set("display_errors", "on");
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

$currentPage = "booter";
$pageon = "Global Attack Status";
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
						<i class="pe-7f-plane"></i>
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
		
				<div class="row">
 <form action="" method="POST">
					

					<div class="col-md-12">
						<article class="widget">
							<header class="widget__header">
								<div class="widget__title" style="width:100%;">
									<i class="pe-7s-mouse"></i><h3><?php echo $pageon ?></h3>
								</div>
							</header>

							<div class="widget__content table-responsive">
								
								<table class="table table-striped media-table">
									  	<thead>
									  		<tr>
									   <th style="width:95px;">ID</th>
										<th>Host</th>
										<th style="width:85px;">Port</th>
										<th style="width:85px;">Time</th>
										<th style="width:145px;">Server Used</th>
                                                                           <th style="width:85px;">Method</th>
<th style="width:300px;">Time Left</th>
									</tr>
								</thead>
								<tbody>
<?php
				  $SQLSelectRunningAttack = $odb -> query("SELECT * FROM `logs` WHERE `time` + `date` > UNIX_TIMESTAMP() AND `stopped` = 0 ORDER BY `ID` DESC");
				  while ($show = $SQLSelectRunningAttack -> fetch(PDO::FETCH_ASSOC))
				  {
					$ip = htmlentities($show['ip']);
					$port = htmlentities($show['port']);
					$time = htmlentities($show['time']);
					$method = htmlentities($show['method']);
					$rowID = htmlentities($show['ID']);
					$server = htmlentities($show['server_used']);
					echo '<tr class="spacer"></tr><tr class="boot-' . $rowID . '"><td>'.$rowID.'</td><td>'.$ip.'</td><td>'.$port.'</td><td>'.$time.'</td><td>' . ($server === "*" ? "All" : $server) . '</td><td>'.$method.'</td><td>';
					
					//echo date("r", ($show['time'] + $show['date'])) . "<br />";
					
					?>
					<script type="text/javascript">
		jQuery(function (){
			$(".att-<?php echo $rowID; ?>").countdown({
				until : <?php echo abs(time()-($show['date']+$show['time'])); ?>,
				layout : " in {hn} {hl}, {mn} {ml} and {sn} {sl}",
				onExpiry : function () {
					$(".att-<?php echo $rowID; ?>").html("Boot finished");
					$("tr.boot-<?php echo $rowID; ?>").delay(6666).fadeOut();
				}
			});
		});
	</script>
	<div class='att-<?php echo $rowID; ?>'></div>
					<?php echo '</td></tr>'; 
				  }
				 ?>
				 
</tbody>
										</table>
										



							</div>
						</article><!-- /widget -->
					</div>
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