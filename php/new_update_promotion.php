<!-- insert promo
	Script that allows the promo to be inserted into the database based on
	requirements provided
-->

<?php
require('server_connection.inc');

require('display_result_promo.inc');

update_promo();

function update_promo() {
	// connect to the main database where the promos are stored
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

	$price = 0;

	$promo_code = $_POST['promoCode'];
	$promo_name = $_POST['promoName'];
	$promo_description = $_POST['promoDesc'];
	$promo_type = $_POST['promoType'];
	$promo_amount = $_POST['promoAmount'];

	// first we grab the pre-existing entry and reapply amounts to the stored item values
	$statement_getAmount = "select AmountOff, PromoType from Promotion where PromoCode='$promo_code'";
	$returnResult = mysql_query($statement_getAmount);

	// next we grab the PromotionItem table and reapply the sale price.
	// this is then recalculated after the edit has been made.
	// should've resulted in a 1 output query, any more then the schema must broken. Any less, we skip this step
	if(mysql_num_rows($returnResult) > 0) {
		while($the_row = mysql_fetch_assoc($returnResult)) {
			// run loop evaluating prices
			$myAmount = $the_row['AmountOff'];
			$myType 	= $the_row['PromoType'];

			$statement_getSalePrice = "select SalePrice from PromotionItem where PromoCode='$promo_code'";
			$returnResultItem = mysql_query($statement_getSalePrice);

			$the_row_item = mysql_fetch_array($returnResultItem);
			$myPrice	= $the_row_item['SalePrice'];

			$price = recalculatePrice($myAmount, $myType, $myPrice);

			// calculate new price
			$new_price = calculatePrice($promo_amount, $promo_type, $price);

			// new price achieved, now add it back into the Promotion Item database
			$update_statement = "update PromotionItem set SalePrice='$new_price' where PromoCode='$promo_code'";
			$update_result = mysql_query($update_statement);
		}
	}

	// append string
	$appendString="";

	// setup string
	if($promo_code != '')			$appendString .= "PromoCode='$promo_code', ";
	if($promo_name != '') $appendString .= "Name='$promo_name', ";
	if($promo_description != '') $appendString .= "Description='$promo_description', ";
	if($promo_type != '') $appendString .= "PromoType='$promo_type', ";
	if($promo_amount != '') $appendString .= "AmountOff='$promo_amount', ";

	$appendString = str_lreplace(",","",$appendString);
	// create the statement
	$insertStatement = "update Promotion set $appendString where PromoCode='$promo_code';";
	$result = mysql_query($insertStatement);

	$message = "";

	if(!$result) {
		$message = "Error in updating promo: $promo_code: ". mysql_error();
	} else {
		$message = "Promotion Successfully Updated for PromoCode: $promo_name.";
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

function recalculatePrice($amount, $type, $price) {
	if($type == "Dollar") {
		$price += $amount;
	} else {
		$price = ($price/(1-$amount));	// reapply percentage of original
	}
	return $price;
}

function calculatePrice($amount, $type, $p) {
	if($type == "Dollar") {
		$p -= $amount;
	} else {
		$p = ($p*(1-$amount));	// apply percentage of original
	}
	return $p;
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
