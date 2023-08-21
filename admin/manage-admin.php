<?php

session_start();

if (isset($_SESSION["a"])) {

?>

	<!DOCTYPE HTML>
	<html>

	<head>
		<title>Manage Admin | Home</title>
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
								<li class="active">Manage Administration</li>
							</ol>
						</div>
						<!--//sub-heard-part-->
						<div class="graph-visual tables-main">
							<h2 class="inner-tittle">Manage Administration</h2>

							<div class="graph">

								<div class="form-group">
									<div class="col-sm-5 search">
										<div class="row">
											<div class="col-sm-10">
												<input type="text" class="form-control" name="ad_search" id="ad_search" placeholder="Search...">
											</div>
											<div class="col-sm-2">
												<a class="btn2 blue" onclick="adminSearch(0);">Search</a>
											</div>
										</div>
									</div>
								</div>

								<div class="tables" id="adminView">

									<?php

									require "../connection.php";

									$query = "SELECT * FROM `admin` INNER JOIN `admin_details` ON admin.email = admin_details.admin_email INNER JOIN `gender` ON admin.gender_id = gender.id INNER JOIN `city` ON admin_details.city_id = city.id WHERE `email` <> '".$_SESSION["a"]["admin_email"]."'";

									$admin_rs = Database::search($query);
									$admin_num = $admin_rs->num_rows;

									$pageno = 0;

									if (isset($_GET["page"])) {
										$pageno = $_GET["page"];
									} else {
										$pageno = 1;
									}

									$results_per_page = 5;
									$number_of_pages = ceil($admin_num / $results_per_page);

									$page_results = ((int)$pageno - 1) * $results_per_page;
									$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

									$ad_rs = Database::search($query);
									$ad_num = $ad_rs->num_rows;

									?>

									<table class="table table-bordered ">

										<thead>
											<tr>
												<th>Email</th>
												<th>U. Name</th>
												<th>Name</th>
												<th>DOB</th>
												<th>Mobile</th>
												<th>Gender</th>
												<th>City</th>
												
											</tr>
										</thead>
										<tbody>

											<?php

											if ($ad_num == 0) {

											?>

												<td colspan="12">No any admins information found
												</td>

												<?php

											} else {

												for ($x = 0; $x < $ad_num; $x++) {

													$ad_details_data = $ad_rs->fetch_assoc();

												?>
													<tr onclick="window.location = 'edit-admin.php?ad=<?php echo $ad_details_data['email']; ?>'">

														<td><?php echo $ad_details_data["email"]; ?></td>
														<td><?php echo $ad_details_data["user_name"]; ?></td>
														<td><?php echo $ad_details_data["first_name"] . " " . $ad_details_data["last_name"]; ?></td>
														<td><?php echo $ad_details_data["birthday"]; ?></td>
														<td><?php echo $ad_details_data["mobile"]; ?></td>
														<td><?php echo $ad_details_data["gender"]; ?></td>
														<td><?php echo $ad_details_data["city"]; ?></td>

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
																			?> onclick="adminView('<?php echo ($pageno - 1); ?>');" <?php } ?>>
														<span aria-hidden="true">&laquo;</span>
														<span class="sr-only">Previous</span>
													</a>
												</li>
												<?php


												for ($page = 1; $page <= $number_of_pages; $page++) {
													if ($page == $pageno) {
												?>

														<li class="page-item active">
															<a class="page-link" onclick="adminView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
														</li>

													<?php
													} else {
													?>

														<li class="page-item">
															<a class="page-link" onclick="adminView('<?php echo ($page); ?>');"><?php echo $page; ?></a>
														</li>

												<?php
													}
												}

												?>
												<li class="page-item">
													<a class="page-link" <?php if ($pageno >= $number_of_pages) {
																				echo "#";
																			} else {
																			?> onclick="adminView('<?php echo ($pageno + 1); ?>');" <?php } ?>>
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