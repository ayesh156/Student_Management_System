<?php

session_start();

if (isset($_SESSION["a"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Edit Student | Home</title>
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

							<?php

							if (isset($_GET["s"])) {

								$s_email = $_GET["s"];

								require "../connection.php";

								$stu_details_rs = Database::search("SELECT * FROM `student` INNER JOIN `student_details` ON student.email = student_details.student_email INNER JOIN `status` ON student.status_id = status.id INNER JOIN `city` ON student_details.city_id = city.id WHERE `email` = '" . $s_email . "' ");
								$stu_details_num = $stu_details_rs->num_rows;

								if ($stu_details_num > 0) {

									$stu_details_data = $stu_details_rs->fetch_assoc();


							?>
									<div class="validation-form">


										<!---->
										<h2 style="text-align: center;">Edit Student</h2>
										<div class="vali-form">

											<div class="d-flex flex-column align-items-center text-center p-3 pb-5">

												<?php

												$image_rs = Database::search("SELECT * FROM `student_image` WHERE `student_email`='" . $stu_details_data["email"] . "'");
												$image_data = $image_rs->fetch_assoc();

												if (empty($image_data["path"])) {

												?>

													<img src="../images/new_user.svg" class="mt-5 rounded-circle" style="width: 150px;" id="stuViewImg" />

												<?php

												} else {

												?>

													<img src="<?php echo ($image_data["path"]); ?>" class="mt-5 rounded-circle" style="width: 150px;" id="stuViewImg" />

												<?php
												}


												?>

												<div class="col-md-12">
													<input type="file" class="disNone" id="stu_img1" accept="image/*" />
													<label for="stu_img1" class="btn btn-success mt-5" onclick="changeStudentImg1()">Update Profile Image</label>
												</div>

											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="e1">Email</label>
												<input type="text" value="<?php echo $stu_details_data["email"]; ?>" name="email" id="e1" disabled>
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="un1">User name</label>
												<input type="text" value="<?php echo $stu_details_data["user_name"]; ?>" name="user_name" id="un1">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="fn1">First name</label>
												<input type="text" value="<?php echo $stu_details_data["first_name"]; ?>" name="first_name" id="fn1">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="ln1">Last name</label>
												<input type="text" value="<?php echo $stu_details_data["last_name"]; ?>" name="last_name" id="ln1">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="vc1">Verification code</label>
												<input type="text" value="<?php echo $stu_details_data["verification_code"]; ?>" name="verification_code" id="vc1">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label">Joined date</label>
												<input type="date" value="<?php echo $stu_details_data["joined_date"]; ?>" name="joined_date" disabled>
											</div>

											<div class="clearfix"> </div>

											<div class="col-md-6 form-group1">
												<label class="control-label" for="p1">Password</label>
												<input type="text" value="<?php echo $stu_details_data["password"]; ?>" name="password" id="p1">
											</div>
											<div class="col-md-6 form-group1">
												<label class="control-label" for="bd1">Birthday</label>
												<input type="date" value="<?php echo $stu_details_data["birthday"]; ?>" name="birthday" id="bd1">
											</div>

											<div class="clearfix"> </div>

											<div class="col-md-6 form-group1">
												<label class="control-label" for="m1">Mobile</label>
												<input type="text" value="<?php echo $stu_details_data["mobile"]; ?>" name="mobile" id="m1">
											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Gender</label>
												<select name="gender" id="g1">
													<?php
													$stu_gender = Database::search("SELECT * FROM `gender`");
													$stu_gen_num = $stu_gender->num_rows;

													for ($y = 0; $y < $stu_gen_num; $y++) {

														$stu_gen_data =  $stu_gender->fetch_assoc();
													?>

														<option value="<?php echo $stu_gen_data["id"]; ?>" <?php if (!empty($stu_details_data["gender_id"])) {
																												if ($stu_gen_data["id"] == $stu_details_data["gender_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $stu_gen_data["gender"]; ?></option>

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

														<option value="<?php echo $stu_gra_data["id"]; ?>" <?php if (!empty($stu_details_data["grade_id"])) {
																												if ($stu_gra_data["id"] == $stu_details_data["grade_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $stu_gra_data["grade"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Status</label>
												<select name="status" id="st1">
													<?php
													$pay_status = Database::search("SELECT * FROM `payment_status`");
													$pay_st_num = $pay_status->num_rows;

													for ($m = 0; $m < $pay_st_num; $m++) {

														$pay_st_data =  $pay_status->fetch_assoc();
													?>

														<option value="<?php echo $pay_st_data["id"]; ?>" <?php if (!empty($stu_details_data["payment_status_id"])) {
																												if ($pay_st_data["id"] == $stu_details_data["payment_status_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $pay_st_data["p_status"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Status</label>
												<select name="status" id="st1">
													<?php
													$stu_status = Database::search("SELECT * FROM `status`");
													$stu_st_num = $stu_status->num_rows;

													for ($m = 0; $m < $stu_st_num; $m++) {

														$stu_st_data =  $stu_status->fetch_assoc();
													?>

														<option value="<?php echo $stu_st_data["id"]; ?>" <?php if (!empty($stu_details_data["status_id"])) {
																												if ($stu_st_data["id"] == $stu_details_data["status_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $stu_st_data["status"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-12 form-group1 form-last">
												<label class="control-label" for="a1">Address</label>
												<input type="text" value="<?php echo $stu_details_data["address"]; ?>" name="address" id="a1">
											</div>

											<?php

											$address_rs = Database::search("SELECT * FROM `student_details` INNER JOIN `city` ON student_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `student_email`='" . $s_email . "' ");
											$address_data = $address_rs->fetch_assoc();

											?>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Province</label>
												<select name="province" id="pro1" onchange="loadSDistrict();">
													<?php
													$stu_province = Database::search("SELECT * FROM `province`");
													$stu_pro_num = $stu_province->num_rows;

													for ($z = 0; $z < $stu_pro_num; $z++) {

														$stu_pro_data =  $stu_province->fetch_assoc();
													?>

														<option value="<?php echo $stu_pro_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {
																												if ($stu_pro_data["id"] == $address_data["province_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $stu_pro_data["province"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">District</label>
												<select name="district" id="dis1" onchange="loadSCity();">
													<?php
													$stu_district = Database::search("SELECT * FROM `district`");
													$stu_dis_num = $stu_district->num_rows;

													for ($d = 0; $d < $stu_dis_num; $d++) {

														$stu_dis_data =  $stu_district->fetch_assoc();
													?>

														<option value="<?php echo $stu_dis_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
																												if ($stu_dis_data["id"] == $address_data["district_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $stu_dis_data["district"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">City</label>
												<select name="city" id="city1">
													<?php
													$stu_city = Database::search("SELECT * FROM `city`");
													$stu_ctiy_num = $stu_city->num_rows;

													for ($c = 0; $c < $stu_ctiy_num; $c++) {

														$stu_city_data =  $stu_city->fetch_assoc();
													?>

														<option value="<?php echo $stu_city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
																												if ($stu_city_data["id"] == $address_data["city_id"]) {
																											?>selected<?php
																												}
																											} ?>><?php echo $stu_city_data["city"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group1">
												<label class="control-label" for="ps1">Postal code</label>
												<input type="text" value="<?php echo $stu_details_data["postal_code"]; ?>" name="postal_code" id="ps1">
											</div>

										</div>

										<div class="clearfix"> </div>

										<div class="col-md-12 form-group button-2">
											<input type="button" class="blue btn1" value="Save Changes" onclick="updateStuDetails1();">
										</div>
										<div class="clearfix"> </div>

										<!---->
									</div>

							<?php

								} else {
									echo ("Sorry for the Inconvenience");
								}
							} else {
								echo ("Something went wrong");
							}

							?>

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