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
	$item_number =  mysql_real_escape_string($_POST['itemNumber']);
	$item_description =  mysql_real_escape_string($_POST['description']);
	$item_category =  mysql_real_escape_string($_POST['category']);
	$department_name =  mysql_real_escape_string($_POST['department']);
	$purchase_cost =  mysql_real_escape_string($_POST['cost']);
	$retail_price =  mysql_real_escape_string($_POST['price']);

	// append string
	$appendString="";

	// setup string
	if($item_number != '')			$appendString .= "ItemNumber='$item_number', ";
	if($item_description != '') $appendString .= "ItemDescription='$item_description', ";
	if($item_category != '') $appendString .= "Category='$item_category', ";
	if($department_name != '') $appendString .= "DepartmentName='$department_name', ";
	if($purchase_cost != '') $appendString .= "PurchaseCost='$purchase_cost', ";
	if($retail_price != '') $appendString .= "FullRetailPrice='$retail_price', ";

	$appendString = str_lreplace(",","",$appendString);
	// create the statement
	$insertStatement = "update Item set $appendString where ItemNumber='$item_number'";

	$result = mysql_query($insertStatement);

	// now to update promoitem if linked

	// first we grab the pre-existing entry and reapply amounts to the stored item values
	$statement_grabPromoCode = "select PromoCode from PromotionItem where ItemNumber='1234569'";
	$return_promoResult = mysql_query($statement_grabPromoCode);

	// first grab the promocodes
	if(mysql_num_rows($return_promoResult) > 0) {
		// the current schema only allows 1 promo to an item, thus only 1 promocode will actually be grabbed
		// this is "future proofing" it if multiple promos are to be added, half the work is done
		while($the_ro = mysql_fetch_assoc($return_promoResult)) {

			// get promocode
			$promo_code = $the_ro['PromoCode'];

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

					// adjust SalePrice to the new price
					$price = calculatePrice($myAmount, $myType, $retail_price);

					// new price achieved, now add it back into the Promotion Item database
					$update_statement = "update PromotionItem set SalePrice='$price' where ItemNumber='$item_number'";
					$update_result = mysql_query($update_statement);
				}
			}
		}
	}

	$message = "";

	if(!$result) {
		$message = "Error in updating Item: $item_number: ". mysql_error();
	} else {
		$message = "Item Successfully Updated for ItemNumber: $item_number.";
	}
	display_result_item($message);
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
