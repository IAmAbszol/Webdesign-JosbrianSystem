<!-- insert item
	Script that allows the item to be inserted into the database based on
	requirements provided
-->

<?php
require('server_connection.inc');

require('display_result.inc');

update_item();

function update_item() {

	// connect to the main database where the items are stored
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$item_number = $_POST['itemNumber'];
	$item_description = $_POST['description'];
	$item_category = $_POST['category'];
	$department_name = $_POST['department'];
	$purchase_cost = $_POST['purchaseCost'];
	$retail_price = $_POST['retailPrice'];

	// append string
	$appendString="";

	// setup string
	if($item_number != '')			$appendString .= "ItemNumber='$item_number', ";
	if($item_description != '') $appendString .= "ItemDescription='$item_description', ";
	if($item_category != '') $appendString .= "Category='$item_category', ";
	if($department_name != '') $appendString .= "DepartmentName='$department_name', ";
	if($purchase_cost != '') $appendString .= "PurchaseCost='$purchase_cost', ";
	if($retail_price != '') $appendString .= "FullRetailPrice='$retail_price', ";

	$appendString = str_lreplace(",","",$appendString);
	// create the statement
	$insertStatement = "update Item set $appendString where ItemNumber='$item_number'";

	$result = mysql_query($insertStatement);

	$message = "";

	if(!$result) {
		$message = "Error in updating Item: $item_number: ". mysql_error();
	} else {
		$message = "Item Successfully Updated for ItemNumber: $item_number.";
	}
	display_result($message);
}

function str_lreplace($search, $replace, $subject)
{
    $pos = strrpos($subject, $search);

    if($pos !== false)
    {
        $subject = substr_replace($subject, $replace, $pos, strlen($search));
    }

    return $subject;
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
