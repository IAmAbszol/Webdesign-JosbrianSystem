<?php
require('server_connection.inc');

require('display_result_ad.inc');

insert_adevent();

function insert_adevent() {

	// connect to the main database where the items are stored
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$event_code = $_POST['adEventcode'];
	$event_name = $_POST['adEventName'];
	$event_start = $_POST['adEventstart'];
	$event_end = $_POST['adEventend'];
	$event_description = $_POST['adEventDescription'];
	$event_type = $_POST['adEventType'];

	// create the statement
	$insertStatement = "insert AdEvent (EventCode, Name, StartDate, EndDate, Description, AdType) values ( '$event_code', '$event_name', '$event_start', '$event_end', '$event_description', '$event_type' )";

	$result = mysql_query($insertStatement);

	$message = "";

	if(!$result) {
<<<<<<< HEAD
		$message = "Error in inserting Ad: $_POST['adEventName']: ". mysql_error();
	} else {
		$message = "Ad Event Successfully Added to Database: $_POST['adEventName'].";
=======
		$message = "Error in inserting Ad: $event_name: ". mysql_error();
	} else {
		$message = "Ad Event Successfully Added to Database: $event_name.";
>>>>>>> ee638205f3fd4c8798a4476f79b5643a2cb999c0
	}
	display_result($message);
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
