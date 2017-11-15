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
	<title>Josbrian Interface - Promotion Search Results</title>
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

    tr:hover td {background:#36465d; cursor: pointer;}
    tr:hover p  {color:#ffffff;}
    p{
           font-size: 100%;
    }
	</style>

	<script type="text/javascript">

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
						<li class="active">
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
				 <li name="newPromotion" id="newPromotion"><a href="promotions.html">Add Promotion</a></li>
				 <li name="searchPromotion" id="searchPromotion" class="active"><a href="promotions.html"><span class="glyphicon glyphicon-search"></span> Search Promotions</a></li>
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
																	$data = grab_sql_promotion($_POST['promotionName'], $_POST['promotionType'], $_POST['promotionAmountOff']);
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
																		echo "<tr data-toggle='modal' data-target='#itemDetailModal'>";
																		foreach($row as $_column) {
																			echo "<td><p><div name='item$increment' id='item$increment'>{$_column}</div></p></td>";
																			$bounce_back++;
																			$increment++;
																		}
																		// should readjust back to itemNumber designated index value
																		// then simply iterate 6 times in evaluateData to grab all fields
																		$adjust=$increment - $bounce_back;
																		echo "<td><button style='padding: 10px 10px;' onclick='evaluateData($adjust)' type='button' class='btn btn-primary' data-toggle='modal' data-target='#itemEditModal'><span class='glyphicon glyphicon-pencil'></span></button></td>
                                    			<td><button style='padding: 10px 10px;' type='button' class='btn btn-primary' data-toggle='modal' data-target='#selectPromotionModal'><span class='glyphicon glyphicon-plus'></span></button></td>

																		</tr>";
																	}

																	echo "</tbody>";
																 ?>

                            </table>
                            </center>
                        </div>
                    	</div>

					<!-- END TABLE CONTENT -->

					</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
		<div class="clearfix"></div>
	</div>
	<!-- END WRAPPER -->

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
                     <div>
                       <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#selectPromotionModal">Select Promotion</button>
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

        <!--  RETURN ALL PROMOTIONS MODAL START -->

<div class="modal fade" id="selectPromotionModal" tabindex="-1" role="dialog" aria-labelledby="selectPromotionModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="selectPromotionModal" style="bottom-padding: 10px;"><b>Select Promotion:</b></h3>
        <button type="button" class="close" data-dismiss="modal" style="bottom-padding: 10px;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
          <tr>
            <th>Promo Header</th>
            <th>Promo Header</th>
            <th>Promo Header</th>
          </tr>
          <tr>
            <td>Data</td>
            <td>Data</td>
            <td>Data</td>
          </tr>
          <tr>
            <td>Data</td>
            <td>Data</td>
            <td>Data</td>
          </tr>
        </table>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" type="submit" value="Submit"><!--<span class="glyphicon glyphicon-floppy-disk"></span>-->Confirm</button>
      </div>
    </div>
  </div>
</div>
</div>
<!--  RETURN ALL PROMOTIONS MODAL END -->
</body>

</html>
