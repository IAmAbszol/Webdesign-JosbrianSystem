<?php
require('server_connection.inc');

require('display_result_promo.inc');

remove_promo_item();

function remove_promo_item() {

	// connect to the main database where the items are stored
  $conn = connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  if(!empty($_POST['itemRemoveCheckbox'])) {
    $error_array = array();
      foreach($_POST['itemRemoveCheckbox'] as $check) {
      	$promo_code 	=  mysql_real_escape_string($_POST["promoCodeForLinked"]);
        $item_code    = mysql_real_escape_string($check);

        $verify_statement = "delete from PromotionItem where PromoCode='$promo_code' and ItemNumber='$item_code'";
        $verify_result = mysql_query($verify_statement);
        array_push($error_array, "Promotion Item $item_code removed successfully.");
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
