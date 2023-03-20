<?php

session_start();

if (isset($_SESSION["s"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Manage Note | Home</title>
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
						<!--sub-heard-part-->
						<div class="sub-heard-part">
							<ol class="breadcrumb m-b-0">
								<li><a href="home.php">Home</a></li>
								<li class="active">Manage Note</li>
							</ol>
						</div>
						<!--//sub-heard-part-->
						<div class="graph-visual tables-main">
							<h2 class="inner-tittle">Manage Note</h2>

							<div class="graph">

								<div class="form-group">
									<div class="col-sm-5 search">
										<div class="row">
											<div class="col-sm-10">
												<input type="text" class="form-control" name="note_search" id="note_search" placeholder="Search...">
											</div>
											<div class="col-sm-2">
												<a class="btn2 blue" onclick="noteSearch(0);">Search</a>
											</div>
										</div>
									</div>
								</div>

								<div class="tables" id="noteView">

									<?php

									require "../connection.php";

									$stu_rs = Database::search("SELECT * FROM `student` WHERE `email` = '" . $_SESSION["s"]["student_email"] . "'");
									$stu_data = $stu_rs->fetch_assoc();

									$query = "SELECT `lesson_note`.`id` AS lid, `subject`.`sub_name`, `lesson_note`.`name` AS lname,`lesson_note`.`description` AS `desc`,`lesson_note`.`date_added` AS da, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `grade_has_subject`.`grade_id` AS gid,`lesson_note`.`path` AS lp FROM `lesson_note` INNER JOIN `teacher` ON lesson_note.teacher_email = teacher.email INNER JOIN `teacher_details` ON lesson_note.teacher_email = teacher_details.teacher_email INNER JOIN `grade_has_subject` ON lesson_note.grade_has_subject_id = grade_has_subject.id INNER JOIN `subject` ON grade_has_subject.subject_id = subject.id WHERE `grade_has_subject`.`grade_id` = '" . $stu_data["grade_id"] . "' ";

									$lesson_rs = Database::search($query);
									$lesson_num = $lesson_rs->num_rows;

									$pageno = 0;

									if (isset($_GET["page"])) {
										$pageno = $_GET["page"];
									} else {
										$pageno = 1;
									}

									$results_per_page = 5;
									$number_of_pages = ceil($lesson_num / $results_per_page);

									$page_results = ((int)$pageno - 1) * $results_per_page;
									$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

									$lnote_rs = Database::search($query);
									$lnote_num = $lnote_rs->num_rows;

									?>

									<table class="table table-bordered">

										<thead>
											<tr>
												<th>Subject</th>
												<th>Lesson</th>
												<th>Description</th>
												<th>Date Added</th>
												<th>Teacher name</th>
												<th></th>
											</tr>
										</thead>
										<tbody>

											<?php

											if ($lnote_num == 0) {

											?>

												<td colspan="12">No any Assignment information found
												</td>

												<?php

											} else {

												for ($x = 0; $x < $lnote_num; $x++) {

													$les_note_data = $lnote_rs->fetch_assoc();

												?>


													<tr>
														<td><?php echo $les_note_data["sub_name"]; ?></td>
														<td><?php echo $les_note_data["lname"]; ?></td>
														<td><?php echo $les_note_data["desc"]; ?></td>
														<td><?php echo $les_note_data["da"]; ?></td>
														<td><?php echo $les_note_data["tfn"] . " " . $les_note_data["tln"]; ?></td>
														<td>
															<a href="download.php?file=<?php echo $les_note_data["lp"]; ?>" class="btn2 orange">Download</a>
														</td>


													</tr>


											<?php


												}
											}

											?>

										</tbody>

									</table>

									<div class="col-12 text-center mb-3 mt-3">
										<nav aria-label="Page navigation example">
											<ul class="pagination">
												<li class="page-item">
													<a class="page-link" <?php if ($pageno <= 1) {
																				echo "#";
																			} else {
																			?> onclick="noteView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
														<span aria-hidden="true">&laquo;</span>
														<span class="sr-only">Previous</span>
													</a>
												</li>
												<?php


												for ($page = 1; $page <= $number_of_pages; $page++) {
													if ($page == $pageno) {
												?>

														<li class="page-item active">
															<a class="page-link" onclick="noteView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
														</li>

													<?php
													} else {
													?>

														<li class="page-item">
															<a class="page-link" onclick="noteView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
														</li>

												<?php
													}
												}

												?>
												<li class="page-item">
													<a class="page-link" <?php if ($pageno >= $number_of_pages) {
																				echo "#";
																			} else {
																			?> onclick="noteView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
														<span aria-hidden="true">&raquo;</span>
														<span class="sr-only">Next</span>
													</a>
												</li>
											</ul>
										</nav>
									</div>

								</div>
							</div>


						</div>
						<!--//graph-visual-->
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