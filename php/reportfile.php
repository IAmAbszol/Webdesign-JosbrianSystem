<?php
// used to generate reports

  require('server_connection.inc');

  function report_by_date($date) {
  	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  	$state_date = mysql_real_escape_string($date);
  	$searchStatement = "select AdEvent.EventCode,
  			    AdEvent.Name, AdEventPromotion.PromoCode, Promotion.Description from AdEvent,
  			    AdEventPromotion, Promotion where (AdEvent.EventCode = AdEventPromotion.EventCode)
                              AND (AdEventPromotion.PromoCode = Promotion.PromoCode) AND AdEvent.StartDate='$state_date'";
  	$result = mysql_query($searchStatement);
    return $result;
  }

  function report_by_price_off($amountOff, $promoType) {
    $amountOff = applyDecimal($amountOff);
  	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  	$amount_off = mysql_real_escape_string($amountOff);
  	$promo_type = mysql_real_escape_string($promoType);
  	$searchStatement = "select * from Promotion where amountOff = '$amount_off'
  			    AND promoType = '$promo_type'";
  	$result = mysql_query($searchStatement);
    return $result;
  }

  function report_by_item($item_number, $item_description, $item_category, $department_name) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    // append string
  	$appendString="";

    $item_number = mysql_real_escape_string($item_number);
    $item_description = mysql_real_escape_string($item_description);
    $item_category = mysql_real_escape_string($item_category);
    $department_name = mysql_real_escape_string($department_name);

  	// setup string search by item number OR the other components
  	if($item_number != '') 		{
      $appendString .= "Item.ItemNumber='$item_number' AND ";
    } else {
    	if($item_description != '') $appendString .= "Item.ItemDescription='$item_description' AND ";
    	if($item_category != '') $appendString .= "Item.Category='$item_category' AND ";
    	if($department_name != '') $appendString .= "Item.DepartmentName='$department_name' AND ";
    }

  	$appendString = str_lreplace("AND","",$appendString);
    // first line is setup, second line is table linkages, third line is more linkages
    $searchStatement = "select AdEvent.EventCode, AdEvent.Description, AdEvent.AdType, Item.ItemNumber, Item.FullRetailPrice, PromotionItem.SalePrice from AdEvent, AdEventPromotion, PromotionItem, Item where
                        (AdEvent.EventCode = AdEventPromotion.EventCode) AND (AdEventPromotion.PromoCode = PromotionItem.PromoCode) AND (PromotionItem.ItemNumber = Item.ItemNumber) AND
                        ($appendString) ORDER BY (Item.FullRetailPrice - PromotionItem.SalePrice) DESC LIMIT 1;";
    $result = mysql_query($searchStatement);
    return $result;
  }

  function report_top_sale_items() {
  	connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
  	$searchStatement = "select Item.ItemNumber, Item.FullRetailPrice,
  			    PromotionItem.SalePrice from Item, PromotionItem where
  			    (PromotionItem.ItemNumber = Item.ItemNumber)
  			    ORDER BY (Item.FullRetailPrice - PromotionItem.SalePrice) DESC LIMIT 50";
  	$result = mysql_query($searchStatement);
    return $result;
  }

  function applyDecimal($value) {
  	return number_format((float)$value, 2, '.', '');
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
