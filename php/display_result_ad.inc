<?php

function display_result($message)
{
  echo "<!doctype html>
<html lang='en'>

<head>
	<meta charset='utf-8'>
	<meta http-equiv='X-UA-Compatible' content='IE=edge, chrome=1'>
	<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
	<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
	<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
	<!-- MAIN CSS -->
	<link rel='stylesheet' href='../assets/css/main.css'>
	<title>Josbrian Interface - Items</title>
	<style>
		@media (min-width: 768px) .sidebar {
			position: fixed;
			top: 51px;
			bottom: 0;
			left: 0;
			z-index: 1000;
			display: block;
			padding: 20px;
			overflow-x: hidden;
			overflow-y: auto;
			background-color: #f5f5f5;
			border-right: 1px solid #eee;
		}

		tr.spaceUnder>td {
			padding-bottom: 1em;
		}

		textarea:focus {
			height: 4em;
		}
	</style>

</head>

<body style='background: #36465d;'>
	<!-- WRAPPER -->
	<div id='wrapper'>
		<!-- NAVBAR -->
		<nav class='navbar navbar-inverse navbar-fixed-top'>
			<div class='container-fluid'>
				<button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
					<span class='sr-only'>Toggle Navigation</span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
					<span class='icon-bar'></span>
				</button>
				<div class='navbar-collapse collapse'>
					<ul class='nav navbar-nav'>
						<li>
							<a class='btn btn-inverse' href='../index.html'>
								<i class='glyphicon glyphicon-home'></i>
							</a>
						</li>
						<li>
							<a href='../items.html'>Items</a>
						</li>
						<li>
							<a href='../promotions.html'>Promotions</a>
						</li>
            <li class='active'>
							<a href='../adEvent.html'>Ad Events</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->

		<!-- LEFT SIDEBAR -->

		<nav id='left-sidebar-nav' class='sidebar-nav'>
			<div class='navbar-collapse collapse'>
				<div id='left-sidebar' class='sidebar'>
					<ul id='main-menu' class='metismenu'>
						<center>
							<li style='padding-top: 10px; padding-bottom: 10px;'>
								<b>Ad Events</b>
							</li>
						</center>
						<li name='adItem' id='adItem'>
							<a href='../adEvent.html'>Add Ad Event</a>
						</li>
						<li name='searchAd' id='searchAd'>
   				 <li name='searchAdEvent' id='searchAdEvent' class='active'><a href='adEvent.html'><span class='glyphicon glyphicon-search'></span> Search Ad Events</a></li>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- END LEFT SIDEBAR -->

		<!-- MAIN CONTENT -->
		<div id='main-content'>
			<div class='container-fluid'>
				<!-- Screen Reader -->
				<h1 class='sr-only'>Ad Event Manipulation</h1>
				<!-- Item Manipulation Panel -->
				<div class='tab-content'>
						<!-- This is for the panel creation -->
						<div class='col-md-4 col-md-offset-4'>
							<div class='panel panel-default'>
								<div class='panel-heading'>
									<h3 class='panel-title'>
										<b>Result</b>
									</h3>
								</div>
								<div class='panel-body'>";
                echo "<center>$message</center>";
							  echo "</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
		<div class='clearfix'></div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
";
}
?>
