<div class="sidebar-menu">
	<header class="logo">
		<a href="#" class="sidebar-icon"> <span class="fa fa-bars"></span> </a> <a href="home.php"> <span id="logo">
			<?php
		$admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $_SESSION["a"]["admin_email"] . "'");
		$admin_data = $admin_rs->fetch_assoc();
		?>
				<h1><?php echo $admin_data["user_name"]; ?></h1>
			</span>
			<!--<img id="logo" src="" alt="Logo"/>-->
		</a>
	</header>
	<div style="border-top:1px solid rgba(69, 74, 84, 0.7)"></div>
	<!--/down-->
	<div class="down">
		<?php

		$image_rs = Database::search("SELECT * FROM `admin_image` WHERE `admin_email`='" . $_SESSION["a"]["admin_email"] . "'");
		$image_data = $image_rs->fetch_assoc();

		if (empty($image_data["path"])) {

		?>
			<a href="home.php"><img src="../images/new_user.svg style="width: 120px;"></a>

		<?php

		} else {

		?>

			<a href="home.php"><img src="<?php echo ($image_data["path"]); ?>" class="rounded-circle" style="width: 120px;" /></a>

		<?php
		}

		?>
		<a href="home.php"><span class="name-caret"></span></a>
		<p>System Administrator</p>
		<ul>
			<li><a class="tooltips" onclick="adminSignout();"><span>Log out</span><i class="lnr lnr-power-switch"></i></a></li>
		</ul>
	</div>
	<!--//down-->
	<div class="menu">
		<ul id="menu">
			<li><a href="home.php"><i class="fa fa-tachometer"></i> <span>Dashboard</span></a></li>

			<li><a href="checkResult.php"><i class="fa fa-list-alt"></i> <span>Check Results</span> </a></li>

			<li><a href="manage-student.php"><i class="fa fa-table"></i> <span>Manage Students</span> </a></li>

			<li id="menu-academico"><a href="#"><i class="fa fa-file-text-o"></i> <span>Teacher</span> <span class="fa fa-angle-right" style="float: right"></span></a>

				<ul id="menu-academico-sub">
					<li id="menu-academico-avaliacoes"><a href="manage-teacher.php">Manage Teachers</a></li>
					<li id="menu-academico-boletim"><a href="tchInvitation.php">Send Invitation</a></li>

				</ul>
			</li>

			<li id="menu-academico"><a href="#"><i class="fa fa-tasks"></i> <span>Academic Officer</span> <span class="fa fa-angle-right" style="float: right"></span></a>
				<ul id="menu-academico-sub">
					<li id="menu-academico-avaliacoes"><a href="manage-officer.php">Manage Academic Officers</a></li>
					<li id="menu-academico-boletim"><a href="officerInvitation.php">Send Invitation</a></li>

				</ul>
			</li>

			<li><a href="manage-admin.php"><i class="fa fa-user"></i> <span>Manage Administration</span> </a></li>

			<li><a href="profile.php"><i class="fa fa-cog"></i> <span>Manage Profile</span> </a></li>


		</ul>
	</div>
</div>