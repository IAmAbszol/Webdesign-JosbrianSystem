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
	<title>Josbrian Interface - Ad Event Search Results</title>
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

	<script type="text/javascript">
	function evaluatePromoRemove() {
		var selection = document.getElementById('promoRemoveCheckbox[]');
		var len = [].slice.call(document.querySelectorAll("[name='promoRemoveCheckbox[]']"))
		.filter(function(e) { return e.checked; }).length;
		if(len == 0) {
			var alertbox = document.getElementById("alertboxpromoremove");
			alertbox.style.display = "block";
			alertbox.style.visibility = "visible";
			alertbox.innerHTML = "Select Ad Events.";
			return false;
		}
		return true;
	}
	function evaluateSelection(i) {
		var insertCode = document.getElementById("adevent" + i).innerHTML;
		// assign code to hidden field
		var code = document.getElementById("adEventCodes").value = insertCode;
		if (window.XMLHttpRequest) {
				 // code for IE7+, Firefox, Chrome, Opera, Safari
				 xmlhttp = new XMLHttpRequest();
		 } else {
				 // code for IE6, IE5
				 xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		 }
		 xmlhttp.onreadystatechange = function() {
				 if (this.readyState == 4 && this.status == 200) {
						 document.getElementById("ponzi").innerHTML = this.responseText;
				 }
		 };
		 xmlhttp.open("GET","php/middle_man2.php?c="+insertCode,true);
		 xmlhttp.send();
	}
		// takes in index i to grab field data generated by dynamic php
		function evaluateData(i) {
			// grab selected row info
			var eventcode = document.getElementById("adevent" + i).innerHTML;
			var eventname = document.getElementById("adevent" + (i+1)).innerHTML;
			var eventstart = document.getElementById("adevent" + (i+2)).innerHTML;
			var eventend = document.getElementById("adevent" + (i+3)).innerHTML;
			var eventdescription = document.getElementById("adevent" + (i+4)).innerHTML;
			var eventtype = document.getElementById("adevent" + (i+5)).innerHTML;

			// assign to respective categories in modal
			document.getElementById("adEventCode").value = eventcode;
			document.getElementById("adEventName").value = eventname;
			document.getElementById("adEventDescription").value = eventdescription;
			document.getElementById("adEventstart").value = eventstart;
			document.getElementById("adEventend").value = eventend;
			document.getElementById("adEventType").value = eventtype;

		}// validate
		function validateInput() {
			var errormessage = "";
			var message = "";
			errormessage += testAdName(message);
			var description = document.forms["adEventAddForm"]["adEventDescription"].value;
			if(description == "") errormessage += "Please enter a valid description\n";
			errormessage += testAdType(message);
			errormessage += checkDate(message, "adEventstart");
			errormessage += checkDate(message, "adEventend");
			errormessage += checkCode(message);
			if(errormessage != "") {
				var alertvalue = document.getElementById("alertboxadeventadd");
				alertvalue.style.display = "block";
				alertvalue.innerHTML = "Error detected!\n" + errormessage;
				return false;
			}

			return true;
		}
		function checkCode(message) {
			message = "";
			var code = document.forms["adEventAddForm"]["adEventCode"].value;
			if(code.length == 11) {
				if(code == code.toUpperCase()) {
					// shweet
				} else {
					message = "Code must be capitalized\n";
				}
			} else {
				message = "Code must be of length 11\n";
			}
			return message;
		}
		function checkDate(message, dateEval) {
			message = "";
				// birthday check
				var month31 = ["1", "3", "5", "7", "8", "10", "12"];
				var month30 = ["4", "6", "9", "11" ];
				var date = document.forms["adEventAddForm"][dateEval].value;
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
		function testAdType(message) {
			message = "";
			var adType = document.forms["adEventAddForm"]["adEventType"].value;

			if (adType == "") {
				message = "Please select a promotion type\n";
			} else { }
			return message;
		}
		function testAdName(message) {
			message = "";
			var adName = document.forms["adEventAddForm"]["adEventName"].value;

			if (adName == "") {
				message = "Please enter a name\n";
			} else {
				if (adName.match(/[^A-Za-z-0-9'  ]/) || adName.match(/^-[A-Za-z0-9]/) ) {
					message = "Name must contain text only\n";
				}
			}
			return message;
		}
	</script>

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
						<li class="active">
							<a href="adEvent.html">Ad Events</a>
						</li>
						<li>
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
                  <center><li style="padding-top: 10px; padding-bottom: 10px;"><b>Ad Events</b></li></center>
				 <li name="newAdEvent" id="newAdEvent"><a href="adEvent.html">Add Ad Event</a></li>
				 <li name="searchAdEvent" id="searchAdEvent" class="active"><a href="adEvent.html"><span class="glyphicon glyphicon-search"></span> Search Ad Events</a></li>
			</ul>
              </div>
              </div>
		</nav>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<!-- Screen Reader -->
				<h1 class="sr-only">Ad Event Search</h1>
				<!-- Item Manipulation Panel -->
     <!--  TABLE TO RETURN DATA TO  -->

                        <div id="searchResults" class="container">
                         <div class="jumbotron">
                            <h2 style="padding-bottom: 20px;"><b>Ad Event Search Results:</b></h2>
                            <center>
                            <table class="table" id="table">
														<!-- Listing Search -->
																<?php
																	include('php/new_search.php');
																	$promo_link = 0;
																	$data = grab_sql_adevent_all();
																	echo "<thead><tr>";
																	for($i = 0; $i < mysql_num_fields($data); $i++) {
																		$field_info = mysql_fetch_field($data, $i);
																		echo "<th>{$field_info->name}</th>";
																	}
																	echo "<th>Edit Ad Event</th><th>Remove Linked Promotions</th>
																	</tr></thead>";

																	echo "<tbody>";

																	// Print the data
																	$increment = 0;
																	while($row = mysql_fetch_row($data)) {
																		$bounce_back = 0;
																		echo "<tr data-toggle='modal' data-target='#promotionDetailModal'>";
																		foreach($row as $_column) {
																			if($bounce_back == 0) $promo_link = $_column;
																			echo "<td><p><div name='adevent$increment' id='adevent$increment'>{$_column}</div></p></td>";
																			$bounce_back++;
																			$increment++;
																		}
																		// should readjust back to itemNumber designated index value
																		// then simply iterate 6 times in evaluateData to grab all fields
																		$adjust=$increment - $bounce_back;
																		echo "<td><button style='padding: 10px 10px;' onclick='evaluateData($adjust)' type='button' class='btn btn-primary' data-toggle='modal' data-target='#promotionEditModal'><span class='glyphicon glyphicon-pencil'></span></button></td>
																		";
																		if(grab_linked_promotions_to_ad($promo_link) != "no") {
																			echo "<td><button style='padding: 10px 10px;' id='remove_promo[]' name='remove_promo[]' onclick='evaluateSelection($adjust)' type='button' class='btn btn-primary' data-toggle='modal' data-target='#selectLinkedItems'><span class='glyphicon glyphicon-minus'></span></button></td>";
																		}
																		echo "</tr>";
																	}

																	echo "</tbody>



		                             </table>
		                             </center>
		                         </div>
		                     	</div>

		 					<!-- END TABLE CONTENT -->

		 					</div>
		 			</div>
		 		</div>
		 		<!-- END MAIN CONTENT -->
		 		<div class='clearfix'></div>
		 	</div>
		 	<!-- END WRAPPER --><div class='modal fade' id='selectLinkedItems' tabindex='-1' role='dialog' aria-labelledby='selectLinkedItems' aria-hidden='true'>
				<div class='modal-dialog' role='document'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h3 class='modal-title' id='selectLinkedItems' style='bottom-padding: 10px;'><b>Select Items To Remove From Promotion:</b></h3>
							<button type='button' class='close' data-dismiss='modal' style='bottom-padding: 10px;' aria-label='Close'>
								<span aria-hidden='true'>&times;</span>
							</button>
						</div>
						<div class='modal-body' style='overflow-y: scroll; max-height: 85%'>
						<div id='alertboxitemremove' class='alert alert-danger alert-dismissable fade in' style='display: none; color: black; white-space: pre-wrap;'>

						</div>
						<form name='removeLinkedPromos' id='removeLinkedPromos' onsubmit='return evaluatePromoRemove()' method='POST' action='php/new_remove_promo_adevent.php'>
						<!-- Hidden but links to what itemcode/row was clicked -->
							<input class='form-control' placeholder='' name='adEventCodes' id='adEventCodes' type='hidden' readonly>
							<center>
							<div id='ponzi' name='ponzi'>

							</div>
							</center>
						<div class='modal-footer'>
							 <input class='btn btn-secondary' data-dismiss='modal' value='Close'>
							 <input class='btn' class='btn btn-lg btn-success btn-block' type='submit' value='Submit'>
						</div>
						</form>
					</div>
				</div>
			</div>
			</div>";
						?>
		<!--  RETURN ALL PROMOTIONS MODAL END -->

    <!-- START OF MODAL PROMOTION PROMPTS -->

<!-- Promotion Edit Modal -->
<div class="modal fade" id="promotionEditModal" tabindex="-1" role="dialog" aria-labelledby="itemEditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="itemEditModal" style="bottom-padding: 10px;"><b>Edit Ad Event:</b></h3>
        <button type="button" class="close" data-dismiss="modal" style="bottom-padding: 10px;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<!-- Update Item Form -->
				<!-- Used to display the alerts -->
					<div id="alertboxadeventadd" class="alert alert-danger alert-dismissable fade in" style="display: none; color: black; white-space: pre-wrap;">

					</div>
	        <form name="adEventAddForm" id="adEventAddForm" onsubmit="return validateInput();" method="POST" action="php/ad_event_update.php">
							<div class="form-group">
							 <h5>Ad Event Code:</h5>
							 	<input class="form-control" placeholder="Ad Event Code" name="adEventCode" id="adEventCode" type="text" readonly>
					 		</div>
							<div class="form-group">
	 						 <input class="form-control" placeholder="Add an Ad Event Name" name="adEventName" id="adEventName" type="text">
	 					 </div>
	 					 <div class="form-group">
	 						 <textarea rows="1" class="form-control" placeholder="Add an Ad Event Description" name="adEventDescription" id="adEventDescription"
	 							type="text"></textarea>
	 					 </div>
	 					 <div class="form-group">
	 						 <select style="color: rgba(0,0,0,0.5);" class="form-control" id="adEventType" name="adEventType">
	 							 <option style="color: rgba(0,0,0,0);" value="" disabled selected>Add an Ad Event Type</option>
	 							 <option value="Circular">Circular</option>
	 							 <option value="PassOut">Pass Out</option>
	 							 <option value="Planner">Planner</option>
	 						 </select>
	 					 </div>
	 					 <div class="form-group">
	 						 <input class="form-control" placeholder="Add a Starting date (YYYY-MM-DD Format)" name="adEventstart" id="adEventstart" type="text">
	 					 </div>
	 					 <div class="form-group">
	 						 <input class="form-control" placeholder="Add an Ending date (YYYY-MM-DD Format)" name="adEventend" id="adEventend" type="text">
	 					 </div>

				 </div>
				 <div class="modal-footer">
				 		<input class="btn btn-secondary" data-dismiss="modal"value="Close">
				 		<input class="btn" class="btn btn-lg btn-success btn-block" type="submit" value="Submit">
				 </div>
	      	</form>
	    </div>
	  </div>
	</div>
</div>
</body>

</html>
