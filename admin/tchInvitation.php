<?php

session_start();

require "../connection.php";

if (isset($_SESSION["a"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Send Invitation Teachers | Home</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" href="../images/icon.svg" />
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<!-- Graph CSS -->
		<link href="css/font-awesome.css" rel="stylesheet">
		<!-- jQuery -->
		<link href='//fonts.googleapis.com/css?family=Roboto:700,500,300,100italic,100,400' rel='stylesheet' type='text/css'>
		<!-- lined-icons -->
		<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
		<!-- //lined-icons -->
		<script src="js/jquery-1.10.2.min.js"></script>
		<script src="js/amcharts.js"></script>
		<script src="js/serial.js"></script>
		<script src="js/light.js"></script>
		<script src="js/radar.js"></script>
		<link href="css/barChart.css" rel='stylesheet' type='text/css' />
		<link href="css/fabochart.css" rel='stylesheet' type='text/css' />
		<!--clock init-->
		<script src="js/css3clock.js"></script>
		<!--Easy Pie Chart-->
		<!--skycons-icons-->
		<script src="js/skycons.js"></script>

		<script src="js/jquery.easydropdown.js"></script>

		<!--//skycons-icons-->

		<!--clock init-->
		<link rel="stylesheet" href="../myStyle.css" type='text/css' />

	</head>

	<body>
		<div class="page-container">
			<!--/content-inner-->
			<div class="left-content">
				<div class="inner-content">
					<!-- header-starts -->
					<div class="header-section">

						<div class="clearfix"></div>
					</div>
					<div class="outter-wp">
						<div class="sub-heard-part">
							<ol class="breadcrumb m-b-0">
								<li><a href="home.php">Home</a></li>
								<li class="active">Send invitations to teachers</li>
							</ol>
						</div>

						<div class="forms-main">

							<div class="graph-form">
								<div class="validation-form">
									<!---->
									<h2 style="text-align: center;">Send invitations to teachers</h2>

									<div class="col-md-12 form-group1 group-mail">
										<label class="control-label" for="ti_e">Email</label>
										<input type="text" placeholder="Email" name="email" id="ti_e">
									</div>
									<div class="col-md-12 form-group1 group-mail">
										<label class="control-label" for="ti_p">Username</label>
										<input type="text" placeholder="Username" name="username" id="ti_u">
									</div>
									<div class="col-md-12 form-group1 group-mail">
										<label class="control-label" for="ti_p">Password</label>
										<input type="text" placeholder="Password" name="password" id="ti_p">
									</div>


									<div class="clearfix"> </div>
									<div class="col-md-12 form-group button-2">
										<input type="button" class="blue btn1" value="Send Invitation" onclick="sendTchInvite()">
									</div>
									<div class="clearfix"> </div>

									<!---->
								</div>

							</div>
						</div>
						<!--//forms-->
					</div>

					<!-- /Modal Msg -->
					<div class="modal fade" id="alertmodel" tabindex="-1">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								</div>
								<div class="modal-body">
									<h2 class="modal-title text-center" id="alertmessage"></h2>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

					<!-- //Modal Msg -->

					<!--footer section start-->
					<footer>
						<p>Copyright ©2022 All rights reserved by : <a target="_blank">AlphaTech System</a></p>
					</footer>
					<!--footer section end-->

					<!--//content-inner-->
					<!--/sidebar-menu-->
					<?php include "sidebar-menu.php"; ?>

					<div class="clearfix"></div>

				</div>
				<!--js -->
				<link rel="stylesheet" href="css/vroom.css">
				<script type="text/javascript" src="js/vroom.js"></script>
				<script type="text/javascript" src="js/TweenLite.min.js"></script>
				<script type="text/javascript" src="js/CSSPlugin.min.js"></script>
				<script src="js/jquery.nicescroll.js"></script>
				<script src="js/scripts.js"></script>

				<!-- Bootstrap Core JavaScript -->
				<script src="js/bootstrap.min.js"></script>
				<script src="js/myScript.js"></script>
	</body>

	</html>

<?php

} else {
	header("Location:index.php");
}

?>