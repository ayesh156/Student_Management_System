<?php

session_start();

if (isset($_SESSION["ao"])) {

?>

<!DOCTYPE HTML>
<html>

<head>
	<title>Add Student | Home</title>
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

	<link rel="stylesheet" href="../myStyle.css" type='text/css' />

</head>

<body>


	<div class="page-container">
		<!--/content-inner-->
		<div class="left-content">
			<div class="inner-content">

				<div class="forms-main">

					<div class="graph-form">

						<div class="validation-form">


							<!---->
							<h2 style="text-align: center;">Add Student</h2>
							<div class="vali-form">

								<div class="d-flex flex-column align-items-center text-center p-3 pb-5">

									<img src="../images/new_user.svg" class="mt-5 rounded-circle" style="width: 150px;" id="stuViewImg" />

									<div class="col-md-12">
										<input type="file" class="disNone" id="stu_img" accept="image/*" />
										<label for="stu_img" class="btn btn-success mt-5" onclick="changeStudentImg()">Update Profile Image</label>
									</div>

								</div>

								<div class="col-md-6 form-group1 form-last">
									<label class="control-label" for="e1">Email</label>
									<input type="text" placeholder="Email" name="email" id="e1">
								</div>

								<div class="col-md-6 form-group1 form-last">
									<label class="control-label" for="un1">User name</label>
									<input type="text" placeholder="User name" name="user_name" id="un1">
								</div>

								<div class="col-md-6 form-group1 form-last">
									<label class="control-label" for="fn1">First name</label>
									<input type="text" placeholder="First name" name="first_name" id="fn1">
								</div>

								<div class="col-md-6 form-group1">
									<label class="control-label" for="ln1">Last name</label>
									<input type="text" placeholder="First name" name="last_name" id="ln1">
								</div>

								<div class="col-md-6 form-group1">
									<label class="control-label" for="p1">Password</label>
									<input type="text" placeholder="Password" name="password" id="p1">
								</div>

								<div class="col-md-6 form-group1">
									<label class="control-label" for="bd1">Birthday</label>
									<input type="date" placeholder="Birthday" name="birthday" id="bd1">
								</div>

								<div class="clearfix"> </div>

								<div class="col-md-6 form-group1">
									<label class="control-label" for="m1">Mobile</label>
									<input type="text" placeholder="Mobile" name="mobile" id="m1">
								</div>

								<div class="col-md-6 form-group2 group-mail">
									<label class="control-label">Gender</label>
									<select name="gender" id="g1">
										<?php

										require "../connection.php";

										$stu_gender = Database::search("SELECT * FROM `gender`");
										$stu_gen_num = $stu_gender->num_rows;

										for ($y = 0; $y < $stu_gen_num; $y++) {

											$stu_gen_data =  $stu_gender->fetch_assoc();
										?>

											<option value="<?php echo $stu_gen_data["id"]; ?>"><?php echo $stu_gen_data["gender"]; ?></option>

										<?php
										}
										?>
									</select>

								</div>

								<div class="clearfix"> </div>

								<div class="col-md-6 form-group2 group-mail">
									<label class="control-label">Grade</label>
									<select name="grade" id="gd1">
										<?php
										$stu_grade = Database::search("SELECT * FROM `grade`");
										$stu_gra_num = $stu_grade->num_rows;

										for ($n = 0; $n < $stu_gra_num; $n++) {

											$stu_gra_data =  $stu_grade->fetch_assoc();
										?>

											<option value="<?php echo $stu_gra_data["id"]; ?>"><?php echo $stu_gra_data["grade"]; ?></option>

										<?php
										}
										?>
									</select>

								</div>

								<div class="col-md-12 form-group1 form-last">
									<label class="control-label" for="a1">Address</label>
									<input type="text" placeholder="Address" name="address" id="a1">
								</div>

								<div class="col-md-6 form-group2 group-mail">
									<label class="control-label">Province</label>
									<select name="province" id="pro1" onchange="loadSDistrict();">
										<?php
										$stu_province = Database::search("SELECT * FROM `province`");
										$stu_pro_num = $stu_province->num_rows;

										for ($z = 0; $z < $stu_pro_num; $z++) {

											$stu_pro_data =  $stu_province->fetch_assoc();
										?>

											<option value="<?php echo $stu_pro_data["id"]; ?>"><?php echo $stu_pro_data["province"]; ?></option>

										<?php
										}
										?>
									</select>

								</div>

								<div class="col-md-6 form-group2 group-mail">
									<label class="control-label">District</label>
									<select name="district" id="dis1" onchange="loadSCity();">
										<?php
										$stu_district = Database::search("SELECT * FROM `district` WHERE `province_id` = '1'");
										$stu_dis_num = $stu_district->num_rows;

										for ($d = 0; $d < $stu_dis_num; $d++) {

											$stu_dis_data =  $stu_district->fetch_assoc();
										?>

											<option value="<?php echo $stu_dis_data["id"]; ?>"><?php echo $stu_dis_data["district"]; ?></option>

										<?php
										}
										?>
									</select>

								</div>

								<div class="col-md-6 form-group2 group-mail">
									<label class="control-label">City</label>
									<select name="city" id="city1">
										<?php
										$stu_city = Database::search("SELECT * FROM `city` WHERE `district_id` = '1'");
										$stu_ctiy_num = $stu_city->num_rows;

										for ($c = 0; $c < $stu_ctiy_num; $c++) {

											$stu_city_data =  $stu_city->fetch_assoc();
										?>

											<option value="<?php echo $stu_city_data["id"]; ?>"><?php echo $stu_city_data["city"]; ?></option>

										<?php
										}
										?>
									</select>

								</div>

								<div class="col-md-6 form-group1">
									<label class="control-label" for="ps1">Postal code</label>
									<input type="text" placeholder="Postal code" name="postal_code" id="ps1">
								</div>

							</div>

							<div class="clearfix"> </div>

							<div class="col-lg-7 form-group button-2">
								<input type="button" class="blue btn1 mr-10 col-md-3" value="Register" onclick="addStudent();">
								<input type="button" class="green btn1 mr-10 col-md-3" value="Send Verification" onclick="sendStuVerification();">
								<input type="button" class="red btn1 col-md-3" value="Reset" onclick="window.location = 'add-student.php';">
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