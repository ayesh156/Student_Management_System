<?php

session_start();

require "../connection.php";

if (isset($_SESSION["t"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Add lesson notes | Home</title>
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
								<li class="active">Add lesson notes</li>
							</ol>
						</div>

						<div class="forms-main">

							<div class="graph-form">
								<div class="validation-form">
									<!---->
									<h2 style="text-align: center;">Add lesson notes</h2>

									<?php

									$temail = $_SESSION["t"]["teacher_email"];

									?>

									<div class="col-md-6 form-group2 group-mail">
										<label class="control-label">Subject</label>
										<select name="subject" id="sub">
											<?php
											$subject_rs = Database::search("SELECT `subject`.`id`, `subject`.`sub_name` FROM `subject` INNER JOIN `teacher_has_subject` ON `subject`.id = teacher_has_subject.subject_id WHERE teacher_has_subject.teacher_email = '" . $temail . "' ");
											$subject_num = $subject_rs->num_rows;

											for ($y = 0; $y < $subject_num; $y++) {

												$subject_data =  $subject_rs->fetch_assoc();
											?>

												<option value="<?php echo $subject_data["id"]; ?>"><?php echo $subject_data["sub_name"]; ?></option>

											<?php
											}
											?>
										</select>

									</div>

									<div class="col-md-6 form-group2 group-mail">
										<label class="control-label">Grade</label>
										<select name="grade" id="g2">
											<?php
											$grade_rs = Database::search("SELECT `grade`.`id`, `grade`.`grade` FROM `grade` INNER JOIN `grade_has_subject` ON grade.id = grade_has_subject.grade_id INNER JOIN `teacher_has_subject` ON grade_has_subject.subject_id = teacher_has_subject.id WHERE teacher_has_subject.teacher_email = '" . $temail . "' GROUP BY `grade_has_subject`.`grade_id` ");
											$grade_num = $grade_rs->num_rows;

											for ($y = 0; $y < $grade_num; $y++) {

												$grade_data =  $grade_rs->fetch_assoc();
											?>

												<option value="<?php echo $grade_data["id"]; ?>"><?php echo $grade_data["grade"]; ?></option>

											<?php
											}
											?>
										</select>

									</div>



									<div class="col-md-12 form-group1 group-mail">
										<label class="control-label" for="les_name">Lesson Name</label>
										<input type="text" placeholder="Lesson Name" name="lname" id="les_name">
									</div>

									<div class="col-md-12 form-group1 form-last">
										<label class="control-label" for="desc">Description</label>
										<textarea cols="50" rows="4" class="form-control1" id="desc" placeholder="Description"></textarea>
									</div>

									<div class="col-md-12 mt-30">
										<input type="file" class="disNone" id="noteFile" accept=".doc,.docx,.ppt,.pptx,application/msword, application/pdf, application/vnd.ms-powerpoint" />
										<label for="noteFile" style="display: inline;" class="btn purple mt-5" onclick="uploadNote()">Upload Note</label>
										<h4 style="display: inline;" id="fileName"></h4>
									</div>

									<div class="clearfix"> </div>
									<div class="col-md-12 form-group button-2">
										<input type="button" class="blue btn1" value="Add Lesson Note" onclick="addLessonNote()">
										<input type="button" class="red btn1" value="Reset" onclick="window.location = 'add-note.php';">
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