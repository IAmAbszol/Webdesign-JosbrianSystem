<?php
require('server_connection.inc');

require('display_result_ad.inc');

remove_promo_adevent();

function remove_promo_adevent() {

	// connect to the main database where the items are stored
  $conn = connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  if(!empty($_POST['promoRemoveCheckbox'])) {
    $error_array = array();
      foreach($_POST['promoRemoveCheckbox'] as $check) {
      	$adevent_code 	=  mysql_real_escape_string($_POST["adEventCodes"]);
        $promo_code    = mysql_real_escape_string($check);
        echo "$adevent_code";
        $verify_statement = "delete from AdEventPromotion where PromoCode='$promo_code' and EventCode='$adevent_code'";
        $verify_result = mysql_query($verify_statement);
        array_push($error_array, "Ad Event Promotion $promo_code removed successfully.");
      }
  }
    display_result(implode("</br>",$error_array) );
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
