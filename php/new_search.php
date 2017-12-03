<?php
  require('server_connection.inc');

  function grab_linked_promotions_to_ad($id) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $new_id = mysql_real_escape_string($id);
    $searchStatement = "select * from AdEventPromotion where EventCode='$new_id'";
  //  echo "$id";
    $result = mysql_query($searchStatement);
    if(mysql_num_rows($result) > 0) {
      // now grab item info from Linked
      $item_search = "select Promotion.PromoCode, Promotion.Description from Promotion, AdEventPromotion where (AdEventPromotion.PromoCode = Promotion.PromoCode) AND AdEventPromotion.EventCode='$new_id';";
      $new_result = mysql_query($item_search);
      return $new_result;
    }
    return "no";
  }

  function grab_linked_promotions_to_item($id) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $new_id = mysql_real_escape_string($id);
    $searchStatement = "select * from PromotionItem where PromoCode='$new_id'";
    //echo "$id";
    $result = mysql_query($searchStatement);
    if(mysql_num_rows($result) > 0) {
      // now grab item info from Linked
      $item_search = "select Item.ItemNumber, Item.ItemDescription from Item, PromotionItem where (PromotionItem.ItemNumber = Item.ItemNumber) AND PromotionItem.PromoCode='$new_id';";
      $new_result = mysql_query($item_search);
      return $new_result;
    }
    return "no";
  }

  function grab_possible_promotion($id) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $new_id = mysql_real_escape_string($id);
    $searchStatement = "select SalePrice from PromotionItem where ItemNumber='$new_id'";
    //echo "$id";
    $result = mysql_query($searchStatement);
    if(mysql_num_rows($result) > 0) {
      $the_row = mysql_fetch_array($result);
      return $the_row['SalePrice'];
    }
    return "no";
  }

  function calculate_best_promotion_to_item($id) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $new_id = mysql_real_escape_string($id);
    $searchStatement = "select PromotionItem.SalePrice from Item, PromotionItem where
            (PromotionItem.ItemNumber = Item.ItemNumber) AND (PromotionItem.ItemNumber='$new_id')
            ORDER BY (Item.FullRetailPrice - PromotionItem.SalePrice) DESC LIMIT 1";
    //echo "$id";
    $result = mysql_query($searchStatement);
    if(mysql_num_rows($result) > 0) {
      $the_row = mysql_fetch_array($result);
      return $the_row['SalePrice'];
    }
    return "no";
  }

  // returns the linked promotion to that item if it exists
  function grab_linked_promotions($id) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $new_id = mysql_real_escape_string($id);
    $searchStatement = "select SalePrice from PromotionItem where ItemNumber='$new_id'";
    //echo "$id";
    $result = mysql_query($searchStatement);
    if(mysql_num_rows($result) > 0) {
      $the_row = mysql_fetch_array($result);
      return $the_row['PromoCode'];
    }
    return "no";
  }

  function grab_sql_adevent_all() {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $searchStatement = "select * from AdEvent";
    $result = mysql_query($searchStatement);

    return $result;
  }

  function grab_sql_promo_all() {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    $searchStatement = "select * from Promotion";
    $result = mysql_query($searchStatement);

    return $result;
  }

  function grab_sql_promo($promo_code, $promo_name, $promo_desc) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);

    $promo_code =  mysql_real_escape_string($promo_code);
    $promo_name =  mysql_real_escape_string($promo_name);
    $promo_desc =  mysql_real_escape_string($promo_desc);

    $appendString="";

    if($promo_name != '')     $appendString .= "Name='$promo_name' AND ";
    if($promo_code != '')     $appendString .= "PromoCode='$promo_code' AND ";
    if($promo_desc != '')     $appendString .= "Description='$promo_desc' AND ";

    $appendString = str_lreplace("AND","",$appendString);
    // create the statement
    $searchStatement = "select * from Promotion where $appendString";

    $result = mysql_query($searchStatement);
    $message = "";

    if(!$result) {
      $message = "Error in updating Item: $item_number: ". mysql_error();
    } else {
      $message = "Data for Item: $item_number.";
    }

    return $result;

  }

  function grab_sql($item_number, $item_description, $item_category, $department_name) {
    connect_to_db(DB_SERVER, DB_UN, DB_PWD, DB_NAME);
    // append string
  	$appendString="";

    $item_number = mysql_real_escape_string($item_number);
    $item_description = mysql_real_escape_string($item_description);
    $item_category = mysql_real_escape_string($item_category);
    $department_name = mysql_real_escape_string($department_name);

  	// setup string
  	if($item_number != '') 		$appendString .= "ItemNumber='$item_number' AND ";
  	if($item_description != '') $appendString .= "ItemDescription='$item_description' AND ";
  	if($item_category != '') $appendString .= "Category='$item_category' AND ";
  	if($department_name != '') $appendString .= "DepartmentName='$department_name' AND ";

  	$appendString = str_lreplace("AND","",$appendString);
  	// create the statement
  	$searchStatement = "select * from Item where $appendString";

  	$result = mysql_query($searchStatement);
    $message = "";

  	if(!$result) {
  		$message = "Error in updating Item: $item_number: ". mysql_error();
  	} else {
  		$message = "Data for Item: $item_number.";
  	}

    return $result;

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
  		echo "Unable to connect to DB: " . mysql_error();
  			exit;
  	}
  	$dbh = mysql_select_db($dbname);
  	if(!$dbh) {
  		echo "Unable to select " .$dbname. ": " . mysql_error();
  		exit;
  	}
  }
 ?>
