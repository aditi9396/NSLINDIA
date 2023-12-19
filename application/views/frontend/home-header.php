	<style type="text/css">
		.navbar-expand-lg{
			background-color: #000;
			padding: inherit;
			border-bottom: #fff 4px solid;
		}

		.navbar-brand span {
			color: #FFF;
		}

		.nav-link {
			color: #fff;
			text-decoration: none;
		}

		.nav-link:hover {
			color: #fff;
			text-decoration: underline;
		}

		@media (max-width: 767px) {
			.navbar-brand img {
				width: 100%;
				max-width: 50px;
			}

			.navbar-brand span {
				display: none;
			}

			.navbar-nav {
				flex-direction: column;
				padding-top: 20px;
			}

			.nav-item {
				margin-bottom: 10px;
			}
		}

		@media (min-width: 768px) {
			.navbar {
				padding-left: 10px;
				padding-right: 10px;
			}

			.navbar-brand img {
				width: 100%;
				max-width: 60px;
			}

			div#navbarNav {
				display: flex;
				justify-content: flex-end;
			}
		}

		@media (min-width: 992px) {
			.navbar {
				padding-left: 20px;
				padding-right: 20px;
			}

			.navbar-brand img {
				width: 100%;
				max-width: 80px;
			}

			.navbar-nav {
				flex-direction: row;
				align-items: center;
			}

			.nav-item {
				margin-right: 10px;
/*				background: #000;*/
/*				color: #fff;*/
			}
		}
	</style>
	<nav class="navbar navbar-expand-lg navbar-light ">
		<div class="container-fluid">
			<div class="navbar-brand">
				<img src="<?php echo base_url('assets_old/frontend/image/northen_star_logo.png'); ?>" alt="Logo">
				<span>NSLINDIA</span>
			</div>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
			aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNav">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item">
					<a class="nav-link" style="color: #fff;" href="#">CAREERS</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" style="color: #fff;" href="login">LOGIN</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-linkedin-square fa-lg"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-dribbble fa-lg"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-behance-square fa-lg"></i></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#"><i class="fa fa-instagram"></i></a>
				</li>
			</ul>
		</div>
	</div>
</nav>
