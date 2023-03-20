<?php

session_start();

require "../connection.php";

if (isset($_SESSION["a"])) {

?>
	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Admin | Home</title>
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
					<!-- header-starts -->
					<div class="header-section">

						<div class="clearfix"></div>
					</div>


					<div class="outter-wp">
						<!--/tabs-->
						<div class="tab-main">
							<!--/tabs-inner-->
							<div class="tab-inner">
								<div id="tabs" class="tabs">
									<h2 class="inner-tittle">Welcome, <?php echo $_SESSION["a"]["first_name"] . " " . $_SESSION["a"]["last_name"]; ?></h2>
									<div class="graph">
										<nav>
											<ul>
												<li><a href="#section-1" class="icon-shop"><i class="lnr lnr-briefcase"></i> <span>Information</span></a></li>
												<li><a href="#section-2" class="icon-lab"><i class="fa fa-flask"></i> <span>Subject</span></a></li>
											</ul>
										</nav>
										<div class="content tab">
											<section class="sec1" id="section-1">
												<div class="mediabox">
													<h3>Information</h3>
													<p> <strong>Email</strong>
														<?php echo $_SESSION["a"]["admin_email"]; ?>
													</p>
													<p> <strong>Birthday:</strong>
														<?php echo $_SESSION["a"]["birthday"]; ?>
													</p>
													<p> <strong>Mobile:</strong>
														<?php echo $_SESSION["a"]["mobile"]; ?>
													</p>
													<p> <strong>Address:</strong>
														<?php echo $_SESSION["a"]["address"]; ?>
													</p>
													<p> <strong>Postal Code:</strong>
														<?php echo $_SESSION["a"]["postal_code"]; ?>
													</p>
													<?php

													$city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $_SESSION["a"]["city_id"] . "'");
													$city_data = $city_rs->fetch_assoc();
													?>
													<p> <strong>City:</strong>
														<?php echo $city_data["city"]; ?>
													</p>
												</div>
											</section>
											<section id="section-2">

												<div class="graph">

													<table class="table table-bordered atable">

														<thead>
															<tr>
																<th>#</th>
																<th>Subject</th>
																<th>Teacher</th>
																<th>Grade</th>
															</tr>
														</thead>
														<tbody>

															<?php

															$te_su_rs = Database::search("SELECT * FROM `teacher_details` INNER JOIN `teacher_has_subject` ON teacher_details.teacher_email = teacher_has_subject.teacher_email INNER JOIN `subject` ON teacher_has_subject.subject_id = `subject`.id");
															$te_su_num = $te_su_rs->num_rows;

															if ($te_su_num == 0) {

															?>

																<td colspan="12">No any Teacher information found
																</td>

																<?php

															} else {

																for ($x = 0; $x < $te_su_num; $x++) {

																	$te_su_data = $te_su_rs->fetch_assoc();

																?>


																	<tr>

																		<td><?php echo ($x + 1); ?></td>
																		<td><?php echo $te_su_data["sub_name"]; ?></td>
																		<td><?php echo $te_su_data["first_name"] . " " . $te_su_data["last_name"]; ?></td>
																		<td>
																			<?php

																			$subj_rs = Database::search("SELECT * FROM `grade_has_subject` WHERE `grade_has_subject`.`subject_id`='" . $te_su_data["subject_id"] . "'");

																			$subj_num = $subj_rs->num_rows;
																			for ($s = 0; $s < $subj_num; $s++) {

																				$subj_data = $subj_rs->fetch_assoc();

																				if ($s == ($subj_num - 1)) {
																					echo $subj_data["grade_id"];
																				} else {
																					echo $subj_data["grade_id"] . ", ";
																				}
																			}
																			?>
																		</td>

																	</tr>


															<?php


																}
															}

															?>

														</tbody>

													</table>

												</div>


											</section>

										</div>
										<!-- /content -->
									</div>
									<!-- /tabs -->

								</div>

								<div class="clearfix"> </div>
							</div>
						</div>
						<!--//tabs-inner-->

						<!--/charts-->
						<div class="charts">
							<div class="chrt-inner">
								<!--//weather-charts-->
								<div class="graph-visualization">

									<div class="col-md-6 map-2">
										<div class="profile-nav alt">
											<section class="panel">
												<div class="user-heading alt clock-row terques-bg">
												</div>
												<ul id="clock">
													<li id="sec"></li>
													<li id="hour"></li>
													<li id="min"></li>
												</ul>
											</section>

										</div>
									</div>
								</div>
							</div>
							<!--/charts-inner-->
						</div>
						<!--//outer-wp-->

						<!--custom-widgets-->
						<div class="custom-widgets">
							<div class="row-one">
								<div class="col-md-6 states-mdl1 widget">
									<div class="stats-left ">
										<h5>Total</h5>
										<h4>Students</h4>
									</div>
									<div class="stats-right">
										<?php

										$stu_rs = Database::search("SELECT * FROM `student`");
										$stu_num = $stu_rs->num_rows;

										?>
										<label><?php echo $stu_num; ?></label>
									</div>
								</div>
								<div class="col-md-6 widget states-mdl">
									<div class="stats-left">
										<h5>Total</h5>
										<h4>Teachers</h4>
									</div>
									<div class="stats-right">
										<?php

										$teach_rs = Database::search("SELECT * FROM `teacher`");
										$teach_num = $teach_rs->num_rows;

										?>
										<label><?php echo $teach_num; ?></label>
									</div>
								</div>

							</div>

							<div class="row-one">
								<div class="col-md-6 mt-20 states-mdl1 widget">
									<div class="stats-left">
										<h5>Total</h5>
										<h4>Subjects</h4>
									</div>
									<div class="stats-right">
										<?php

										$sub_rs = Database::search("SELECT * FROM `subject`");
										$sub_num = $sub_rs->num_rows;

										?>
										<label><?php echo $sub_num; ?></label>
									</div>
								</div>
								<div class="col-md-6 widget mt-20 states-mdl">
									<div class="stats-left">
										<h5>Total</h5>
										<h4>Officers</h4>
									</div>
									<div class="stats-right">
										<?php

										$a_offi_rs = Database::search("SELECT * FROM `academic_officer`");
										$a_offi_num = $a_offi_rs->num_rows;

										?>
										<label><?php echo $a_offi_num; ?></label>
									</div>
								</div>

							</div>
							
						</div>
						<!--//custom-widgets-->
					</div>

					<!--footer section start-->
					<footer>
						<p>Copyright ©2022 All rights reserved by : <a target="_blank">AlphaTech System</a></p>
					</footer>
					<!--footer section end-->
				</div>
			</div>
			<!--//content-inner-->

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
		<script src="js/cbpFWTabs.js"></script>
		<script>
			new CBPFWTabs(document.getElementById('tabs'));
		</script>

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