<?php
  require('server_connection.inc');

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

    $appendString="";

    if($promo_name != '')     $appendString .= "Name='$promo_name' AND ";
    if($promo_code != '')     $appendString .= "PromoCode='$promo_code' AND ";
    if($promo_desc != '')      $appendString .= "Description='$promo_desc' AND ";

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
