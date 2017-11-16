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

	$promo_number = $_POST['promoCode'];
	$promo_description = $_POST['promoName'];
	$promo_category = $_POST['promoDesc'];
	$purchase_cost = $_POST['promoType'];
	$retail_price = $_POST['promoAmount'];

	// first we grab the pre-existing entry and reapply amounts to the stored item values
	$statement_getAmount = "select AmountOff, PromoType from Promotion where PromoCode='$promo_number'";
	$returnResult = mysql_query($statement_getAmount);

	// next we grab the PromotionItem table and reapply the sale price.
	// this is then recalculated after the edit has been made.
	// should've resulted in a 1 output query, any more then the schema must broken. Any less, we skip this step
	if(mysql_num_rows($returnResult) > 0) {
		$the_row = mysql_fetch_array($returnResult);
		$myAmount = $the_row['AmountOff'];
		$myType 	= $the_row['PromoType'];
		
		$statement_getSalePrice = "select SalePrice from PromotionItem where PromoCode='$promo_number'";
		$returnResultItem = mysql_query($statement_getSalePrice);

		$the_row_item = mysql_fetch_array($returnResultItem);
		$myPrice	= $the_row_item['SalePrice'];

		$price = recalculatePrice($myAmount, $myType, $myPrice);
	}

	// append string
	$appendString="";

	// setup string
	if($promo_number != '')			$appendString .= "PromoCode='$promo_number', ";
	if($promo_description != '') $appendString .= "Name='$promo_description', ";
	if($promo_category != '') $appendString .= "Description='$promo_category', ";
	if($purchase_cost != '') $appendString .= "PromoType='$purchase_cost', ";
	if($retail_price != '') $appendString .= "AmountOff='$retail_price', ";

	$appendString = str_lreplace(",","",$appendString);
	// create the statement
	$insertStatement = "update Promotion set $appendString where PromoCode='$promo_number';";
	$result = mysql_query($insertStatement);

	$message = "";

	if(!$result) {
		$message = "Error in updating promo: $promo_number: ". mysql_error();
	} else {
		$message = "Promotion Successfully Updated for PromoCode: $promo_description.";
	}

	// now we grab the PromotionItem table, check if the update
	// if price doesn't equal 0, were in the clear for processing the item associated
	if(price != 0) {

	}

	display_result($price);
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
		$price = ($price/$amount);	// reapply percentage of original
	}
	return $price;
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
