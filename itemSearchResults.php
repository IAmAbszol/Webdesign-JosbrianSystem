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

    tr:hover td {background:#36465d; cursor: pointer;}
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
							<a class="btn btn-default" href="index.html">
								<i class="glyphicon glyphicon-home"></i>
							</a>
						</li>
						<li class="active">
							<a href="items.html">Items</a>
						</li>
						<li>
							<a href="promotions.html">Promotions</a>
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
				<li name="newItem" id="newItem"><a href="items.html" data-toggle="pill">Add Item</a></li>
				 <li name="updateItem" id="updateItem"><a href="items.html" data-toggle="pill">Update Item</a></li>
				 <li name="searchItem" id="searchItem" class="active"><a href="items.html" data-toggle="pill"><span class="glyphicon glyphicon-search"></span> Search Items</a></li>
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
			<!--	<form accept-charset="UTF-8" role="form" action="" method="POST"> -->

     <!--  TABLE TO RETURN DATA TO  -->



                        <div id="searchResults" class="container">
                         <div class="jumbotron">
                            <h2 style="padding-bottom: 20px;"><b>Item Search Results:</b></h2>
                            <center>
                            <table class="table" id="table">
                                <thead>
                                  <tr>
                                    <center>
                                    <th>Example 1</th>
                                    <th>Example 2</th>
                                    <th>Example 3</th>
                                    <th>Example 4</th>
                                    <th>Edit Item</th>
                                    <th>Add Promotion</th>
                                    </center>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr data-toggle="modal" data-target="#itemDetailModal">
                                    <td><p>Result 1</p></td>
                                    <td><p>Result 1</p></td>
                                    <td><p>Result 1</p></td>
                                    <td><p>Result 1</p></td>
                                    <td><button style="padding: 10px 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemEditModal"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                    <td><button style="padding: 10px 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=""><span class="glyphicon glyphicon-plus"></span></button></td>
                                  </tr>
                                  <tr data-toggle="modal" data-target="#itemDetailModal">
                                    <td><p>Result 1</p></td>
                                    <td><p>Result 1</p></td>
                                    <td><p>Result 1</p></td>
                                    <td><p>Result 1</p></td>
                                    <td><button style="padding: 10px 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemEditModal"><span class="glyphicon glyphicon-pencil"></span></button></td>
                                    <td><button style="padding: 10px 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target=""><span class="glyphicon glyphicon-plus"></span></button></td>
                                  </tr>
                                </tbody>
                            </table>
                            </center>
                        </div>
                    	</div>

					</div>
			</div>
		</div>
		<!-- END MAIN CONTENT -->
		<div class="clearfix"></div>
	</div>
	<!-- END WRAPPER -->

    <!-- START OF MODAL PROMOTION PROMPTS -->


    <!-- Button trigger details modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemDetailModal">
  Row to click on.
</button>

<!-- Promotion Details Modal -->
<div class="modal fade" id="itemDetailModal" tabindex="-1" role="dialog" aria-labelledby="itemDetailTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="itemDetailTitle" style="bottom-padding: 10px;"><b>Item Details:</b></h3>
        <button type="button" class="close" data-dismiss="modal" style="bottom-padding: 10px;" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table" id="itemDetailsTable" name="itemDetailsTable">
            <thead>
              <tr>
                <th>Detail 1</th>
                <th>Detail 2</th>
                <th>Detail 3</th>
                <th>Detail 4</th>
                <th>Detail 5</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
                <td>Data</td>
              </tr>
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button style="float: left;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#itemEditModal"><span class="glyphicon glyphicon-pencil"></span>&nbsp;Edit</button>
      </div>
    </div>
  </div>
</div>



<!-- Promotion Edit Modal -->
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
        <form name="itemUpdateForm" onsubmit="validateItemUpdate()">
             <div class="form-group">
               <h5>Item Number:</h5>
 			   <input class="form-control" placeholder="Item Number" name="itemNumber" id="itemNumber" type="text">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" type="submit" value="Submit"><!--<span class="glyphicon glyphicon-floppy-disk"></span>-->Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- END OF MODAL PROMOTION PROMPTS -->
</body>

</html>
