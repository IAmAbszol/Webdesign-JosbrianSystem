<!-- insert item
	Script that allows the item to be inserted into the database based on 
	requirements provided
-->

<?php
require('server_connection.inc');

require('display_result_promo.inc');

insert_promotion();

function insert_promotion() {

	// connect to the main database where the items are stored	
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$promo_name = $_POST['promotionName'];
	$promo_desc = $_POST['promotionDescription'];
	$promo_type = $_POST['promotionType'];
	$amount     = $_POST['amountOff'];
	// create the statement
	$insertStatement = "insert Promotion (Name, Description, AmountOff, PromoType) values ( '$promo_name', '$promo_desc', '$amount', '$promo_type')";

	$result = mysql_query($insertStatement);

	$message = "";

	if(!$result) {
		$message = "Error in inserting Promotion: $promo_name: ". mysql_error();
	} else {
		$message = "Promotion Successfully Added to Database: $promo_name.";
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
