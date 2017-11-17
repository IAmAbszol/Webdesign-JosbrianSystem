<!--
  Adds the item to the specified promotionitem table
-->
<?php
require('server_connection.inc');

require('display_result.inc');

update_item_promotion();

function update_item_promotion() {

	// connect to the main database where the items are stored
	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
	$item_code 	= $_POST["itemCodeForPromo"];
	$promo_code	= $_POST["promoAddCheckbox"];

	// first grab promoitem to see if it exists prior into the table
	$question_there = "select PromoCode, ItemNumber from PromotionItem where PromoCode='$promo_code' AND ItemNumber='$item_code'";
	$question_result = mysql_query($question_there);

	if(mysql_num_rows($question_result) == 0) {

	  // grab item retail price via query
		$searchStatement = "select FullRetailPrice from Item where ItemNumber='$item_code'";
		$result_retail = mysql_query($searchStatement);

	  // grab promo discount via query, calculate
		$statement_getAmount = "select AmountOff, PromoType from Promotion where PromoCode='$promo_code'";
		$returnResult = mysql_query($statement_getAmount);

		$the_row = mysql_fetch_array($returnResult);
		$the_retail = mysql_fetch_array($result_retail);
		$myAmount = $the_row['AmountOff'];
		$myType 	= $the_row['PromoType'];
		$myPrice	= $the_retail['FullRetailPrice'];

		// apply discount, return value
		$grabbed_price = calculatePrice($myAmount, $myType, $myPrice);
		echo "<script type='text/javascript'>alert($grabbed_price);</script>";

	  // insert into promoitem
		$insertStatement = "insert PromotionItem (PromoCode, ItemNumber, SalePrice) values ( '$promo_code', '$item_code', '$grabbed_price')";
		$results = mysql_query($insertStatement);

		$message = "";

		if(!$results) {
			$message = "Error in inserting PromotionItem: $promo_code: ". mysql_error();
		} else {
			$message = "PromotionItem Successfully Added to Database PromoCode: $promo_code and ItemNumber: $item_code with a SalePrice: $grabbed_price.";
		}
		display_result_item($message);
	} else
		display_reuslt_item("Error in inserting PromotionItem: $promo_code. Item has been already linked into table.");

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

function calculatePrice($amount, $type, $price) {
	if($type == "Dollar") {
		$price -= $amount;
	} else {
		$price = ($price*$amount);	// apply percentage of original
	}
	return $price;
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
