<?php
require('server_connection.inc');

require('display_result_ad.inc');

insert_adevent();

function insert_adevent() {

	// connect to the main database where the items are stored
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$event_code = mysql_real_escape_string($_POST['adEventcode']);
	$event_name =  mysql_real_escape_string($_POST['adEventName']);
	$event_start =  mysql_real_escape_string($_POST['adEventstart']);
	$event_end =  mysql_real_escape_string($_POST['adEventend']);
	$event_description =  mysql_real_escape_string($_POST['adEventDescription']);
	$event_type =  mysql_real_escape_string($_POST['adEventType']);

	// create the statement
	$insertStatement = "insert AdEvent (EventCode, Name, StartDate, EndDate, Description, AdType) values ( '$event_code', '$event_name', '$event_start', '$event_end', '$event_description', '$event_type' )";

	$result = mysql_query($insertStatement);

	$message = "";
	$name = $_POST['adEventName']:
	if(!$result) {
		$message = "Error in inserting Ad: $name ". mysql_error();
	} else {
		$message = "Ad Event Successfully Added to Database: $name.";
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
