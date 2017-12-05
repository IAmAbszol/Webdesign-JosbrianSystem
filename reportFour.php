<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="assets/scripts/validatePromotionForms.js" type="text/javascript"></script>
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<title>Josbrian Interface - Report Four</title>
  <script>
		function printDiv() {
			window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
			window.frames["print_frame"].window.focus();
			window.frames["print_frame"].window.print();
		}
  </script>
	<style>
		@media (min-width: 768px)
   .sidebar {
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

	 .jumbotron .container {
		  position: relative;
		  left: auto;
		  right: auto;
		  height:100vh;
		  width: 100vw;
		  padding:100px 0;
		  text-align: center;
		}

   textarea:focus {
    height: 10em;
   }

	 table {
		 font-size: 85%;
	 }

    tr:hover td {background:#36465d; cursor: pointer; color: #ffffff; }
    tr:hover p  {color:#ffffff;}
    p{
           font-size: 100%;
    }
	</style>

</head>

<body style="background: #36465d;">
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container-fluid">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<div class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li>
							<a class="btn btn-inverse" href="index.html">
								<i class="glyphicon glyphicon-home"></i>
							</a>
						</li>
						<li>
							<a href="items.html">Items</a>
						</li>
						<li>
							<a href="promotions.html">Promotions</a>
						</li>
						<li>
							<a href="adEvent.html">Ad Events</a>
						</li>
						<li class="active">
							<a href="reports.php">Reports</a>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<nav id="left-sidebar-nav" class="sidebar-nav">
            <div class="navbar-collapse collapse">
            <div id="left-sidebar" class="sidebar">
                <ul id="main-menu" class="metismenu">
                  <center><li style="padding-top: 10px; padding-bottom: 10px;"><b>Generate Reports</b></li></center>
                  <li name="firstReport" id="firstReport"><a href="reports.php">First Report</a></li>
                  <li name="secondReport" id="secondReport"><a href="reports.php">Second Report</a></li>
                  <li name="thirdReport" id="thirdReport"><a href="reports.php">Third Report</a></li>
                  <li name="fourthReport" id="fourthReport" class="active"><a href="reports.php">Fourth Report</a></li>
                </ul>
              </div>
              </div>
		</nav>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<!-- Screen Reader -->
				<h1 class="sr-only"></h1>
				<!-- Item Manipulation Panel -->
     <!--  TABLE TO RETURN DATA TO  -->

                        <div id="searchResults" class="container">
                         <div class="jumbotron">
                            <h2 style="padding-bottom: 20px; text-align: left"><b>Report Four Results:</b></h2>
                            <button onclick="printDiv()"><span class="glyphicon glyphicon-print"></span></button>
                            <center>
														<div id="printableTable">
                            <table class="table" id="printTable">
														<!-- Listing Search -->
																<?php
																	include('php/reportfile.php');
																	$data = report_top_sale_items();
																	echo "<thead><tr>";
                                  echo "<th>Rank</th>";
																	for($i = 0; $i < mysql_num_fields($data); $i++) {
																		$field_info = mysql_fetch_field($data, $i);
																		echo "<th>{$field_info->name}</th>";
																	}

																	echo "<tbody>";

																	// Print the data
                                  $increment = 1;
																	while($row = mysql_fetch_row($data)) {
																		echo "<tr data-toggle='modal' data-target='#promotionDetailModal'>";
                                    echo "<td><p><div>$increment</div></p></td>";
																		foreach($row as $_column) {
																			echo "<td><p><div name='' id=''>{$_column}</div></p></td>";
																		}
                                    $increment++;
																		echo"</tr>";
																	}

																	echo "</tbody>";

                                  ?>

		                             </table>
																 </div>
		                             </center>
																 <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
		                         </div>
		                     	</div>

		 					<!-- END TABLE CONTENT -->

		 					</div>
		 			</div>
		 		</div>
		 		<!-- END MAIN CONTENT -->
		 		<div class="clearfix"></div>
		 	</div>
</body>

</html>
