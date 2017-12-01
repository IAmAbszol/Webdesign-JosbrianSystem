<?php

require ('server_connection.inc');
require ('display_result_ad.inc');

updateToAdEvent();

function updateToAdEvent() {
  $conn = connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  if(!empty($_POST['adEventAddCheckbox'])) {
      $error_array = array();
      foreach($_POST['adEventAddCheckbox'] as $check) {
      	$promo_code 	=  mysql_real_escape_string($_POST["promoCodeForAdEvent"]);
      	$adevent_code	=  mysql_real_escape_string($check);
        $adEventNotes = mysql_real_escape_string($_POST["adEventNotes"]);

        $verify_statement = "select * from AdEventPromotion where PromoCode='$promo_code' and EventCode='$adevent_code'";
        $verify_result = mysql_query($verify_statement);

        if(mysql_num_rows($verify_result) == 0) {
          $tmp_statement = "insert AdEventPromotion (EventCode, PromoCode, Notes) values ('$adevent_code', '$promo_code', '$adEventNotes');";
          $tmp_result = mysql_query($tmp_statement);
          array_push($error_array, "Ad Event successfully added $adevent_code.");
        } else {
          array_push($error_array, "Error inserting Ad Event $adevent_code.");
        }
      }
        display_result(implode("</br>",$error_array) );
  }
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
