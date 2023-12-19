<style type="text/css">
	.popover__content {
		visibility: hidden;
		position: absolute;
		border-radius: 15px;
		left: 83%;
		padding: 0.5rem;
		box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26);
		width: 270px;
		background-color: white;
	}

	.popover__wrapper:hover .popover__content {
		z-index: 10;
		opacity: 1;
		visibility: visible;
	}

	.topnav11 {
		overflow: hidden;
		background-color: #262626;
	}

	.topnav11 a {
		float: left;
		display: block;
		color: #f2f2f2;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		font-size: 12px;
	}

	.active {
		background-color: #;
		color: white;
	}

	.topnav11 .icon {
		display: none;
	}

	.dropdown1 {
		float: left;
		overflow: hidden;
	}

	.dropdown1 .dropbtn {
		font-size: 12px;
		border: none;
		outline: none;
		color: white;
		padding: 2px 5px;
		background-color: inherit;
		font-family: inherit;
		margin: 0;
	}

	.popover__title {
		font-size: 1em;
		margin-left: 10px;
		margin-right: 20px;
		text-decoration: none;
		color: rgb(228, 68, 68);
		text-align: center;
	}

	.dropdown-content1 {
		display: none;
		position: absolute;
		background-color: #f9f9f9;
		min-width: 160px;
		box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
		z-index: 1;
	}

	.dropdown-content1 a {
		float: none;
		color: black;
		padding: 12px 16px;
		text-decoration: none;
		display: block;
		text-align: left;
	}

	.topnav11 a:hover,
	.dropdown1:hover .dropbtn {
		background-color: #555;
		color: white;
	}

	.dropdown-item:active {
		background-color: none !important;
	}

	.dropdown-content1 a:hover {
		background-color: #ddd;
		color: black;
	}

	.dropdown1:hover .dropdown-content1 {
		display: block;
	}

	@media screen and (max-width: 600px) {
		.topnav11 a:not(:first-child),
		.dropdown1 .dropbtn {
			display: none;
		}
		.topnav11 a.icon {
			float: right;
			display: block;
		}
	}

	@media screen and (max-width: 600px) {
		.topnav11.responsive {
			position: relative;
		}

		.topnav11.responsive .icon {
			position: absolute;
			right: 0;
			top: 0;
		}

		.topnav11.responsive a {
			float: none;
			display: block;
			text-align: left;
		}

		.topnav11.responsive .dropdown1 {
			float: none;
		}

		.topnav11.responsive .dropdown-content1 {
			position: relative;
		}

		.topnav11.responsive .dropdown1 .dropbtn {
			display: block;
			width: 100%;
			text-align: left;
		}
	}

	.topnav11 {
		margin: 20px;
	}

	.sticky {
		position: fixed;
		top: 0;
		width: 100%;
	}

	.sticky1 + .content {
		padding-top: 60px;
	}

	.menu_item {
		font-family: Verdana;
		color: gray;
		float: left;
		width: 84px;
		border-radius: 10px;
		text-align: center;
		padding-top: 15px;
		padding-bottom: 15px;
		font-size: 0.7em;
		margin-bottom: 5px;
	}


