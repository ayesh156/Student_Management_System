<div class="sidebar-menu">
	<header class="logo">
		<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="home.php"> <span id="logo">
			<?php
		$tch_rs = Database::search("SELECT * FROM `teacher` WHERE `email`='" . $_SESSION["t"]["teacher_email"] . "'");
		$tch_data = $tch_rs->fetch_assoc();
		?>
				<h1><?php echo $tch_data["user_name"]; ?></h1>


			</span>
			<!--<img id="logo" src="" alt="Logo"/>-->
		</a>
	</header>
	<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
	<!--/down-->
	<div class="down">
		<?php

		$image_rs = Database::search("SELECT * FROM `teacher_image` WHERE `teacher_email`='" . $_SESSION["t"]["teacher_email"] . "'");
		$image_data = $image_rs->fetch_assoc();

		if (empty($image_data["path"])) {

		?>
			<a href="home.php"><img src="../images/new_user.svg" class="rounded-circle" style=" width: 120px;"></a>

		<?php

		} else {

		?>

			<a href="home.php"><img src="<?php echo ($image_data["path"]); ?>" class="rounded-circle" style="width: 120px;" /></a>

		<?php
		}

		?>
		<a href="home.php"><span class="name-caret"></span></a>
		<p>Teacher</p>
		<ul>
			<li><a class="tooltips" onclick="tchSignout();"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
		</ul>
	</div>
	<!--//down-->
	<div class="menu">
		<ul id="menu">
			<li><a href="home.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

			<li><a href="add-note.php"><i class="fa fa-file-text-o"></i> <span>Add Notes</span> </a></li>

			<li><a href="add-assignment.php"><i class="fa fa-calendar-o"></i> <span>Add Assignments</span> </a></li>

			<li><a href="manage-assignment.php"><i class="fa fa-building-o"></i> <span>Manage Assignment</span> </a></li>

			<li><a href="profile.php"><i class="fa fa-cog"></i> <span>Manage Profile</span> </a></li>

		</ul>
	</div>
</div>