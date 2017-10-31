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
	
	// append string
	$appendString="";
	
	// setup string
	if($item_number != '') 		$appendString .= "ItemNumber='$item_number' AND ";
	if($item_description != '') $appendString .= "ItemDescription='$item_description' AND ";
	if($item_category != '') $appendString .= "Category='$item_category' AND ";
	if($department_name != '') $appendString .= "DepartmentName='$department_name' AND ";

	$appendString = str_lreplace("AND","",$appendString);
	// create the statement
	$searchStatement = "select * from Item where $appendString";

	$result = mysql_query($searchStatement);

	$message = "";

	if(!$result) {
		$message = "Error in updating Item: $item_number: ". mysql_error();
	} else {
		$message = "Data for Item: $item_number.";
	}
	echo "<table><tr>";
	for($i = 0; $i < mysql_num_fields($result); $i++) {
		$field_info = mysql_fetch_field($result, $i);
		echo "<th>{$field_info->name}</th>";
	}

	// Print the data
	while($row = mysql_fetch_row($result)) {
		echo "<tr>";
		foreach($row as $_column) {
			echo "<td>{$_column}</td>";
		}
		echo "</tr>";
	}

	echo "</table>";
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
