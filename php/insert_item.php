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
	$item_number = mysql_real_escape_string($_POST['itemNumber']);
	$item_description =  mysql_real_escape_string($_POST['description']);
	$item_category =  mysql_real_escape_string($_POST['category']);
	$department_name =  mysql_real_escape_string($_POST['department']);
	$purchase_cost =  mysql_real_escape_string($_POST['purchaseCost']);
	$retail_price =  mysql_real_escape_string($_POST['retailPrice']);

	// create the statement
	$insertStatement = "insert Item (ItemNumber, ItemDescription, Category, DepartmentName, PurchaseCost, FullRetailPrice) values ( '$item_number', '$item_description', '$item_category', '$department_name', '$purchase_cost', '$retail_price' )";

	$result = mysql_query($insertStatement);

	$message = "";

	$tmp_Desc = $_POST['description'];
	if(!$result) {
		$message = "Error in inserting Item: $tmp_Desc: ". mysql_error();
	} else {
		$message = "Item Successfully Added to Database: $tmp_Desc.";
	}
	display_result_item($message);
}

function connect_to_db($server, $username, $pwd, $dbname) {
	$conn = mysql_connect($server, $username, $pwd);
	if(!$conn) {
			display_result_item("Unable to connect to DB: " . mysql_error());
			exit;
	}
	$dbh = mysql_select_db($dbname);
	if(!$dbh) {
		display_result_item("Unable to select " .$dbname. ": " . mysql_error());
		exit;
	}
}

?>
