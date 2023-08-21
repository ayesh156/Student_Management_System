<?php

session_start();

if (isset($_SESSION["a"])) {

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

							$a_email = $_SESSION["a"]["admin_email"];

							require "../connection.php";

							$ad_details_rs = Database::search("SELECT * FROM `admin` INNER JOIN `admin_details` ON admin.email = admin_details.admin_email INNER JOIN `city` ON admin_details.city_id = city.id WHERE `email` = '" . $a_email . "' ");
							$ad_details_num = $ad_details_rs->num_rows;

							if ($ad_details_num > 0) {

								$ad_details_data = $ad_details_rs->fetch_assoc();


						?>
								<div class="validation-form">


									<!---->
									<h2 style="text-align: center;">Update Profile</h2>
									<div class="vali-form">

										<div class="d-flex flex-column align-items-center text-center p-3 pb-5">

											<?php

											$image_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $ad_details_data["email"] . "'");
											$image_data = $image_rs->fetch_assoc();

											if (empty($image_data["path"])) {

											?>

												<img src="../images/new_user.svg" class="mt-5 rounded-circle" style="width: 150px;" id="adminViewImg" />

											<?php

											} else {

											?>

												<img src="<?php echo ($image_data["path"]); ?>" class="mt-5 rounded-circle" style="width: 150px;" id="adminViewImg" />

											<?php
											}


											?>

											<div class="col-md-12">
												<input type="file" class="disNone" id="admin_img" accept="image/*" />
												<label for="admin_img" class="btn btn-success mt-5" onclick="changeAdminImg()">Update Profile Image</label>
											</div>

										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="e2">Email</label>
											<input type="text" value="<?php echo $ad_details_data["email"]; ?>" name="email" id="e2" disabled>
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="un2">User name</label>
											<input type="text" value="<?php echo $ad_details_data["user_name"]; ?>" name="user_name" id="un2">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="fn2">First name</label>
											<input type="text" value="<?php echo $ad_details_data["first_name"]; ?>" name="first_name" id="fn2">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="ln2">Last name</label>
											<input type="text" value="<?php echo $ad_details_data["last_name"]; ?>" name="last_name" id="ln2">
										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="vc2">Verification code</label>
											<input type="text" value="<?php echo $ad_details_data["verification_code"]; ?>" name="verification_code" id="vc2">
										</div>
										
										<div class="col-md-6 form-group1">
											<label class="control-label" for="bd2">Birthday</label>
											<input type="date" value="<?php echo $ad_details_data["birthday"]; ?>" name="birthday" id="bd2">
										</div>

										<div class="clearfix"> </div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="m2">Mobile</label>
											<input type="text" value="<?php echo $ad_details_data["mobile"]; ?>" name="mobile" id="m2">
										</div>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">Gender</label>
											<select name="gender" id="g2">
												<?php
												$ad_gender = Database::search("SELECT * FROM `gender`");
												$ad_gen_num = $ad_gender->num_rows;

												for ($y = 0; $y < $ad_gen_num; $y++) {

													$ad_gen_data =  $ad_gender->fetch_assoc();
												?>

													<option value="<?php echo $ad_gen_data["id"]; ?>" <?php if (!empty($ad_details_data["gender_id"])) {
																											if ($ad_gen_data["id"] == $ad_details_data["gender_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $ad_gen_data["gender"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-12 form-group1 form-last">
											<label class="control-label" for="a2">Address</label>
											<input type="text" value="<?php echo $ad_details_data["address"]; ?>" name="address" id="a2">
										</div>

										<?php

										$address_rs = Database::search("SELECT * FROM `admin_details` INNER JOIN `city` ON admin_details.city_id=city.id INNER JOIN `district` ON city.district_id=district.id INNER JOIN `province` ON district.province_id=province.id WHERE `admin_email`='" . $a_email . "' ");
										$address_data = $address_rs->fetch_assoc();

										?>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">Province</label>
											<select name="province" id="pro2" onchange="loadS2District();">
												<?php
												$ad_province = Database::search("SELECT * FROM `province`");
												$ad_pro_num = $ad_province->num_rows;

												for ($z = 0; $z < $ad_pro_num; $z++) {

													$ad_pro_data =  $ad_province->fetch_assoc();
												?>

													<option value="<?php echo $ad_pro_data["id"]; ?>" <?php if (!empty($address_data["province_id"])) {
																											if ($ad_pro_data["id"] == $address_data["province_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $ad_pro_data["province"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">District</label>
											<select name="district" id="dis2" onchange="loadS2City();">
												<?php
												$ad_district = Database::search("SELECT * FROM `district`");
												$ad_dis_num = $ad_district->num_rows;

												for ($d = 0; $d < $ad_dis_num; $d++) {

													$ad_dis_data =  $ad_district->fetch_assoc();
												?>

													<option value="<?php echo $ad_dis_data["id"]; ?>" <?php if (!empty($address_data["district_id"])) {
																											if ($ad_dis_data["id"] == $address_data["district_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $ad_dis_data["district"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-6 form-group2 group-mail">
											<label class="control-label">City</label>
											<select name="city" id="city2">
												<?php
												$ad_city = Database::search("SELECT * FROM `city`");
												$ad_ctiy_num = $ad_city->num_rows;

												for ($c = 0; $c < $ad_ctiy_num; $c++) {

													$ad_city_data =  $ad_city->fetch_assoc();
												?>

													<option value="<?php echo $ad_city_data["id"]; ?>" <?php if (!empty($address_data["city_id"])) {
																											if ($ad_city_data["id"] == $address_data["city_id"]) {
																										?>selected<?php
																												}
																											} ?>><?php echo $ad_city_data["city"]; ?></option>

												<?php
												}
												?>
											</select>

										</div>

										<div class="col-md-6 form-group1">
											<label class="control-label" for="ps2">Postal code</label>
											<input type="text" value="<?php echo $ad_details_data["postal_code"]; ?>" name="postal_code" id="ps2">
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