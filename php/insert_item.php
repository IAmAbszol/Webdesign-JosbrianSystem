<!-- insert item
	Script that allows the item to be inserted into the database based on 
	requirements provided
-->

<?php
require('server_connection.inc');

require('display_result.inc');

insert_item();

function insert_item() {

	// connect to the main database where the items are stored	
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$item_number = $_POST['itemNumber'];	
	$item_description = $_POST['description'];
	$item_category = $_POST['category'];
	$department_name = $_POST['department'];
	$purchase_cost = $_POST['cost'];
	$retail_price = $_POST['price'];

	// create the statement
	$insertStatement = "insert Item (ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice) values ( '$item_number', '$item_description', '$item_category', '$department_name', '$purchase_cost', '$retail_price' )";

	$result = mysql_query($insertStatement);

	$message = "";

	if(!$result) {
		$message = "Error in inserting Item: $item_description: ". mysql_error();
	} else {
		$message = "Data for Item: $item_description.";
	}
	display_result($message);
}

function connect_to_db($server, $username, $pwd, $dbname) {
	$conn = mysql_connect($server, $username, $pwd);
	if(!$conn) {
		echo "Unable to connect to DB: " . mysql_error();
			exit;
	}
	$dbh = mysql_select_db($dbname);
	if(!$dbh) {
		echo "Unable to select " .$dbname. ": " . mysql_error();
		exit; 
	}
}

?> 
