<?php

session_start();

if (isset($_SESSION["t"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Update Profile | Home</title>
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

					<div class="forms-main">

						<div class="graph-form">

							<?php

							$t_email = $_SESSION["t"]["teacher_email"];

							require "../connection.php";

							$t_details_rs = Database::search("SELECT * FROM `teacher` INNER JOIN `teacher_details` ON teacher.email = teacher_details.teacher_email INNER JOIN `city` ON teacher_details.city_id = city.id WHERE `email` = '" . $t_email . "' ");
							$t_details_num = $t_details_rs->num_rows;

							if ($t_details_num > 0) {

								$t_details_data = $t_details_rs->fetch_assoc();


							?>
								<div class="validation-form">


									<!---->
									<h2 style="text-align: center;">Update Profile</h2>
									<div class="vali-form">

										<div class="d-flex flex-column align-items-center text-center p-3 pb-5">

											<?php

											$image_rs = Database::search("SELECT * FROM `teacher_image` WHERE `teacher_email`='" . $t_details_data["email"] . "'");
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
												<label for="tch_img" class="btn btn-success mt-5" onclick="changeTchImg()">Update Profile Image</label>
											</div>

										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="e1">Email</label>
											<input type="text" value="<?php echo $t_details_data["email"]; ?>" name="email" id="e1" disabled>
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="un1">User name</label>
											<input type="text" value="<?php echo $t_details_data["user_name"]; ?>" name="user_name" id="un1">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="fn1">First name</label>
											<input type="text" value="<?php echo $t_details_data["first_name"]; ?>" name="first_name" id="fn1">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="ln1">Last name</label>
											<input type="text" value="<?php echo $t_details_data["last_name"]; ?>" name="last_name" id="ln1">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="bd1">Birthday</label>
											<input type="date" value="<?php echo $t_details_data["birthday"]; ?>" name="birthday" id="bd1">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="m1">Mobile</label>
											<input type="text" value="<?php echo $t_details_data["mobile"]; ?>" name="mobile" id="m1">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label">Joined Date</label>
											<input type="text" value="<?php echo $t_details_data["joined_date"]; ?>" name="joined_date" disabled>
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="p1">Password</label>
											<input type="text" value="<?php echo $t_details_data["password"]; ?>" name="password" id="p1">
										</div>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">Gender</label>
											<select name="gender" id="g1">
												<?php
												$t_gender = Database::search("SELECT * FROM `gender`");
												$t_gen_num = $t_gender->num_rows;

												for ($y = 0; $y < $t_gen_num; $y++) {

													$t_gen_data =  $t_gender->fetch_assoc();
												?>

													<option value="<?php echo $t_gen_data["id"]; ?>" <?php if (!empty($t_details_data["gender_id"])) {
																											if ($t_gen_data["id"] == $t_details_data["gender_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $t_gen_data["gender"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<?php

										$tch_hs_rs = Database::search("SELECT * FROM `teacher_has_subject` WHERE `teacher_email`='" . $t_email . "' ");
										$tch_hs_data = $tch_hs_rs->fetch_assoc();

										?>

										<div class="col-md-12 form-group1 form-last">
											<label class="control-label" for="a1">Address</label>
											<input type="text" value="<?php echo $t_details_data["address"]; ?>" name="address" id="a1">
										</div>

										<?php

										$address_rs = Database::search("SELECT * FROM `teacher_details` INNER JOIN `city` ON teacher_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `teacher_email`='" . $t_email . "' ");
										$address_data = $address_rs->fetch_assoc();

										?>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">Province</label>
											<select name="province" id="pro1" onchange="loadTDistrict();">
												<?php
												$t_province = Database::search("SELECT * FROM `province`");
												$t_pro_num = $t_province->num_rows;

												for ($z = 0; $z < $t_pro_num; $z++) {

													$t_pro_data =  $t_province->fetch_assoc();
												?>

													<option value="<?php echo $t_pro_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {
																											if ($t_pro_data["id"] == $address_data["province_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $t_pro_data["province"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">District</label>
											<select name="district" id="dis1" onchange="loadTCity();">
												<?php
												$t_district = Database::search("SELECT * FROM `district`");
												$t_dis_num = $t_district->num_rows;

												for ($d = 0; $d < $t_dis_num; $d++) {

													$t_dis_data =  $t_district->fetch_assoc();
												?>

													<option value="<?php echo $t_dis_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
																											if ($t_dis_data["id"] == $address_data["district_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $t_dis_data["district"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">City</label>
											<select name="city" id="city1">
												<?php
												$t_city = Database::search("SELECT * FROM `city`");
												$t_ctiy_num = $t_city->num_rows;

												for ($c = 0; $c < $t_ctiy_num; $c++) {

													$t_city_data =  $t_city->fetch_assoc();
												?>

													<option value="<?php echo $t_city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
																											if ($t_city_data["id"] == $address_data["city_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $t_city_data["city"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="ps1">Postal code</label>
											<input type="text" value="<?php echo $t_details_data["postal_code"]; ?>" name="postal_code" id="ps1">
										</div>

									</div>

									<div class="clearfix"> </div>

									<div class="col-md-12 form-group button-2">
										<input type="submit" class="btn btn-primary" value="Save Changes" onclick="updateProfile();">
									</div>
									<div class="clearfix"> </div>

									<!---->
								</div>

							<?php

							} else {
								echo ("Sorry for the Inconvenience");
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