<?php

require ('server_connection.inc');
require ('display_result_ad.inc');

update_adevent();

function update_adevent() {
  $conn = connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$event_code = mysql_real_escape_string($_POST['adEventCode']);
	$event_name =  mysql_real_escape_string($_POST['adEventName']);
	$event_start =  mysql_real_escape_string($_POST['adEventstart']);
	$event_end =  mysql_real_escape_string($_POST['adEventend']);
	$event_description =  mysql_real_escape_string($_POST['adEventDescription']);
	$event_type =  mysql_real_escape_string($_POST['adEventType']);

  $update_adevent = "update AdEvent set Name='$event_name', StartDate='$event_start', EndDate='$event_end', Description='$event_description', AdType='$event_type' where EventCode='$event_code'";
  $result = mysql_query($update_adevent);

  $message = "";
  if(!$result) {
    $message = "Error updating Ad Event: $event_code.";
  } else {
    $message = "Succesfully updated Ad Event: $event_code.";
  }

  display_result($message);
}

function connect_to_db($server, $username, $pwd, $dbname) {
	$conn = mysql_connect($server, $username, $pwd);
	if(!$conn) {
			display_result("Unable to connect to DB: " . mysql_error());
			exit;
	}
	$dbh = mysql_select_db($dbname);
	if(!$dbh) {
		display_result("Unable to select " .$dbname. ": " . mysql_error());
		exit;
	}
}

 ?>
