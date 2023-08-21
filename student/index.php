<!DOCTYPE HTML>
<html>

<head>
	<title>Student | Login</title>
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
				<h3 class="inner-tittle t-inner">Student Login</h3>

				<div class="buttons login">
					<ul>
						<li><a href="#" class="hvr-sweep-to-right">Facebook</a></li>
						<li class="lost"><a href="#" class="hvr-sweep-to-left">Twitter</a> </li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<input type="text" class="text" id="s_uname" name="s_username" placeholder="Username" />
				<input type="password" class="text" id="s_pwd" name="s_Password" placeholder="Password" />
				<div class="submit"><input type="submit" value="Send Verification Code" name="admin_signin" id="subBtn" onclick="stuVerification();"></div>
				<div class="clearfix"></div>
			</div>

		</div>


		<!--//login-top-->
	</div>

	<!--//login-->

	<!-- /Modal Student Verification -->
	<div class="modal fade" id="verificationModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Student Verification</h4>
				</div>
				<div class="modal-body">
					<label class="form-label">Enter Your Verification Code</label>
					<input type="text" class="text" id="svcode">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary mSave" onclick="verify();">Verify</button>
				</div>
			</div>
		</div>
	</div>

	<!-- /Modal Student Payment -->
	<div class="modal fade" id="epaymentModal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h2 class="modal-title text-center">Enrollment payment</h2>
					<h4 class="modal-title text-center">Your trial period has now ended. Please pay the enrollment fee of Rs.1000.00</h4>
				</div>
				<div class="modal-body">

					<div class="col-md-12 form-group1 mt-20">
						<label class="control-label" for="un2">User name</label>
						<input type="text" name="user_name" class="text-dark" placeholder="User name" id="un3">
					</div>
					<div class="col-md-12 form-group1">
						<label class="control-label" for="p2">Password</label>
						<input type="password" name="password" class="text-dark" placeholder="Password" id="p3">
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<button type="submit" id="payhere-payment" class="btn btn-primary mSave" onclick="enPayNow();">Paynow</button>
				</div>
			</div>
		</div>
	</div>

	<!-- //Modal Student Payment -->

	<!-- //Modal Student Verification -->

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
	<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

</body>

</html>