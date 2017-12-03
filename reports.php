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
    <script>

		// validate
		function report2Validate() {
			var errormessage = "";
			var message = "";
			errormessage += testPromotionType(message);
			errormessage += testPromoAmount(message);
			if(errormessage != "") {
				var alertvalue = document.getElementById("alertSecondReport");
				alertvalue.style.display = "block";
				alertvalue.innerHTML = "Error detected!\n" + errormessage;
				return false;
			}

			return true;
		}
		function testPromotionType(message) {
			var promoType = document.forms["secondReportForm"]["promotionType"].value;

			if (promoType == "") {
				message = "Please select a promotion type\n";
			} else { }
			return message;
		}

		function testPromoAmount(message) {
			var promoAmount = document.forms["secondReportForm"]["amountOff"].value;
			var promoType = document.forms["secondReportForm"]["promotionType"].value;

			if (promoAmount != "") {
				if (promoType == "Dollar") {
					// no javascript wizard, also demorgans law would be the best here
					if (promoAmount.match(/^[0-9]*[.][0-9]{2}$/) || promoAmount.match(/^[0-9]+$/) || promoAmount.match(/^[0-9]+[.]$/) || promoAmount.match(/^[0-9]*[.][0-9]$/)) {

					} else {
						message = "Please enter amount\n";
					}
				} else if (promoType == "Percent") {
					if (!promoAmount.match(/^[.][0-9]$/) && !promoAmount.match(/^[.][0-9]{2}$/)) {
						message = "Please enter valid percent {0.9}\n";
					}
				} else {
					message = "Unknown promo type\n";
				}
			} else
				message = "Please enter amount\n";

			return message;
		}
		function report1Validate() {
			var errormessage = "";
			var message = "";
			errormessage += checkDate(message, "adEventstart");
			if(errormessage != "") {
				var alertvalue = document.getElementById("alertboxAdd");
				alertvalue.style.display = "block";
				alertvalue.innerHTML = "Error detected!\n" + errormessage;
				return false;
			}

			return true;
		}
		function report3Validate() {
			var errormessage = "";
			var message = "";
			var x = document.forms["thirdReportForm"]["itemNumber"].value;
			errormessage += validateItemNumber(message,x);
			if(errormessage != "") {
				var alertvalue = document.getElementById("alertThirdReport");
				alertvalue.style.display = "block";
				alertvalue.innerHTML = "Error detected!\n" + errormessage;
				return false;
			}

			return true;
		}
		function validateItemNumber(error, x) {
			if (x.match(/^\d{6,7}$/)) {
				error = "";
				return error;

			} else if (x == "") {
				error = "Please Enter an Item Number\n";

			} else {
				error = "Item Number is invalid: should have 6 or 7 digits\n";
			}

			return error;
		}
		function checkDate(message, dateEval) {
			message = "";
				// birthday check
				var month31 = ["1", "3", "5", "7", "8", "10", "12"];
				var month30 = ["4", "6", "9", "11" ];
				var date = document.forms["firstReportForm"][dateEval].value;
				// splice date to mm/dd/yyyy format
				var spliced = date.split("-");
				if(spliced.length != 3) return (message += "Enter valid date");
				var month = spliced[1];
				var day = spliced[2];
				var year = spliced[0];
				if(month.charAt(0) == "0") month = month.substr(1);
				if(month > 0 && month <= 12) {
					if(month31.indexOf(month) > -1) {
						if(day < 1 || day > 31) {
							message += "Enter valid month\n";
						}
					} else
						if(month30.indexOf(month) > -1) {
							if(day < 1 || day > 30) {
								message += "Enter valid day\n";
							}
						} else {
							message += "Enter valid day\n";
						}
					if(!year.match(/^[0-9]{4}$/)) {
						message += "Enter valid year\n";
					}

				 } else {
					message += "Enter valid month\n";
				}
				return message;
			}
	</script>

	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<title>Josbrian Interface - Reports</title>
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

   textarea:focus {
    height: 10em;
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
								<li name="firstReport" id="firstReport" class="active"><a href="#firstReportLink" data-toggle="pill">First Report</a></li>
								<li name="secondReport" id="secondReport"><a href="#secondReportLink" data-toggle="pill">Second Report</a></li>
								<li name="thirdReport" id="thirdReport"><a href="#thirdReportLink" data-toggle="pill">Third Report</a></li>
								<li name="fourthReport" id="fourthReport"><a href="#fourthReportLink" data-toggle="pill">Fourth Report</a></li>
					 		</ul>
          	</div>
      		</div>
			</nav>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<!-- Screen Reader -->
				<h1 class="sr-only">Report Manipulation</h1>
				<div class="tab-content">
					<div id="firstReportLink" class="tab-pane fade in active">
						<!-- This is for the panel creation -->
						<div class="col-md-4 col-md-offset-4">
							<!-- Used to display the alerts -->
							<div id="alertboxAdd" class="alert alert-danger fade in" style="display: none; color: black; white-space: pre-wrap;">

							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><b>Report One:</b></h3>
								</div>
								<div class="panel-body">
									<fieldset>
										<form name="firstReportForm" onsubmit="return report1Validate();" method="POST" action="reportOne.php">
											<div class="form-group">
												<input class="form-control" placeholder="Add a date (YYYY-MM-DD Format)" name="adEventstart" id="adEventstart" type="text">
											</div>
											<button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Submit</button>
											<button class="btn btn-lg btn-danger btn-block" type="reset" value="Reset">Clear</button>
										</form>
									</fieldset>
								</div>
							</div>
						</div>
					</div>

					<div id="secondReportLink" class="tab-pane fade">
						<!-- This is for the panel creation -->
						<div class="col-md-4 col-md-offset-4">
							<!-- Used to display the alerts -->
							<div id="alertSecondReport" class="alert alert-danger fade in" style="display: none; color: black; white-space: pre-wrap;">

							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><b>Second Report:</b></h3>
								</div>
								<div class="panel-body">
									<form name="secondReportForm" onsubmit="return report2Validate();" method="POST" action="reportTwo.php">
										<div class="form-group">
											<select style="color: rgba(0,0,0,0.5);" class="form-control" id="promotionType" name="promotionType">
																					<option style="color: rgba(0,0,0,0);" value="" disabled selected>Promotion Type</option>
																					<option value="Dollar">Dollar</option>
																					<option value="Percent">Percent</option>
																			</select>
										</div>
										<div class="form-group">
											<input class="form-control" placeholder="Amount Off" name="amountOff" id="amountOff" type="text">
										</div>
										<button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Submit</button>
										<button class="btn btn-lg btn-danger btn-block" type="reset" value="Reset">Clear</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div id="thirdReportLink" class="tab-pane fade">
						<!-- This is for the panel creation -->
						<div class="col-md-4 col-md-offset-4">
							<!-- Used to display the alerts -->
							<div id="alertThirdReport" class="alert alert-danger fade in" style="display: none; color: black; white-space: pre-wrap;">

							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><b>Third Report:</b></h3>
								</div>
								<div class="panel-body">
									<form name="thirdReportForm" onsubmit="return report3Validate();" method="POST" action="reportThree.php">
										<input class="form-control" placeholder="Item Number" name="itemNumber" id="itemNumber" type="text">
										<button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div id="fourthReportLink" class="tab-pane fade">
						<!-- This is for the panel creation -->
						<div class="col-md-4 col-md-offset-4">
							<!-- Used to display the alerts -->
							<div id="alertFourthReport" class="alert alert-danger fade in" style="display: none; color: black; white-space: pre-wrap;">

							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title"><b>Fourth Report:</b></h3>
								</div>
								<div class="panel-body">
									<form name="fourthReportForm" onsubmit="" method="POST" action="reportFour.php">

										<button class="btn btn-lg btn-success btn-block" type="submit" value="Submit">Submit</button>
									</form>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
<div class="clearfix"></div>
</div>
<!-- END WRAPPER -->

</body>
</html>
