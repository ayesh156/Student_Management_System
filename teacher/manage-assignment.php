<?php

session_start();

if (isset($_SESSION["t"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Manage Assignment | Home</title>
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
								<li class="active">Manage Assignment</li>
							</ol>
						</div>
						<!--//sub-heard-part-->
						<div class="graph-visual tables-main">
							<h2 class="inner-tittle">Manage Assignment</h2>

							<div class="graph">

								<div class="form-group">
									<div class="col-sm-5 search">
										<div class="row">
											<div class="col-sm-10">
												<input type="text" class="form-control" name="assingn_search" id="assingn_search" placeholder="Search...">
											</div>
											<div class="col-sm-2">
												<a class="btn2 blue" onclick="assignmentSearch(0);">Search</a>
											</div>
										</div>
									</div>
								</div>

								<div class="tables" id="assignmentView">

									<?php

									require "../connection.php";

									$query = "SELECT `student`.`email` AS su_email, `submitted_assignment`.`id` AS `sasid`, `student`.`user_name` AS su_n, `student_details`.`first_name` AS sfn, `student_details`.`last_name` AS sln, `assignment`.`name` AS sname,`submitted_assignment`.`date_submitted` AS ds, `teacher_details`.`first_name` AS tfn, `teacher_details`.`last_name` AS tln, `submitted_assignment`.`answer_path` AS ap, `submitted_assignment`.`marks` FROM `submitted_assignment` INNER JOIN `assignment` ON submitted_assignment.assignment_id = assignment.id INNER JOIN `student` ON student.email = submitted_assignment.student_email INNER JOIN `student_details` ON student.email = student_details.student_email INNER JOIN `teacher_details` ON assignment.teacher_email = teacher_details.teacher_email";

									$assignment_rs = Database::search($query);
									$assignment_num = $assignment_rs->num_rows;

									$pageno = 0;

									if (isset($_GET["page"])) {
										$pageno = $_GET["page"];
									} else {
										$pageno = 1;
									}

									$results_per_page = 5;
									$number_of_pages = ceil($assignment_num / $results_per_page);

									$page_results = ((int)$pageno - 1) * $results_per_page;
									$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

									$assign_rs = Database::search($query);
									$assign_num = $assign_rs->num_rows;

									?>

									<table class="table table-bordered ">

										<thead>
											<tr>
												<th>U. Name</th>
												<th>Student Name</th>
												<th>Assignment</th>
												<th>Date Submitted</th>
												<th>Teacher Name</th>
												<th>Marks</th>
												<th style="text-indent: 75px;">&nbsp;</th>
											</tr>
										</thead>
										<tbody>

											<?php

											if ($assign_num == 0) {

											?>

												<td colspan="12">No any Assignment information found
												</td>

												<?php

											} else {

												for ($x = 0; $x < $assign_num; $x++) {

													$assign_details_data = $assign_rs->fetch_assoc();

												?>


													<tr>
														<td><?php echo $assign_details_data["su_n"]; ?></td>
														<td><?php echo $assign_details_data["sfn"] . " " . $assign_details_data["sln"]; ?></td>
														<td><?php echo $assign_details_data["sname"]; ?></td>
														<td><?php echo $assign_details_data["ds"]; ?></td>
														<td><?php echo $assign_details_data["tfn"] . " " . $assign_details_data["tln"]; ?></td>
														<td>
															<?php

															if ($assign_details_data["marks"] == -1) {
															?>
																<input type="text" id="amark<?php echo $assign_details_data['su_email']; ?><?php echo $assign_details_data['sasid']; ?>" class="col-md-6 input1">
																<a class="btn2 red col-md-offset-1 col-md-5" onclick="addMark('<?php echo $assign_details_data['su_email']; ?>',<?php echo $assign_details_data['sasid']; ?>)">Add</a>

															<?php
															} else {
															?>

																<input type="text" id="amark<?php echo $assign_details_data['su_email']; ?><?php echo $assign_details_data['sasid']; ?>" class="col-md-6 input1" value="<?php echo $assign_details_data["marks"]; ?>">
																<a class="btn2 red col-md-offset-1 col-md-5" onclick="addMark('<?php echo $assign_details_data['su_email']; ?>',<?php echo $assign_details_data['sasid']; ?>)">Add</a>


															<?php
															}

															?>
														</td>
														<td>
															<a href="download.php?file=<?php echo $assign_details_data["ap"]; ?>" class="btn2 orange col-md-offset-1">Download</a>
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
																			?> onclick="assignmentView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
														<span aria-hidden="true">&laquo;</span>
														<span class="sr-only">Previous</span>
													</a>
												</li>
												<?php


												for ($page = 1; $page <= $number_of_pages; $page++) {
													if ($page == $pageno) {
												?>

														<li class="page-item active">
															<a class="page-link" onclick="assignmentView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
														</li>

													<?php
													} else {
													?>

														<li class="page-item">
															<a class="page-link" onclick="assignmentView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
														</li>

												<?php
													}
												}

												?>
												<li class="page-item">
													<a class="page-link" <?php if ($pageno >= $number_of_pages) {
																				echo "#";
																			} else {
																			?> onclick="assignmentView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
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