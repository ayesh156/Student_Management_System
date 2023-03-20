<!DOCTYPE HTML>
<html>

<head>
	<title>Teacher | Login</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
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
	<!--clock init-->
	<link rel="stylesheet" href="../myStyle.css" type='text/css' />
</head>

<body>
	<!--/login-->

	<div class="error_page">
		<!--/login-top-->

		<div class="error-top">

			<h2 class="inner-tittle page">Login</h2>

			<div class="login">
				<h3 class="inner-tittle t-inner">Teacher Login</h3>

				<div class="buttons login">
					<ul>
						<li><a href="#" class="hvr-sweep-to-right">Facebook</a></li>
						<li class="lost"><a href="#" class="hvr-sweep-to-left">Twitter</a> </li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<input type="text" class="text" id="t_uname" name="t_username" placeholder="Username" />
				<input type="password" class="text" id="t_pwd" name="t_Password" placeholder="Password" />
				<div class="submit"><input type="submit" value="Send Verification Code" name="admin_signin" id="subBtn" onclick="tchVerification();"></div>
				<div class="clearfix"></div>
			</div>

		</div>


		<!--//login-top-->
	</div>

	<!--//login-->

	<!-- /Modal Teacher Verification -->
	<div class="modal fade" id="verificationModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Teacher Verification</h4>
				</div>
				<div class="modal-body">
					<label class="form-label">Enter Your Verification Code</label>
					<input type="text" class="text" id="tvcode">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary mSave" onclick="verify();">Verify</button>
				</div>
			</div>
		</div>
	</div>

	<!-- //Modal Teacher Verification -->

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
	<div class="footer">
		<div class="error-btn">
			<a class="read fourth" href="../index.php">Return to Home</a>
		</div>
		<p>Copyright ©2022 All rights reserved by : <a target="_blank">AlphaTech System</a></p>
	</div>
	<!--footer section end-->

	<!--js -->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/myScript.js"></script>

</body>

</html>