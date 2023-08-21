<?php

session_start();

if (isset($_SESSION["a"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Edit teacher | Home</title>
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

							if (isset($_GET["tch"])) {

								$t_email = $_GET["tch"];

								require "../connection.php";

								$tch_details_rs = Database::search("SELECT * FROM `teacher` INNER JOIN `teacher_details` ON teacher.email = teacher_details.teacher_email INNER JOIN `status` ON teacher.status_id = status.id INNER JOIN `city` ON teacher_details.city_id = city.id WHERE `email` = '" . $t_email . "' ");
								$tch_details_num = $tch_details_rs->num_rows;

								if ($tch_details_num > 0) {

									$tch_details_data = $tch_details_rs->fetch_assoc();


							?>
									<div class="validation-form">


										<!---->
										<h2 style="text-align: center;">Edit teacher</h2>
										<div class="vali-form">

											<div class="d-flex flex-column align-items-center text-center p-3 pb-5">

												<?php

												$image_rs = Database::search("SELECT * FROM `teacher_image` WHERE `teacher_email`='" . $tch_details_data["email"] . "'");
												$image_data = $image_rs->fetch_assoc();

												if (empty($image_data["path"])) {

												?>

													<img src="../images/new_user.svg" class="mt-5 rounded-circle" style="width: 150px;" id="tchViewImg" />

												<?php

												} else {

												?>

													<img src="<?php echo ($image_data["path"]); ?>" class="mt-5 rounded-circle" style="width: 150px;" id="tchViewImg" />

												<?php
												}


												?>

												<div class="col-md-12">
													<input type="file" class="disNone" id="tch_img" accept="image/*" />
													<label for="tch_img" class="btn btn-success mt-5" onclick="changeTeacherImg()">Update Profile Image</label>
												</div>

											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="e4">Email</label>
												<input type="text" value="<?php echo $tch_details_data["email"]; ?>" name="email" id="e4" disabled>
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="un4">User name</label>
												<input type="text" value="<?php echo $tch_details_data["user_name"]; ?>" name="user_name" id="un4">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="fn4">First name</label>
												<input type="text" value="<?php echo $tch_details_data["first_name"]; ?>" name="first_name" id="fn4">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="ln4">Last name</label>
												<input type="text" value="<?php echo $tch_details_data["last_name"]; ?>" name="last_name" id="ln4">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label" for="vc4">Verification code</label>
												<input type="text" value="<?php echo $tch_details_data["verification_code"]; ?>" name="verification_code" id="vc4">
											</div>

											<div class="col-md-6 form-group1 form-last">
												<label class="control-label">Joined date</label>
												<input type="date" value="<?php echo $tch_details_data["joined_date"]; ?>" name="joined_date" disabled>
											</div>

											<div class="clearfix"> </div>

											<div class="col-md-6 form-group1">
												<label class="control-label" for="p4">Password</label>
												<input type="text" value="<?php echo $tch_details_data["password"]; ?>" name="password" id="p4">
											</div>
											<div class="col-md-6 form-group1">
												<label class="control-label" for="bd4">Birthday</label>
												<input type="date" value="<?php echo $tch_details_data["birthday"]; ?>" name="birthday" id="bd4">
											</div>

											<div class="clearfix"> </div>

											<div class="col-md-6 form-group1">
												<label class="control-label" for="m4">Mobile</label>
												<input type="text" value="<?php echo $tch_details_data["mobile"]; ?>" name="mobile" id="m4">
											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Gender</label>
												<select name="gender" id="g4">
													<?php
													$tch_gender = Database::search("SELECT * FROM `gender`");
													$tch_gen_num = $tch_gender->num_rows;

													for ($y = 0; $y < $tch_gen_num; $y++) {

														$tch_gen_data =  $tch_gender->fetch_assoc();
													?>

														<option value="<?php echo $tch_gen_data["id"]; ?>" <?php if (!empty($tch_details_data["gender_id"])) {
																												if ($tch_gen_data["id"] == $tch_details_data["gender_id"]) {
																											?>selected<?php
																													}
																												} ?>><?php echo $tch_gen_data["gender"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="clearfix"> </div>

											<?php

											$tch_hs_rs = Database::search("SELECT * FROM `teacher_has_subject` WHERE `teacher_email`='" . $t_email . "' ");
											$tch_hs_data = $tch_hs_rs->fetch_assoc();

											?>


											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Subject</label>
												<select name="subject" id="sj">
													<?php

													$tch_subj = Database::search("SELECT * FROM `subject`");
													$tch_subj_num = $tch_subj->num_rows;

													for ($n = 0; $n < $tch_subj_num; $n++) {

														$tch_subj_data =  $tch_subj->fetch_assoc();
													?>

														<option value="<?php echo $tch_subj_data["id"]; ?>" <?php if (!empty($tch_hs_data["subject_id"])) {
																												if ($tch_subj_data["id"] == $tch_hs_data["subject_id"]) {
																											?>selected<?php
																													}
																												} ?>><?php echo $tch_subj_data["sub_name"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Status</label>
												<select name="status" id="st4">
													<?php
													$tch_status = Database::search("SELECT * FROM `status`");
													$tch_st_num = $tch_status->num_rows;

													for ($m = 0; $m < $tch_st_num; $m++) {

														$tch_st_data =  $tch_status->fetch_assoc();
													?>

														<option value="<?php echo $tch_st_data["id"]; ?>" <?php if (!empty($tch_details_data["status_id"])) {
																												if ($tch_st_data["id"] == $tch_details_data["status_id"]) {
																											?>selected<?php
																													}
																												} ?>><?php echo $tch_st_data["status"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-12 form-group1 form-last">
												<label class="control-label" for="a4">Address</label>
												<input type="text" value="<?php echo $tch_details_data["address"]; ?>" name="address" id="a4">
											</div>

											<?php

											$address_rs = Database::search("SELECT * FROM `teacher_details` INNER JOIN `city` ON teacher_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `teacher_email`='" . $t_email . "' ");
											$address_data = $address_rs->fetch_assoc();

											?>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">Province</label>
												<select name="province" id="pro4" onchange="loadS4District();">
													<?php
													$tch_province = Database::search("SELECT * FROM `province`");
													$tch_pro_num = $tch_province->num_rows;

													for ($z = 0; $z < $tch_pro_num; $z++) {

														$tch_pro_data =  $tch_province->fetch_assoc();
													?>

														<option value="<?php echo $tch_pro_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {
																												if ($tch_pro_data["id"] == $address_data["province_id"]) {
																											?>selected<?php
																													}
																												} ?>><?php echo $tch_pro_data["province"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">District</label>
												<select name="district" id="dis4" onchange="loadS4City();">
													<?php
													$tch_district = Database::search("SELECT * FROM `district`");
													$tch_dis_num = $tch_district->num_rows;

													for ($d = 0; $d < $tch_dis_num; $d++) {

														$tch_dis_data =  $tch_district->fetch_assoc();
													?>

														<option value="<?php echo $tch_dis_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
																												if ($tch_dis_data["id"] == $address_data["district_id"]) {
																											?>selected<?php
																													}
																												} ?>><?php echo $tch_dis_data["district"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group2 group-mail">
												<label class="control-label">City</label>
												<select name="city" id="city4">
													<?php
													$tch_city = Database::search("SELECT * FROM `city`");
													$tch_ctiy_num = $tch_city->num_rows;

													for ($c = 0; $c < $tch_ctiy_num; $c++) {

														$tch_city_data =  $tch_city->fetch_assoc();
													?>

														<option value="<?php echo $tch_city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
																												if ($tch_city_data["id"] == $address_data["city_id"]) {
																											?>selected<?php
																													}
																												} ?>><?php echo $tch_city_data["city"]; ?></option>

													<?php
													}
													?>
												</select>

											</div>

											<div class="col-md-6 form-group1">
												<label class="control-label" for="ps4">Postal code</label>
												<input type="text" value="<?php echo $tch_details_data["postal_code"]; ?>" name="postal_code" id="ps4">
											</div>

										</div>

										<div class="clearfix"> </div>

										<div class="col-md-12 form-group button-2">
											<input type="button" class="blue btn1" value="Save Changes" onclick="updateTchDetails();">
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