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
	<title>Josbrian Interface - Item Search Results</title>
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

   .glyphicon:empty{
      width: 100%;
   }

    tr:hover td {background:#36465d; cursor: pointer; color: #ffffff }
    tr:hover p  {color:#ffffff;}
    p{
           font-size: 100%;
    }
	</style>

<script>
/*START OF JQUERY*/
$(document).ready(function(){

$("select[title='category']").change(function() {
        var val = $(this).find("option:selected").text();
	ReadCategory();
        });
});

function ReadCategory() {

$("select[title='department']").empty();

var categoryValue = $("select[title='category']").val();

if(categoryValue == "ACCESSORIES/FOOTWEAR"){

$("select[title='department']").append("<option style='color: rgba(0,0,0,0);' value='' disabled selected>Department Name</option>");
$("select[title='department']").append("<option value='ACCESSORIES'>ACCESSORIES</option>");
$("select[title='department']").append("<option value='FOOTWEAR'>FOOTWEAR</option>");
}

if(categoryValue == "BASIC APPAREL"){

$("select[title='department']").append("<option style='color: rgba(0,0,0,0);' value='' disabled selected>Department Name</option>");
$("select[title='department']").append("<option value='CHILDRENS BASICS'>CHILDRENS BASICS</option>");
$("select[title='department']").append("<option value='LADIES BASICS'>LADIES BASICS</option>");
$("select[title='department']").append("<option value='MENS BASICS'>MENS BASIC</option>");
}

if(categoryValue == "FOOD CONVENIENCE"){

$("select[title='department']").append("<option style='color: rgba(0,0,0,0);' value='' disabled selected>Department Name</option>");
$("select[title='department']").append("<option value='CANDY'>CANDY</option>");
$("select[title='department']").append("<option value='REFRIGERATED'>REFRIGERATED</option>");
}

if(categoryValue == "FOOD GROCERY"){

$("select[title='department']").append("<option style='color: rgba(0,0,0,0);' value='' disabled selected>Department Name</option>");
$("select[title='department']").append("<option value='COOKIES/CRACKERS'>COOKIES/CRACKERS</option>");
$("select[title='department']").append("<option value='GROCERY'>GROCERY</option>");
$("select[title='department']").append("<option value='SALTY SNACKS'>SALTY SNACKS</option>");
}

}
/*END OF JQUERY*/
	$(document).ready(function () {
		hideSign();

			 $('tr').click(function () {
				if(this.style.background == "" || this.style.background =="white") {
						$(this).css('background', 'Blue');
				}
				else {
						$(this).css('background', 'white');
				}
			});

	});

	function hideSign(){
		var minus = document.getElementById('minusSign');
		minus.style.display = minus.style.display == 'none' ? 'block' : 'none';
	}

	function changeSign() {
		var plus = document.getElementById('plusSign');
		var minus = document.getElementById('minusSign');

		if(minus.style.display != 'none'){
			minus.style.display = minus.style.display == 'inline'  ? 'block' : 'none';
			plus.style.display = plus.style.display == 'none' ? 'block' : 'none';
		}
			else if(plus.style.display != 'none'){
				plus.style.display = plus.style.display == 'inline' ? 'block' : 'none';
				minus.style.display = minus.style.display == 'none' ? 'block' : 'none';
			}
			return false;
	}

	function test() {
		alert("hello");
		return true;
	}

	// change promoAddCheckbox by appending []
	function evaluatePromoAddition() {
		var selection = document.getElementById('promoAddCheckbox');
		var len = [].slice.call(document.querySelectorAll("[name='promoAddCheckbox']"))
    .filter(function(e) { return e.checked; }).length;
		if(len == 0) {
			var alertbox = document.getElementById("alertboxsearchpromos");
			alertbox.style.display = "block";
			alertbox.style.visibility = "visible";
			alertbox.innerHTML = "Select a promotion.";
			return false;
		}
		return true;
	}

	function evaluateSelection(i) {
		var insertCode = document.getElementById("item" + i).innerHTML;
		// assign code to hidden field
		var code = document.getElementById("itemCodeForPromo").value = insertCode;
	}

	// takes in index i to grab field data generated by dynamic php
	function evaluateData(i) {
		// grab selected row info
		var itemNum = document.getElementById("item" + i).innerHTML;
		var itemDes = document.getElementById("item" + (i+1)).innerHTML;
		var itemCat = document.getElementById("item" + (i+2)).innerHTML;
		var itemDep = document.getElementById("item" + (i+3)).innerHTML;
		var itemPur = document.getElementById("item" + (i+4)).innerHTML;
		var itemFul = document.getElementById("item" + (i+5)).innerHTML;

		// assign to respective categories in modal
		document.getElementById("itemNumber").value = itemNum;
		document.getElementById("description").value = itemDes;
		document.getElementById("category").value = itemCat;
		document.getElementById("department").value = itemDep;
		document.getElementById("cost").value = itemPur;
		document.getElementById("price").value = itemFul;

	}

	function addItemValidation() {
		var description = document.forms["itemUpdateForm"]["description"].value;
		var category = document.forms["itemUpdateForm"]["category"].value;
		var department = document.forms["itemUpdateForm"]["department"].value;
		var itemNumber = document.forms["itemUpdateForm"]["itemNumber"].value;
		var cost = document.forms["itemUpdateForm"]["cost"].value;
		var retailPrice = document.forms["itemUpdateForm"]["price"].value;
		var alertvalue = document.getElementById('alertboxitemadd');
		var error = "";

		description = toCapitalLetter(description);

		if (category == "")
			error += "Please enter a Category\n"

		if (department == "")
			error += "Please enter a Department\n"

		error += validateCost(error, cost);
		error += validatePrice(error, retailPrice);

		if (error != "") {
			alertvalue.style.display = "block";
			alertvalue.style.visibility = "visible";
			alertvalue.innerHTML = error;
			/*setTimeout("hideAlertItemAdd()", 3000);*/
			return false;
		}

		return true;
	}

	function hideAlertItemAdd() {
		document.getElementById("alertboxitemadd").style.display = "none";
		document.getElementById("alertboxitemadd").style.visibility = "hidden";
	}

	function toCapitalLetter(myElement) {

		myElement = myElement.toUpperCase(); //Upper case to the entered parameters

		return myElement;
	}

	function validateCost(error, x) {
		if (x.match(/^\${0,1}\d*(?:\.{0,1}\d{0,2})$/)) {

			//Erase the dollar sign
			var res = x.replace("$", "");
			x = res;

			error = "";
			return error;
		} else if (x == "") {
			error = "Please Enter a Purchase Price\n";

		} else {
			error = "Purchase Cost is invalid\n";
		}

		return error;
	}

	function validatePrice(error, x) {
		if (x.match(/^\${0,1}\d+(?:\.{0,1}\d{0,2})$/)) {

			//Erase the dollar sign
			var res = x.replace("$", "");
			x = res;

			error = "";
			return error;
		} else if (x == "") {
			error = "Please Enter a Retail Price\n";

		} else {
			error = "Retail Price is invalid\n";
		}

		return error;
	}

	function validateItemNumber(error, x) {
		if (x.match(/^\d{7}$/)) {
			error = "";
			return error;

		} else if (x == "") {
			error = "Please Enter an Item Number\n";

		} else {
			error = "Item Number is invalid: should have 7 digits\n";
		}

		return error;
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
						<li class="active">
							<a href="items.html">Items</a>
						</li>
						<li>
							<a href="promotions.html">Promotions</a>
						</li>
						<li>
							<a href="adEvent.html">Ad Events</a>
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
                  <center><li style="padding-top: 10px; padding-bottom: 10px;"><b>Items</b></li></center>
				 <li name="newItem" id="newItem"><a href="items.html">Add Item</a></li>
				 <li name="searchItem" id="searchItem" class="active"><a href="items.html"><span class="glyphicon glyphicon-search"></span> Search Items</a></li>
			</ul>
              </div>
              </div>
		</nav>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN CONTENT -->
		<div id="main-content">
			<div class="container-fluid">
				<!-- Screen Reader -->
				<h1 class="sr-only">Item Search</h1>
				<!-- Item Manipulation Panel -->
     <!--  TABLE TO RETURN DATA TO  -->

                        <div id="searchResults" class="container">
                         <div class="jumbotron">
                            <h2 style="padding-bottom: 20px;"><b>Item Search Results:</b></h2>
                            <center>
                            <table class="table" id="table">
														<!-- Listing Search -->
																<?php
																	include('php/new_search.php');
																	$data = grab_sql($_POST['itemNumber'], $_POST['description'], $_POST['category'], $_POST['department']);
																	echo "<thead><tr>";
																	for($i = 0; $i < mysql_num_fields($data); $i++) {
																		$field_info = mysql_fetch_field($data, $i);
																		echo "<th>{$field_info->name}</th>";
																	}
																	echo "<th>Edit Item</th><th>Add Promotion</th>
																	</tr></thead>";

																	echo "<tbody>";

																	// Print the data
																	$increment = 0;
																	while($row = mysql_fetch_row($data)) {
																		$bounce_back = 0;
																		$item_number = 0;
																		echo "<tr data-toggle='modal' data-target='#itemDetailModal'>";
																		foreach($row as $_column) {
																			if($bounce_back == 0) {
																				$item_number = $_column;
																			}
																			if(($bounce_back + 1) == count($row)) {
																				// first we need to check if a promotion is linked, if not we can stop this approach
																				$sale_price = grab_possible_promotion($item_number);

																				if($sale_price != "no") {
																					// promotion was attached, grabbing sale price
																					echo "<td><p><div><span style='text-decoration: line-through; color: #ff7272; white-space: nowrap;'>{$_column}</span></div> <div name='item$increment' id='item$increment'>$sale_price</div></p></td>";
																				} else
																					echo "<td><p><div name='item$increment' id='item$increment'>{$_column}</div></p></td>";

																			} else
																				echo "<td><p><div name='item$increment' id='item$increment'>{$_column}</div></p></td>";

																			$bounce_back++;
																			$increment++;
																		}
																		// should readjust back to itemNumber designated index value
																		// then simply iterate 6 times in evaluateData to grab all fields
																		$adjust=$increment - $bounce_back;
																		echo "<td><button style='padding: 10px 10px;' onclick='evaluateData($adjust)' type='button' class='btn btn-primary' data-toggle='modal' data-target='#itemEditModal'><span class='glyphicon glyphicon-pencil'></span></button></td>
                                    			<td><button style='padding: 10px 10px;' onclick='evaluateSelection($adjust)' type='button' class='btn btn-primary' data-toggle='modal' data-target='#selectPromotionModal'><span class='glyphicon glyphicon-plus'></span></button></td>

																		</tr>";
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
	<!-- END WRAPPER -->

	<!--  RETURN ALL PROMOTIONS MODAL START -->

<div class='modal fade' id='selectPromotionModal' tabindex='-1' role='dialog' aria-labelledby='selectPromotionModal' aria-hidden='true'>
  <div class='modal-dialog' role='document'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h3 class='modal-title' id='selectPromotionModal' style='bottom-padding: 10px;'><b>Select Promotion:</b></h3>
        <button type='button' class='close' data-dismiss='modal' style='bottom-padding: 10px;' aria-label='Close'>
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class='modal-body'>
			<div id='alertboxsearchpromos' class='alert alert-danger alert-dismissable fade in' style='display: none; color: black; white-space: pre-wrap;'>

			</div>
			<form name='itemAddPromotionForm' id='itemAddPromotionForm' onsubmit='return evaluatePromoAddition()' method='POST' action='php/new_update_item_promotion.php'>
			<!-- Hidden but links to what itemcode/row was clicked -->
				<input class='form-control' placeholder='' name='itemCodeForPromo' id='itemCodeForPromo' type='hidden' readonly>
				<center>
				<table class='table' id='selectPromoTable'>
				<!-- Listing Search -->";


																	$promo_data = grab_sql_promo_all();
																	echo "<thead><tr>";
																	for($i = 0; $i < mysql_num_fields($promo_data); $i++) {
																		$field_infos = mysql_fetch_field($promo_data, $i);
																		echo "<th>{$field_infos->name}</th>";
																	}
																	echo "<th>Add Promotion</th>
																	</tr></thead>";

																	echo "<tbody>";

																	// Print the data
																	$increment = 0;
																	while($row = mysql_fetch_assoc($promo_data)) {
																		$bounce_back = 0;
																		$link_code = $row['PromoCode'];
																		echo "<tr data-toggle='modal' data-target='#itemDetailModal'>";
																		foreach($row as $_column) {
																			echo "<td><p><div name='promo$increment' id='promo$increment'>{$_column}</div></p></td>";
																			$bounce_back++;
																			$increment++;
																		}
																		// should readjust back to itemNumber designated index value
																		// then simply iterate 5 times in evaluateData to grab all fields
																		$adjust=$increment - $bounce_back;
																		// change to [] if type='checkbox'
																		echo "<td><input type='radio' name='promoAddCheckbox' id='promoAddCheckbox' value='$link_code'></td>

																		</tr>";
																	}

																	echo "</tbody>

				</table>
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

<!-- Item Edit Modal -->
<div class="modal fade" id="itemEditModal" tabindex="-1" role="dialog" aria-labelledby="itemEditModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="itemEditModal" style="bottom-padding: 10px;"><b>Edit Item:</b></h3>
        <button type="button" class="close" data-dismiss="modal" style="bottom-padding: 10px;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
			<!-- Update Item Form -->
				<!-- Used to display the alerts -->
					<div id="alertboxitemadd" class="alert alert-danger alert-dismissable fade in" style="display: none; color: black; white-space: pre-wrap;">

					</div>
	        <form name="itemUpdateForm" id="itemUpdateForm" onsubmit="return addItemValidation();" method="POST" action="php/new_update_item.php">
							<div class="form-group">
							 <h5>Item Number:</h5>
							 <input class="form-control" placeholder="Item Number" name="itemNumber" id="itemNumber" type="text" readonly>
					 </div>
					 <div class="form-group">
									 <h5>Item Description:</h5>
								 <textarea rows="1" class="form-control" placeholder="Item Description" name="description" id="description" type="text"></textarea>
					 </div>
					 <div class="form-group">
									 <h5>Item Category:</h5>
									 <select style="color: rgba(0,0,0,0.5);" class="form-control" id="category" title="category" name="category">
						 <option style="color: rgba(0,0,0,0);" value="" disabled selected>Item Category</option>
						 <option value="ACCESSORIES/FOOTWEAR">ACCESSORIES/FOOTWEAR</option>
						 <option value="BASIC APPAREL">BASIC APPAREL</option>
						 <option value="FOOD CONVENIENCE">FOOD CONVENIENCE</option>
						 <option value="FOOD GROCERY">FOOD GROCERY</option>
									 </select>
					 </div>
					 <div class="form-group">
									 <h5>Department Name:&nbsp;&nbsp;</h5>
									 <select style="color: rgba(0,0,0,0.5);" class="form-control" id="department" title="department" name="department">
						 <option style="color: rgba(0,0,0,0);" value="" disabled selected>Department Name</option>
						 <option value="ACCESSORIES">ACCESSORIES</option>
						 <option value="FOOTWEAR">FOOTWEAR</option>
						 <option value="CHILDRENS BASICS">CHILDRENS BASICS</option>
						 <option value="LADIES BASICS">LADIES BASICS</option>
						 <option value="MENS BASIC">MENS BASIC</option>
						 <option value="CANDY">CANDY</option>
						 <option value="REFRIGERATED">REFRIGERATED</option>
						 <option value="COOKIES/CRACKERS">COOKIES/CRACKERS</option>
						 <option value="GROCERY">GROCERY</option>
						 <option value="SALTY SNACKS">SALTY SNACKS</option>
									 </select>
					 </div>
					 <div class="form-group">
									 <h5>Purchase Cost:</h5>
						 <input class="form-control" placeholder="Purchase Cost" name="cost" id="cost" type="text" value="">
					 </div>
					 <div class="form-group">
									 <h5>Full Retail Price:</h5>
						 <input class="form-control" placeholder="Full Retail Price" name="price" id="price" type="text" value="">
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

<!-- END OF MODAL PROMOTION PROMPTS -->
</body>

</html>