</style>
<div style="width: 100%; z-index: 9;left: 0; top: 0; padding-top: 10px; height: 70px; background-color: white;">
	<div style="margin-left: 10px; float: left;">
		<a href="index.php">
			<img src="assets_old/frontend/image/northen_star_logo (1).png"  style="height: 60px; width: 83px;">
			<span style="text-decoration:none; color:#000;">NSLINDIA</span>
		</a>
	</div>        
	<div style="float: right; display: flex;">
		<div class="text-center" style="font-family: Verdana; margin-top: 5px; margin-right: 20px; float: right; color: darkgray;">
			<?php
			$emp = array("EmpName", "UserName", "dept", "Designation");
			echo $user->UserName . " | " . $user->EmpName . " | " . $user->Depot . " | " . $user->Designation;
			?>
		</div> 


		<div class="popover__wrapper">
			<a href="#">
				<span class="popover__title">
					<img src="assets_old/frontend/image/app.png?1" onmouseover="this.src='assets_old/frontend/image/appover.png'" onmouseout="this.src='assets_old/frontend/image/app.png'" height="30px">
				</span>
			</a>
			<div class="popover__content">
				<a href="cpmenubar">
					<div class="menu_item" data-modal="CP">
						<img src="assets_old/frontend/image/channelpartner1.png" width="40px" height="40px"><br><br>
						CP
					</div>
				</a>
			</div>
		</div>
		
		<div class="popover__wrapper">
			<a href="#">
				<span class="popover__title">
					<img style="border-radius: 50%;" src="assets_old/frontend/image/profile.png?1" onmouseover="this.src='assets_old/frontend/image/profilehov.png'" onmouseout="this.src='assets_old/frontend/image/profile.png?1'" height="30px">
				</span>
			</a>
			<div class="popover__content">
				<div style="text-align: center; width: 106%; margin-left: -3%; border-bottom: 1px solid gainsboro;">
					<img src="assets_old/frontend/image/profile.png?1" style="border-radius: 50%;" height="120px">
					<a href="profilepic.php" title="Upload your Profile Picture." style="display: unset;">
						<img src="assets_old/frontend/image/camera.png" style="position: absolute; margin-top: 95px" onmouseover="this.src='assets_old/frontend/image/camerahov.png'" onmouseout="this.src='assets_old/frontend/image/camera.png'" height="20px">
					</a>
					<br>
					<span style="font-family: Verdana; font-size: .9em;"><b>User ID:</b>
						<?php 
						$emp = array("EmpName", "UserName");
						echo $user->UserName . "<br>" . $user->EmpName;  
						?>
						<br>
						<br>
						<div style="text-align: center;">
							<a href="cpall_depo" onmouseout="this.style.backgroundColor='white'" onmouseover="this.style.backgroundColor='aliceblue'" style="font-family: Verdana; font-size: .8em; color: #4f4f4f; display: inline-block; text-align: center; border-radius: 10px; margin: 15px; padding: 8px; width: 70%; border: 1px solid gainsboro;">
								Virtual Login
							</a>
						</div>
					</span>
					<div class="text-center">
						<a href="#" onmouseout="this.style.backgroundColor='white'" onmouseover="this.style.backgroundColor='aliceblue'" style="font-family: Verdana; font-size: .8em; color: #4f4f4f; display: inline-block; text-align: center; border-radius: 10px; margin: 15px; padding: 8px; width: 70%; border: 1px solid gainsboro;">
							Change Password
						</a>
					</div>
					<div class="text-center">
						<a href="login">
							Log Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div style="display: inline-block; margin-top: 55px;"></div>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<a class="navbar-brand" href="#" style="color: orange;">CP</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
				</li>
				<li class="nav-item">
					<!-- <a class="nav-link" href="#">Link</a> -->
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="cpDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: orange;">
						CP
					</a>
					<ul class="dropdown-menu dropdown-menu-dark mt-3" aria-labelledby="cpDropdown">
						<li><a class="dropdown-item" href="lr-generataion">CP LR VOLUMETRIC</a></li>
						<li><a class="dropdown-item" href="LR_cancel">LR CANCEL</a></li>
						<li><a class="dropdown-item" href="createlr">LR ENTRY</a></li>
						<li><a class="dropdown-item" href="createdrs">CREATE DRS</a></li>
						<li><a class="dropdown-item" href="drs_cancel">DRS CANCEL</a></li>
						<li><a class="dropdown-item" href="thcarrival">THC ARRIVAL</a></li>
						<li><a class="dropdown-item" href="thc_cancel">THC CANCEL</a></li>
						<li><a class="dropdown-item" href="verify_POD">VERIFY POD NEW</a></li>
						<li><a class="dropdown-item" href="verify_THC">VERIFY THC VOUCHER</a></li>
					</ul>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="cpReportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration: none; color: orange;">
						CP REPORT
					</a>
					<ul class="dropdown-menu dropdown-menu-dark mt-3" aria-labelledby="cpReportDropdown">
						<li><a class="dropdown-item" href="register">REGISTRATION</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<ul class="dropdown-menu scrollable-menu" role="menu"></ul>
		<form class="d-flex">
			<input id="txtSearch" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autocomplete="off">
		</form>
	</nav>
</div>

<!-- <div class="center-container">
	<div class="sb-example-3">
		<img src="assets_old_old_old_old_old/frontend/VTCLogo.png" alt="Logo">
		<br><br>
		<form id="form1" name="form1" method="POST" action="searchdoc.php">
			<input class="search__input" name="docno" type="text" placeholder="Search">
		</form>
	</div>
</div>
 -->



